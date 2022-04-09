<?php
include 'connection.php';
if (isset($_POST['add']))
{
    $item =$_POST['item'];
    $quantity=$_POST['quantity'];
    $mrp =$_POST['mrp'];
    $gst =$_POST['gst'];
    $discount =$_POST['discount'];
    $rate =$_POST['rate'];
    $amount =$_POST['amount'];
    $sql="INSERT INTO `invoice_data`( `item`, `quantity`, `mrp`, `gst`, `discount`, `rate`, `amount`) VALUES ('$item','$quantity','$mrp',$gst,$discount,$rate,$amount)";
    if
    (mysqli_query($con,$sql))
    {
        echo "<script>
        alert('added succesfully')
        
        </script>";
    }
    else{
    "error:" .mysqli_error($con);
    mysqli_close($con);
    }
    header('location:billing.php');
}