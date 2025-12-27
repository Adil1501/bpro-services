<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
                          ->orderBy('order')
                          ->get();

        return view('frontend.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }

        return view('frontend.services.show', compact('service'));
    }
}
