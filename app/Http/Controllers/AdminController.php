<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'webService'])->orderBy('created_at', 'desc')->get();
        $courses = Course::withCount('lessons')->get();
        
        $totalStudents = User::where('role', 'student')->count();
        $totalClients = User::where('role', 'client')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');

        return view('admin.dashboard', compact('orders', 'courses', 'totalStudents', 'totalClients', 'totalRevenue'));
    }

    public function updateOrderStatus(Order $order, Request $request): RedirectResponse
    {
        $request->validate([
            'project_status' => ['required', 'in:pending,designing,developing,completed'],
            'payment_status' => ['required', 'in:pending,paid,cancelled'],
        ]);

        $order->update([
            'project_status' => $request->project_status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Status order berhasil diperbarui.');
    }
}
