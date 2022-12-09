<?php
// echo '<pre>'; print_r($_POST); echo '</pre>';
if($_POST['tosearch']==="" ){
header("Location: index.php");
}

$conn=mysqli_connect ( "localhost", "root", "", "mobile_store" ) or die("Connection failed"); 
$q="SELECT * FROM products WHERE products.pname LIKE '%{$_POST['tosearch']}%'";
$result=mysqli_query($conn,$q) or die("Checking Query unsuccessful");
// echo '<pre>'; print_r($result); echo '</pre>';
if(mysqli_num_rows($result)>0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4698c91ecf.js" crossorigin="anonymous"></script>
    <title>Index</title>
</head>
<body>  
    <div class="grid-container">
      <!-- <div w3-include-html="header.html"></div> -->
        <?php include 'header.php';?>
        <div class="grid-item item3"></div>  
        <div class="grid-item item4">
          
          <div class="sub-grid-container">
            <?php
         
            $price=500;
            // while($row=mysqli_fetch_assoc($result)){
            while($row=mysqli_fetch_assoc($result)){
            // echo '<pre>'; print_r($row); echo '</pre>';
          ?>
            <div class="sub-grid-item">
              <a href="product.php?name='<?php echo $row['pname']; ?>'&price=<?php echo $price; ?>">
              <div class="card">
                <div id="card-img-container">
                <img src="images/produts/<?php echo $row['pimage'];?>" alt="Avatar">
                </div>
                <div class="container">
                  <h4><b>$<span><?php echo $price;  ?></span></b></h4> 
                  <p><?php echo $row['pname']; ?></p> 
                </div>
              </div>
            </a>
            </div>
          <?php
          $price=$price+100; 
        }}
        ?>
          </div>
          
      </div>
        <!-- <div class="grid-item">5</div>
        <div class="grid-item">6</div>  
        <div class="grid-item">7</div>
        <div class="grid-item">8</div>
        <div class="grid-item">9</div>   -->
      </div>
      
</body>
</html>