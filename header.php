
<?php
$admin=false;
session_start();
// echo '<pre>'; print_r($_SESSION); echo '</pre>';
if(isset($_SESSION['name'])){
  $link='SignOut.php';
  $icon='<i class="fa fa-sign-out fa-lg icon" aria-hidden="true"></i>';
  if($_SESSION['type']==='admin'){
  $admin=true;
  }
}else{
  $link='Login.php';
 $icon='<i class="fas fa-user fa-lg icon"></i>';
}
?>
<div class="grid-item item1">
  <div class="flex-container flex-1">
      <div class="titleBar">
          <div class="logo"><img src="images/web/logo.png" alt=""></div>
      </div>  
      <div class="search-container" style="flex-grow: 1;">
        <form action="search.php" method="post">
          <input name="tosearch" type="text"><button type="submit" namme="submit" class="btn"><i class="fas fa-search fa-lg"></i></button>
      </form></div>
      <div class="cart-container">
        <span class="fa-layers fa-fw" >
         <a href="cart.html" style="text-decoration: none;">
          <i class="fas fa-cart-plus fa-lg icon"></i>
          <span class="fa-layers-counter" style="background:Tomato">10</span>
        </a>
        </span>
      </div>
      <div>
        <a href="<?php echo $link;?>">
        <?php echo $icon; ?>
        </a>
      </div>
    </div>
  
</div>
<div class="grid-item item2">
  <?php 
  if($admin){
    ?>
<nav>
<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="addProduct.php">Add Product</a></li>
</ul>
</nav>
<?php }else{?>
  <nav>
<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
</nav>
<?php }?>  
</div>