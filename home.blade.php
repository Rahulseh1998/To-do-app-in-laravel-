




@extends('layouts.mylayout')

@section('title')
	Home-ToDo App
@endsection

@section('content')
	
	<div class="container">

		<div class="row">
			
			<div class="col-lg-7 col-md-7 col-sm-7">
				<div class="row col-xs-12" id="showpendingtasks">	
					<div class="page-header">
					  <h2>Your tasks<i class="fa fa-plus pull-right" id="addNewButton" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></h2>
					</div>

						{{-- genrating dynamically --}}
						@if(count($pending_tasks)!=0)
								<?php  $i=1; ?>
							@foreach($pending_tasks as $pending_task)
								

									<div class="panel panel-default">
									  <div class="panel-heading" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true">
									    <h3 class="panel-title text-center" id="pending_task_title*{{$i}}">{{ $pending_task->task_title }}<a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i></a></h3>
									  </div>
									  <div class="panel-body panel-collapse collapse in" aria-expanded="true" id="collapse{{$i}}">
									    
									  		<form>
									  			<input type="hidden" name="id" id="pending_task_id*{{$i}}" value="{{Crypt::encryptString($pending_task->id)}}">
									  		</form>
									    	<ul class="list-group">
									    	    
									    	    <li class="list-group-item">
										    	    <div class="row">
											    	    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
											    	    	<h5>Description : </h5>
											    	    </div>
											    	    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7"><h5 class="text-info" id="pending_task_description*{{$i}}">{{ $pending_task->task_description}}</h5></div>
											    	  </div>
									    	    </li>
									    	    <li class="list-group-item">
										    	    <div class="row">
											    	    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
											    	    	<h5>Last Date : </h5>
											    	    </div>
											    	    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7"><h5 class="text-info" id="pending_task_last_date*{{$i}}">{{$pending_task->last_date}}</h5></div>
											    	  </div>
									    	    </li>
									    	</ul>
									    	<br>

									    			{!! Form::open(['class'=>'form-inline']) !!}
									    				<div class="row pull-right">
									    					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									    						<span class="btn btn-danger pending_task_delete" id="pending_task_delete*{{$i}}">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></span>
									    				
									    					</div> 
									    					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									    						<span  class="btn btn-primary pending_task_edit" id="pending_task_edit*{{$i}}"  data-toggle="modal" data-target="#myModal">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>

									    						
									    					</div> 
									    					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									    						<span class="btn btn-success pending_task_done" id="pending_task_done*{{$i}}">Done <i class="fa fa-check" aria-hidden="true"></i></span>

									    						
									    					</div> 
									    				</div>
									    				

									    			{!! Form::close() !!}

									  </div>
									</div>

								<?php  $i++;  ?> 
							@endforeach
						@else
							<h1>You don't have any task</h1>
						@endif


				</div>
			</div> 

			<div class="col-lg-4 col-md-4 col-sm-4 row col-xs-12 pull-right">
				<div class="row col-xs-12" id="count_of_tasks">
					<div class="page-header">
					
					@if(((count($tasks_done)+count($pending_tasks)))>0)
					<?php $per = intval(100*count($tasks_done)/(count($tasks_done)+count($pending_tasks)));  ?>
					  <h2>Tasks : {{$per}}% completed</h2>
					  @endif
					 
					  
					</div>
					<div class="panel panel-default">
					  <div class="panel-body">
					   		<div class="page-header">
					   			  <h4>Total tasks : <span id="total_tasks_count_per">{{count($pending_tasks)+count($tasks_done)}}</span></h4>
					   		</div>
					   		<div class="page-header">
					   			  <h4>Pending Tasks : <span id="pending_task_count_per">{{count($pending_tasks)}}</span></h4>
					   		</div>
					   		<div class="page-header">
					   			  <h4>Done tasks : <span>{{count($tasks_done)}}</span></h4>
					   		</div>
					  </div>
					</div>
				</div>
				<div class="row" id="RecentlyDonetasks">
					<div class="page-header">
					  <h2>Task recently done</h2>
					</div>
					  @if(count($tasks_done)!=0)
								<?php  $i=1; ?>
							@foreach($tasks_done as $task_done)
								

									<div class="panel panel-default">
									  <div class="panel-heading" data-toggle="collapse" href="#collapse_task_done_{{$i}}">
									    <h3 class="panel-title" id="task_done_title*{{$i}}">{{ $task_done->task_title }}<a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i></a></h3>
									  </div>
									  <div class="panel-body panel-collapse collapse" id="collapse_task_done_{{$i}}">
									    
									  		<form>
									  			<input type="hidden" name="id" id="task_done_id*{{$i}}" value="{{Crypt::encryptString($task_done->id)}}">
									  		</form>
									    	<ul class="list-group">
									    	    
									    	    <li class="list-group-item">
										    	    <div class="row">
											    	    <div class="col-lg-4 col-md-4">
											    	    	Description : 
											    	    </div>
											    	    <div class="col-lg-8 col-md-8"><p class="text-info" id="task_done_description*{{$i}}">{{ $task_done->task_description}}</p></div>
											    	  </div>
									    	    </li>
									    	    <li class="list-group-item">
										    	    <div class="row">
											    	    <div class="col-lg-4 col-md-4">
											    	    	Last Date : 
											    	    </div>
											    	    <div class="col-lg-8 col-md-8"><p class="text-info" id="task_done_last_date*{{$i}}">{{$task_done->last_date}}</p></div>
											    	  </div>
									    	    </li>
									    	</ul>
									    	<br>

									    			{!! Form::open(['class'=>'form-inline']) !!}
									    				<div class="row pull-right">
									    					<div class="col-lg-4 col-md-4">
									    						<span class="btn btn-danger task_done_undone" id="task_done_undone*{{$i}}">Mark Undone <i class="fa fa-times" aria-hidden="true"></i></span>
									    				
									    					</div> 
									    				</div>
									    			{!! Form::close() !!}

									  </div>
									</div>

								<?php  $i++;  ?> 
							@endforeach
						@else
							<h3>You don't have any task done</h3>
						@endif

				
			</div>
			

		</div>
	</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" >Add new task</h4>
      </div>
      <div class="modal-body">
      	      			        <p>
      	      			        	

      	      			        		{!! Form::open(['class'=>'form-horizontal']) !!}
      	      			        		<input type="hidden" name="modal_task_id" id="modal_task_id" value="">
      	      			        		<div class="form-group">
      	      			        			{!! Form::label('modal_task_title', 'Task title : ', ['class'=>'control-label col-sm-3']) !!} 
      	      			        		 <div class="col-sm-9">
      	      			        		 	{!! Form::text('title', '', ['class'=>'form-control','placeholder'=>'Task title','id'=>'modal_task_title']) !!} 
      	      			        		 </div>
      	      			        		  
      	      			        		</div> 
      	      			        		<br>
      	      			        		<div class="form-group">
      	      			        			{!! Form::label('modal_task_description', 'Description : ', ['class'=>'control-label col-sm-3']) !!}
      	      			        		  <div class="col-sm-9">
      	      			        		  	{!! Form::textarea('item', '', ['class'=>'form-control','rows'=>'5','id'=>'modal_task_description','placeholder'=>'Write task description here']) !!} 
      	      			        		  </div> 
      	      			        		 

      	      			        		</div>
      	      			        		<br>
      	      			        		<div class="form-group">
      	      			        			{!! Form::label('modal_task_date',	'Last date : '  , ['class'=>'control-label col-sm-3' ]) !!}
      	      			        		   <div class="col-sm-9">
      	      			        		{!! Form::date('date', '', ['class'=>'form-control','id'=>'modal_task_date']) !!}
      	      			        		   	
      	      			        		   </div>

      	      			        		</div>
      	      			        		
      	      			        		
      	      			        		{!! Form::close() !!}
      	      			        	
      	      			        </p>
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="AddButton" class="btn btn-primary" data-dismiss="modal">Add Task</button>
        <button type="button" id="saveChanges" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

