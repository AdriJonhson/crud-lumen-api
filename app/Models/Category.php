<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 14:26
 */

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title', 'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}