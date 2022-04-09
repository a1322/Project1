<?php
session_start();

if (!isset($_SESSION['AdminloginId'])) {
    header("location: Admin login,php");
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
                    <a  class="list-group-item list-group-item-action " href="stock.php">Stock</a>
                    <a class="list-group-item list-group-item-action " href="billing.php">Billing</a>
                    <a class="list-group-item list-group-item-action active" href="in.php">Invoice</a>
            </div>
            <div class="col-sm-8 text-left">



            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>
</body>

</html>