<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Quote;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'news' => News::count(),
            'faqs' => Faq::count(),
            'services' => Service::count(),
            'portfolio' => Portfolio::count(),
            'quotes' => Quote::count(),
            'contact_messages' => ContactMessage::count(),
        ];

        $pending = [
            'new_quotes' => Quote::where('status', 'pending')->count(),
            'new_contacts' => ContactMessage::where('is_read', false)->count(),
            'draft_news' => News::where('is_published', false)->count(),
        ];

        $recent = [
            'quotes' => Quote::with(['service'])
                            ->latest()
                            ->take(5)
                            ->get(),
            'contacts' => ContactMessage::latest()
                                        ->take(5)
                                        ->get(),
            'news' => News::with('author')
                          ->latest()
                          ->take(5)
                          ->get(),
        ];

        $charts = [
            'quotes_by_status' => [
                'pending' => Quote::where('status', 'pending')->count(),
                'reviewed' => Quote::where('status', 'reviewed')->count(),
                'approved' => Quote::where('status', 'approved')->count(),
                'rejected' => Quote::where('status', 'rejected')->count(),
            ],
        ];

        return view('admin.dashboard', compact('stats', 'pending', 'recent', 'charts'));
    }
}
