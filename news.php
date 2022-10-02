<?php
    require_once "conn.php";

if (isset($_GET['request'])) {
    $request = $_GET['request'];

    $message = "error";
    $status = "-1";


    if ($request == 'getAll') {
        $sql = "SELECT * FROM news";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {

            $news = array();
            while ($row = mysqli_fetch_assoc($result)) {

                $image = $row['image'] . ".jpg";
                $row['image'] = "http://10.0.2.2/foodhub_server/image/" . "news/" . $image;

                $news[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $news,
                "message" => $message,
                "status" => $status
            );

            echo $json = json_encode($json_body);
        }
    }
    $conn->close();
} else if (isset($_POST['request'])) {
    
    $request = $_POST['request'];
    $message = "error";
    $status = "-1";

    require_once "conn.php";

    if ($request == 'createNews') {

   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];


        $sql = "INSERT INTO news(news_id, title, image, url) VALUES ('$id','$title','$id','$url')"; // text url id image id

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "data Insert success";
            $status = "0";

        
        } else {
            $message = "Insert Error";
            $status = "1";
        }
    $json_body = array(
                "message" => $message,
                "status" => $status
            );

        echo $json = json_encode($json_body);
    }
    else if ($request == 'updateNews'){
        
        require_once "conn.php";
        
        $id = $_POST['id'];
        $title = $_POST['title'];

        $sql = "UPDATE news SET title='$title' WHERE news_id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "data Update success";
            $status = "0";

       
        } else {
            $message = "Insert Error";
            $status = "1";
        } 
            $json_body = array(
                "message" => $message ,
                "status" => $status
            );
        echo $json = json_encode($json_body);
    }
    else if ($request == 'deleteNews'){
        
        require_once "conn.php";
        
        $id = $_POST['id'];

        $sql = "DELETE FROM news WHERE news_id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "data Delete success";
            $status = "0";

       
        } else {
            $message = "Delete Error";
            $status = "1";
        } 
            $json_body = array(
                "message" => $message ,
                "status" => $status
            );
        echo $json = json_encode($json_body);
    }
    

}   
 $conn->close();
 ?>