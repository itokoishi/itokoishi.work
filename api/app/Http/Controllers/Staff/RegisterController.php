<?php
namespace App\Http\Controllers\Staff;


use App\Http\Controllers\CommonController;

class RegisterController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('staff.register', $this->_items);
    }
}
