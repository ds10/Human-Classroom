<?php

// INIT SCRIPT
// Sets up templating, databases, event manager, aggregator, etc


// Deal with Error reporting

if (strpos($_SERVER['SERVER_NAME'],"cetis.ac.uk")!==FALSE){
	
	// WHEN RUNNING FROM A REAL WEBSERVER
	// Do not display errors etc
	
    error_reporting(E_ALL);
    ini_Set("display_errors",false); 
    $testmode=true;
    $db_test=true;

} else {

	// WHEN RUNNING LOCALLY
	error_reporting(E_ALL);
	ini_Set("display_errors",false); 
	$testmode=false; // Logs in as a fake user
	$db_test=false; // Displays extra databse messages

}

// THE FOLLOWING is a fudge - 
// if we are being called from the CLI it needs to pretend to be logged in

if (php_sapi_name()=="cli"){
	$climode=TRUE;
	$testmode=true;
}

// Deal with paths and the lib directory - taken from sam's standard set of routines for this


$env_libdir=dirname(__FILE__); // The lib directory of the site in which this file resides
$env_peardir=$env_libdir."/pear/PEAR";

set_include_path(get_include_path().PATH_SEPARATOR.$env_libdir.PATH_SEPARATOR.$env_peardir); // add the directory to the include path


$env_basedir=substr($env_libdir,0,-3); // strip off the last three chars "lib" for the basedir


$env_subdir=substr($env_basedir,strlen($_SERVER['DOCUMENT_ROOT'])); // Determine the subdirectory from the docroot


$env_subdir=str_replace("\\","/",$env_subdir);
$env_subdir=trim($env_subdir,"/");

if ($env_subdir!=""){
	$env_subdir="/".$env_subdir;
}


// Determine the base url
//$env_baseurl='http'.(isset($_SERVER['HTTPS'])?$_SERVER['HTTPS']=='on'?'s':'':'');
$env_baseurl='http://'.$_SERVER['HTTP_HOST'];

//$env_baseurl="http://prod.cetis.ac.uk";


$env_fullself=$env_baseurl.rtrim($_SERVER["REQUEST_URI"],"/");
$env_scriptname=$env_baseurl.rtrim($_SERVER["SCRIPT_NAME"],"/");

// And append our working subdirectory
// may also be worth checking for multiple slashes in the subdir - if we are several directories deep!
if ($env_subdir!="") {
	$dir=trim($env_subdir,'\,/');
	 $env_baseurl.="/$dir";
}


$env_self=$_SERVER['SCRIPT_NAME'];


// SMARTY ---------
require_once 'lib/smarty/libs/Smarty.class.php';
$smarty=new smarty;

$smarty->plugins_dir=array('plugins',//thedefaultunderSMARTY_DIR
'smarty-plugins'
);

$smarty->template_dir=$env_basedir."templates";
$smarty->compile_dir=$env_basedir."templates_c";

$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->assign("env_basedir",$env_basedir);
$smarty->assign("env_subdir",$env_subdir);
$smarty->assign("env_baseurl",$env_baseurl);
$smarty->assign("env_self",$env_self);
$smarty->assign("env_fullself",$env_fullself);
$smarty->assign("env_scriptname",$env_scriptname);
$smarty->assign("env_getrequest",$_GET);

// DATABASE -----------

require_once 'db.php';
$db=new db;

// OTHER CLASSES
require_once 'agent.class.php';
require_once 'properties.class.php';
require_once 'taxonomy.class.php';

$agentman=new agent_manager;

?>
