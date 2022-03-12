<?php

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\CommonController;
use App\Lib\ItokoishiTrait;
use App\Models\Staff;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ListController extends CommonController
{

    use ItokoishiTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): Factory|View|Application
    {
        $list = Staff::getListAll();

        $this->_items['list'] = $list;
        return view('staff.list', $this->_items);
    }
}
