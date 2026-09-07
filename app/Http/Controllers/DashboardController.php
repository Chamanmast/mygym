<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //  return redirect()->route('instructor.dashboard');
        //dd($request->user()->role);
           $role = $request->user()->role;
       return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'user' => redirect()->route('member.dashboard'),
            'instructor' => redirect()->route('instructor.dashboard'),
            'member' => redirect()->route('member.dashboard'),
            default => abort(403, 'Unauthorized action.'),
        };
    }
}
