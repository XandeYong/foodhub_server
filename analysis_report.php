<?php

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM analysis_report";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
            
            $analysis_report = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $analysis_report[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $analysis_report,
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

    if ($request == "update" 
    && isset($_POST['analysisReportID']) && isset($_POST['totalUser']) && isset($_POST['totalDonor']) && isset($_POST['totalDonee']) && isset($_POST['totalDonation']) && isset($_POST['totalRequest']) && isset($_POST['totalNews'])) {
    
        $analysisReportID = $_POST['analysisReportID'];
        $totalUser = $_POST['totalUser'];
        $totalDonor = $_POST['totalDonor'];
        $totalDonee = $_POST['totalDonee'];
        $totalDonation = $_POST['totalDonation'];
        $totalRequest = $_POST['totalRequest'];
        $totalNews = $_POST['totalNews'];
    
            //Update
            $sql = "UPDATE analysis_report SET total_user = '$totalUser', total_donor = '$totalDonor', total_donee = '$totalDonee', total_donation = '$totalDonation', total_request  = '$totalRequest', total_news = '$totalNews' WHERE analysis_report_id = '$analysisReportID'";
        
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

    } 

    $conn->close();
}


?>