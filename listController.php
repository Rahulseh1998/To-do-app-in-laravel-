<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\task;
use Auth;

class listController extends Controller
{
    //

    public function create(Request $request)
    {
    	$task = new task;
    	// return Auth::user()->id;
    	$task->user_id =  Auth::user()->id;

    	$task->task_title = $request->title;

    	$task->task_description = $request->description;

    	$task->last_date = $request->date;

    	// $task->done = true;
    	
    	$task->save();

    	return "recorded successfully";
    	// return $request->all();
    } 


    public function taskDelete(Request $request)
    {	

        // return $request->id;
        $id = Crypt::decryptString($request->id);
        // return $id;
    	Task::where('id',$id)->delete();
    	return "deleted";

    	// return $request->all();
    }


    public function taskDone(Request $request)
    {
        $id = Crypt::decryptString($request->id);
    	$task = Task::find($id);
    	$task->done = true;
    	$task->save();
    	return "task done";
    }


    public function editTask(Request $request)
    {


        $id = Crypt::decryptString($request->id);

    	$task = Task::find($id);

    	$task->task_title = $request->title;

    	$task->task_description = $request->description;

    	$task->last_date = $request->date;

    	$task->save();

    	return "task edited";

    }

    public function taskUndone(Request $request)
    {
        $id = Crypt::decryptString($request->id);
    	$task = Task::find($id);
    	$task->done = false;
    	$task->save();
    	return "task undone";
    }

}
