<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Product;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProducts = Product::with(['category', 'variants'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();
        
        $allProducts = Product::with(['category', 'variants'])
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact('categories', 'featuredProducts', 'allProducts'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        // 1. Silent Honeypot anti-spam check (catches bots that fill every input)
        if (!empty($request->input('_hp_website'))) {
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        // 2. Time-trap & Scraper Check:
        // Real users load the page and take > 3s to submit.
        // Direct curl / XRumer bot scripts that don't load the form or submit in < 3s get dropped.
        $formTime = $request->input('_form_time');
        if (!$formTime) {
            // Direct POST request without rendering the blade form
            Log::info('Spam bot blocked (Missing _form_time): ' . ($request->input('email') ?? 'unknown'));
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        try {
            $timestamp = decrypt($formTime);
            if ((time() - (int)$timestamp) < 3) {
                // Submitted inhumanly fast (< 3 seconds)
                Log::info('Spam bot blocked (Submitted too fast): ' . ($request->input('email') ?? 'unknown'));
                return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
            }
        } catch (\Throwable $e) {
            // Invalid encrypted token
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        // Combine inputs to scan for spam patterns
        $textToScan = ($request->input('name') ?? '') . ' ' . 
                      ($request->input('email') ?? '') . ' ' . 
                      ($request->input('comment') ?? '');

        // 3. Block Cyrillic / Russian characters (Targeting "Вам перевод ... руб" spam network)
        if (preg_match('/[\p{Cyrillic}]/u', $textToScan)) {
            Log::info('Spam bot blocked (Cyrillic detected): ' . ($request->input('email') ?? 'unknown'));
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        // 4. Block Spam Keywords (Russian wire scam phrases, telegram/crypto spam)
        if (preg_match('/(руб|перевод|получить тут|забрать тут|fredm|telegram|casino)/iu', $textToScan)) {
            Log::info('Spam bot blocked (Keyword pattern): ' . ($request->input('email') ?? 'unknown'));
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        // 5. Block known bot names
        if (strtolower(trim($request->input('name') ?? '')) === 'duchdula') {
            Log::info('Spam bot blocked (Known bot name duchdula)');
            return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'comment' => 'required|string|max:3000',
        ]);

        ContactMessage::create($validated);

        try {
            // Send inquiry notification to info@coffeebaseph.com
            Mail::send('emails.contact-inquiry', ['contact' => $validated], function ($m) use ($validated) {
                $m->to('info@coffeebaseph.com')
                  ->replyTo($validated['email'], $validated['name'])
                  ->subject('New Customer Inquiry: ' . $validated['name'] . ' | Coffee Base PH');
            });

            // Send confirmation acknowledgment to customer
            Mail::send('emails.contact-confirmation', ['contact' => $validated], function ($m) use ($validated) {
                $m->to($validated['email'], $validated['name'])
                  ->subject('We have received your message | COFFEE BASE Philippines');
            });
        } catch (\Throwable $e) {
            Log::error('Contact form email delivery error: ' . $e->getMessage());
        }

        return back()->with('success', 'Arigatou! Your message has been received. Our matcha team will get back to you shortly.');
    }

    public function stayConnected(Request $request)
    {
        // Silent Honeypot anti-spam check
        if (!empty($request->input('_hp_website'))) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for staying connected! We have sent a confirmation email to your inbox.',
                ]);
            }
            return back()->with('success', 'Thank you for staying connected! We have sent a confirmation email to your inbox.');
        }

        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        NewsletterSubscriber::firstOrCreate([
            'email' => strtolower(trim($validated['email'])),
        ]);

        try {
            Mail::send('emails.stay-connected', ['email' => $validated['email']], function ($m) use ($validated) {
                $m->to($validated['email'])
                  ->subject('Stay Connected with COFFEE BASE Philippines | Matcha Updates & New Arrivals');
            });
        } catch (\Throwable $e) {
            Log::error('Stay connected email delivery error: ' . $e->getMessage());
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for staying connected! We have sent a confirmation email to your inbox.',
            ]);
        }

        return back()->with('success', 'Thank you for staying connected! We have sent a confirmation email to your inbox.');
    }
}
