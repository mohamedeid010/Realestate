<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realestate;
use App\Detail;
use Session;

class RealestatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('realestates.all')->with('realestates',Realestate::All());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('realestates.create')->with('details',Detail::All());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $realestate = $request->validate([
          'name' => 'required',
          'image' => 'required|image',
          'details' => 'required'
        ],
        [
          'name.required' => 'يجب ادخال اسم العقار',
          'image.required' => 'يجب رفع صورة',
          'details.required' => 'يجب اختيار تفاصيل'
          ]  );
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads',$image_new_name);
        $realestate = new Realestate;
        $realestate->name = $request->name;
        $realestate->image = $image_new_name;
        $realestate->save();
        $realestate->details()->attach($request->details);
        Session::flash('success','تم اضافة العقار بنجاح');
        return redirect()->route('realestates');
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
