<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $roleId = $user->role_id;

        // Determine filters from query parameters (default is today for sales and revenue, this year for customers)
        $salesRevenueFilter = request('sales_revenue_filter', 'today');
        $customersFilter = request('customers_filter', 'this_year');

        // Define time ranges
        $dateRanges = [
            'today' => Carbon::today(),
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->startOfYear(),
            'last_year' => Carbon::now()->subYear()->startOfYear(),
        ];

        // Filters for sales and revenue
        $salesStartDate = $dateRanges[$salesRevenueFilter] ?? Carbon::today();

        // Filters for customers
        $customersStartDate = $dateRanges[$customersFilter] ?? Carbon::now()->startOfYear();

        // Super admin logic
        if ($roleId == 3) {
            $salesToday = Booking::whereDate('created_at', '>=', $salesStartDate)->count();
            $revenueToday = Booking::whereDate('created_at', '>=', $salesStartDate)->sum('total_price');
            $customersThisYear = User::whereDate('created_at', '>=', $customersStartDate)->count();
        } else {
            $salesToday = Booking::whereDate('created_at', '>=', $salesStartDate)
                ->where('user_id', $user->id)
                ->count();
            $revenueToday = Booking::whereDate('created_at', '>=', $salesStartDate)
                ->where('user_id', $user->id)
                ->sum('total_price');
            $customersThisYear = User::whereDate('created_at', '>=', $customersStartDate)
                ->where('role_id', 2)
                ->count();
        }

        // Data for chart and recent activities remains unchanged
        // For the report chart (last week data)
        $salesData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as sales'))
            ->whereDate('created_at', '>=', Carbon::now()->subWeek())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('sales', 'date')->toArray();

        $revenueData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_price) as revenue'))
            ->whereDate('created_at', '>=', Carbon::now()->subWeek())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('revenue', 'date')->toArray();

        $customersData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as customers'))
            ->whereDate('created_at', '>=', Carbon::now()->subWeek())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('customers', 'date')->toArray();

        // Fetch recent activities (for all companies or filtered by company for non-admin users)
        $recentActivities = $roleId == 3
            ? Booking::with('user', 'tour')
                ->orderBy('created_at', 'desc')
                ->take(12)
                ->get()
            : Booking::with('user', 'tour')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

        // Pass the data to the view
        return view('admin_dashboard', compact(
            'salesToday',
            'revenueToday',
            'customersThisYear',
            'salesData',
            'revenueData',
            'customersData',
            'recentActivities',
            'salesRevenueFilter',
            'customersFilter'
        ));
    }
}