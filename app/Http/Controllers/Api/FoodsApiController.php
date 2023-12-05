<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Foods;
use App\Http\Resources\FoodsResource;
	
	class FoodsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
	$foods = Foods::orderBy('name', 'ASC')->get();
	return FoodsResource::collection($foods);	
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $this->validate($request,[
        'name' => 'required|max:255',
        'calories' => 'required|max:255',
        'fat' => 'required|max:255',
        'carbs'=> 'max:255',
        'protein' => 'required|max:255',
        'iron' => 'required|max:255',] );

        $food = new Foods;
        $food->name = $request->name;
        $food->calories = $request->calories;
        $food->fat = $request->fat;
        $food->carbs = $request->carbs;
        $food->protein = $request->protein;
        $food->iron = $request->iron;
        $food->save();
        return new FoodsResource($food);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'calories' => 'required|max:255',
            'fat' => 'required|max:255',
            'carbs'=> 'max:255',
            'protein' => 'required|max:255',
            'iron' => 'required|max:255',] );
            
            $food = Foods::find($id);
            $food->name = $request->name;
            $food->calories = $request->calories;
            $food->fat = $request->fat;
            $food->carbs = $request->carbs;
            $food->protein = $request->protein;
            $food->iron = $request->iron;
            $food->save();
            return new FoodsResource($food);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Foods::find($id);
        $deleted = $food->delete();
        if ($deleted) {
            return response()->json(['message'=>'Successfully Deleted'],200);
        }
        else {
            return response()->json(['message'=>'Error occurred'],404);
        }
    }
}
