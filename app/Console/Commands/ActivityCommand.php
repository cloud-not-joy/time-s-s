<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Users;
use Illuminate\Console\Command;

class ActivityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时开奖';

    const DEFAULT_HELP_NUM = 39;
    const FLOAT_NUM = 5;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $activity= Activity::getOne();
            if(strtotime($activity->activity_open_prize_time) < time()){
                return ['code'=>0,'msg'=>'未到开奖时间'];
            }
            if($activity->activity_status){
                return ['code'=>0,'msg'=>'已经开奖'];
            }
            $select = ['nickname','avatar','help_num','user_id'];
            $activity_win_num = $activity->activity_win_num;
            $maybe =  Users::getAllByOrderNum($select);
            $sum_help_num = Users::sumByHelpNum();
            $win_arr = $undetermined = [];
            foreach ($maybe as $item) {
                if($item->help_num > self::DEFAULT_HELP_NUM) {
                    $win_arr[] = $item->user_id;
                    continue;
                }
                $undetermined[] = $item;
            }
            $need_num = $activity_win_num - count($win_arr);
            $win = $this->randWin($undetermined, $need_num,$sum_help_num, $win_arr);
            $activity->activity_status = 1;
            $activity->activity_win_user_id = json_encode($win);
            $activity->save();
            return ['code'=>1,'msg'=>'成功开奖'];
        } catch (\Exception $e) {
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }

    protected function randWin($undetermined, $need_num, $sum_help_num, $win_arr){
        $i = 0;
        foreach ($undetermined as $item) {
            $help_num = $item->help_num;
            $avg = floor($help_num / $sum_help_num * 10 );
            $standard = rand(1,10);
            if($standard <= $avg ){
                $win_arr[] = $item->user_id;
                $i++;
                if($i == $need_num){
                    return  $win_arr;
                }
            }
        }
        return $win_arr;
    }
}
