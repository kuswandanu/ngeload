<?php
if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $target_dir = trim($_POST['directory']);
    $target_file = $target_dir . ($target_dir == "" ? "" : "/") . basename($file_name);
    
    if($file_size > 52428800) {
        $errors[]='Sorry, your file is too large.';
    }
    
    if($target_dir != "" && !is_dir($target_dir)){
        if(!mkdir($target_dir)){
            $errors[]='Directory does not exist. Failed to Created Directory.';
        }
    }
    
    if(empty($errors)==true) {
        if(move_uploaded_file($file_tmp, $target_file)){
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

    <?php if(isset($_FILES['file']) && empty($errors)==true){ ?>
      <ul>
        <li>Sent file:
          <?php echo $_FILES['file']['name'];  ?>
        </li>
        <li>File size:
          <?php echo $_FILES['file']['size'];  ?>
        </li>
        <li>File type:
          <?php echo $_FILES['file']['type']; ?>
        </li>
        <?php if(isset($_POST['directory'])){ ?>
          <li>Directory:
            <?php echo $_POST['directory']; ?>
          </li>
          <?php } ?>
      </ul>
      <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" name="file" /> Directory
          <input type="text" name="directory" />
          <input type="submit" />

        </form>
        1. Upload di root : Pilih file tapi kosongkan Directory
        <br/> 2. Upload di direktori : Pilih file dan isi Directory
        <br/> 3. Buat direktori : Jangan memilih file kemudian isi Directory
        <br/> // Semua file yang diupload akan me-rewrite semua file yang sudah ada
  </body>

  </html>