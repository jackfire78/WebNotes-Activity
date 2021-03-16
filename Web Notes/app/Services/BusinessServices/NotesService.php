<?php

namespace App\Services\BusinessServices;

use PDO;
use App\Http\Models\Note;
use App\Services\DataService\NotesDAO;
use App\Services\Utility\MyLogger;
use mysqli;

class NotesService {
	public function __construct() {
	}
	public function create(Note $note) {
		MyLogger::info('Entering create() in NotesService');
		
		// Azure database
		// $db = new mysqli("localhost", "azure", "6#vWHD_$", "webnotes", "53217");
		// Heroku database
		$db = new mysqli ( "z3iruaadbwo0iyfp.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "fahczpdegdfdk58l", "da4ukk3v4t1lddor", "ozgf8unmfu7uuiad" );
		// AWS database
		// $db = new mysqli ( "webnotes-jack.cocq0qavoe0i.us-east-2.rds.amazonaws.com", "admin", "adminpassword", "awswebnotes" );
		// Google Cloud database
		// $db = new mysqli ( "root", "root", "webnotes_jack", "/cloudsql/smooth-ripple-304314:us-central1:webnotes-jack" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "webnotes");

		// Check connection
		if ($db->connect_errno) {
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}
		// create connection (THIS GIVE A PDOEXCEPTION ERROR-"Cannot find driver")
		// $db = new PDO("hostname:port=localhost;port=53217;dbname=webnotes;", "azure", "6#vWHD_$");
		// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$service = new NotesDAO ( $db );
		$flag = $service->createNote ( $note );

		// close connection
		$db->close ();

		// return results
		// $this->logger->info("Exit NotesService.doSubmit with" . $flag);
		return $flag;
	}
	public function getNotes($USERNAME) {
		MyLogger::info('Entering getNotes() in NotesService');
		
		// Azure database
		// $db = new mysqli("localhost", "azure", "6#vWHD_$", "webnotes", "53217");
		// Heroku database
		$db = new mysqli ( "z3iruaadbwo0iyfp.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "fahczpdegdfdk58l", "da4ukk3v4t1lddor", "ozgf8unmfu7uuiad" );
		// AWS database
		// $db = new mysqli ( "webnotes-jack.cocq0qavoe0i.us-east-2.rds.amazonaws.com", "admin", "adminpassword", "awswebnotes" );
		// Google Cloud database
		// $db = new mysqli ( "root", "root", "webnotes_jack", "/cloudsql/smooth-ripple-304314:us-central1:webnotes-jack" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "webnotes");

		// Check connection
		if ($db->connect_errno) {
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}
		// create connection (THIS GIVE A PDOEXCEPTION ERROR-"Cannot find driver")
		// $db = new PDO("hostname:port=localhost;port=53217;dbname=webnotes;", "azure", "6#vWHD_$");
		// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$service = new NotesDAO ( $db );
		$notes = $service->findByUsername ( $USERNAME );

		// close connection
		$db->close ();

		// return results
		// $this->logger->info("Exit NotesService.getNotes with");
		return $notes;
	}
}

