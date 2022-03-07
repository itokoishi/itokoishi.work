<?php
namespace App\Http\Controllers;

class IndexController extends CommonController
{
    public function index(Request $request)
    {
        dd($request->input('test'));
    }
}
