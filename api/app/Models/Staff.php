<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * スタッフリスト取得
     * @return Builder[]|Collection
     */
    public static  function getListAll(): Collection|array
    {
        return self::query()
            ->where('view_flag', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

}
