<?php

namespace App\Http\Controllers\Staff;

use App\Lib\ItokoishiTrait;
use App\Models\Staff;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

class ModifyController extends CommonController
{

    use ItokoishiTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show($id): View|Factory|Application
    {
        $modify_data = Staff::query()->where('id', $id)->first();

        $this->_items['modify_data'] = $modify_data;
        $this->_items['year_items'] = $this->_getYearArray();
        $this->_items['month_items'] = $this->_getMonthArray();
        $this->_items['date_items'] = $this->_getDateArray();
        return view('staff.modify', $this->_items);
    }
}
