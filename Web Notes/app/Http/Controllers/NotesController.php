<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Note;
use App\Services\BusinessServices\NotesService;
use App\Services\Utility\MyLogger;

class NotesController extends Controller {
	public function addNote(Request $request) {				
		MyLogger::info('Entering addNote() in Notes Controller');
		
		// get the posted Form Data
		$username = $request->input ( 'username' );
		$content = $request->input ( 'noteContent' );

		// save data to Note Object Model
		$note = new Note ($username, $content );

		// create note service and send note
		$service = new NotesService ();
		$status = $service->create ( $note );

		// rendered failed or success view and pass $note to it
		if ($status) {
			$data = [ 
					'model' => $note
			];
			return view ('NotesSuccess')->with ( $data );
		} else {
			return view ('NotesFailure');
		}
	}
	
	public function searchNotes(Request $request) {
		// get the posted Form Data
		$username = $request->input ( 'username' );
		
		// create note service and send $username
		$service = new NotesService ();
		$notesArray = $service->getNotes ( $username );
		
		// rendered failed or success view
		if ($notesArray) {
			return view ('showNotesSearch')->with ( "note", $notesArray );
		} else {
			return view ( 'NotesSearchFailure' );
		}
	}
	
}