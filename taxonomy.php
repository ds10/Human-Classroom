<?php

// class loader
require_once 'lib/init.php';

if (isset($_REQUEST['action'])){
	$action=$_REQUEST['action'];
	
	switch ($action){
		case "new_term":
			if (isset($_REQUEST['term_name']) AND isset($_REQUEST['module_id'])){
				$term=$_REQUEST['term_name'];
				$module_id=$_REQUEST['module_id'];
				$sql="INSERT INTO terms SET term='$term', module_id='$module_id'";
				$result = $db->query($sql);
			}
			
			break;
			
		case "new_module":
			if (isset($_REQUEST['module_name'])){
				$module_name=$_REQUEST['module_name'];
				$sql="INSERT INTO modules SET name='$module_name'";
				$result=$db->query($sql);
			}
			
			break;
	}

}


// List the taxonomies by module
	
$sql="SELECT *,
		modules.id AS module_id,
		terms.id as term_id,
		modules.name AS module_name,
		term_classes.id AS class_id,
		term_classes.name AS class_name,
		terms.multiple AS multiple,
		terms.necessary AS necessary
	FROM modules 
	LEFT OUTER JOIN terms ON terms.module_id = modules.id 
	LEFT JOIN term_classes ON terms.term_class_id = term_classes.id";

$taxonomydata=$db->queryarray($sql);
$smarty->assign("taxonomies",$taxonomydata);


$sql="SELECT * FROM term_classes";
$classes=$db->queryarray($sql);
$smarty->assign("classes",$classes);

	
$smarty->display("headers.tpl");
$smarty->display("taxonomy-admin.tpl");
$smarty->display("footers.tpl");

?>