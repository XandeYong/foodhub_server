<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $analysis_report = array();
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM analysis_report";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
            
            while ($row = mysqli_fetch_assoc($result)) {
                $analysis_report[] = $row;
            }

            $message = "data retrived success";
            $status = "0";
        }

        $json_body = array(
            "data" => $analysis_report,
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);
    }

    $conn->close();
}


?>