<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index page.
     */
    public function index(): View
    {
        // Mock data for demonstration - in real app, this would come from database
        $kpis = [
            'total_bookings' => 12,
            'balance_due' => 1250.00,
            'upcoming_trips' => 3,
            'total_spent' => 8750.00,
        ];

        $recent_bookings = [
            [
                'id' => 'BK001',
                'tour' => 'Mystical Mountain Adventures',
                'date' => '2025-02-15',
                'status' => 'confirmed',
                'amount' => 2499.00,
            ],
            [
                'id' => 'BK002',
                'tour' => 'Tropical Paradise Escape',
                'date' => '2025-03-20',
                'status' => 'pending',
                'amount' => 3299.00,
            ],
            [
                'id' => 'BK003',
                'tour' => 'Cultural Heritage Journey',
                'date' => '2025-04-10',
                'status' => 'confirmed',
                'amount' => 1899.00,
            ],
        ];

        $upcoming_trips = [
            [
                'tour' => 'Mystical Mountain Adventures',
                'destination' => 'Swiss Alps',
                'start_date' => '2025-02-15',
                'end_date' => '2025-02-22',
                'status' => 'confirmed',
            ],
            [
                'tour' => 'Tropical Paradise Escape',
                'destination' => 'Maldives',
                'start_date' => '2025-03-20',
                'end_date' => '2025-03-25',
                'status' => 'pending',
            ],
        ];

        return view('dashboard.index', compact('kpis', 'recent_bookings', 'upcoming_trips'));
    }

    /**
     * Display the bookings page.
     */
    public function bookings(): View
    {
        $bookings = [
            [
                'id' => 'BK001',
                'tour' => 'Mystical Mountain Adventures',
                'destination' => 'Swiss Alps',
                'start_date' => '2025-02-15',
                'end_date' => '2025-02-22',
                'status' => 'confirmed',
                'amount' => 2499.00,
                'created_at' => '2025-01-10',
            ],
            [
                'id' => 'BK002',
                'tour' => 'Tropical Paradise Escape',
                'destination' => 'Maldives',
                'start_date' => '2025-03-20',
                'end_date' => '2025-03-25',
                'status' => 'pending',
                'amount' => 3299.00,
                'created_at' => '2025-01-12',
            ],
            [
                'id' => 'BK003',
                'tour' => 'Cultural Heritage Journey',
                'destination' => 'Kyoto, Japan',
                'start_date' => '2025-04-10',
                'end_date' => '2025-04-20',
                'status' => 'confirmed',
                'amount' => 1899.00,
                'created_at' => '2025-01-08',
            ],
            [
                'id' => 'BK004',
                'tour' => 'Safari Wildlife Experience',
                'destination' => 'Kenya',
                'start_date' => '2025-05-15',
                'end_date' => '2025-05-23',
                'status' => 'cancelled',
                'amount' => 2799.00,
                'created_at' => '2025-01-05',
            ],
        ];

        return view('dashboard.bookings.index', compact('bookings'));
    }

    /**
     * Display the itineraries page.
     */
    public function itineraries(): View
    {
        $itineraries = [
            [
                'id' => 1,
                'title' => 'Swiss Alps Adventure',
                'destination' => 'Swiss Alps',
                'duration' => '7 days',
                'status' => 'active',
                'created_at' => '2025-01-10',
                'last_updated' => '2025-01-15',
            ],
            [
                'id' => 2,
                'title' => 'Maldives Paradise',
                'destination' => 'Maldives',
                'duration' => '5 days',
                'status' => 'draft',
                'created_at' => '2025-01-12',
                'last_updated' => '2025-01-12',
            ],
            [
                'id' => 3,
                'title' => 'Japan Cultural Tour',
                'destination' => 'Kyoto, Japan',
                'duration' => '10 days',
                'status' => 'completed',
                'created_at' => '2024-12-20',
                'last_updated' => '2024-12-30',
            ],
        ];

        return view('dashboard.itineraries.index', compact('itineraries'));
    }

    /**
     * Display the messages page.
     */
    public function messages(): View
    {
        $messages = [
            [
                'id' => 1,
                'from' => 'Maria Rodriguez',
                'subject' => 'Swiss Alps Tour Details',
                'message' => 'Hi! I wanted to confirm the meeting point for our tour tomorrow...',
                'is_read' => false,
                'created_at' => '2025-01-15 10:30',
            ],
            [
                'id' => 2,
                'from' => 'THUFAYLONIA Support',
                'subject' => 'Payment Confirmation',
                'message' => 'Your payment for the Maldives tour has been processed successfully.',
                'is_read' => true,
                'created_at' => '2025-01-14 15:45',
            ],
            [
                'id' => 3,
                'from' => 'Hiroshi Tanaka',
                'subject' => 'Kyoto Tour Itinerary',
                'message' => 'Here is the updated itinerary for your Japan tour...',
                'is_read' => true,
                'created_at' => '2025-01-13 09:20',
            ],
        ];

        return view('dashboard.messages.index', compact('messages'));
    }

    /**
     * Display the payments page.
     */
    public function payments(): View
    {
        $payments = [
            [
                'id' => 'PAY001',
                'description' => 'Mystical Mountain Adventures',
                'amount' => 2499.00,
                'status' => 'completed',
                'method' => 'Credit Card',
                'date' => '2025-01-10',
            ],
            [
                'id' => 'PAY002',
                'description' => 'Tropical Paradise Escape',
                'amount' => 3299.00,
                'status' => 'pending',
                'method' => 'Credit Card',
                'date' => '2025-01-12',
            ],
            [
                'id' => 'PAY003',
                'description' => 'Cultural Heritage Journey',
                'amount' => 1899.00,
                'status' => 'completed',
                'method' => 'PayPal',
                'date' => '2025-01-08',
            ],
            [
                'id' => 'PAY004',
                'description' => 'Safari Wildlife Experience (Refund)',
                'amount' => -2799.00,
                'status' => 'completed',
                'method' => 'Credit Card',
                'date' => '2025-01-05',
            ],
        ];

        return view('dashboard.payments.index', compact('payments'));
    }

    /**
     * Display the profile edit page.
     */
    public function profile(): View
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }
}
