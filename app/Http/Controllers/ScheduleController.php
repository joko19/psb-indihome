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

    public function calendar($teknisi)
    {
        $teknisi = User::find($teknisi);
        $dataOrder = Order::all()->where("status", "scheduled")->where('teknisi', $teknisi->name);
        return response()->json($dataOrder);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($teknisi)
    {
        $dataTeknisi = User::find($teknisi);
        $dataOrder = Order::all()->where("status", "scheduled")->where('teknisi', $dataTeknisi->name);
        if (auth()->user()->level == "admin") {
            return view('schedule.create', compact('dataOrder'));
            // dd($dataOrder);
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
            $teknisi = User::find($request->teknisi);
            // $arrTeknisi = ["", "aa"];
            // $all = Order::all()->where('status', 'scheduled');
            // $totalOrder = count($all);
            // if($totalOrder == 0){
            //     $teknisi = $arrTeknisi[0];
            // } else{
            //     $lastOrder = end($all);
            //     $lastTeknisi = $lastOrder["teknisi"];
            //     $teknisi = "hello";
            // }
            // for($i = 0; $i< $totalOrder; $i++){
            //     array_push($teknisi, $all.$i->teknisi);
            //  }
            // $orderByDate = Order::where('date', $request->date);
            // $array = (array) $allTeknisi;
            // $rand_keys = array_rand($array, 1);
            // @foreach($allTeknisi as $item)
            $event = Order::where('id', $request->id)->update([
                'status'    => "scheduled",
                'teknisi'   => $teknisi->name,
                'date'      => $request->date,
                'time' => "07.00 - 10.00",
                'day' => "sunday"
            ]);
            return $event;
            //  $event = Order::all()->where('id', $request->id);
            //  dd($event);
            // return $all;
            // $arr = json_decode(json_encode ( $allTeknisi ) , true);
            // $arr = (array) $allTeknisi;
            // return $teknisi->name;
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
