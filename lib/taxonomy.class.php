<?php


class taxonomy_manager{
	var $environment=array();
	var $environment_variables=array();
	var $thoughts=array();
	var $actions=array();
	var $interactions=array();
	
	function taxonomy_manager(){
		//get all the different types put them into arrays
		$this->environment= $this->getbysql("SELECT id FROM terms WHERE module_id ='3'");
		$this->environment_variables= $this->getbysql("SELECT id FROM terms WHERE module_id ='4'");
		$this->thoughts= $this->getbysql("SELECT id FROM terms WHERE module_id ='10'");
		$this->actions= $this->getbysql("SELECT id FROM terms WHERE module_id ='11'");
		$this->interactions= $this->getbysql("SELECT id FROM terms WHERE module_id ='14'");
		$this->agent_variables= $this->getbysql("SELECT id FROM terms WHERE module_id ='2'");
	}
		
	function getbysql($sql){
		global $db;
		$terms=array();
		$data=$db->queryarray($sql);
		
		if (is_array($data)){
			foreach ($data as $thisterm){
				$terms[]=new term($thisterm['id']);
			}
		}
	
		return $terms;
	}
		
}
	
	
	


class term extends database_record {

	
	function term($id){
		global $db;
		
		//create a term by its ID.. do we actually need anything other than the term ID and its text name
		//who knows
		
		$this->database_record($id,"terms");	
	
	}
	
	function savetodb(){
		
		if ($this->id==null){
			$newrec=TRUE;
		} else {
			$newrec=FALSE;
		}
	
		// Pass back to the main
	}
	
	function setattribute($term,$data){
		// Should be some validation here...
		
		$this->$term=$data;
		$this->savetodb();
		
	}
	
	function getattribute($term){
		// if the term exists - return it
		if (isset($this->$term)){		
			return $this->$term;
		} else {
			return FALSE;
		}
	
	}
	
	
	function destroy(){
		// This will actually destroy the database record
		// and all the properties and activities associated with the agent...
		
		database_record::destroy();
	}
	

	
	
	
	
	
}



?>