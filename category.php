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
} else if (isset($_POST['request'])) {
    $request = $_POST['request'];

    $message = "error";
    $status = "-1";

    require_once "conn.php";

    if (
        $request == "UpdateCategory"
        && isset($_POST['categoryID']) && isset($_POST['categoryName'])
    ) {

        $categoryID = $_POST['categoryID'];
        $categoryName = $_POST['categoryName'];

        //Update Status
        $sql = "UPDATE category SET name = '$categoryName' WHERE category_id = '$categoryID'";

        if (!$conn->query($sql)) {
            $message = "Fail to update into Remote DB";
            $status = "-2";
        } else {
            $message = "Successfully update into Remote DB";
            $status = "0";
        }
        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);
    } else if (
        $request == "AddCategory"
        && isset($_POST['categoryID']) && isset($_POST['categoryName'])
    ) {

        $categoryID = $_POST['categoryID'];
        $categoryName = $_POST['categoryName'];

        //Add Status
        $sql = "INSERT INTO category(category_id, name) values('$categoryID', '$categoryName')";


        if (!$conn->query($sql)) {
            $message = "Fail to insert into Remote DB";
            $status = "-2";
        } else {
            $message = "Successfully insert into Remote DB";
            $status = "0";
        }
        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);
    } else if ($request == "DeleteCategory" && isset($_POST['categoryID'])) {

        $categoryID = $_POST['categoryID'];

        //Delete Status
        try {

            $sql = "DELETE FROM category WHERE category_id = '$categoryID'";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                $message = "Fail to delete from Remote DB : Maybe foreign key issue?";
                $status = "-2";
            } else {
                $message = "Successfully deleted from Remote DB";
                $status = "0";
            }
        } catch (\Throwable $th) {
            //throw $th;
            $message = "Database delete error";
            $status = "-3";
        }


        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);
    }
    $conn->close();
}
