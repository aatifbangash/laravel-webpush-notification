<?php

namespace App\Http\Controllers;

use App\Responses\FinalResponse;
use App\Responses\Pagi;

class PostsController extends Controller
{
    public function index()
    {

//        $obj = new FinalResponse(
//            total: 100,
//            perPage: 25
//        );

        $p = new Pagi();

        $p->

$obj = new FinalResponse(
    1000,
    25,
    new Pagi()
);
var_dump($obj);exit;
        return response()->json(new FinalResponse(
            1000,
            25,
            new Pagi()
        ));
    }
}
