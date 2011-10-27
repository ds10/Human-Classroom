<?php

// class loader
require_once 'lib/init.php';


if (isset($_REQUEST['action'])){
	// This bit is just for managing the checkboxes...
	$action=$_REQUEST['action'];
	$termid=$_REQUEST['termid'];
	$property=$_REQUEST['property'];
	$value=$_REQUEST['value'];
	
	if ($value=="on"){$value=1;} else {$value=0;}
	//error_log("I want to $action with term $termid - setting $property to $value");
	
} else {


	
	if (isset($_REQUEST['editorId'])){
		$editorid=$_REQUEST['editorId'];
		$editorid=explode("-",$editorid);
	//	print_r ($editorid);
	} else {
		echo ("What is going on? Nothing was asked for...");
		exit();
	}
	
	
	if (isset($editorid[0])){
		if ($editorid[0]=="term"){
			//we are assuming
			$action='edit_term';
			$property='name';
		}
	}
	
	if (isset($editorid[0])){
		if ($editorid[0]=="scale"){
			//we are assuming
			$action='edit_term';
			$property='scale';
		}
	}
	
	if (isset($editorid[0])){
		if ($editorid[0]=="agent"){
			//we are assuming
			$action='edit_term';
			$property='agent';
		}
	}
	
	
	
	if (isset($editorid[1])){
		if (is_numeric($editorid[1])){
			$termid=$editorid[1];
		}
	}
	
	if (isset($editorid[2])){
		if ($editorid[2]=="class"){
			$property='class';
		}
	}
	
	if (isset($editorid[2])){
		if ($editorid[2]=="classag"){
			$property='classag';
		}
	}
	
	if (isset($_REQUEST['value'])){
		$value=$_REQUEST['value'];
	} else {
		echo "Error: No value given";
		exit;
	}


}


switch ($action){
	case "edit_term":
		
		switch ($property){
			case 'class':
				$sql="SELECT id FROM term_classes WHERE name='$value'";
				$ourid=$db->queryarray($sql);
				if (isset($ourid[0]['id'])){
					$classid=$ourid[0]['id'];
				} else {
					echo "Error: term not found";
				}
				
				$sql="UPDATE terms SET term_class_id='$classid' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
				
		case 'classag':
				$sql="SELECT id FROM terms WHERE term='$value'";
				$ourid=$db->queryarray($sql);
				if (isset($ourid[0]['id'])){
					$classid=$ourid[0]['id'];
				} else {
					echo "Error: term not found";
				}
				
				$sql="INSERT INTO properties (term_id, agent_id) VALUES ('$classid', '$termid')";
				$db->query($sql);
				echo ($value);
				break;
		
			case 'name':
				$sql="UPDATE terms SET term='$value' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
				
			case 'scale':
				$sql="UPDATE terms SET scale='$value' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
				
			case 'multiple':
				$sql="UPDATE terms SET multiple='$value' WHERE id='$termid' LIMIT 1";
				error_log($db->query($sql));
				echo ($value);
				break;
				
			case 'necessary':
				$sql="UPDATE terms SET necessary='$value' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
				
			case 'scalable':
				$sql="UPDATE terms SET scalable='$value' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
				
			case 'agent':
				$sql="UPDATE agents SET name='$value' WHERE id='$termid' LIMIT 1";
				$db->query($sql);
				echo ($value);
				break;
					
		}				
	
		
		break;
		
}





?>