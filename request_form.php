<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM request_form";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {

            $requestForm = array();
            while($row = mysqli_fetch_assoc($result)) {
                $requestForm[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $requestForm,
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
    && isset($_POST['requestFormID']) && isset($_POST['status']) ) {
    
        $requestFormID = $_POST['requestFormID'];
        $status = $_POST['status'];
    
            //Update Status
            $sql = "UPDATE request_form SET status = '$status' WHERE request_form_id = '$requestFormID'";
        
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

    } else if ($request == "InsertNewReqForm" 
    && isset($_POST['reqFormID']) && isset($_POST['ctgID']) && isset($_POST['qty']) && isset($_POST['status']) && isset($_POST['accountID']) ) {
    
        $reqFormID = $_POST['reqFormID'];
        $ctgID = $_POST['ctgID'];
        $qty = $_POST['qty'];
        $status = $_POST['status'];
        $accountID = $_POST['accountID'];
    
            //Insert new Form
            $sql = "INSERT INTO request_form (request_form_id, category_id, quantity, status, account_id) VALUES ('$reqFormID', '$ctgID', '$qty', '$status', '$accountID')";
        
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