@extends('layouts.appmaster')

@section('head','Note')

@section('title')
@section('content')

    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
	<form action="addNote" method="post">
	    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
	    
	    <div class="form-group">
			<label for="username"><b>Username:</b></label>
	    	<input type="text" class="form-control" placeholder="Enter your username" name="username" >
	    </div>
	    
	    <div class="form-group">
	    	<label for="noteContent"><b>Note Content:</b></label>
	    	<textarea class="form-control" placeholder="Enter the note you want to save" name="noteContent"></textarea>
	    </div>
	
	    <hr>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
  </div>
  </div>
  
  <div class="container signin">
    <p>Want to check your notes instead? <a href="NotesSearch">Find notes</a>.</p>
  </div>
@endsection