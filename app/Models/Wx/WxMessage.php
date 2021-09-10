<?php

namespace App\Models\Wx;


use App\Models\Model;

class WxMessage extends Model
{
    protected $table = 'wx_message';

    protected $guarded = [];

    public function setTable($table)
    {
        return parent::setTable($table.date('Ym'));
    }
}
