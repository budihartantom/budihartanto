<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect authenticated users to their specific dashboards based on role.
     */
    public function index(): RedirectResponse
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            'client' => redirect()->route('client.dashboard'),
            default => redirect('/'),
        };
    }
}
