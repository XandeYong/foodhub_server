<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM category";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {
            
            $category = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $category[] = $row;
            }

            echo json_encode($category);

        }
    }

    $conn->close();
}


?>