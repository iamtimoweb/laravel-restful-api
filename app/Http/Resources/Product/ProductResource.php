<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->details,
            'stock' => $this->stock === 0 ? 'Product is out of stock' : $this->stock,
            'price' => $this->price,
            'discount' => $this->discount,
            'Total Price' => round($this->price - ($this->price * $this->discount / 100), 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'There is no review yet for this product',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
