<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $dataOrder = Order::where(['teknisi' => $user->name, 'status' => 'scheduled'])->get();
        return view('timer.index', compact('dataOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timer($id)
    {
        return view('timer.timer');
    }

    public function getTime($id)
    {
        $dataOrder = Order::where('id', $id)->get();

        return $dataOrder;
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
        $prepare = Order::where(['id' => $request->id, 'prepare' => NULL])->count();
        if ($prepare) {
            Order::find($id)->update([
                'prepare'   => $request->estimate,
                'endStep' => $request->endStep
            ]);
            return response()->json(['isFinished' => false]);
        }
        $otw = Order::where(['id' => $request->id, 'ontheway' => NULL])->count();
        if ($otw) {
            Order::find($id)->update([
                'ontheway'   => $request->estimate,
                'endStep' => $request->endStep
            ]);
            return response()->json(['isFinished' => false]);
        }
        $process = Order::where(['id' => $request->id, 'process' => NULL])->count();
        if ($process) {
            Order::find($id)->update([
                'process'   => $request->estimate,
                'endStep' => $request->endStep
            ]);
            return response()->json(['isFinished' => false]);
        }
        $finishing = Order::where(['id' => $request->id, 'finishing' => NULL])->count();
        if ($finishing) {
            Order::find($id)->update([
                'finishing'   => $request->estimate,
                'endStep' => $request->endStep,
                'status' => 'finished'
            ]);
            return response()->json(['isFinished' => true]);
        }
    }
}
