<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 14:25
 */

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    protected $table = 'products';

    protected $fillable = [
        'category_id', 'name', 'slug', 'price', 'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}