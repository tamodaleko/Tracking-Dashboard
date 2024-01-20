<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campaign\UpdateCampaignProductRequest;
use App\Models\Campaign\Campaign;
use Illuminate\Http\RedirectResponse;

class CampaignsController extends Controller
{
    public function updateProduct(Campaign $campaign, UpdateCampaignProductRequest $request): RedirectResponse
    {
        $campaign->update(['product_id' => $request->product_id]);

        return redirect()->route('dashboard.index')
                ->withSuccess('Proizvod je uspešno povezan sa kampanjom.');
    }
}
