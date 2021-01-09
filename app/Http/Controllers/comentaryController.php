<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentary;
use App\Http\Controllers\AuthController;
use Validator;
use Illuminate\Support\Facades\DB;

class comentaryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['']]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_post' => 'required',
            'id_user' => 'required',
            'long_text' => 'required|between:1,1500',
            'userName' =>'required'
                      
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
            // var_dump(response()->json(auth()->user()));
            $blog = Commentary::create(array_merge(
                $validator->validated()
            ));
            return response()->json([
                'message' => 'commentarie successfully created',
                'commentaries' => $blog
            ], 201); 
       
    }  
   
     public function readCommentaries(Request $request) {
        $id = $request->all()['id'];
        $post = DB::table('commentaries')        
        // ->join('users', 'commentaries.id_user', '=', 'users.id')
        ->join('blogs','blogs.id','=','commentaries.id_post')
        ->select('commentaries.*', 'blogs.id as idPost')
        ->where('commentaries.id_post',$id)
        ->get();
         return $post;
         
      }

      public function delete(Request $request) {
        $id = $request->all()['id'];
         $Commentary = Commentary::destroy($id);
         return $Commentary;
         
      }
}
