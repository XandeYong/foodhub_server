<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM donation_form";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {
            
            $donationForm = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $donationForm[] = $row;
            }

            echo json_encode($donationForm);

        }
    }

    $conn->close();
}


?>