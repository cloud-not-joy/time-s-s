<?php

namespace App\Models;
use Illuminate\Database\Eloquent;

/**
 * Class Users
 * @property tinyint $is_join
 * @package App\Models
 */
class Users extends Eloquent\Model
{
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'openid', 'avatar',
    ];
    protected static $select = ['nickname','avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    public static function getOneByWhere($where){
      return  self::where($where)->first();
    }

    public static function getAllByWhere($where,$select){
        return  self::where($where)->select($select)->get();
    }

    public static function getWinPerson($user_id_arr){
        return  self::whereIn('user_id',$user_id_arr)->select(self::$select)->get();
    }

    public static function getAllByOrderNum($select){
        return  self::select($select)->orderBy('help_num','desc')->get();
    }

    public static function sumByHelpNum(){
        return  self::sum('help_num');
    }


}
