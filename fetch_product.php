<?php
include("connection.php");
$sql = "SELECT * FROM invoice_data WHERE id='".$_POST['id']."'";
while($row = mysqli_fetch_assoc($query))
{
    $data= $row;
}
echo json_encode($data);

?>