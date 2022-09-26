<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM category";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
            
            $category = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $category[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $category,
                "message" => $message,
                "status" => $status
            );
    
            echo $json = json_encode($json_body);
        }
    }

    $conn->close();
}


?>