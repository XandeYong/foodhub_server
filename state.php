<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM state";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {
            
            $state = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $state[] = $row;
            }

            echo json_encode($state);

        }
    }

    $conn->close();
}


?>