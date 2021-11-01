<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    public function __construct(private AdvertisementService $advertisementService)
    {
    }

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
        $this->advertisementService->updateAd($advertisement, $request->validated());
        return redirect()->route('admin.advertisements')->with('success', 'Advertisement updated successfully!');
    }

    public function updateStatus(Advertisement $advertisement)
    {}

    public function delete(Advertisement $advertisement)
    {}
}
