<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM news";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            echo "failure";
        } else {

            $news = array();
            while ($row = mysqli_fetch_assoc($result)) {
                
                $image = $row['image'] . ".jpg";
                $row['image'] = "http://localhost/foodhub_server/image/" . "news/" . $image;

                $news[] = $row;
            }

            echo json_encode($news);
            $data = $news;

        }
    }

    $conn->close();
}

?>