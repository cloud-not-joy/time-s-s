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


}
