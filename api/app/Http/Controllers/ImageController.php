<?php
namespace App\Http\Controllers;

class ImageController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function staff($param)
    {

        $file = $this->_storage_path . 'staff/' . $param . '.jpg';

        if(!file_exists($file)){
            $file = $this->_storage_path . 'staff/default.jpg';
        }

        return response()->file($file);
    }

}
