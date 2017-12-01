<?php

namespace App\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'description' => $order->description,
            'status' => $order->status,
            'created_at' => $order->created_at->toFormattedDateString(),
            'updated_at' => $order->updated_at->toFormattedDateString(),
            'item' => $order->products,
        ];
    }
}
