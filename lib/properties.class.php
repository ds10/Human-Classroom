<?php

class properties{
	var $agent_id;

	function properties($agent_id=null){
		$this->agent_id=$agent_id;
	}
	
	// PUBLIC ACCESSOR FUNCTIONS TO THE COLLECTION...
	
	function get_property($term,$justdata=FALSE){
		// This form of it just gets the top property... hopefully the most recent one for the term...
		$retprops=$this->get_byterm($term);

		if (isset($retprops[0])){
			if ($justdata==TRUE){
				return $retprops[0]->getdata();
			} else {
				return $retprops[0];
			}
		} else {
			return FALSE;
		}
	}
	
	
	
	function get_properties($term=null,$justdata=FALSE){
	
		if (!is_null($term)){
			
			return $this->get_byterm($term,$justdata);
		}
	
		global $db;
		$properties=array();
		
		$sql="SELECT properties.id as id,term FROM properties JOIN terms ON properties.term_id = terms.id ";
		if (!is_null($this->agent_id)){
			$sql.="WHERE agent_id='".$this->agent_id."'";
		}
		
		$sql.=" ORDER BY data ASC ";
		
		print $sql;
		exit();
		$result=$db->queryarray($sql);
		
		foreach ($result as $thisprop){
			$properties[]=new property($thisprop['id']);
		}
		
		if ($justdata==TRUE){
			$outprops=array();
			foreach ($properties as $thisprop){
				$outprops[$thisprop->id]=$thisprop->data;
			}
			return $outprops;
		}
		
		return $properties;
	}
	

	function set_property($term,$data,$prescedence=0,$user=null){
		// If there is an existing property for $term then we set it
		// Otherwise we create a new one.
	
		if ($data==""){
			return false;
		}
		
		$ourprops=$this->get_byterm($term);
		
		// We are not allowing any multiplicity here...
		if (isset($ourprops[0])){
			$ourprops[0]->setdata($data);
		} else {
			//print "Creating new prop for $term with $data<br/>";
			$this->new_property($term,$data);
		}

		
		
	}
	
	
	// PRIVATE FUNCTIONS (yeah right)
	
		
	function new_property($term,$data){
		if ($this->agent_id != null){
			$newprop=new property();
			$newprop->createself($this->agent_id,$term,$data);
		}
	}

	function get_byclass($propclass){
		global $db;

		$properties=array();
		
		$sql="SELECT properties.id as id,
			term,
			term_classes.name as term_class
			FROM properties
			JOIN terms ON properties.term_id = terms.id
			JOIN term_classes ON terms.term_class_id = term_classes.id
			WHERE term_classes.name LIKE '$propclass' ";
			if (!is_null($this->agent_id)){
			$sql.="AND agent_id='".$this->agent_id."'";
			}
			// $sql.=" ORDER BY LOWER(data) ASC ";
		$result=$db->queryarray($sql);
	
		foreach ($result as $thisprop){
			
			$properties[]=new property($thisprop['id']);
		}
		
		return $properties;
	}
	
	function get_byclass_distinct($propclass){
		
		global $db;
		$properties=array();
		
		$sql="SELECT DISTINCT properties.data , 
			term,
			term_classes.name as term_class
			FROM properties
			JOIN terms ON properties.term_id = terms.id
			JOIN term_classes ON terms.term_class_id = term_classes.id
			WHERE term_classes.name LIKE '".$propclass."'
       		ORDER BY data";
        
        $result=$db->queryarray($sql);
		
		return $result;
		
	}
	
	
	function get_byterm($term_idorname,$justdata=FALSE){
		global $db;
		
		
		$properties=array();
		
		if (is_numeric($term_idorname)){
			$sql="SELECT properties.id as id, term FROM properties JOIN terms ON properties.term_id = terms.id
			WHERE terms.id LIKE '$term_idorname' ";
			if (!is_null($this->agent_id)){
				$sql.="AND agent_id='".$this->agent_id."'";
			}
		} else {
			$sql="SELECT properties.id as id, term FROM properties JOIN terms ON properties.term_id = terms.id 
			WHERE terms.term LIKE '$term_idorname' ";
			if (!is_null($this->agent_id)){
				$sql.="AND agent_id='".$this->agent_id."'";
			}
		}
		
		$result=$db->queryarray($sql);
		
	
		
		foreach ($result as $thisprop){
			$properties[]=new property($thisprop['id']);
		}
	
		return $properties;
	}
	
