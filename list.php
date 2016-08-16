<?php
$list_dir = scandir(".");
$full_path = "";
$get_url = "";

for ($i=1; $i <= 10; $i++) { 
    $get_url = $get_url . ($i==1 ? "?" : "&") . $i . "=";
    if(isset($_GET[$i])) {
        $list_dir = scandir($full_path . $_GET[$i]);
        $full_path = $full_path . $_GET[$i] . "/";
        $get_url = $get_url . $_GET[$i];
    } else {
        break;
    }
    // echo $i . $_GET[$i] . "<br>";
}

// print_r($list_dir);
// echo "<br>" . $full_path;
// echo "<br>" . $get_url;
// echo "<br>";

foreach ($list_dir as $value) {
    if (!in_array($value,array(".",".."))) {
        if(is_dir($full_path . $value)) {
            echo "<a href='". $get_url . $value . "'>[". $value ."]</a>";
        } else {
            echo $value;
        }
        echo "\n<br/>";
    }
}
?>