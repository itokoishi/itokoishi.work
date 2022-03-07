<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use DateTime;
use Exception;

class CommonController extends Controller
{
    protected array  $_items;
    protected string $_today;
    protected string $_now_time;
    protected string $_this_month;
    protected string $_this_year;
    protected int    $_hour;
    protected int    $_week;
    protected string $_next_month;
    protected string $_yesterday;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_items = [];

        /*-----------------------------------------------
        日付設定
        -----------------------------------------------*/
        $date              = new DateTime();
        $this->_now_time   = $date->format('Y-m-d H:i:s');
        $this->_today      = $date->format('Y-m-d');
        $this->_this_year  = $date->format('Y');
        $this->_this_month = $date->format('Y-m');
        $this->_hour       = (int)$date->format('H');
        $this->_week       = (int)$date->format('w');
        $start_date        = new DateTime($this->_this_month . '-' . '01');
        $this->_next_month = $start_date->modify('next month')->format('Y-m');
        $yesterday         = new DateTime($this->_this_month . '-' . '01');
        $this->_yesterday  = $yesterday->modify('-1 day')->format('Y-m-d');
    }
}
