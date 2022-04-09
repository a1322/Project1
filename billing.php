<?php
session_start();

if (!isset($_SESSION['AdminloginId'])) {
    header("location: Admin login,php");
}
?>
<?php
include('connection.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>



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
    <script>
        function putData() {
            let mrp = parseFloat(document.getElementById("mrp").value);
            let qty = parseFloat(document.getElementById("qty").value);
            let gst = parseFloat(document.getElementById("gst").value);
            let dis = parseFloat(document.getElementById("dis").value);
            let disamt = mrp - (mrp * (dis / 100));
            let gstamt = disamt + (disamt * (gst / 100));

            let amt = gstamt * qty;
            document.getElementById("amt").value = amt;
            document.getElementById("rate").value = gstamt;
            //alert("hello check"+amt)
        }
       $(document).ready(function()
       {
           var html ='<tr><td><input id="check_all" type="checkbox" class="itemRow" /></td><td><input type="text" id="item" name="item" placeholder="Enter item" class="formcontrol"></td><td><input type="number" id="qty" name="quantity" placeholder="Enter Quantity" class="formcontrol"></td><td><input type="number" id="mrp" name="mrp" placeholder="Enter mrp" class="formcontrol"></td><td><input type="number" id="gst" name="gst" placeholder="Enter gst" class="formcontrol"></td><td><input type="number" id="dis" name="discount" placeholder="Enter discount" onchange="putData()" class="formcontrol"></td><td><input type="number" id="rate" name="rate" placeholder="Enter rate" class="formcontrol"></td><td><input type="number" id="amt" name="amount" class="formcontrol"></td></tr>';
           var x =1;  
           $('#add').click(function()
           {
               $('#myTable').append(html);
           });
      
        });
    </script>

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
                <a class="list-group-item list-group-item-action " href="stock.php">Stock</a>
                <a class="list-group-item list-group-item-action active" href="billing.php">Billing</a>
                <a class="list-group-item list-group-item-action " href="in.php">Invoice</a>
            </div>
            <div class="col-sm-10 text-left">
                <form method="POST" action="post_data.php" id="invoice" class="form-group">

                    <div class="col-sm-6 ">
                        <div class="leftside d-flex justify-content-left align-items-left">
                            <pre style="text-decoration: none;">  <h1>From,</h1>Sarawagi,Nawabganj
                            <br>Barabanki-225001
                            <br>Uttar Pradesh</pre>

                        </div>
                    </div>
                    <div class="col-sm-6 " style="justify-items: auto;"">
                         <div class=" rightside d-flex justify-content-right align-items-right">

                        <h1>To,
                            <br>
                        </h1>
                        <ul style="list-style-type: none;" style="list-style-position: outside;">
                            <li>
                                <input type="date" id="date" name="date" class="form-control"></br>
                            </li>
                            <li>
                                <input type="text" id="phoneNum" name="number" placeholder="number" class="form-control"></br>
                            </li>
                            <li>
                                <input type="text" id="name" name="name" placeholder="name" class="form-control"></br>
                            </li>
                            <li>
                                <textarea name="address" id="" cols="5" rows="2" placeholder="address" class="form-control">Address</textarea>
                            </li>
                        </ul>





                    </div>



            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-sm" id="myTable ">
                        <thead>
                            <tr>
                                <th width="2%"><input id="check_all" class="formcontrol" type="checkbox" />
                                </th>
                                <th width="30%">
                                    item
                                </th>
                                <th width="8%">
                                    Quantity
                                </th>
                                <th width="5%">
                                    Mrp
                                </th>
                                <th width="5%">
                                    Gst
                                </th>
                                <th width="6%">
                                    Disc
                                </th>
                                <th width="6%">
                                    Rate
                                </th>

                                <th width="6%">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><input id="check_all" type="checkbox" class="itemRow" /></td>
                                <td>
                                    <input type="text" id="item" name="item" placeholder="Enter item" class="formcontrol">
                                </td>
                                <td>
                                    <input type="number" id="qty" name="quantity" placeholder="Enter Quantity" class="formcontrol">
                                </td>
                                <td>
                                    <input type="number" id="mrp" name="mrp" placeholder="Enter mrp" class="formcontrol">
                                </td>
                                <td>
                                    <input type="number" id="gst" name="gst" placeholder="Enter gst" class="formcontrol">
                                </td>
                                <td>
                                    <input type="number" id="dis" name="discount" placeholder="Enter discount" onchange="putData()" class="formcontrol">
                                </td>
                                <td>
                                    <input type="number" id="rate" name="rate" placeholder="Enter rate" class="formcontrol">
                                </td>

                                <td>
                                    <input type="number" id="amt" name="amount" class="formcontrol">
                                </td>


                            </tr>

                        </tbody>




                    </table>
                    <br>
                    <input type="submit" class="btn btn-success" value="Add" name="add">
                    <button class="btn btn-danger">DELETE</button>
                    <div>
                        <table class="table table-sm table-striped table-bordered align-middle" id="table_2">
                            <thead>
                                <tr>
                                    <th scope="col">Sr No.</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Mrp</th>
                                    <th scope="col">Gst</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Amount</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql1 = "SELECT * FROM `invoice_data` WHERE 1";
                                $resultset = $con->query($sql1);
                                $sno = 1;
                                if ($resultset->num_rows > 0) {
                                    while ($row = $resultset->fetch_assoc()) {

                                ?>
                                        <tr>
                                            <th scope="row"> <?php echo $sno++; ?></th>
                                            <td> <?php echo $row['item'] ?> </td>
                                            <td> <?php echo $row['quantity'] ?> </td>
                                            <td> <?php echo $row['mrp'] ?></td>
                                            <td> <?php echo $row['gst'] ?> </td>
                                            <td> <?php echo $row['discount'] ?> </td>
                                            <td> <?php echo $row['rate'] ?> </td>
                                            <td> <?php echo $row['amount'] ?></td>


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
                    <div>
                       
                    

                    </div>
                </div>

            </div>
            </form>




        </div>
    </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>
</body>

</html>