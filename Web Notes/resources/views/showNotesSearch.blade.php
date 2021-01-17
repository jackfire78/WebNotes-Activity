@extends('layouts.appmaster')
@section('head','Search Notes')
@section('title', 'Search Results')
@section('content')

<!-- Note Postings -->
<div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<form method="post" action="searchNotes">
	        <input type="hidden" name="_token" value="{{csrf_token()}}" />
	    	<input type="text" name="username" placeholder = "Search by username"> 
	        <button class="btn btn-dark" type="submit">Search</button>       			
        </form>
        
    	<table class="table table-dark">
    	<tr>
    	  <th scope="col">Username</th>
    	  <th scope="col">Content</th>

    	</tr>
    	<tbody id="myTable">   	    	
        	@foreach($note as $note)
        	<tr>
        		<td>{{$note->getUsername()}}</td>
        		<td>{{$note->getContent()}}</td> 
        	</tr>
        	@endforeach
        </tbody>                		
        </table>
        
        </div>
     </div>
</div>
@endsection