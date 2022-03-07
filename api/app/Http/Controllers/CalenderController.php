<?php

namespace App\Http\Controllers;

use App\Lib\Calender;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CalenderController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Request $request): View|Factory|Application
    {
        $month = $request->get('month', $this->_this_month);

        $calender  = new Calender();
        $month_obj = new \DateTime($month);

        /* -- 日付の整形 ---------------------*/
        $last_day  = $month_obj->modify('last day of ' . $month)->format('d');
        $str_month  = $month_obj->format('Y年m月');
        $next_month = $month_obj->modify('next month ' . $month)->format('Y-m');
        $prev_month = $month_obj->modify('previous month ' . $month)->format('Y-m');

        /* -- 表示変数 ---------------------*/
        $this->_items['prev_month'] = $prev_month;
        $this->_items['next_month'] = $next_month;
        $this->_items['str_month']  = $str_month;
        $this->_items['calender']   = $calender->getTable($month, $last_day, $this->_today);
        return view('calender', $this->_items);
    }
}
