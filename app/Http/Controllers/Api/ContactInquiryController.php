<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactInquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:general,donation,volunteer,partnership,feedback,complaint,other',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'donation_type' => 'required_if:type,donation|nullable|in:one-time,monthly,sponsorship,in-kind',
            'amount' => 'nullable|numeric|min:0',
            'purpose' => 'required_if:type,donation|nullable|in:general,shelter,adoption,outreach,education,medical,infrastructure,nutrition',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $inquiry = ContactInquiry::create([
                'type' => $request->type,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'donation_type' => $request->donation_type,
                'amount' => $request->amount,
                'purpose' => $request->purpose,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => $request->except(['name', 'email', 'phone', 'subject', 'message', 'donation_type', 'amount', 'purpose']),
            ]);

            // Here you can add email notification logic
            // $this->sendNotificationEmail($inquiry);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry. We will contact you soon.',
                'data' => [
                    'id' => $inquiry->id,
                    'type' => $inquiry->type,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Contact inquiry submission failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your inquiry. Please try again.'
            ], 500);
        }
    }
    
    // Optional: Get inquiry statistics for dashboard
    public function stats()
    {
        $total = ContactInquiry::count();
        $pending = ContactInquiry::where('status', 'pending')->count();
        $donationInquiries = ContactInquiry::where('type', 'donation')->count();
        $today = ContactInquiry::whereDate('created_at', today())->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'pending' => $pending,
                'donation_inquiries' => $donationInquiries,
                'today' => $today,
            ]
        ]);
    }
}