	function get_bymodule($module_idorname){
		global $db;
		
		$properties=array();
		
		if (!is_numeric($module_idorname)){
			//it's a module name... find out which module it is...
			$sql="SELECT id FROM modules WHERE name LIKE '$module_idorname'";
			$result=$db->queryarray($sql);
			
			$module_idorname=$result[0]['id'];
			// this is probably rather brittle...
			
		}
		
		$sql="SELECT properties.id as id, term FROM properties JOIN terms ON properties.term_id = terms.id WHERE terms.module_id='$module_idorname' ";
		if (!is_null($this->agent_id)){
			$sql.="AND agent_id='".$this->agent_id."'";
		}
		$result=$db->queryarray($sql);
		
		foreach ($result as $thisprop){
			$properties[]=new property($thisprop['id']);
		}
		
		
		return $properties;
	}
	
	
	function get_terms($showall=FALSE){
		global $db;
		
		$sql="SELECT *,
				modules.id AS module_id,
				terms.id as term_id,
				modules.name AS module_name,
				COUNT(properties.id) AS prop_count
			FROM modules 
			LEFT OUTER JOIN terms ON terms.module_id = modules.id 
			JOIN properties on properties.term_id=terms.id ";
		if ($showall===FALSE){
			$sql.=" WHERE browse=1 ";
		}
		$sql.="	GROUP BY terms.id";
		$sql.="	ORDER BY terms.term ASC";
		$result=$db->queryarray($sql);
		return $result;
	}
	
	function get_tagterms($showall=FALSE){
		global $db;
		$sql="SELECT *
			  FROM `terms`
			  WHERE term_class_id = '7'";
		if ($showall===FALSE){
			$sql.=" AND browse=1 ";
		}
		$sql.="	ORDER BY terms.term ASC";
		
		$result=$db->queryarray($sql);
		

		return $result;
	}
	
	function search_taglist($searchterm){
		global $db;
		$sql="SELECT DISTINCT data FROM terms 
			  JOIN properties on properties.term_id=terms.id 
			  where terms.term_class_id = '7'
			  and properties.data LIKE '%$searchterm%'
			  ORDER BY data ASC ";
	
		$result=$db->queryarray($sql);
		return $result;
	}
	

	function get_termlist($termclass=null){
		global $db;
		$sql="SELECT *
			FROM terms
			LEFT JOIN term_classes ON terms.term_class_id = term_classes.id ";
		if (!is_null($termclass)){
			$sql.=" WHERE term_classes.name LIKE '$termclass' ";
		}
		$sql.="	ORDER BY terms.term ASC";
		$result=$db->queryarray($sql);
		return $result;
	}
	
	function get_termlist_mod($modulename){
		global $db;
		$sql="SELECT *
			FROM terms
			JOIN modules ON terms.module_id = modules.id
			WHERE modules.name LIKE '$modulename'
			";
			$sql.="	ORDER BY terms.term ASC";
		$result=$db->queryarray($sql);
		return $result;
	}
	
	
	function get_termvalues($term_idorname){
	
	global $db;
		
		$properties=array();
		
		if (is_numeric($term_idorname)){
			$sql="SELECT properties.data AS value, COUNT(properties.id) AS count, term FROM properties JOIN terms ON properties.term_id = terms.id
			WHERE terms.id='$term_idorname'
			GROUP BY value
			ORDER BY value ASC
			";

		} else {
			$sql="SELECT properties.data AS value, COUNT(properties.id) AS count, term FROM properties JOIN terms ON properties.term_id = terms.id
			WHERE terms.term LIKE '$term_idorname'
			GROUP BY value
			ORDER BY value ASC
			";

		}
		$result=$db->queryarray($sql);
		
		return ($result);
	
	}
	
	
	function getbysql($sql){
		global $db;
		$properties=array();
		
		$data=$db->queryarray($sql);
		//print_r ($data);
		if (is_array($data)){
			foreach ($data as $thisprop){
				$properties[]=new property($thisprop['id']);
			}
		}
		
		return $properties;
	}

	
	
