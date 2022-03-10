<?php
namespace App\Http\Controllers\Staff;


use App\Http\Controllers\CommonController;
use App\Lib\ItokoishiTrait;

class RegisterController extends CommonController
{

    use ItokoishiTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->_items['year_item'] = $this->_getYearArray();
        $this->_items['month_item'] = $this->_getMonthArray();
        $this->_items['date_item'] = $this->_getDateArray();
        return view('staff.register', $this->_items);
    }
}
