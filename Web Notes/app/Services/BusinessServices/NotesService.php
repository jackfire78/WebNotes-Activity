<?php
namespace App\Services\BusinessServices;

use \PDO;
use App\Http\Models\Note;
use App\Services\DataService\NotesDAO;

class NotesService{ 

	public function __construct() {
    }
    
    public function create(Note $note){
        //$this->logger->info("Entering NotesService.doSubmit()");
                
        //create connection
        $db = new PDO("mysql:host=localhost;port=3306;dbname=webnotes;", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new NotesDAO($db);
        $flag = $service->createNote($note);
         
        //close connection
        $db = null;
        
        //return results
        //$this->logger->info("Exit NotesService.doSubmit with" . $flag);
        return $flag;
    }
    
    public function getNotes($USERNAME){
    	//$this->logger->info("Entering NotesService.getNotes()");
        
        //create connection
        $db = new PDO("mysql:host=localhost;port=3306;dbname=webnotes;", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new NotesDAO($db);
        $notes = $service->findByUsername($USERNAME);
        
        //close connection
        $db = null;
        
        //return results
        //$this->logger->info("Exit NotesService.getNotes with");
        return $notes;
    }

}

