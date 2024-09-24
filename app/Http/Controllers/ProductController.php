<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        foreach (range(1, 1) as $key => $value) {
            $product = Product::firstOrCreate([
                'project_id' => 1,
                'wr_no' => '500',
            ], [
                'project_id' => 1,
                'wr_no' => '500',
                'name' => 'New',
            ]);
            dd($product->wasRecentlyCreated);
            $isNewProduct = is_null($product->wasRecentlyCreated);
        }
        return view('test');


    }
}
