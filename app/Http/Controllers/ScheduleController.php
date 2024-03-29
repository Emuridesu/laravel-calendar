<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    /**
     * イベントを登録
     *
     * @param  Request  $request
     */
    public function scheduleAdd(Request $request)
    {


        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);
        Log::info(date('Y-m-d', $request->input('start_date') / 1000));

        //登録処理
        $schedule = new Schedule;
        $schedule->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $schedule->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $schedule->event_name = $request->input('event_name');
        $schedule->save();
        return;
    }

    public function scheduleget(Request $request)
    {

        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
        ]);

        //カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        //表示処理
        return Schedule::query()
            ->select(
                //カレンダーの方式に合わせる
                'event_id',
                'start_date as start',
                'end_date as end',
                'event_name as title'
            )
            //カレンダーの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->get();
    }

    public function scheduleUpdate(Request $request)
    {

        Log::info($request->input('event_id')); //追記
        Log::info(date('Y-m-d', $request->input('start_date') / 1000));//追記
        Log::info(date('Y-m-d', $request->input('end_date') / 1000)); //追記
        Log::info($request->input('event_name')); //追記

        $request->validate([
            'event_id' => 'required|integer',
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);

        //更新処理
        $start_date = Schedule::find($request->input('event_id'));
        $start_date->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $start_date->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $start_date->event_name = $request->input('event_name');
        $start_date->save();


        return;
    }
}
