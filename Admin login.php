<?php
require("connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    
    <script>
    function validateform()
    {
        var AdminName=document.myform.name.value;
        var AdminPassword=document.myform.password.value;
        if(name==null || name=="")
        {
            alert('Name cant be blank');
            return false;
        }
        else if(password.length<4){
            alert('password must be atleast 4 character');
            return false;
        }
    }



    </script>
</head>
<body>
<div class="login-form">
    <h2>ADMIN LOGIN</h2>
    <form method="POST" onsubmit="return validateform()">
        <div class="input-field">
            <label>User_name:</label>
            <input type="text" placeholder="Username" name="AdminName" require>
        </div>
        <div class="input-field">
            <label>Password: </label>
            <input type="password" placeholder="Password" name="AdminPassword" require>
        </div>
       <button type="submit" name="Signin" value="submit">Sign In</button>
        <div class="extra">
            <a href="#">Forgot password</a>
        </div>
    </form>

</div>
<?php
if(isset($_POST['Signin']))
{
    $query="SELECT * FROM `admin_login` WHERE `admin_name`='$_POST[AdminName]' AND `admin_password`='$_POST[AdminPassword]'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==1)
    {
        session_start();
        $_SESSION['AdminloginId']=$_POST['AdminName'];
        header("location:Admin panel.php");
    }
    else{
        echo"<script>alert('enter all require fields');</script>";
    }
}

?>
</body>
</html>