<?php

require_once "lib/init.php";

 /*
  * if we are creating a new scenario then give the 'player' some options,
  * do some voodoo on the options, display and store scenario Otherwise 
  * print main page. natch
  * 
  */

 if  ($_REQUEST['create'] == "new"){
 	
 	$smarty->display("headers.tpl");
	$smarty->display("create.tpl");
	$smarty->display("footers.tpl");
 	
 }elseif ($_REQUEST['create'] == "data"){
 	
 	$sql="truncate table agents";
	$result = $db->query($sql);

	$sql="truncate table properties";
	$result = $db->query($sql);
	
	
 	//now create a new one, start with just creating agents
 	//We have an array of names for our person!
	$arrayofnames = file("names.txt");
	while ($_REQUEST['num_agents']>0){
		$sql="INSERT INTO agents SET name='" . $arrayofnames[array_rand($arrayofnames)]."'";
		$result = $db->query($sql);
		$_REQUEST['num_agents']--;
	}
	
	$sql="SELECT *,
		agents.id as agent_id,
		agents.name AS agent_name
	FROM agents ";
	
	$agents=$db->queryarray($sql);
	$smarty->assign("agents",$agents);
	
	$sql="SELECT terms.id as term_id, terms.term AS agent_type
	FROM terms 
	LEFT JOIN term_classes ON term_classes.id = terms.term_class_id 
        WHERE term_classes.name = 'Agent'";
	
    $agent_types=$db->queryarray($sql);
	$smarty->assign("agent_types",$agent_types);
	
	//we have agents now let user set what type they are
	//then add all the voodoo
	
 	$smarty->display("headers.tpl");
	$smarty->display("agents.tpl");
	$smarty->display("footers.tpl");
 }elseif($_REQUEST['create'] == "generate"){

 	// We want to show some agents - better make a collection object
	
 	
 	$sql="SELECT * FROM term_classes";
	$classes=$db->queryarray($sql);
	$smarty->assign("classes",$classes);
	$smarty->assign("agents",$agentman->agents);
	$agentman->qualifyagents();
	
	$smarty->display("headers.tpl");
	$smarty->display("showcreated.tpl");
	$smarty->display("footers.tpl");
 }else{
	$smarty->display("headers.tpl");
	$smarty->display("index.tpl");
	$smarty->display("footers.tpl");
 }
	//We have an array of names for our person!
	


	
	
?>