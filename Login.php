<?php
$nameerror;
$passerror;
$conn=mysqli_connect ( "localhost", "root", "", "mobile_store" ) or die("Connection failed");
 
if(isset($_POST['submit'])){
    // echo 'set';
    $q="SELECT * FROM users WHERE uname='{$_POST['username']}'";
    // echo $q;
    $result=mysqli_query($conn,$q) or die("Checking Query unsuccessful");
    if(mysqli_num_rows($result)>0){
        unset($nameerror);
        while($row=mysqli_fetch_assoc($result)){
           if($row['upass']===$_POST['pass']){
            unset($passerror);
            session_start();
            $_SESSION['name']=$row['uname'];
            $_SESSION['type']=$row['utype'];
           header("Location: index.php");
           }else{
            $passerror="wrong password";
           }
        }
    }else{
        $nameerror="user not found";
    }
    // header("Location: emptydata.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body>
    <div id="BackGround" style="background-image: url('images/web/LognBackground.jpg');">
        <br>
    <div id="LoginForm">
<!-- <i class="fa fa-cloud"></i> -->
<!-- <i class="fa fa-heart"></i>
<i class="fa fa-car"></i>
<i class="fa fa-file"></i>
<i class="fa fa-bars"></i>
<i style="font-family: FontAwesome;" class="">&#xf002</i> -->
<br><br>
        <center><h2>Login</h2></center>
        <form action="" method="post">
        <label for="">User Name</label><br><br>
        <input class="transparent" type="text" name="username" id="" required placeholder="  &#xf2bc  Enter Your UserName"><br><br>
        <?php
        if(isset($nameerror)) echo "<span style='color:red;'>{$nameerror}<span>";
        else echo "<span><span>";
        ?>
    
        <label for="">Password</label><br><br>
        <input class="transparent" type="text" name="pass" id="" required  placeholder="  &#xf023 Enter Your Password"><br>
        <?php
        if(isset($passerror)) echo "<span style='color:red;'>{$passerror}<span>";
        else echo "<span><span>";
        ?>
        <a id="ForgetPassword" href="">Forget Password?</a>
        <input name="submit" type="submit" value="Login" class="Submit">
    </form>
<center>
<p>Or Signup using</p>
<img src="images/web/Gmail icon.png" alt="" height="30px" width="30px">&nbsp;&nbsp;
<img src="images/web/FBicon.png" alt="" height="30px" width="30px"> <br>
<a href="Signup.php" id="SignUp">Signup</a>
</center>
</div>
</div>
</body>
</html>