	function destroy(){
		// OMG it deletes all the records in the collection!
		// But only if we have got an associated agent...
		
		if (!is_null($this->agent_id)){
		
			$props=$this->get_properties();
			foreach ($props as $property){
				$property->destroy();
			}
		}
	}
	
	
}





class property extends database_record{
	var $term, $term_class;
	

	function property($id=null){
		$this->database_record($id,"properties");
		if (isset($this->term_id)){
			$this->term=$this->lookup_term_name($this->term_id);
			$this->term_class=$this->lookup_term_class($this->term_id);
		}
	}
	
	
	// This looks like a rather pointless bit of functionality...
	function createself($agent_id,$term,$data,$url=null){
		$this->term_id=$this->lookup_term_id($term);
		$this->agent_id=$agent_id;
		$this->setdata($data,$url);
		
		//$this->savetodb(); already done in setdata call...
	
	}
	
	function setdata($data,$url=null,$comment=null){
	
		//if the data is a null string we are going to destroy ourself! wow
	
		if ($data==""){
			$this->destroy();
			return;
		}
		
		// At this stage there really should be some sanitisation based on the class...
		$this->term_class=$this->lookup_term_class($this->term_id);
		
		switch ($this->term_class){
			case "date":
				$data=date("Y-m-d h:i:s",strtotime($data));
				break;
			case "boolean":
				if ($data=="TRUE" OR $data=="yes" OR $data>0){
					$data=1;
				} else {
					$data=0;
				}
				break;
			default:
				break;
		
		}

		//Set the data
		$this->data=$data;
		
		
		//Some props have urls associated with them - standards particularly
		$this->url=$url;
		//$this->comments=$comment;
		$this->savetodb();
		
		
		//Log this as activity
		/*
		global $user;
		$agentobj=new agent($this->agent_id);
		$items=$agentobj->activities->get_activities();
		
		//check if we have user in last comment
		
		$lastuser = false;
		
		if (isset($items[0]->details)){
			$needle = $user->name;
			$haystack = $items[0]->details;
			if (stristr($haystack, $needle)){
				$lastuser = true;
			}
		}		
	
		$activity=new activity();
		if ($lastuser==false){ //if the last comment does feature this UID
			$this->term=$this->lookup_term_name($this->term_id);
			$updatestr=$this->term." was updated by ".$user->name;
			$activity->logevent($this->agent_id,6,$updatestr,null,null,null);
		}else{ 	//hide old activity and add a new one
			$oldactivity=new activity($items[0]->id);
			$oldactivity->hide();
			$updatestr=$user->name." updated agent details";
			$activity->logevent($this->agent_id,6,$updatestr,null,null,null);
		}
		*/
	}
	
	function set_term($term){
		$this->term_id=$this->lookup_term_id($term);
		$this->savetodb();
	}
	
	function getdata(){
		
		return $this->data;

	}
	
	function getcomment(){
		
		return $this->comments;

	}
	
	function getchildobject(){
	
		$object_class=$this->term_class;
		$object_id=$this->child_id;
		if (class_exists($object_class) AND $object_id){
			return new $object_class($object_id);
		} else {
			return false;
		}
		
	}
	
	
	function setchild_id($child_id){
		$this->child_id=$child_id;
		$this->savetodb();
	}
	
	function lookup_term_id($term){
		global $db;
		
		$sql="SELECT id FROM terms WHERE term LIKE '$term' LIMIT 1";
		$result=$db->queryarray($sql);

		if (count($result)==1){
		$term_id=$result[0]['id'];
		return $term_id;
		}
	}
	
	function lookup_term_name($term_id){
		global $db;
		
		$sql="SELECT term FROM terms WHERE id='$term_id' LIMIT 1";
		$result=$db->queryarray($sql);

		if (count($result)==1){
		$term=$result[0]['term'];
		return $term;
		}
	}
	
	function lookup_term_class($term_id){
		global $db;
		
		$sql="SELECT term_classes.name
			FROM terms JOIN term_classes
			ON terms.term_class_id = term_classes.id
			WHERE terms.id='$term_id'
			LIMIT 1";
			
		$result=$db->queryarray($sql);

		if (count($result)==1){
		$class=$result[0]['name'];
		return $class;
		}
	
	}
		

}

?>
