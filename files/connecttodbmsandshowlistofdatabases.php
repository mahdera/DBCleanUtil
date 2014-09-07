<?php
    $host = mysql_real_escape_string($_GET['host']);
    $username = mysql_real_escape_string($_GET['username']);
    $password = mysql_real_escape_string($_GET['password']);
    $port = mysql_real_escape_string($_GET['port']);
    
    require_once '../classes/DBConnection.php';
    
    $dbCon = new DBConnection($host, $username, $password, $port);
    if($dbCon){
        $databaseList = $dbCon->getListOfDatabasesFromTheConnection();
        ?>
        <table border="0" width="100%">
            <tr>
                <td>Please Select the database:</td>
                <td>
                    <select name="slctdatabase" id="slctdatabase" style="width:60%">
                        <option value="" selected="selected">--Select--</option>
                    <?php
                        while($databaseRow = mysql_fetch_object($databaseList)){
                            ?>
                            <option value="<?php echo $databaseRow->schema_name;?>"><?php echo $databaseRow->schema_name;?></option>
                            <?php
                        }//end while loop
                    ?>
                    </select>
                </td>
                <td>
                    <input type="button" value="Show Tables From Selected Database" id="btnlisttable"/>
                </td>
            </tr>
        </table>
        <hr/>
        <div id="listTableDiv"></div>
        <?php
    }else{
        echo 'Could not establish database connection...';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnlisttable').click(function(){
            var selectedDatabase = $('#slctdatabase').val();            
            if(selectedDatabase !== ""){                
                var host = "<?php echo $host;?>";                
                var username = "<?php echo $username;?>";
                var password = "<?php echo $password;?>";
                
                var dataString = "selectedDatabase="+selectedDatabase+"&host="+host+
                        "&username="+username+"&password="+password;                
                $('#listTableDiv').load('files/showlistoftablesfromdatabase.php?'+dataString);
            }else{
                alert('Select database!');
            }
        });
    });//end document.ready function
</script>

