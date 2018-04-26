<?php

namespace App\Http\Controllers;

use App\Shardoctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class shareDoctorController extends Controller
{

    public function index()
    {
        $shareDoc = Shardoctor::where('confirm','<>',0)->distinct()->get();
        return view('admin.shareDoc.view',compact('shareDoc'));
    }


    public function create()
    {
        $shareDoc = Shardoctor::where('confirm',0)->get();
        return view('admin.shareDoc.create',compact('shareDoc'));
    }


    public function store(Request $request)
    {
        $s = Shardoctor::find($request->input('shareID'));
       $s->confirm = $request->input('confirm');
        $s->save();
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
