<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Controllers\AuthController;
use Validator;

class categoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['']]);
    }
    public function readCategories(Request $request) {
        $categories = Categories::all(); 
        return $categories;
         
      }
    

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',                      
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
            // var_dump(response()->json(auth()->user()));
            $blog = Categories::create(array_merge(
                $validator->validated()
            ));
            return response()->json([
                'message' => 'Categories successfully created',
                'categories' => $blog
            ], 201); 
       
    }  

    public function delete(Request $request) {
        $id = $request->all()['id'];
         $Categories = Categories::destroy($id);
         return $Categories;
         
      }
 
}
