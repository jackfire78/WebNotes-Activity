<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Models\Note;
use App\Services\BusinessServices\NotesService;
use App\Services\Utility\MyLogger;
use Carbon\Carbon;

class NotesController extends Controller {
	public function addNote(Request $request) {
		MyLogger::info("Entering addNote() in Notes Controller");

		// get the posted Form Data
		$username = $request->input ( 'username' );
		$content = $request->input ( 'noteContent' );

		// save data to Note Object Model
		$note = new Note ( $username, $content );

		// create note service and send note
		$service = new NotesService ();
		$status = $service->create ( $note );

		// rendered failed or success view and pass $note to it
		if ($status) {
			MyLogger::info("Exiting addNote() with success");
			
			return view ('NotesSuccess');
		} else {
			MyLogger::info ("Exiting addNote() with failure");
			
			return view ( 'NotesFailure' );
		}
	}
	public function searchNotes(Request $request) {
		MyLogger::info("Entering searchNotes() in Notes Controller");
		
		// get the posted Form Data
		$username = $request->input ( 'username' );

		// create note service and send $username
		$service = new NotesService ();
		$notesArray = $service->getNotes ( $username );

		// rendered failed or success view
		if ($notesArray) {
			MyLogger::info ("Exiting searchNotes() with success");
			return view ( 'showNotesSearch' )->with ( "note", $notesArray );
		} else {
			MyLogger::info ("Exiting searchNotes() with failure");
			return view ( 'NotesSearchFailure' );
		}
	}
}