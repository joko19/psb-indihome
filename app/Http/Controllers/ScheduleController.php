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

    public function calendar()
    {
        $dataOrder = Order::all()->where("status", "scheduled");
        return response()->json($dataOrder);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::find($id);
        if (auth()->user()->level == "admin") {
            return view('schedule.create', compact('order'));
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
            $teknisi = '';
            $teknisi = [];
            $all = Order::get();
            // $allTeknisi = User::all()->where('level', 'teknisi');
            // $array = (array) $allTeknisi;
            // $rand_keys = array_rand($array, 1);
            // @foreach($allTeknisi as $item)
            // $event = Order::where('id', $request->id)->update([
            //     'status'    => "scheduled",
            //     'teknisi'   => $request->teknisi,
            //     'date'      => $request->date,
            //     'time' => "07.00 - 10.00",
            //     'day' => "sunday"
            // ]);
            // return $event;
            //  $event = Order::all()->where('id', $request->id);
            //  dd($event);
            // return $all;
            return response()->json($all);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
