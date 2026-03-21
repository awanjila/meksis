<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemoPlans;

class DemoPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demo_plans=DemoPlans::get();
        return view('admin.demo_plans.demo_plans')->with('demo_plans', $demo_plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.demo_plans.create_demoplans');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=> 'required',

            'name'=> 'required',
            'amount'=> 'required',
            'image'=>'image|nullable|max:1999']);



        if($request->hasFile('image')){
            //1 : get filename with ext
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //2 : get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //3 : get just extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //4 : file name to store


            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image

            $path =$request->file('image')->storeAs('public/demoPlans_images', $fileNameToStore);

        }

        else{

            $fileNameToStore ='noimage.jpg';

        }

        $demo_plan=new DemoPlans();
        $demo_plan->name =$request->input('name');
        $demo_plan->price =$request->input('amount');
        $demo_plan->image =$fileNameToStore;
        $demo_plan->save();

        //return dd($request->all());

        return redirect()->route('demo_plans')->with('status', 'The '.$demo_plan->name.' Plan has been saved successfully');

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
