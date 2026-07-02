<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $tab = request('tab', 'pending'); // デフォルトは承認待ち

        $applications = Application::with('user')
            ->where('status', $tab)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.application.index', compact('applications', 'tab'));
    }
}
