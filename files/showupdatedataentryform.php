<?php
    $checkValues = $_GET['checkValues'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $host = $_GET['host'];
    $database = $_GET['database'];
    $table = $_GET['table'];
    
    require_once '../classes/DBConnection.php';
    
    $dbCon = new DBConnection($host, $username, $password, "port");
    
    if($dbCon){
        //now get the column names from the string checkValues...
        $columnArray = explode(',', $checkValues);
        ?>
        <form>
            <table border="0" width="100%">
                <tr style="background: #ccc">
                    <td>Column</td>
                    <td>Old Value</td>
                    <td>New Value</td>
                </tr>
                <?php
                    $rowCtr=1;
                    foreach($columnArray as $column){
                        $oldTextBoxName = "txtoldvalue" . $rowCtr;
                        $newTextBoxName = "txtnewvalue" . $rowCtr;
                        $hiddenBoxName = "txthiddenbox" . $rowCtr;
                        ?>
                            <tr>
                                <td><?php echo $column;?></td>
                                <td>
                                    <input type="text" name="<?php echo $oldTextBoxName;?>" id="<?php echo $oldTextBoxName;?>"/>
                                    <input type="hidden" name="<?php echo $hiddenBoxName;?>" id="<?php echo $hiddenBoxName;?>" value="<?php echo $column;?>"/>
                                </td>
                                <td>
                                    <input type="text" name="<?php echo $newTextBoxName;?>" id="<?php echo $newTextBoxName;?>"/>
                                </td>
                            </tr>
                        <?php
                        $rowCtr++;
                    }//end foreach loop
                ?>
                            <tr>
                                <td colspan="3" align="right">
                                    <input type="button" value="Update Old Values with New Values" id="btnupdatevalues"/>
                                    <input type="reset" value="Clear Text Boxes"/>
                                </td>
                            </tr>
            </table>
        </form>
        <?php
    }else{
        echo 'Error connecting to database!';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#btnupdatevalues').click(function(){
            var rowCtr = "<?php echo $rowCtr;?>";
            var newRowCtr = (rowCtr - 1);
            var dataString = "";
            var username = "<?php echo $username;?>";
            var password = "<?php echo $password;?>";
            var host = "<?php echo $host;?>";
            var database = "<?php echo $database;?>";
            var table = "<?php echo $table;?>";
            //now get the values from the dynamic form so that I can update the values
            //back to the database...
            for(var i=1; i <= newRowCtr; i++){
                var oldTextBoxName = "txtoldvalue" + i;
                var newTextBoxName = "txtnewvalue" + i;
                var hiddenBoxName = "txthiddenbox" + i;
                //now get values using the above define textbox names...
                var oldTextBoxValue = $('#'+oldTextBoxName).val();
                var newTextBoxValue = $('#'+newTextBoxName).val();
                var hiddenBoxValue = $('#'+hiddenBoxName).val();
                if(oldTextBoxValue !== "" && newTextBoxValue !== "" && hiddenBoxValue !== ""){
                    //now build the dataString...
                    dataString += oldTextBoxName+"="+encodeURIComponent(oldTextBoxValue)+"&"+
                            newTextBoxName+"="+encodeURIComponent(newTextBoxValue)+"&"+
                            hiddenBoxName+"="+hiddenBoxValue+"&";
                }//end validation if condition.
            }//end for...loop
            dataString += "newRowCtr="+newRowCtr+"&username="+username+"&password="+
                    password+"&host="+host+"&database="+database+"&table="+table;
            $('#dataEntryFormDiv').load('files/updatedatabasevalues.php?'+dataString);
        });
        
    });//end document.ready function
</script>
