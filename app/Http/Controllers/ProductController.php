<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 14:40
 */

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Util\Util;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response(['products' => ProductResource::collection($products)], 200);
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug'  => Util::slugGenerate($request->name)
        ]);

        $this->validate($request, [
            'name'          => 'required',
            'category_id'   => 'required',
            'price'         => 'required',
            'quantity'      => 'required',
            'slug'          => 'required|unique:products'
        ]);

        $product = Product::create($request->all());

        if($product){
            return response(['product' => $product, 'message' => 'Produto cadastrado com sucesso'], 201);
        }

        return response(['message' => 'Erro ao cadastrar o produto'], 404);
    }

    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if($product == null){
            return response(['message' => 'Produto não encontrado'], 405);
        }

        if($request->has('name') && $request->name != null){
            $request->merge([
                'slug'  => Util::slugGenerate($request->name)
            ]);

            $this->validate($request, [
                'slug'  => 'required|unique:products,slug,'.$product->id
            ]);

        }

        $product->update($request->all());

        return response(['product' => $product, 'message' => 'Dados atualizados com sucesso'], 200);
    }

    public function delete($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if($product == null){
            return response(['message' => 'Produto não encontrado'], 405);
        }

        $product->delete();

        return response(['message' => 'Dados removidos com sucesso'], 200);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->get();

        if(count($product) == 0){
            return response(['message' => 'Produto não encontrado'], 404);
        }

        return response(['product' => ProductResource::collection($product)], 200);
    }
}