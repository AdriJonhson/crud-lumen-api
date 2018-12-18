<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 15:11
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'slug'      => $this->slug
        ];
    }
}