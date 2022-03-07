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
        $calender = new Calender();
        $last_date = new \DateTime($this->_this_month);
        $last_day = $last_date->modify('last day')->format('d');

        $this->_items['calender'] = $calender->getTable($this->_this_month, $last_day, $this->_today);
        return view('calender', $this->_items);
    }
}
