<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $contactPage = ContactPage::where('is_active', true)->first();
        
        if (!$contactPage) {
            return response()->json([
                'success' => false,
                'message' => 'Contact page not found'
            ], 404);
        }
        
        $data = [
            'headquarters' => [
                'title' => $contactPage->headquarters_title,
                'address' => $contactPage->headquarters_address,
                'phone' => $contactPage->headquarters_phone,
                'email' => $contactPage->headquarters_email,
                'hours' => $contactPage->headquarters_hours,
            ],
            'centers' => $contactPage->centers ?? [],
            'emergency' => [
                'title' => $contactPage->emergency_title,
                'child_helpline' => $contactPage->child_helpline,
                'whatsapp_number' => $contactPage->whatsapp_number,
                'email' => $contactPage->emergency_email,
                'note' => $contactPage->emergency_note,
                'whatsapp_link' => $contactPage->whatsapp_link,
                'helpline_link' => $contactPage->helpline_link,
                'phone_link' => $contactPage->phone_link,
            ],
            'form' => [
                'title' => $contactPage->form_title,
                'description' => $contactPage->form_description,
                'general_title' => $contactPage->general_form_title,
                'donation_title' => $contactPage->donation_form_title,
            ],
            'quick_actions' => $contactPage->quick_actions ?? [],
            'map' => [
                'title' => $contactPage->map_title,
                'embed_code' => $contactPage->google_maps_embed,
                'coordinates' => $contactPage->coordinates,
            ],
            'form_options' => [
                'donation_types' => \App\Models\ContactInquiry::availableDonationTypes(),
                'donation_purposes' => \App\Models\ContactInquiry::availablePurposes(),
                'inquiry_types' => \App\Models\ContactInquiry::availableTypes(),
            ],
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}