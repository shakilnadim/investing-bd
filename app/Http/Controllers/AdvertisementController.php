<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    public function index() : View
    {
        $advertisements = Advertisement::all();
        return view('admin.advertisements.index', compact('advertisements'));
    }

    public function edit(Advertisement $advertisement) : View
    {
        return view('admin.advertisements.edit', compact('advertisement'));
    }

    public function update(AdvertisementRequest $request, Advertisement $advertisement) : RedirectResponse
    {
        dd($advertisement);
    }

    public function updateStatus(Advertisement $advertisement)
    {}

    public function delete(Advertisement $advertisement)
    {}
}
