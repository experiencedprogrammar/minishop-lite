<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
          // Total users (customers only)
          $totalUsers = User::where('role', 'customer')->count();

          // Latest 10 orders
          $orders = Order::latest()->take(10)->get();
          $totalSales = Order::sum('total'); // Sum of all order totals
        
           // Total number of orders
           $totalOrders = Order::count();

           // Top 5 best-selling products
           $topProducts = OrderItem::select('product_id', \DB::raw('SUM(qty) as total_sold'))
           ->groupBy('product_id')
           ->orderByDesc('total_sold')
           ->with('product')
           ->take(5)
           ->get();
   
          // Revenue last 7 days
          $revenueLast7Days = Order::select(
               \DB::raw('DATE(created_at) as date'),
               \DB::raw('SUM(total) as total_revenue')
           )
           ->where('created_at', '>=', now()->subDays(7))
           ->groupBy('date')
           ->orderBy('date')
           ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'orders', 'totalSales', 'totalOrders',
             'topProducts', 'revenueLast7Days'));
    }
    public function logout(Request $request)
    {
        Auth::logout(); // logout the currently authenticated user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login'); // redirect to admin login page
    }
}
