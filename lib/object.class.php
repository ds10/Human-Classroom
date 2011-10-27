<?php






class object extends database_record{
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
		$this->comments=$comment;
		$this->savetodb();
		
		
		//Log this as activity
		global $user;
		$agentobj=new agent($this->agent_id);
		$items=$agentobj->activities->get_activities();
		
		//check if we have user in last comment
		/*
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
