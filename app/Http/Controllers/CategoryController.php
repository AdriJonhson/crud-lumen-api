<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 15:07
 */

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Util\Util;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response(['categories' => CategoryResource::collection($categories)], 200);
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug'  => Util::slugGenerate($request->title)
        ]);

        $this->validate($request, [
            'title'          => 'required',
            'slug'          => 'required|unique:categories'
        ]);

        $category = Category::create($request->all());

        if($category){
            return response(['category' => $category, 'message' => 'Categoria registrada com sucesso'], 201);
        }

        return response(['message' => 'Erro no cadastrado da categoria']);
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($category == null){
            return response(['message' => 'Categoria não encontrada'], 405);
        }

        if($request->has('title') && $request->title != null){
            $request->merge([
                'slug'  => Util::slugGenerate($request->title)
            ]);

            $this->validate($request, [
                'slug'  => 'required|unique:categories,slug,'.$category->id
            ]);

        }

        $category->update($request->all());

        return response(['category' => $category, 'message' => 'Dados atualizados com sucesso'], 200);
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($category == null){
            return response(['message' => 'Categoria não encontrada'], 405);
        }

        $category->delete();

        return response(['message' => 'Dados removidos com sucesso'], 200);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->get();

        if(count($category) == 0){
            return response(['message' => 'Categoria não encontrada'], 403);
        }

        return response(['category' => CategoryResource::collection($category)], 200);
    }
}