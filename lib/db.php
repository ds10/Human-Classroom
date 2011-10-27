<?php

class db {

    var $databasehandle;

    var $dbhost='localhost';
    var $dbuser='ld_creation';
    var $dbpass='demdorfsmandemfukindorfs';
    var $dbname='ld_creation';
    
    function db($dbname=null){
    	// ERROR REPORTING
		//error_reporting('E_ALL');
    
    	if (isset($dbname)){
    	$this->dbname=$dbname;
    	}
    
        $status=$this->OpenDB();
        if ($status==FALSE) {
        	//$err="<br/>";
        	$err.="<h3>There was a problem opening the database</h3>";
        	$err.="<b>Host:</b>".$this->dbhost."<br/>";
        	$err.="<b>Username:</b>".$this->dbuser."<br/>";
        	$err.="<b>Using Password: $dbpass</b>";
        	if (isset($this->dbpass)){$err.="YES<br/>";}else{$err.="NO<br/>";}
        	//$err.="<b>Password:</b>".$this->dbpass."<br/>";
        	print $err;
        	exit();
        }
    }
    

    function OpenDB(){

        /* Open the database and handle errors if it doesn't work... */

        /* Returns TRUE if sucessful */

        

        $databasehandle = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		
        mysql_select_db($this->dbname);

        $err=mysql_error();

		

        $status=TRUE;

        if ($err) {$status=FALSE;
        
       // print $err;
        }
        
        return ($status);

    }

    

    function queryarray($sql){
    mysql_select_db($this->dbname);

        $result = mysql_query($sql);

        $returnarray = array();
        
		$err=mysql_error();
		if ($err){
			
			global $testmode;
			if ($testmode){
			print "DATABASE ERROR: ".$err;
			print "<br/>SQL: ".$sql."<br/><br/>";
			}
			return $err;
		}
		
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            array_push($returnarray, $row);

        }

        

      

        
        return $returnarray;

    }
    
    function query($sql){
    	global $db_test;
		mysql_select_db($this->dbname);
		mysql_query($sql);
		
		// Returns the id number of any inserts
		$result=mysql_insert_id();
		
		$err=mysql_error();
		
		if ($db_test){
		print "QUERY: $sql<br/>ERR: $err<br/>RESULT: $result<br/>";
		}
		
		if ($err) {
			$result=$err;
		}
		
		return $result;
            
    }
    
}


class database_collection{

	var $db_table;
	var $record_class;
	
	function database_collection($db_table,$record_class){
		$this->db_table=$db_table;
		$this->record_class=$record_class;	
	}
	
	function get_records($limit=null,$sortby=null){

		$sql="SELECT id FROM ".$this->db_table." ";
			if ($limit){
				$sql.="LIMIT $limit ";
			}
			
			if ($sortby){
				$sql.="ORDER BY $sortby ASC";
			}
			$this->get_bysql($sql);
	
	}
	
	function get_bysql($sql){
	
		global $db;
		$returnedobjects=array();
		
		$data=$db->queryarray($sql);
		//print_r ($data);
		if (is_array($data)){
			foreach ($data as $item){
				$returnedobjects[]=new $this->record_class($item['id']);
			}
		}
		if (count($returnedobjects)==0){
			return FALSE;
		} else {
			return $returnedobjects;
		}
	}
	

	

}


class database_record{
	
	var $id;
	var $db_table;
	var $isnew;
	var $col_data=array();
	
	
	function database_record($id=null,$db_table){
		
		$this->db_table=$db_table;
		
		if (is_numeric($id)){
			$this->id=$id;
			$this->loadfromdb();
		} else {
			$this->isnew=TRUE;
		}
	}
	
	function loadfromdb(){
		
		global $db;
		
		if (!is_numeric($this->id)){
			return "Error: No id set - nothing to load";
		}
		$sql="SELECT * FROM ".$this->db_table."
			WHERE id='".$this->id."'
			LIMIT 1";
		
		$data=$db->queryarray($sql);
			
		if (!is_array($data) or !isset($data[0])){
			return "Error: the data was not an array - perhaps the record doesn't exist";
		}
		
		
		$data=$data[0];
		
		foreach ($data as $key=>$value){
				$this->$key=$value;
		}
		
		return true;
	}
	
	function savetodb(){
		
		global $db;
		
		if (is_numeric($this->id)){
			$transaction="UPDATE";
			$sql="UPDATE ";//If we have an id number it's an update
	 	} else {
	 		$transaction="INSERT";
	 		$sql="INSERT INTO "; //Otherwise we are creating a new record!

	 	}
	 	$sql.=$this->db_table." ";
	
	 	
	 	$sql.="SET ";
	 	
	 	if (count($this->col_data==0)){
	 		// Get the list of fields in the table
	 		$col_sql="SHOW COLUMNS FROM ".$this->db_table;
	 		
	 		
	 		
	 		$this->col_data=$db->queryarray($col_sql);

	 	}
	 	
	 	
	 	
	 	foreach($this->col_data as $key=>$value){
	 		$field=$value["Field"];
	 		if ($field!='id'){
	 			if (isset($this->$field)){			
					$sql.="`$field`='".addslashes($this->$field)."', ";
				}
	 		}
	 	}
	 	
	 	$sql=rtrim($sql,", ");
	 	
	 	if ($transaction=="UPDATE"){
	 		$sql.=" WHERE id='".$this->id."'";
	 	}
	 	
	 	
	 	/*
	 	if ($this->db_table == "activity"){ 
	 	
	 	print $this->db_table;
	 	print $sql;
	 	exit();
	 	}
	 	*/
	 	
	 	
	 	$result=$db->query($sql);
	 	
	 	// If it was an insert we will want to retrieve the ID number and set the local variable
	 	
	 	if ($transaction=="INSERT"){
	 		//print $result;
	 		$newid=mysql_insert_id();	 		
	 		$this->isnew=FALSE;
	 		$this->id=$newid;
	 	}
		
	}
	
	
	function destroy(){
		global $db;
		if (is_numeric($this->id)){
			// Are you really sure you want to do this? it's going to delete the record!
			$sql="DELETE FROM ".$this->db_table." WHERE id=".$this->id." LIMIT 1";
			$result=$db->query($sql);
		}
		
		
	
	}
	
	
	function makepubliccomment(){
		global $db;
		if (is_numeric($this->id)){
			// Are you really sure you want to do this? it's going to delete the record!
			// UPDATE `comments`  SET PRIVATECOMMENT = "0" WHERE id = '46'
			$sql="UPDATE ".$this->db_table." SET PRIVATECOMMENT = '0' WHERE id=".$this->id." LIMIT 1";
			$result=$db->query($sql); 
		}
		
	function getprojcomment(){
		global $db;
		if (is_numeric($this->id)){
			$sql="SELECT COMMENTS FROM ".$this->db_table." WHERE id = 'this->$id' LIMIT 1";
			$result=$db->query($sql); 
		}
	}
		
	
	}
}
