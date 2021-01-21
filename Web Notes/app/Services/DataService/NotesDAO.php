<?php

namespace App\Services\DataService;

use PDO;
use PDOException;
use App\Http\Models\Note;
use App\Services\Utility\DatabaseException;

class NotesDAO {
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function createNote(Note $note) {
		// $this->logger->info ( "Entering NotesDAO.createNote()" );
		$user = $note->getUsername ();
		$content = $note->getContent ();
		try {
/*			$stmt = mysqli_prepare( $this->db, "INSERT INTO `notes` (`ID`, `USERNAME`, `CONTENT`) VALUES (NULL, '$user', '$content');" );
			mysqli_stmt_execute($stmt);
			
			//get results
			$result = $stmt->get_result(); */

			//connect to database
			if ($this->db->connect_error){
				return "please connect to database";
			}else{
				//insert into db
				$sql_statement = "INSERT INTO `ozgf8unmfu7uuiad`.`notes` (`ID`, `USERNAME`, `CONTENT`) VALUES (NULL, '$user', '$content');";
				if (mysqli_query($this->db, $sql_statement)) {
					//echo "New note created successfully";
					return true;
				}else{
					return false;
				}
			}
		} catch ( PDOException $e ) {
			// $this->logger->error ( "Exception: ", array (
			// "message" => $e->getMessage ()) );
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
	public function findByUsername($username) {
		// $this->logger->info ( "Entering NotesDAO.findByUsername()" );
		try {
/*			$stmt = mysqli_prepare( $this->db, "SELECT * FROM `notes` WHERE `USERNAME` LIKE '%$username%'" );
			mysqli_stmt_execute($stmt);
			
			$result = $stmt->get_result();
			//check result
			if ($result) {
				// \App\Services\Utility\MyLogger1::info("Exit SecurityDAO.findAllUsers() with empty array");
				return array ();
			} else {
				// \App\Services\Utility\MyLogger1::info("Exit SecurityDAO.findAllUsers() with array of all users");
				$index = 0;
				$notes = array ();
				while ( $row = $result->fetch_assoc()) {
					$note = new Note ( $row ['USERNAME'], $row ['CONTENT'] );
					$notes [$index ++] = $note;
				}
				return $notes;
			} */
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
					if(isset($array))
						//if something is in the array return it
						return $array;
						//return if empty
						$empty=array();
						return $empty;
				}
		} catch ( PDOException $e ) {
			// \App\Services\Utility\MyLogger1::error("Exception: ", array("message" => $e->getMessage()));
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
}

