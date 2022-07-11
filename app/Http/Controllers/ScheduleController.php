<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataOrder = Order::orderBy('id', 'DESC')->get();
        // $dataScheduled = Order::all()->where("status", "scheduled");
        return view('schedule.index', compact('dataOrder'));
    }
    public function chooseTeknisi($id)
    {
        $allTeknisi = User::all()->where('level', 'teknisi');
        // $dataScheduled = Order::all()->where("status", "scheduled");
        return view('schedule.choose-teknisi', compact('allTeknisi', 'id'));
    }

    // data scheduled on calendar
    public function calendar($teknisi)
    {
        $dataTeknisi = User::find($teknisi);
        $dataOrder = Order::where(['teknisi' => $dataTeknisi->name])->get();
        return response()->json($dataOrder);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // view calendar
    public function create(Request $request)
    {
         if (auth()->user()->level == "admin") {
            if ($request->ajax()) {
                $data = Order::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end']);
                return response()->json($data);
            }
            return view('schedule.create');
        } else {
            return redirect('schedule');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        if ($request->type == 'create') {
            $time = '';
            $time = '07.00 - 10.00';
            $teknisi = User::find($request->teknisi);
            $shift = Order::where(['teknisi' => $teknisi->name, 'date' => $request->date])->get();
            $count = count($shift);
            // when sunday
            if ($request->day == 0) {
                $time = "libur";
                return $time;
            }
            // when saturday
            if ($request->day == 6) {
                if ($count == 0) {
                    $time = '07.00 - 10.00';
                } else if ($count == 1) {
                    $time = '10.00 - 13.00';
                } else {
                    $time = "full";
                    return response()->json($time);
                }
            }
            // when weekdays
            if ($count == 0) {
                $time = '07.00 - 10.00';
            } else if ($count == 1) {
                $time = '10.00 - 13.00';
            } else if ($count == 2) {
                $time = '13.30 - 16.30';
            } else {
                $time = "full";
                return response()->json($time);
            }
            $event = Order::where('id', $request->id)->update([
                'status'    => "scheduled",
                'teknisi'   => $teknisi->name,
                'date'      => $request->date,
                'time' => $time,
                'day' => $request->day
            ]);
            return $event;
        }
    }
}
