<?php


 include('connection.php');

 $id = 0;
 $update = false;
 $pro_name = '';
 $med_type = '';
 $pack_type = '';
 $mrp =  '';
 $expiry = '';
 $stock = '';
 $target_file = '';

    if (isset($_POST['submit'])) {
        $pro_name = ($_POST['pro_name']);
        $med_type = ($_POST['med_type']);
        $pack_type = ($_POST['pack_type']);
        $mrp = ($_POST['mrp']);
        $expiry = ($_POST['expiry']);
        $stock = ($_POST['stock']);

        $target_dir = "product_thumbs/";
        $target_file = $target_dir . basename($_FILES["pro_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["pro_img"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["pro_img"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO medicines(`pro_name`, `med_type`, `pack_type`, `mrp`, `expiry`, `stock`, `pro_url`) 
                VALUES('$pro_name','$med_type','$pack_type','$mrp','$expiry' ,'$stock' ,'$target_file')";

                if ($con->query($sql)) {
                    echo "<script> alert(Data & File has been Uploaded Successfully.)</script>";
                    header("Refresh:0");
                    header("location: stock.php");
                }
                // echo "The file ". htmlspecialchars( basename( $_FILES["productImg"]["name"])). " has been uploaded.";
                // echo "<script> alert(The file ". $target_file . " has been uploaded.)</script>";

            } else {
                echo "Sorry, there was an error saving & uploading your file.";
            }
        }
    } else {
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $con->query("DELETE FROM medicines WHERE id=$id");
        

        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";
    
        header("location: stock.php");
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $con->query("SELECT * FROM medicines WHERE id=$id");
        if($result->num_rows>0){
            $row = $result->fetch_array();
            $pro_name = $row['pro_name'];
            $med_type = $row['med_type'];
            $pack_type = $row['pack_type'];
            $mrp =  $row['mrp'];
            $expiry = $row['expiry'];
            $stock = $row['stock'];

        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $pro_name = $_POST['pro_name'];
        $med_type = $_POST['med_type'];
        $pack_type = $_POST['pack_type'];
        $mrp =  $_POST['mrp'];
        $expiry = $_POST['expiry'];
        $stock = $_POST['stock'];
        $con->query("UPDATE medicines SET pro_name='$pro_name', med_type='$med_type', pack_type='$pack_type', mrp='$mrp', expiry='$expiry', stock='$stock'   WHERE id=$id");
        
        $_SESSION['message'] = "Record has been updated";
        $_SESSION['msg_type'] = "warning";

        header('location: stock.php');

    }
    
    // , pro_url='$target_file'




        
   
     
        


    // $result = "UPDATE into medicines SET pro_name= '$pro_name',med_type='$med_type',pack_type='$pack_type',mrp='$mrp',expiry='$expiry',stock='$stock',pro_url='$target_file') where id='$id'";
    // $result = "UPDATE `medicines` SET `pro_name`='$pro_name',`med_type`='$med_type',`pack_type`='$pack_type',`mrp`='$mrp',`expiry`='$expiry',`stock`='$stock',`pro_url`='$target_file' WHERE id = '$id'";



    // $query= mysqli_query($con,$result);


// if($query){
//     echo "Your File updated";
//     header('location:medicines.php');
// }else{
// echo "Errro".mysqli_error($con);
// }

    ?>