<?php
session_start();

if (!isset($_SESSION['AdminloginId'])) {
    header("location: Admin login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0px;
        }

        div.header {
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: blueviolet;

        }

        div.header h1 {
            color: white;
            font-size: 25px;
        }

        div.header button {
            background-color: aqua;
            font-weight: 300;
            font-family: poppins;
            font-size: 16px;
            padding: 0px 15px;
            border: 2px solid black;
            border-radius: 5px;


        }

        .row.content {
            height: 450px
        }


        .sidenav {
            padding-top: 30px;
            background-color: blueviolet;
            height: 145%;
        }

        .sidenav p a {
            color: white;
            font-size: medium;
            font-weight: 200;

        }



        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }


        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>

</head>

<body>
    <div class="header">
        <h1> Welcome to Admin Pannel - <?php echo $_SESSION['AdminloginId'] ?></h1>
        <form method="POST">
            <button name="LogOut">LogOut</button>
        </form>
    </div>

    <?php
    if (isset($_POST['LogOut'])) {
        session_destroy();
        header('location: Admin login.php');
    }

    ?>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                    <a class="list-group-item list-group-item-action " href="Admin panel.php">Dashboard</a>
                    <a  class="list-group-item list-group-item-action active" href="stock.php">Stock</a>
                    <a class="list-group-item list-group-item-action " href="billing.php">Billing</a>
                    <a class="list-group-item list-group-item-action " href="in.php">Invoice</a>
            </div>
            <div class="col-sm-10 text-left">
            <?php require 'process.php';?>

<?php 
    if (isset($_SESSION['message'])):
?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
</div>
<?php endif ?>

<div class="container mt-5">
    
    <form class="row g-3" action="process.php" method="POST" enctype="multipart/form-data">
        <div class="col-md-5">
            <input type="hidden" name="id" value="<?php echo $id; ?>">  
            <label for="pro_name" class="form-label">Product Name: </label>
            <input type="text" class="form-control" name="pro_name" id="pro_name" value="<?php echo $pro_name; ?>"> <br>

            <label for="med_type" class="form-label"> Medicine Type: </label>
            <input type="text" class="form-control" name="med_type" id="med_type" value="<?php echo $med_type;?>"> <br>

            <label for="pack_type" class="form-label"> Pack Type: </label>
            <input type="text" class="form-control" name="pack_type" id="pack_type" value="<?php echo $pack_type;?>"> <br>

            <label for="mrp" class="form-label"> MRP: </label>
            <input type="text" class="form-control" name="mrp" id="mrp" value="<?php echo $mrp;?>"> <br>

            <label for="expiry" class="form-label"> Expiry: </label>
            <input type="date" class="form-control" name="expiry" id="expiry" value="<?php echo $expiry;?>"> <br>

            <label for="stock" class="form-label"> Stock: </label>
            <input type="text" class="form-control" name="stock" id="stock" value="<?php echo $stock; ?>"> <br>

            <label for="pro_img" class="form-label"> Product Image: </label>
            <input type="file" class="form-control" name="pro_img" id="pro_img" value="<?php echo $target_file;?>"> <br>

            <?php 
                if($update == true):
            ?>
                <button type="submit" class="btn btn-info" value="Update" name="update">Update</button>
            <?php else: ?>                
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <table class="table table-sm table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col">Sr No.</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Medicine Type</th>
                        <th scope="col">Pack Type</th>
                        <th scope="col">MRP</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql1 = "SELECT * FROM `medicines` WHERE 1";
                    $resultset = $con->query($sql1);
                    $sno = 1;
                    if ($resultset->num_rows > 0) {
                        while ($row = $resultset->fetch_assoc()) {

                    ?>
                            <tr>
                                <th scope="row"> <?php echo $sno++; ?></th>
                                <td> <?php echo $row['pro_name'] ?> </td>
                                <td> <?php echo $row['med_type'] ?> </td>
                                <td> <?php echo $row['pack_type'] ?></td>
                                <td> <?php echo $row['mrp'] ?> </td>
                                <td> <?php echo $row['expiry'] ?> </td>
                                <td> <?php echo $row['stock'] ?> </td> 
                                <td> <img src="<?php echo $row['pro_url'] ?>" style="width: 150px; height: 150px"> </td>
                                <td> 
                                    <a href="stock.php?edit=<?php echo $row['id']; ?>" class="btn btn-info"> Edit </a> 
                                    <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"> Delete </a>
                                </td>
                                

                            </tr>
                    <?php
                        }
                    } else {
                        echo "<script> alert(No Data Found...)</script>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>
</body>

</html>