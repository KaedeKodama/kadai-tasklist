<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tasklist;    // add





class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        if (\Auth::check()) {
        $user = \Auth::user();
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

        return view('tasks.index', [ // resource/view/tasks/index.blade.php
            'tasks' => $tasks,
        ]);        
       
        }else{
            return view('welcome');
        } 


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $task = new Tasklist;
            
            return view('tasks.create',[
                'task' => $task,
            ]);
    
            }
    
            

            


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$this->validate($request, [
            'content' => 'required|max:191',
            'status'=>'required|max:10'
        ]);
    


	    $task = new Tasklist;
        $task->content = $request->content;
        $task->status = $request ->status;
       
        $user=\Auth::user();
        $task-> user_id = $user-> id;
       
       
       
        $task->save();

        return redirect('/tasks');        



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Tasklist::find($id);
        if (\Auth::id() === $task->user_id) {
            
            return view('tasks.show',[
                'task' => $task,
            ]);

    
    }
    else {
        return redirect('/tasks');
        
        
        
    }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $task = Tasklist::find($id);
        
        if (\Auth::id() === $task->user_id) {
           
            return view('tasks.edit',['task' => $task,
            ]);
        }  
        
        
        else {
        return redirect('/tasks');
        
        
        
    }
        

        
        
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
	$this->validate($request, [
            'content' => 'required|max:191',
            'status'=>'required|max:10'
        ]);       
	$task = Tasklist::find($id);
        $task->content = $request->content;
        $task->status = $request ->status;
        if (\Auth::id() === $task->user_id) {
       
        $task->save(); }

        return redirect('/tasks');
         
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
        $task = Tasklist::find($id);
        
         if (\Auth::id() === $task->user_id) {
        $task->delete();
        }
        return redirect('/tasks');
    }
}
