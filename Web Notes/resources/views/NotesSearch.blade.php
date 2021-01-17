@extends('layouts.appmaster')
@section('head','Notes Search')

@section('title')
    	<h2>Notes Search</h2>
@endsection

@section('content')
<!-- Note Postings -->
    <div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<form method="post" action="searchNotes">
	        <input type="hidden" name="_token" value="{{csrf_token()}}" />
	        <br/><br/><br/>
	    	<input type="text" name="username" placeholder = "Search by username"> 
	        <button class="btn btn-dark" type="submit">Search</button>       			
        </form>
        </div>
     </div>
     </div>
@endsection