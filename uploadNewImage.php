<?php
  
    $file_path = "image/news/";
    if(!is_dir($file_path)){
        //Directory does not exist, so lets create it.
        mkdir($file_path, 0755, true);
    }
    
    $file_path = $file_path . basename( $_FILES['uploaded_file']['tmp_name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'],  replace_extension($file_path))) {
     
        echo "success";
    } else{
        echo "fail";
    }
    function replace_extension($filename) {
        $new_extension = "jpg";
        $file_path1 = "image/news/";
        $info['filename'] = pathinfo($filename);
        $info['filename'] = $_FILES['uploaded_file']['name'];
   
        return $file_path1 . $info['filename'] . '.' . $new_extension;
    }
 ?>