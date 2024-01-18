<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateCompanyKeysRequest;
use App\Models\Product;
use App\Services\SPService;
use Exception;
use Illuminate\Http\RedirectResponse;

class CompaniesController extends Controller
{
    public function updateKeys(UpdateCompanyKeysRequest $request): RedirectResponse
    {
        try {
            $products = (new SPService($request->sp_api_key))->getProducts();
        } catch (Exception $e) {
            return redirect()->route('dashboard.index')
                ->withError('Slanje paketa nije moguće povezati. Proveri da li je API key ispravan.');
        }

        if (!isset($products['totalCount']) || !$products['totalCount'] || !isset($products['data'])) {
            return redirect()->route('dashboard.index')
                ->withError('Slanje paketa nije moguće povezati. Proizvodi nisu pronadjeni.');
        }
        
        $request->user()->company->update(['sp_api_key' => $request->sp_api_key]);

        foreach ($products['data'] as $product) {
            Product::create([
                'company_id' => $request->user()->company->id,
                'sp_id' => $product['_id'],
                'code' => $product['code'],
                'name' => $product['name'],
                'url' => $product['url'],
                'image' => $product['image'],
                'selling_price' => $product['selling_price'],
                'qty_warehouse' => $product['temporary_quantity']['warehouse'],
                'qty_sending' => $product['temporary_quantity']['for_sending']
            ]);
        }

        return redirect()->route('products.index')
                ->withSuccess('Tvoj nalog je uspešno povezan. Potrebno je da izmeniš kupovne cene proizvoda.');
    }
}
