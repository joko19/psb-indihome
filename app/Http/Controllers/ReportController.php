<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->level == "admin") {
            $dataReport = Order::where(['status' => 'finished'])->orderBy('id', 'DESC')->get();
            return view('report.index', compact('dataReport'));
        } else {
            $dataReport = Order::where(['teknisi' => $user->name, 'status' => 'finished'])->orderBy('id', 'DESC')->get();
            return view('report.index', compact('dataReport'));
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
        $dataReport = Order::find($id);
        return view('report.report', compact('dataReport'));
    }
    public function print($id)
    {
        $dataReport = Order::find($id);
        return view('report.print', compact('dataReport'));
    }
}
