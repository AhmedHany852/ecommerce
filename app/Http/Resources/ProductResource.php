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
            'name' => $this->name,
            'price' => [
                'normal' => $this->price,
                'compare' => $this->compare_price,
            ],
            'description' => $this->description,
            'image' => $this->image,
            'relations' => [
                'category' => [
                    'id' => $this->categore->id,
                    'name' => $this->categore->name
                ],
                'store' => [
                    'id' => $this->store->id,
                    'name' => $this->store->name
                ],
            ]




        ];
    }
}
