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
            $dataOrder = Order::orderBy('id', 'DESC')->get();
            return view('data-order.index', compact('dataOrder'));
        } else {
            $dataOrder = Order::where('teknisi', $user->name)->orderBy('id', 'DESC')->get();
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
