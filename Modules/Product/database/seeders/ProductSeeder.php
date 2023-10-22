<?php

namespace Modules\Product\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Brand\app\Models\Brand;
use Modules\Manufacturer\app\Models\Manufacturer;
use Modules\Product\app\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = database_path('data/goody_market_table_products.json');
        if (! file_exists($file) or ! $file = json_decode(file_get_contents($file), true)) {
            return;
        }

        foreach ($file['data'] as $item) {
            // Filter
            $product = Arr::only($item, [
                'name', 'subtitle', 'slug',
            ]);

            // Brand
            if (Arr::has($item, ['brand'])) {
                $brand_id = ($x = Brand::where('name', $item['brand'])
                    ->orWhere('slug', $item['brand'])->value('id')) ? $x : null;

                if ($brand_id) {
                    $product = Arr::add($product, 'brand_id', $brand_id);
                }
            }

            // Manufacturer
            if (Arr::has($item, ['manufacturer'])) {
                $manufacturer_id = ($x = Manufacturer::where('name', $item['manufacturer'])
                    ->orWhere('slug', $item['manufacturer'])->value('id')) ? $x : null;

                if ($manufacturer_id) {
                    $product = Arr::add($product, 'manufacturer_id', $manufacturer_id);
                }
            }

            // dd($product);

            $exists = Product::where('name', $product['name']);
            if (Arr::has($product, ['brand'])) {
                $exists->where('brand_id', $product['brand_id']);
            }

            if (! $exists->count()) {
                Product::create($product);
            }
        }
    }
}
