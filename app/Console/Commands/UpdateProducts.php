<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Product;
use App\Services\SPService;
use Illuminate\Console\Command;

class UpdateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            if (!$company->isSetUp('slanje_paketa')) {
                continue;
            }

            $products = (new SPService(trim($company->sp_api_key)))->getProducts();

            if (!isset($products['totalCount']) || !$products['totalCount'] || !isset($products['data'])) {
                return false;
            }

            foreach ($products['data'] as $product) {
                $existingProduct = Product::where('company_id', $company->id)
                    ->where('sp_id', $product['_id'])
                    ->first();

                if ($existingProduct) {
                    $existingProduct->update([
                        'selling_price' => $product['selling_price'],
                        'qty_warehouse' => $product['temporary_quantity']['warehouse'],
                        'qty_sending' => $product['temporary_quantity']['for_sending']
                    ]);
                    
                    continue;
                }
                
                Product::create([
                    'company_id' => $company->id,
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

            return true;
        }
    }
}
