<?php
    $selectedDatabase = $_GET['selectedDatabase'];
    require_once '../classes/DBConnection.php';
    $host = $_GET['host'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $database = $_GET['selectedDatabase'];
    $port = "port";
    $dbCon = new DBConnection($host, $username, $password, $port);
    if($dbCon){
        $tableList = $dbCon->getListOfTablesFromDatabase($database);
        ?>
        <table border="0" width="100%">
            <tr>
                <td>Select Table:</td>
                <td>
                    <select name="slcttable" id="slcttable" style="width: 60%">
                        <option value="" selected="selected">--Select--</option>
                    <?php
                        while($tableRow = mysql_fetch_object($tableList)){
                            $columnName = "Tables_in_" . $database;
                            ?>
                                <option value="<?php echo $tableRow->$columnName;?>"><?php echo $tableRow->$columnName;?></option>
                            <?php
                        }//end while loop
                    ?>
                    </select>
                </td>
                <td>
                    <input type="button" value="Show Columns" id="btnshowcolumn"/>
                </td>
            </tr>
        </table>
        <hr/>
        <div id="tableColumnDiv"></div>
        <?php
    }else{
        echo 'Connection error!';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnshowcolumn').click(function(){
            var selectedTable = $('#slcttable').val();
            if(selectedTable !== ""){
                var username = "<?php echo $username;?>";
                var password = "<?php echo $password;?>";
                var host = "<?php echo $host;?>";
                var database = "<?php echo $database;?>";
                
                var dataString = "selectedTable="+selectedTable+"&username="+username+
                        "&host="+host+"&password="+password+"&database="+database;
                $('#tableColumnDiv').load('files/showtablecolumn.php?'+dataString);
            }else{
                alert('Select table!');
            }
        });
    });//end document.ready function
</script>
