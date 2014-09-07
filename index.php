<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>DB clean utils</title>
        <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    </head>
    <body>
        <form>
            <table border="0" width="100%">
                <tr>
                    <td>host:</td>
                    <td>
                        <input type="text" name="txthost" id="txthost"/>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="txtusername" id="txtusername"/>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="txtpassword" id="txtpassword"/>
                    </td>
                </tr>
                <!--
                <tr>
                    <td>Port:</td>
                    <td>
                        <input type="text" name="txtport" id="txtport"/>
                    </td>
                </tr>
                -->
                <tr>
                    <td colspan="2" align="right">
                        <input type="button" value="Connect" id="btnconnect"/>
                        <input type="reset" value="Clear"/>
                    </td>
                </tr>
            </table>
        </form>
        <hr/>
        <div id="mainDetailDiv"></div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#txthost').focus();
        
        $('#btnconnect').click(function(){
            var host = $('#txthost').val();
            var username = $('#txtusername').val();
            var password = $('#txtpassword').val();
            var port = "port";
            
            if(host !== "" && username !== "" && password !== "" && port !== ""){
                var dataString = "host="+host+"&username="+username+"&password="+password+
                        "&port="+port;
                $('#mainDetailDiv').load('files/connecttodbmsandshowlistofdatabases.php?'+dataString);
            }else{
                alert('Please enter all the fields...');
            }
            
        });
    });//end document.ready function
</script>
