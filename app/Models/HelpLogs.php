<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpLogs extends Model
{
    //
    protected $primaryKey = 'help_id';

    public static function getOneByWhere($where){
        return  self::where($where)->first();
    }

}
