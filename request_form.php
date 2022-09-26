<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM request_form";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {

            $requestForm = array();
            while($row = mysqli_fetch_assoc($result)) {
                $requestForm[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $requestForm,
                "message" => $message,
                "status" => $status
            );
    
            echo $json = json_encode($json_body);
        }
    }

    $conn->close();
}


?>