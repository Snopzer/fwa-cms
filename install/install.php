<?php
	if($_POST['action']=='testconnection'){
		try {
			$postQuery = $conn->query("SELECT * from table_name order by column desc")or die(mysql_error());
			} catch (MySQLException $e) {
			header("Location: http://example.com/");
		}
	}
	if($_POST['action']=='install'){
		//create table and add records to tables
		// show suceess
	}
	
?>