<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'image' => $this->image,
            'description' => $this->description,
            'export_price' => $this->export_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function with($request)
    {
        return [
            'pagination' => [
                'current_page' => $this->collection->currentPage(),
                'total_pages' => $this->collection->lastPage(),
                'total_products' => $this->collection->total(),
            ],
        ];
    }
}
