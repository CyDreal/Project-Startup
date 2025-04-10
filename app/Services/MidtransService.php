<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Config;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        MidtransConfig::$serverKey = config('services.midtrans.server_key');
        MidtransConfig::$clientKey = config('services.midtrans.client_key');
        MidtransConfig::$isProduction = config('services.midtrans.is_production', false);
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }

    public function createTransaction(Booking $booking)
    {
        // Ensure relationships are loaded
        $booking->loadMissing(['customer', 'bus']);

        // Get related data safely
        $customer = $booking->getRelation('customer');
        $bus = $booking->getRelation('bus');

        // Generate unique order ID with timestamp
        $uniqueOrderId = sprintf('BOOKING-%d-%s', $booking->getKey(), time());

        $params = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId,
                'gross_amount' => (int) $booking->getAttribute('total_amount'),
            ],
            'customer_details' => [
                'first_name' => $customer?->getAttribute('name') ?? 'Unknown',
                'email' => $customer?->getAttribute('email') ?? 'unknown@example.com',
                'phone' => $customer?->getAttribute('phone') ?? '-',
            ],
            'item_details' => [
                [
                    'id' => $booking->getAttribute('bus_id'),
                    'price' => (int) $booking->getAttribute('total_amount'),
                    'quantity' => 1,
                    'name' => "Bus Booking - " . ($bus?->getAttribute('name') ?? 'Unknown Bus'),
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return [
                'success' => true,
                'token' => $snapToken,
                'order_id' => $uniqueOrderId,
                'message' => 'Success generate snap token',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ];
        }
    }
}
