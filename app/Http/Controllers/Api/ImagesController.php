<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function profile($imageName){
        return response()->file("public/img/users/profile/$imageName");
    }
    public function post(){

    }
}
