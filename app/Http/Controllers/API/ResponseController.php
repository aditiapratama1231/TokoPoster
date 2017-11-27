<?php

namespace App\Http\Controllers\API;

class ResponseController{
    public function send_success_api($data, $message=''){
        $meta = [
            'message' => $message,
            'success' => true
        ];
        return response()->json([
            'data' => $data,
            'meta' => $meta
        ]);
    }

    public function send_error_api($data, $message=''){
        $meta = [
            'message' => $message,
            'success' => false
        ];
        return response()->json([
            'data' => $data,
            'meta' => $meta
        ]);
    }
}