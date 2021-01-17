@extends('layouts.appmaster')
@section('head','Note Submittion Failed')
@section('title', 'There was an error submitting your note...sorry about that')
@section('content')
@isset($result)
	{{$result}}
@endisset
<p>Click <a href="NotesSubmit">here</a> to try again.</p>
@endsection
