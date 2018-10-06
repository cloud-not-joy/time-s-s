<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HelpLogs extends Model
{
    //
    protected $primaryKey = 'help_id';

    public static function getOneByWhere($where){
        return  self::where($where)->first();
    }

    public static function getAllByWhere($where,$select){
        return  DB::table('help_logs')->join('users', 'users.user_id', '=', 'help_logs.help_from_user_id')
            ->where($where)->select($select)->get();
    }

    public static function getFriendsByWhere($where,$page = 1){
        return  self::where($where)
            ->join('users', 'users.user_id', '=', 'help_logs.help_from_user_id')
            ->paginate($page);
    }

}
