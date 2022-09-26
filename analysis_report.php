<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM analysis_report";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {
            
            $analysis_report = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $analysis_report[] = $row;
            }

            echo json_encode($analysis_report);

        }
    }

    $conn->close();
}


?>