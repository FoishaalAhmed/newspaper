<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole(['Admin'])) {

            return redirect(route('admin.dashboard'));

        } else {

            return redirect(route('editor.dashboard'));
        }
    }
}
