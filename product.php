<?php
$conn=mysqli_connect ( "localhost", "root", "", "mobile_store" ) or die("Connection failed"); 
$q="SELECT * FROM products WHERE pname={$_GET['name']}";
// echo $q;
$result=mysqli_query($conn,$q) or die("Checking Query unsuccessful");
// echo '<pre>'; print_r($_GET); echo '</pre>';
// echo '<pre>'; print_r($result); echo '</pre>';
if(mysqli_num_rows($result)>0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4698c91ecf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>product</title>
</head>
<body>
    <div class="grid-container">
        <!-- <div w3-include-html="header.html"></div> -->
        <?php include 'header.php';?>
        
    </div>
     <?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="grid-container" style="padding: 20px;">
        <div class="grid-item">
            <div id="pImage">
                <img src="images/produts/<?php echo $row['pimage'];?>" alt="" style="width:100%;">
            </div>
        </div>
        <div class="grid-item">
            <div class="flex-container" style="flex-direction: row;">
                <div >
                    <h2 style="font-weight: normal;"><?php echo $row['pname'];?></h2>
                </div>
                <!-- <hr style="height: 5px; width:100%; background-color:black; margin: 10px 0px;"> -->
                <div style="width: 100%;">
                </div>
                <!-- <hr style="height: 5px; width:100%; background-color:black; margin: 10px 0px;"> -->
                <div style="text-align: left; font-size: 20px; margin:30px auto; padding-bottom: 100px;">
                    <p style="margin: 10px 0px;"><b>About this item</b></p>
                    <p style="margin: 10px 0px;"><?php echo $row['pdescrip']; ?></p>
                </div>
            </div>
        </div>
        <div class="grid-item" id="p-grid-item3" >
            <div id="addToCart-box">
                <p><?php echo $row['pname'];?></p>
                <span id="addToCart-box-span">$<span id="value"><?php echo $_GET['price'];?></span></span>
                <button class="btn" id="addToCartBtn">Add to cart</button>
                <button class="hidden btn" id="removeToCartBtn">Remaove from cart</button>
            </div>
        </div>
    </div>
    <?php }}?>
</body>
<script src="cart.js"></script>        
</html>