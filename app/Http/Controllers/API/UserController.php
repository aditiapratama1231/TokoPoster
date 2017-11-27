<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller{

    protected $responseController;
    public function __construct(ResponseController $responseController){
        $this->response = $responseController;
    }

    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $data['access_token'] = $user->createToken('access_token')->accessToken;
            $data['firstname'] = $user->firstname;
            $data['lastname'] = $user->lastname;
            $data['username'] = $user->username;
            $data['email'] = $user->email;
            return $this->response->send_success_api($data, 'Login success');
        }else{
            return $this->response->send_error_api(null, 'Unauthorized');
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()){
            return $this->response->send_error_api($validator->errors(), 'Data required');
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['access_token'] = $user->createToken('access_token')->accessToken;
        $data['firstname'] = $user->firstname;
        $data['lastname'] = $user->lastname;
        $data['username'] = $user->username;
        $data['email'] = $user->email;
        return $this->response->send_success_api($data, 'Register Complete');
    }

    public function profile(){
        $data = Auth::user();
        return $this->response->send_success_api($data, 'Data retrieved successfully');
    }
}