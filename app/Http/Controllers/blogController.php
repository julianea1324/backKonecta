<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Controllers\AuthController;
use Validator;
use Illuminate\Support\Facades\DB;

class blogController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['']]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_category' => 'required',
            'id_user' => 'required',
            'name' => 'required|string|between:2,100',
            'slug' => 'required|string|between:2,100',
            'short_text' => 'required|string|between:2,200',
            'long_text' => 'required|string|between:2,1500',
            'image' => 'required|string|between:2,100',           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
            // var_dump(response()->json(auth()->user()));
            $blog = Blog::create(array_merge(
                $validator->validated()
            ));
            return response()->json([
                'message' => 'blog successfully created',
                'blog' => $blog
            ], 201); 
       
    }

    
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',           
            'short_text' => 'required|string|between:1,200',
            'long_text' => 'required|string|between:1,1500', 
            'name' => 'required|string|between:1,100',                   
        ]);
        $arr = $validator->validated();
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }      

           
            $blog = Blog::where('id', $arr['id']) ->update([
                'short_text' => $arr['short_text'],
                'long_text'=> $arr['long_text'],
                'name' => $arr['name']
            ]);
           
            return response()->json([
                'message' => 'blog successfully created',
                'blog' => $blog
            ], 201); 
       
    }
    public function read(Request $request) {


        $post = DB::table('blogs')
        ->join('categories', 'blogs.id_category', '=', 'categories.id')
        ->join('users', 'blogs.id_user', '=', 'users.id')
        ->select('blogs.*', 'categories.name as category','users.name as user')
        ->get();
        // $post = Blog::all(); 
        // var_dump($post);
        
        return $post;
        
     }
     

     public function readOne(Request $request) {
        $id = $request->all()['id'];
         $post = Blog::find($id);
         return $post;
         
      }

      public function delete(Request $request) {
        $id = $request->all()['id'];
         $post = Blog::destroy($id);
         return $post;
         
      }
      
}
