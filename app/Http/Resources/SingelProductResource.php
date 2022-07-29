<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingelProductResource extends JsonResource
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
            'product_name' => $this->name,
            'dicsounted_price' => $this->dicsounted_price,
            'slug ' => $this->slug ,
            'pro_thumbnail_photo' => $this->pro_thumbnail_photo,
        ];

    }
}
