<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseController;
use App\Poster;
use App\User;
use App\Category;
use App\PosterImage;
use Illuminate\Support\Facades\Auth;
use Validator;

class PosterController extends Controller{
    
    protected $responseController;
    public function __construct(ResponseController $responseController){
        $this->response = $responseController;
    }

    public function index(){
        $data = Poster::with('category', 'poster_image')->paginate(6);
        return $this->response->send_success_api($data, 'Data retrieved successfully');
    }

    public function show($id){
        $data = Poster::with('category', 'poster_image')->find($id);
        if(!$data){
            return $this->response->send_error_api($data, 'Poster not found');
        }
        return $this->response->send_success_api($data, 'Poster retrieved successfully');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'poster_name' => 'required',
            'poster_image' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required'
        ]);
        if($validator->fails()){
            return $this->response->send_error_api($validator->errors(), 'Data required');
        }
        $data = array(
            'user_id' => Auth::user()->id,
            'poster_name' => $request->poster_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price
        );
        $poster = Poster::create($data);
        //upload image process
        $filename = $request->poster_image->store('public/posters');
        $poster_image = PosterImage::create([
            'poster_id' => $poster->id,
            'filename' => 'storage/'.$filename
        ]);
        $data['poster_image'] = $poster_image->filename;   
        if(!$poster && !$poster_image){
            return $this->response->send_error_api($data, 'Poster failed to create');
        }
        return $this->response->send_success_api($data, 'Poster Created');
    }

    public function delete($id){
        $data = Poster::find($id);
        $user= $data->User;
        if($user['id'] == Auth::User()->id){
            $data = $data->delete();
            if(!$data){
                return $this->response->send_error_api($data, 'Poster not deleted');   
            }
            return $this->response->send_success_api($data, 'Poster deleted');
        }else{
            return $this->response->send_error_api($user, 'You cannot delete this poster');
        }
    }
}