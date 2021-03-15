<?php
namespace App\Http\Controllers;
   
use App\Models\Activities;
use Illuminate\Http\Request;
  
class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activities::latest()->paginate(5);
    
        return view('activities.index',compact('activities'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
       
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
    
       Activities::create($request->all());
     
        return redirect()->route('activities.index')
                        ->with('success','Activity created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Activities  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Activities $activity)
    {
        return view('activities.show',compact('activity'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activities $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Activities $activity)
    {
        return view('activities.edit',compact('activity'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activities  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activities $activity)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $activity->update($request->all());
    
        return redirect()->route('activities.index')
                        ->with('success','Activity updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activities  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activities $activity)
    {
        $activity->delete();
    
        return redirect()->route('activities.index')
                        ->with('success','Activity deleted successfully');
    }
}
