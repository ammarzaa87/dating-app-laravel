<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Models\User;
use JWTAuth;
use Auth;


class AuthController extends Controller{
	
	function login(Request $request){
		$data = $request->only("email", "password");

		try{
			if(!$token = JWTAuth::attempt($data)){
				return json_encode(["error" => "Invalid Credentials"]);
			}
		}catch(JWTException $e){
			return json_encode(["error" => "Error occured"]);
		}
		
		$user = Auth::user();
		$user->token = $token;
        if($user->user_type_id == 3) {
            return redirect()->route("index");
        }else {
            return redirect()->route("home");
        }
	}

}

?>