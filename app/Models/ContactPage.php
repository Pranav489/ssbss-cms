<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'headquarters_title',
        'headquarters_address',
        'headquarters_phone',
        'headquarters_email',
        'headquarters_hours',
        'centers',
        'emergency_title',
        'child_helpline',
        'whatsapp_number',
        'emergency_email',
        'emergency_note',
        'form_title',
        'form_description',
        'general_form_title',
        'donation_form_title',
        'quick_actions',
        'map_title',
        'google_maps_embed',
        'coordinates',
        'is_active',
    ];

    protected $casts = [
        'centers' => 'array',
        'quick_actions' => 'array',
        'is_active' => 'boolean',
    ];

    // Singleton pattern
    public static function getContactPage()
    {
        return self::first() ?? new self();
    }

    // Available center icons
    public static function availableCenterIcons(): array
    {
        return [
            'Heart' => 'Heart',
            'Building' => 'Building',
            'Users' => 'Users',
            'Home' => 'Home',
            'Shield' => 'Shield',
            'BookOpen' => 'BookOpen',
            'MedicalCross' => 'MedicalCross',
            'Phone' => 'Phone',
            'Mail' => 'Mail',
            'MapPin' => 'MapPin',
        ];
    }

    // Available quick action icons
    public static function availableActionIcons(): array
    {
        return [
            'MessageSquare' => 'MessageSquare',
            'Phone' => 'Phone',
            'Mail' => 'Mail',
            'Whatsapp' => 'MessageSquare', // Using MessageSquare as WhatsApp
            'ExternalLink' => 'ExternalLink',
            'Calendar' => 'Calendar',
            'Download' => 'Download',
            'FileText' => 'FileText',
        ];
    }

    // Available action types
    public static function availableActionTypes(): array
    {
        return [
            'whatsapp' => 'WhatsApp',
            'phone' => 'Phone Call',
            'email' => 'Email',
            'link' => 'External Link',
            'download' => 'File Download',
        ];
    }

    // Generate WhatsApp link
    public function getWhatsappLinkAttribute(): string
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $this->whatsapp_number);
        return "https://wa.me/{$cleanNumber}";
    }

    // Generate phone link
    public function getPhoneLinkAttribute(): string
    {
        $cleanNumber = preg_replace('/[^0-9+]/', '', $this->headquarters_phone);
        return "tel:{$cleanNumber}";
    }

    // Generate child helpline link
    public function getHelplineLinkAttribute(): string
    {
        return "tel:{$this->child_helpline}";
    }
}