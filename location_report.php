<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];

    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM location_report";
    
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {
    
            $location_report = array();
            while($row = mysqli_fetch_assoc($result)) {
                $location_report[] = $row;
            }
    
            echo json_encode($location_report);
        }
    }

    $conn->close();
}


?>