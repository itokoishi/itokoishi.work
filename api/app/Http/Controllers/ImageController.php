<?php
namespace App\Http\Controllers;

class ImageController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function staff($staff_id)
    {

    }

    public function staffDefault($staff_id)
    {
        $dir = $this->_storage_path . 'develop/staff/';
    }
}
