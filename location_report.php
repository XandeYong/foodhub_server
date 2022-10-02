<?php
$test;
$message = "error";
$status = "-1";

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM location_report";
    
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
    
            $location_report = array();
            while($row = mysqli_fetch_assoc($result)) {
                $location_report[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $location_report,
                "message" => $message,
                "status" => $status
            );
    
            echo $json = json_encode($json_body);
        }
    }

    $conn->close();

} else if (isset($_POST['data'])) {
    $request = $_POST['data'];
    $test = $_POST['data'];
    require_once "conn.php";

    if ($request == 'update') {
        //update location_report database..
        
    }



    $conn->close();
}

var_dump($test)

?>