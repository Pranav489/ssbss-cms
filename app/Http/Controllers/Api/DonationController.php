<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationSetting;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Get active donation page settings
     */
    public function getDonationPage()
    {
        $donationSetting = DonationSetting::getActive();
        
        if (!$donationSetting) {
            return response()->json([
                'message' => 'No active donation page found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Donation page settings retrieved successfully',
            'data' => $donationSetting
        ]);
    }

}