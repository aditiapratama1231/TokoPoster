<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseController;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller{

    protected $responseController;
    public function __construct(ResponseController $responseController){
        $this->response = $responseController;
    }

    public function index(){
        $data = Category::all();
        return $this->response->send_success_api($data, 'Data retrieved successfully');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required'
        ]);
        if($validator->fails()){
            return $this->response->send_error_api($validator->errors(), 'Data required');
        }
        $data = array('category' => $request->category);
        $category = Category::create($data);
        if(!$category){
            return $this->response->send_error_api($data, 'Category failed to create');
        }
        return $this->response->send_success_api($data, 'Category Created');
    }

    public function show($id){
        $data = Category::find($id);
        if(!$data){
            return $this->response->send_error_api($data, 'Category not found');
        }
        return $this->response->send_success_api($data, 'Category retrieved successfully');
    }

    public function delete($id){
        $data = Category::find($id);
        if(!$data){
            return $this->response->send_error_api($data, 'Category not found');
        }
        $data = $data->delete();
        return $this->response->send_success_api($data, 'Category deleted');
    }
}