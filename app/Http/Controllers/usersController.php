<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Validator;
use Illuminate\Support\Facades\DB;

class usersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['']]);
    } 

    
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required',           
            'user_type' => 'required',
            'phone' => 'required',                               
        ]);
        $arr = $validator->validated();
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        } 
     
            $user = User::where('id', $arr['id']) ->update([
                'email' => $arr['email'],
                'user_type'=> $arr['user_type'],
                'phone' => $arr['phone']
            ]);
           
            return response()->json([
                'message' => 'user successfully update',
                'user' => $user
            ], 201); 
       
    }
    public function read(Request $request) {


        $user = User::all(); 
        // var_dump($post);        
        return $user;
        
     }
     

     public function readOne(Request $request) {
        $id = $request->all()['id'];
         $user = User::find($id);
         return $user;
         
      }

      public function delete(Request $request) {
        $id = $request->all()['id'];
         $user = User::destroy($id);
         return $user;         
      }
      
}
