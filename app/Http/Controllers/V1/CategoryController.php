<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{

	public function index()
	{
		return CategoryResource::collection(Category::all());
	}

	public function show(int $id)
	{
		$category = Category::findOrfail($id);

		return response()->json([new CategoryResource($category)], 200);
	}

	public function store(Request $request)
	{
		$category = Category::create([
			'name' => $request->name
		]);
		return response()->json(new CategoryResource($category), 201);
	}
}
