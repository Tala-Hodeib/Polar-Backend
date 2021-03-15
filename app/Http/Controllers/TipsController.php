<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tips = Tips::latest()->paginate(5);
    
        return view('tips.index',compact('tips'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
       Tips::create($request->all());
     
        return redirect()->route('tips.index')
                        ->with('success','Tip created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tips  $tips
     * @return \Illuminate\Http\Response
     */
    public function show(Tips $tips)
    {
        return view('tips.show',compact('tips'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tips  $tips
     * @return \Illuminate\Http\Response
     */
    public function edit(Tips $tips)
    {
        return view('tips.edit',compact('tips'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tips  $tips
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tips $tips)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $tips->update($request->all());
    
        return redirect()->route('tips.index')
                        ->with('success','Tip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tips  $tips
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tips $tips)
    {
        $tips->delete();
    
        return redirect()->route('tips.index')
                        ->with('success','Tip deleted successfully');
    }
}
