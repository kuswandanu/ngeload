<?php
$files = isset($_POST['files']) ? trim($_POST['files']) : "";
$directory = isset($_POST['directory']) ? trim($_POST['directory']) : "";
if($files != ""){
    foreach (explode(",", $files) as $file) {
        echo trim($file);
    }
}elseif ($directory != "") {
    $directory = $_POST['directory'];
    if(is_dir($directory)){
        if(deleteDirectory($directory)){
            echo "Directory deleted.";
        } else {
            echo "Failed to delete directory.";
        }
    } else {
        echo "Directory does not exist.";
    }
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
?>
  <html>

  <body>
    <form action="" method="POST">
      File(s)
      <input type="text" name="files" /> Directory
      <input type="text" name="directory" />
      <input type="submit" />
    </form>

    1. Delete file dari root : Isi nama file(s) tapi kosongkan Directory
    <br/> 2. Delete file dari direktori : Isi nama file(s) dan isi Directory
    <br/> 3. Delete direktori saja : Jangan isi file(s) kemudian isi Directory
    <br/> // Semua file yang ada di direktori akan terhapus semua jika direktori dihapus
  </body>

  </html>