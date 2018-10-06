<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $primaryKey = 'activity_id';
    protected $table='activity';
    public static function getOne($select=['*']){
        return  self::orderBy('activity_id', 'DESC')->select($select)->first();
    }

    public static function getOneByWhere($where){
        return  self::where($where)->first();
    }
}
