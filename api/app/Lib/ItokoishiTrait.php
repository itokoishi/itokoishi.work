<?php
namespace App\Lib;


trait ItokoishiTrait
{

    /**
     * 曜日を返す
     * @return string[]
     */
    public function _getWeekList(): array
    {
        return [
            0 => '日',
            1 => '月',
            2 => '火',
            3 => '水',
            4 => '木',
            5 => '金',
            6 => '土'
        ];
    }

    /**
     * 曜日(英)を返す
     * @return string[]
     */
    public function _getWeekEnList(): array
    {
        return [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday'
        ];
    }

    /**
     * デバッグ用
     * @param $val
     * @param $flag
     * @return void
     */
    public function _debug($val, $flag = false): void
    {
        echo '<pre>';
        var_dump($val);
        echo '</pre>';

        if($flag){
            exit();
        }
    }

    /**
     * 時間の配列を返す
     * @return int[]
     */
    protected function _getHourArray(): array
    {
        $array = [];
        for ($i = 1; $i < 24; $i++) {
            $array[$i] = sprintf('%02s', $i);
        }
        return $array;
    }

    /**
     * 分の配列を返す
     * @return int[]
     */
    protected function _getMinuteArray(): array
    {
        return [0 => '00', 15 => '15', 30 => '30', 45 => '45'];
    }

}
