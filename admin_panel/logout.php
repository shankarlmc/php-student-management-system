<?php 

// 1. Find the session
@session_start();


 // $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
 //          VALUES (".$_SESSION['IDNO'].",'".date('Y-m-d H:i:s')."','Student','Logged out')";
 //           $mydb->setQuery($sql) ;
 //          $mydb->executeQuery();


		unset($_SESSION['staff_unique_id']);   		 
		unset($_SESSION['staff_name']); 	 
			 

// 4. Destroy the session
session_destroy();
header("location:../index.php?logout=1");
?> 	 