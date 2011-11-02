<?php


class agent_manager{
	var $agents=array();
	
	function agent_manager($limit=null,$order=null,$dir="ASC"){
	
		// Returns a full set of all the agents in the system
		// as an array of objects naturally
		
		global $db;
		
		$sql="SELECT id FROM agents ";
		if ($limit!=null AND is_numeric($limit)){
			$sql.=" LIMIT $limit ";
		}
		
		if ($dir<>"ASC" AND $dir<>"DESC"){
			$dir="ASC";
		}

		if (!is_null($order)){
		switch ($order){
			case "id":
				$sql.=" ORDER BY id $dir";
				break;
			case "name":
				$sql.=" ORDER BY name $dir";
				break;
		}
		}
		$agents=$this->getbysql($sql,$order);
		//print_r($agents);
		$this->agents = $agents;
		//return $agents;
		
	}
		
		function qualifyagents($limit=null,$order=null,$dir="ASC"){
	
			foreach ($this->agents as $agent){
				$taxman=new taxonomy_manager;	
				

				$rand = rand(0, 5);
	
				
				while ( $rand > 0) {
						$newprop=new property();
						$newprop->createself($agent->id,$taxman->agent_variables[array_rand($taxman->agent_variables)]->term,'0');
					$rand--;
				}
				
				
				$rand = rand(0, 5);
				while ( $rand > 0) {
						$newprop=new property();
						$newprop->createself($agent->id,$taxman->environment[array_rand($taxman->environment)]->term,'0');
					$rand--;
				}
				
				
	
				/*
				print_r($taxman->environment_variables);
				print_r($taxman->thoughts);
				print_r($taxman->actions);
				print_r($taxman->interactions);
				*/
			}
			
		}
	
	
	
	
	function getbysql($sql,$order='title'){
		global $db;
		$agents=array();
		
		$data=$db->queryarray($sql);
		//print_r ($data);
		if (is_array($data)){
			foreach ($data as $thisagen){
				$agents[]=new agent($thisagen['id']);
			}
		}
		
	if ($order){
		$sorter = new objSorter($agents,$order);
		$agents = $sorter->sorted;
		}
		
		return $agents;
	}
	
	}

class agent extends database_record{

	
	var $properties;
	var $relationships;

	
	function agent($idorname=null){
		global $db;
		
		$id=null;
		
		// If we have been given a number, it will be an ID won't it
		if (is_numeric($idorname)){
			$id=$idorname;
			
		// If it is a string we will look ourselves up...
		} elseif (is_string($idorname)) {
			$sql="SELECT id FROM agents WHERE shortname LIKE '$idorname'";
			$data=$db->queryarray($sql);
			
			if (isset($data[0]['id'])){
				$id=$data[0]['id'];
			} else {
				// If no record exists - but we have been given a shortname - we kinda assume that we are making a record
				// but don't actually save ourselves...
				$this->shortname=$idorname;
			}
		}
		
		$this->database_record($id,"agents");
		
		if ($id != null){
			$this->properties=new properties($id);
			//$this->relationships=new agent_relationships($id);
			
		}
		
	
	}
	
	function savetodb(){
		global $user;
		
		if ($this->id==null){
			$newrec=TRUE;
		} else {
			$newrec=FALSE;
		}
	
		// Pass back to the main
	
	
		database_record::savetodb();
		if ($this->id != null){
			$this->properties=new properties($this->id);
			$this->comments=new comments($this->id);
			if ($newrec){
				$activity=new activity();
				$updatestr="New agent added by ".$user->name;
				$activity->logevent($this->id,6,$updatestr,null,null,null);
			}
			
		}
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
		
		$this->properties->destroy();
		$this->relationships->destroy();
		database_record::destroy();
	}
	

	
	
	
	
	
}

 class objSorter  
 {  
 var $property;  
 var $sorted;  
   
  
     function ObjSorter($objects_array,$property=null)   
         {  

         	
            if(isset($objects_array[0])){
            	$sample = $objects_array[0];  
             $vars       = get_object_vars($sample);  
             $r_objects_array    = $objects_array;  
   			}
         if (isset($property))  
             {  
             if (isset($sample->$property)) // make sure requested property is correct for the object  
                {     
                 $this->property = $property;  
                 usort($objects_array, array($this,'_compare'));  
                 usort($r_objects_array, array($this,'_r_compare'));  
                 }  
             else  
                 {     
                $this->sorted    = $objects_array;  
                 $this->r_sorted  = $objects_array;  
                 return;   
                 }  
             }  
         else  
             {     
                 list($property,$var)    = each($sample);  
                     $this->property      = $property;  
                 usort($objects_array, array($this,'_compare'));  
                 usort($r_objects_array, array($this,'_r_compare'));  
             }  
   
         $this->sorted    = ($objects_array);  
         $this->r_sorted  = ($r_objects_array);  
         }  
   
     function _compare($apple, $orange)   
        {   
         $property   = $this->property; 
         if (ucfirst($apple->$property) == ucfirst($orange->$property)) return 0;  
         return (ucfirst($apple->$property) < ucfirst($orange->$property)) ? -1 : 1;  
         }  
   
     function _r_compare($apple, $orange)   
         {  
         $property   = $this->property;  
         if ($apple->$property == $orange->$property) return 0;  
         return ($apple->$property > $orange->$property) ? -1 : 1;  
         }  
   
 }  


?>