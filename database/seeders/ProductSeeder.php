<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\SPService;
use Exception;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): bool
    {
        Product::whereNotNull('id')->delete();

        try {
            $products = (new SPService)->getProducts();
        } catch (Exception $e) {
            exit('Molimo Vas proverite SP integraciju.');
        }

        if (!isset($products['data']) || !$products['data']) {
            exit('Nemate dostupnih proizvoda.');
        }

        foreach ($products['data'] as $product) {
            Product::create([
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
