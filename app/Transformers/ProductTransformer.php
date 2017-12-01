<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'category_id' => $product->category_id,
            'description' => $product->description,
            'image' => $product->image,
            'created_at' => $product->created_at->toFormattedDateString(),
            'updated_at' => $product->updated_at->toFormattedDateString(),
        ];
    }
}
