<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquiry extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'donation_type',
        'amount',
        'purpose',
        'status',
        'admin_notes',
        'assigned_to',
        'ip_address',
        'user_agent',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    // Available inquiry types
    public static function availableTypes(): array
    {
        return [
            'general' => 'General Inquiry',
            'donation' => 'Donation Inquiry',
            'volunteer' => 'Volunteer Application',
            'partnership' => 'Partnership Request',
            'feedback' => 'Feedback',
            'complaint' => 'Complaint',
            'other' => 'Other',
        ];
    }

    // Available donation types
    public static function availableDonationTypes(): array
    {
        return [
            'one-time' => 'One-time Donation',
            'monthly' => 'Monthly Donation',
            'sponsorship' => 'Child Sponsorship',
            'in-kind' => 'In-kind Donation',
        ];
    }

    // Available donation purposes
    public static function availablePurposes(): array
    {
        return [
            'general' => 'General Fund',
            'shelter' => 'Shelter Home Support',
            'adoption' => 'Adoption Program',
            'outreach' => 'Street Children Outreach',
            'education' => 'Education Support',
            'medical' => 'Medical Care',
            'infrastructure' => 'Infrastructure Development',
            'nutrition' => 'Nutrition Program',
        ];
    }

    // Available statuses
    public static function availableStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'contacted' => 'Contacted',
            'resolved' => 'Resolved',
            'spam' => 'Spam',
        ];
    }

    // Relationships
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDonation($query)
    {
        return $query->where('type', 'donation');
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Accessors
    public function getFormattedAmountAttribute(): string
    {
        if ($this->amount) {
            return '₹' . number_format($this->amount, 2);
        }
        return 'N/A';
    }

    public function getFormattedTypeAttribute(): string
    {
        return self::availableTypes()[$this->type] ?? $this->type;
    }

    public function getFormattedDonationTypeAttribute(): string
    {
        if ($this->donation_type) {
            return self::availableDonationTypes()[$this->donation_type] ?? $this->donation_type;
        }
        return 'N/A';
    }

    public function getFormattedPurposeAttribute(): string
    {
        if ($this->purpose) {
            return self::availablePurposes()[$this->purpose] ?? $this->purpose;
        }
        return 'N/A';
    }

    public function getFormattedStatusAttribute(): string
    {
        return self::availableStatuses()[$this->status] ?? $this->status;
    }

    // Get email link
    public function getEmailLinkAttribute(): string
    {
        return "mailto:{$this->email}";
    }

    // Get phone link
    public function getPhoneLinkAttribute(): string
    {
        $cleanNumber = preg_replace('/[^0-9+]/', '', $this->phone);
        return "tel:{$cleanNumber}";
    }
}