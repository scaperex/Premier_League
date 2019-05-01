<html>
<body>
<h1>Add Parts</h1>
<?php
// Connecting to the database
$server = "tcp:yourserver.database.windows.net,1433";
$user = "yourusername";
$pass = "yourpassword";
$database = "yourdatabase";
$c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect($server, $c);
if($conn === false)
{
    echo "error";
    die(print_r(sqlsrv_errors(), true));
}
//echo "connected to DB"; //debug
// In case of success
if (isset($_POST["submit"]))
{
    // First insert data to the Parts table
    $sql = "INSERT INTO Parts(pid,pname,color) VALUES(1,'b','c');";
    // echo $sql."<br>"; //debug
    /* Example:  $sql = "INSERT INTO Parts(pid,pname,color) VALUES(1, 'TV', 'Red');"; */
    $result = sqlsrv_query($conn, $sql);
    // In case of failure
    if (!$result)
    {
        die("Couldn't add the part specified.<br>");
    }
    // Now insert data to the Catalog table
    $sql = "INSERT INTO Catalog(sid,pid,cost) VALUES (1,'b',2);";
    // echo $sql."<br>"; //debug
    $result = sqlsrv_query($conn, $sql);
    // In case of failure
    if (!$result) {
        die("Couldn't add the part to the catalog.<br>");
    }
    echo "The details have been added to the database.<br><br>";
}
?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <select name="SUPID">
        <option value="">Choose Supplier...</option>
        <?php


        echo '<option value="1">Some Supplier</option>'; //debug



        ?>
    </select>
    <h2>Part Details</h2>
    <table border="0" cellpadding="5">
        <tr>
            <td>ID</td>
            <td><input name="PID" type="text" size="10"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input name="PNAME" type="text" size="20"></td>
        </tr>
        <tr>
            <td>Color</td>
            <td><input name="COLOR" type="text" size="10"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input name="PRICE" type="text" size="5"></td>
        </tr>
        <tr>
            <td colspan="2"><br><input name="submit" type="submit" value="Send"></td>
        </tr>

    </table>
</form>
</body>
</html>
