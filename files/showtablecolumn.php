<?php
    $host = $_GET['host'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $database = $_GET['database'];
    $table = $_GET['selectedTable'];
    
    require_once '../classes/DBConnection.php';
    
    $dbCon = new DBConnection($host, $username, $password, "port");
    
    if($dbCon){
        $columnList = $dbCon->getListOfColumnsFromTable($database, $table);
        ?>
        <p>
            Please select the columns you would like to update. After after selecting the 
            columns, you are supposed to enter the old and new value for the selected columns respectively!
        </p>
        <table border="0" width="100%">
            <tr style="background: #ccc;font-weight: bold;">
                <td>Select</td>
                <td>Column</td>
                <td>Data Type</td>
                <td>Can be null ?</td>
                <td>Key</td>
                <td>Default Value</td>
                <td>Extra Info</td>
            </tr>
            <?php
                $ctr=1;
                while($columnRow = mysql_fetch_object($columnList)){
                    if($ctr % 2 === 0){
                    ?>
                        <tr style="background: #eee">
                    <?php
                    }else{
                    ?>
                        <tr style="background: #fff">
                    <?php
                    }
                    ?>
                        <td>
                            <input type="checkbox" name="checkboxlist" id="chk<?php echo $columnRow->Field;?>" value="<?php echo $columnRow->Field;?>"/>
                        </td>
                        <td><?php echo $columnRow->Field;?></td>
                        <td><?php echo $columnRow->Type;?></td>
                        <td><?php echo $columnRow->Null;?></td>
                        <td><?php echo $columnRow->Key;?></td>
                        <td><?php echo $columnRow->Default;?></td>
                        <td><?php echo $columnRow->Extra;?></td>
                    </tr>
                    <?php
                    $ctr++;
                }//end while loop
            ?>
            <tr>
                <td colspan="7" align="right">
                    <input type="button" value="Show Data Entry Form" id="btnshowdataentryform"/>
                </td>
            </tr>
        </table>
        <hr/>
        <div id="dataEntryFormDiv"></div>
        <?php
    }else{
        echo 'Error connecting to dbms';
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnshowdataentryform').click(function(){
            var checkValues = $('input[name=checkboxlist]:checked').map(function(){
                return $(this).val();
            }).get();
            
            if(checkValues != ""){
                var username = "<?php echo $username;?>";
                var password = "<?php echo $password;?>";
                var host = "<?php echo $host;?>";
                var database = "<?php echo $database;?>";
                var table = "<?php echo $table;?>";
                var dataString = "checkValues="+checkValues+"&username="+username+
                        "&password="+password+"&host="+host+"&database="+database+
                        "&table="+table;
                $('#dataEntryFormDiv').load('showupdatedataentryform.php?'+dataString);
            }else{
                alert('Please select the column(s) you want to modifiy!');
            }
            
        });
    });//end document.ready function
</script>