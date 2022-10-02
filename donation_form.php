<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM donation_form";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
            
            $donationForm = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $donationForm[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $donationForm,
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

    if ($request == "UpdateFormStatus" 
    && isset($_POST['donationFormID']) && isset($_POST['status']) ) {
    
        $donationFormID = $_POST['donationFormID'];
        $status = $_POST['status'];
    
            //Update Status
            $sql = "UPDATE donation_form SET status = '$status' WHERE donation_form_id = '$donationFormID'";
        
            if (!$conn->query($sql)) {
                $message = "Fail to update.";
                $status = "-2";
            } else {
                $message = "Update successfully";
                $status = "0";
            }


        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);

    } else if ($request == "InsertNewForm" 
    && isset($_POST['donationFormID']) && isset($_POST['categoryID']) && isset($_POST['food']) && isset($_POST['quantity']) && isset($_POST['status']) && isset($_POST['accountID']) ) {
    
        $donationFormID = $_POST['donationFormID'];
        $categoryID = $_POST['categoryID'];
        $food = $_POST['food'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        $accountID = $_POST['accountID'];
    
            //Insert new Form
            $sql = "INSERT INTO donation_form (donation_form_id, category_id, food, quantity, status, account_id) VALUES ('$donationFormID', '$categoryID', '$food', '$quantity', '$status', '$accountID')";
        
            if (!$conn->query($sql)) {
                $message = "Fail to insert.";
                $status = "-2";
            } else {
                $message = "Insert successfully";
                $status = "0";
            }


        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);

    }

    $conn->close();

}


?>