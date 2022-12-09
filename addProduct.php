<?php
$conn=mysqli_connect ( "localhost", "root", "", "mobile_store" ) or die("Connection failed"); 
// echo '<pre>'; print_r($_SERVER); echo '</pre>';
// echo '<pre>'; print_r($_FILES); echo '</pre>';
// echo '<pre>'; print_r($_POST); echo '</pre>';

$name_error;
$file_error;
$description_error;
$find_name;
$find_imag;
$find_description;
// --------------------Adding------------------------------

if(isset($_POST['add'])){
  // echo 'add clocked';
  if($_FILES['Pimage']['name']==="")
  $file_error="image is required";
  else{
    unset($file_error);
    // echo "file suucessful";
    if($_POST['Pname']===""){
      $name_error="name is required";
      }
      else if($_POST['Pdescription']===""){
      $description_error="description is required";
    }
      else{
        // echo "Data accessed no error";
        unset($name_error);
        unset($description_error);
        // echo $_POST['Pname'] ."<br>";
        // echo $_POST['Pdescription']."<br>";
        $q1="SELECT * FROM products WHERE pname='{$_POST['Pname']}'";
        $result=mysqli_query($conn,$q1) or die("Checking Query unsuccessful");
        if(mysqli_num_rows($result)>0){
          $name_error="Two products not allowed to have same name";
        }else{
          $file_name=$_FILES['Pimage']['name'];
          $file_tmp=$_FILES['Pimage']['tmp_name'];
          $file_type=$_FILES['Pimage']['type'];
          $file_ext=strtolower(end(explode('.', $file_name)));
          $extensions=array("jpeg","jpg","png");
          if(in_array($file_ext,$extensions)=== false)
          $file_error="This extensio is not allowed. Try jpg or png";
          else{
            unset($file_error);
            // $t=$file_name."".time();
            // echo '<pre>'; print_r($_FILES); echo '</pre>';
            move_uploaded_file($file_tmp,"images/produts/".$file_name);
          $q2="INSERT INTO products (pname, pdescrip, pimage ) VALUES ('{$_POST['Pname']}','{$_POST['Pdescription']}', '{$file_name}')";
          mysqli_query($conn,$q2) or die("Inserting Query unsuccessful");
          header("Location: emptydata.php");
          }
        }
      }
  }
}
else if(isset($_POST['find'])){
  // echo 'find clocked';
  $q1="SELECT * FROM products WHERE pname='{$_POST['Pname']}'";
        $result=mysqli_query($conn,$q1) or die("Checking Query unsuccessful");
        if(mysqli_num_rows($result)>0){
          unset($name_error);
          while($row=mysqli_fetch_assoc($result)){
// echo '<pre>'; print_r($row); echo '</pre>';

            $find_name=$row['pname'];
            $find_description=$row['pdescrip'];
            $find_imag=$row['pimage'];
          }
        }else{
          $name_error="No data found";
        }

}
else if(isset($_POST['update'])){
  // echo 'update clicked';
  $q1="SELECT * FROM products WHERE pname='{$_POST['Pname']}'";
        $result=mysqli_query($conn,$q1) or die("Checking Query unsuccessful");
        if(mysqli_num_rows($result)>0){
          unset($name_error);
          while($row=mysqli_fetch_assoc($result)){
        //  echo '<pre>'; print_r($row); echo '</pre>';
            $prev_imag=$row['pimage'];
          }
          if($_FILES['Pimage']['name']===""){
            $q2="UPDATE products SET pname = '{$_POST['Pname']}', pdescrip = '{$_POST['Pdescription']}' WHERE pname='{$_POST['Pname']}'" or die('Update failed');
            mysqli_query($conn,$q2) or die("Update failed");
            header("Location: emptydata.php");
          }else{
            $file_name=$_FILES['Pimage']['name'];
            $file_tmp=$_FILES['Pimage']['tmp_name'];
            $file_type=$_FILES['Pimage']['type'];
            $file_ext=strtolower(end(explode('.', $file_name)));
            $extensions=array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false)
            $file_error="This extensio is not allowed. Try jpg or png";
            else{
              unset($file_error);
              // $t=$file_name."".time();
              // echo '<pre>'; print_r($_FILES); echo '</pre>';
              unlink("images/produts/".$prev_imag);
              move_uploaded_file($file_tmp,"images/produts/".$file_name);
              $q3="UPDATE products SET pname = '{$_POST['Pname']}', pdescrip = '{$_POST['Pdescription']}', pimage = '{$file_name}' WHERE pname='{$_POST['Pname']}'" or die('Update failed');
            // $q2="INSERT INTO products (pname, pdescrip, pimage ) VALUES ('{$_POST['Pname']}','{$_POST['Pdescription']}', '{$file_name}')";
            mysqli_query($conn,$q3) or die("Update failed");
            header("Location: emptydata.php");
            }
          }
        }else{
          $name_error="No data found";
        }
}
else if(isset($_POST['delete'])){
  // echo 'delete clicked';
   // echo 'find clocked';
   $q1="SELECT * FROM products WHERE pname='{$_POST['Pname']}'";
   $result=mysqli_query($conn,$q1) or die("Checking Query unsuccessful");
   if(mysqli_num_rows($result)>0){
     unset($name_error);
     while($row=mysqli_fetch_assoc($result)){
// echo '<pre>'; print_r($row); echo '</pre>';
       $prev_imag=$row['pimage'];
     }
     unlink("images/produts/".$prev_imag);
     $q2="DELETE FROM products WHERE pname='{$_POST['Pname']}'";
     mysqli_query($conn,$q2) or die("Checking Query unsuccessful");
     header("Location: emptydata.php");
   }else{
     $name_error="No data found";
   }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4698c91ecf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Cart</title>
</head>
<body>
    <div class="grid-container">
        <!-- <div w3-include-html="header.html"></div> -->
        <?php include 'header.php';?>
         
          </div>

          <div id="add-product-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
              <label for="Pname" style="margin-top: 50px;">Product Name</label>
              <?php 
              if(isset($name_error)) echo "<span style='color:red;'>{$name_error}<span>";
              else echo "<span><span>";
              ?>
              <input required type="text" name="Pname" id="Pname" value="<?php if(isset($find_name)) echo "{$find_name}";?>">
              
              <label for="Pimage">Product Image</label>
              <?php 
              if(isset($file_error)) echo "<span style='color:red;'>{$file_error}<span>";
              else echo "<span><span>";
              ?>
              <input  type="file" name="Pimage" id="Pimage">
              
              <label for="Pdescript">Product Description</label>
              <?php 
              if(isset($description_error)) echo "<span style='color:red;'>{$description_error}<span>";
              else echo "<span><span>";
              ?>
              <textarea id="Pdescript"  rows="10" cols="50" name="Pdescription" ><?php if(isset($find_description)) echo "{$find_description}";?></textarea>
              <div id="addProduct-button-container">  
              <input class="btn" id="find" name="find" type="submit" value="Find">
              <input class="btn" id="add" name="add" type="submit" value="Add">
              <input class="btn" id="update" name="update" type="submit" value="Update">
              <input class="btn" id="delete" name="delete" type="submit" value="Delete">
            </div>
            </form>
          </div>
</body>

<?php
// echo '<script type="text/JavaScript">
// prompt("GeeksForGeeks");
// </script>'
;
?>

</html>