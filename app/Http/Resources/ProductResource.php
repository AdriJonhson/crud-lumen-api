<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 14:50
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'slug'      => $this->slug,
            'price'     => $this->price,
            'quantity'  => $this->quantity,
            'category'  => $this->category->title
        ];
    }
}