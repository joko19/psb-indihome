<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
            // when admin login, show all data
            $dataOrder = Order::orderBy('id', 'DESC')->get();
            return view('data-order.index', compact('dataOrder'));
        } else {
            // show data based teknisi login
            $dataOrder = Order::where(['teknisi' => $user->name, 'status' => 'scheduled'])->orderBy('id', 'DESC')->get();
            return view('data-order.index', compact('dataOrder'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // dd(auth()->user()->level);
        if (auth()->user()->level == "admin") {
            return view('data-order.create');
        } else {
            return redirect('data-order');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'typeIdentity' => $request->typeIdentity,
            'numberIdentity' => $request->numberIdentity,
            'phone' => $request->phone
        ]);
        return redirect('data-order')->with('success', 'Berhasil Menambahkan Data Pesanan');
    }
}
