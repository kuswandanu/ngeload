<?php
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    $target_dir = "upload/";
    $target_file = $target_dir . basename($file_name);
    
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152) {
        $errors[]='File size must be excately 2 MB';
    }
    
    if(file_exists($target_file)){
        $errors[]='File already exist.';
    }
    
    if(empty($errors)==true) {
        if(move_uploaded_file($file_tmp, $target_dir.$file_name)){
            echo "Success";
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }else{
        print_r($errors);
    }
}
?>
  <html>

  <body>

    <?php if(isset($_FILES['image']) && empty($errors)==true){ ?>
      <ul>
        <li>Sent file:
          <?php echo $_FILES['image']['name'];  ?>
        </li>
        <li>File size:
          <?php echo $_FILES['image']['size'];  ?>
        </li>
        <li>File type:
          <?php echo $_FILES['image']['type']; ?>
        </li>
      </ul>
      <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" name="image" />
          <input type="submit" />

        </form>

  </body>

  </html>