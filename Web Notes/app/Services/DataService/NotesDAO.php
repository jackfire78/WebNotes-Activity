<?php

namespace App\Services\DataService;

use PDO;
use PDOException;
use App\Http\Models\Note;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger;

class NotesDAO {
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function createNote(Note $note) {
		MyLogger::info('Entering createNote() in NotesDAO');
		
		$user = $note->getUsername ();
		$content = $note->getContent ();		
		try {
			//connect to database
			if ($this->db->connect_error){
				return "please connect to database";
			}else{
				//insert into db
				$sql_statement = "INSERT INTO `notes` (`USERNAME`, `CONTENT`) VALUES ('$user', '$content');";
				if (mysqli_query($this->db, $sql_statement)) {
					MyLogger::info('Exiting createNote() in NotesDAO with True');
					return true;
				}else{
					MyLogger::info('Exiting createNote() in NotesDAO with False');
					return false;
				}
			}
		} catch ( PDOException $e ) {
			 MyLogger::error("Exception: ", array ("message" => $e->getMessage ()) );
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		} 
	}
	
	public function findByUsername($username) {
		MyLogger::info('Entering findByUsername() in NotesDAO');
		
		try {
			$sql_statement =  "SELECT * FROM `notes` WHERE `USERNAME` LIKE '%$username%'";
				$counter = 0;
				$result = mysqli_query($this->db, $sql_statement);
				//run the statment
				if($result){
					//loop through all results to create models to make an array
					while($row = mysqli_fetch_assoc($result)){
						//create new model to send back
						$note = new Note ( $row ['USERNAME'], $row ['CONTENT'] );
						//add the new models to an array to return
						$array[$counter] = $note;
						$counter++;
					}
					if(isset($array)){
						MyLogger::info('Exiting findByUsername() in NotesDAO with Populated Array');						
						//if something is in the array return it
						return $array;
					}else{
						MyLogger::info('Exiting findByUsername() in NotesDAO with Empty Array');
						//return if empty
						$empty=array();
						return $empty;
					}	
				}
		} catch ( PDOException $e ) {
			MyLogger::error("Exception: ", array("message" => $e->getMessage()));
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
}

