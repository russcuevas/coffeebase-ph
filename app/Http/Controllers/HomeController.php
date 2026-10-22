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
