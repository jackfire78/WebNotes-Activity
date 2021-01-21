<?php
namespace App\Services\BusinessServices;

use \PDO;
use App\Http\Models\Note;
use App\Services\DataService\NotesDAO;
use \mysqli;

class NotesService{ 

	public function __construct() {
    }
    
    public function create(Note $note){
        //$this->logger->info("Entering NotesService.doSubmit()");
         
    	//Azure database
    	//$db = new mysqli("localhost", "azure", "6#vWHD_$", "webnotes", "53217");
    	//Heroko and local testing database
    	$db = new mysqli("localhost", "root", "root", "webnotes");
    	
    	// Check connection
    	if ($db -> connect_errno) {
    		echo "Failed to connect to MySQL: " . $db -> connect_error;
    		exit();
    	}
        //create connection (THIS GIVE A PDOEXCEPTION ERROR-"Cannot find driver")
        //$db = new PDO("hostname:port=localhost;port=53217;dbname=webnotes;", "azure", "6#vWHD_$");
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new NotesDAO($db);
        $flag = $service->createNote($note);
         
        //close connection
        $db -> close();
        
        //return results
        //$this->logger->info("Exit NotesService.doSubmit with" . $flag);
        return $flag;
    }
    
    public function getNotes($USERNAME){
    	//$this->logger->info("Entering NotesService.getNotes()");
        
    	//Azure database
    	//$db = new mysqli("localhost", "azure", "6#vWHD_$", "webnotes", "53217");
    	//Heroko and local testing database
    	$db = new mysqli("localhost", "root", "root", "webnotes");
    	
    	// Check connection
    	if ($db -> connect_errno) {
    		echo "Failed to connect to MySQL: " . $db -> connect_error;
    		exit();
    	}
    	//create connection (THIS GIVE A PDOEXCEPTION ERROR-"Cannot find driver")
    	//$db = new PDO("hostname:port=localhost;port=53217;dbname=webnotes;", "azure", "6#vWHD_$");
    	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new NotesDAO($db);
        $notes = $service->findByUsername($USERNAME);
        
        //close connection
        $db -> close();
        
        //return results
        //$this->logger->info("Exit NotesService.getNotes with");
        return $notes;
    }

}

