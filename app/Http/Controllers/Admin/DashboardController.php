<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Quote;
use App\Models\Ticket;
use App\Models\ContactMessage;
use App\Models\PortfolioProject;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_news' => News::count(),
            'pending_quotes' => Quote::where('status', 'pending')->count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_projects' => PortfolioProject::count(),
        ];

        $recent_quotes = Quote::with('service', 'user')
            ->latest()
            ->take(5)
            ->get();

        $recent_tickets = Ticket::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recent_quotes',
            'recent_tickets',
            'recent_users'
        ));
    }
}
