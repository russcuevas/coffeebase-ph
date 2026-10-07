<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_phone',
        'company',
        'country',
        'address',
        'apartment',
        'barangay',
        'city',
        'postal_code',
        'region',
        'subtotal',
        'shipping_fee',
        'total_amount',
        'payment_method',
        'payment_status',
        'payment_reference',
        'status',
        'tracking_courier',
        'tracking_link',
        'customer_notes',
        'admin_notes',
        'preparing_at',
        'out_for_delivery_at',
        'delivered_at',
        'cancelled_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'preparing_at' => 'datetime',
        'out_for_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getCustomerFullNameAttribute()
    {
        return trim("{$this->customer_first_name} {$this->customer_last_name}");
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->apartment,
            $this->barangay,
            $this->city,
            $this->postal_code,
            $this->region,
            $this->country,
        ]);
        return implode(', ', $parts);
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'preparing' => 'bg-blue-100 text-blue-800 border-blue-300',
            'out_for_delivery' => 'bg-purple-100 text-purple-800 border-purple-300',
            'delivered' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-stone-100 text-stone-800 border-stone-300',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Confirmation',
            'preparing' => 'Preparing your order',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered / Completed',
            'cancelled' => 'Order Cancelled',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }
}
