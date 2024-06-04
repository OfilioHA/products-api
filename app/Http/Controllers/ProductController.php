<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination = \App\Models\Product::select(['id', 'name'])
            ->simplePaginate(15);
        return response()->json($pagination);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'tags',
            'details.attributes'
        ]);

        $response = $product->getAttributes();
        $response['category'] = $product->category['name'];
        $response['tags'] = $product->tags->pluck('name');
        $attributes = $product->details->map(function ($item) {
            return $item->attributes->map(function ($subItem) {
                return [
                    $subItem->name => $subItem->pivot->value
                ];
            });
        });

        $temp = [];
        $attributes->each(function ($subarray) use (&$temp) {
            foreach ($subarray as $item) {
                foreach ($item as $key => $value) {
                    if (!isset($temp[$key])) {
                        $temp[$key] = [];
                    }
                    if (!in_array($value, $temp[$key])) {
                        $temp[$key][] = $value;
                    }
                }
            }
        });

        foreach ($temp as &$values) {
            sort($values);
        }

        $response['attributes'] = $temp;
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
