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
			$stmt = $this->db->prepare ( "INSERT INTO `notes` (`ID`, `USERNAME`, `CONTENT`) VALUES (NULL, '$user', '$content');" );
			$stmt->execute ();

			if ($stmt->rowCount () == 0) {
				// $this->logger->info ( "Exit NoteDAO.createNote()with null" );
				return null;
			} else {
				return true;
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
			$stmt = $this->db->prepare ( "SELECT * FROM `notes` WHERE `USERNAME` LIKE '%$username%'" );
			$stmt->execute ();

			if ($stmt->rowCount () == 0) {
				// \App\Services\Utility\MyLogger1::info("Exit SecurityDAO.findAllUsers() with empty array");
				return array ();
			} else {
				// \App\Services\Utility\MyLogger1::info("Exit SecurityDAO.findAllUsers() with array of all users");
				$index = 0;
				$notes = array ();
				while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
					$note = new Note ( $row ['USERNAME'], $row ['CONTENT'] );
					$notes [$index ++] = $note;
				}
				return $notes;
			}
		} catch ( PDOException $e ) {
			// \App\Services\Utility\MyLogger1::error("Exception: ", array("message" => $e->getMessage()));
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
}

