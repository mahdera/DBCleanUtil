<?php
    require_once '../classes/DBConnection.php';
    
    $username = $_GET['username'];
    $password = $_GET['password'];
    $host = $_GET['host'];
    $database = $_GET['database'];
    $table = $_GET['table'];
    $newRowCtr = $_GET['newRowCtr'];
    
    $dbCon = new DBConnection($host, $username, $password, "port");
    
    for($i = 1; $i <= $newRowCtr; $i++){
        $oldTextBoxName = "txtoldvalue" . $i;
        $newTextBoxName = "txtnewvalue" . $i;
        $hiddenBoxName = "txthiddenbox" . $i;
        //echo $oldTextBoxName;
        //now get values using the above define textbox names...
        
        $oldTextBoxValue = $_GET["$oldTextBoxName"];
        $newTextBoxValue = $_GET["$newTextBoxName"];
        $hiddenBoxValue = $_GET["$hiddenBoxName"];
        //echo $oldTextBoxValue.' '.$newTextBoxValue.' '.$hiddenBoxValue;
        //now got the correct values...
        //compose the SQL update statement and update it respectively...
        $query = "UPDATE $table SET $hiddenBoxValue = '$newTextBoxValue' WHERE $hiddenBoxValue = '$oldTextBoxValue'";
        
        if($dbCon){
            $rc = $dbCon->executeQuery($database, $query);
            if($rc === 1){
                echo "<p style='background:lightgreen'>Successfully Executed: $query</p>";
            }else{
                echo "<p style='background:red'>No matching condition! Hence did not execute query!</p>'";
            }
        }else{
            echo 'Error connecting to DBMS';
        }
    }//end for...loop
?>