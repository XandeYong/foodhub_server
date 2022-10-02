<?php
$test;
$message = "error";
$status = "-1";

if (isset($_GET['request'])) {
    $request = $_GET['request'];
    require_once "conn.php";

    if ($request == 'getAll') {
        $sql = "SELECT * FROM location_report";
    
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {
    
            $location_report = array();
            while($row = mysqli_fetch_assoc($result)) {
                $location_report[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $location_report,
                "message" => $message,
                "status" => $status
            );
    
            echo $json = json_encode($json_body);
        }
    }

    $conn->close();

} else if (isset($_POST['data'])) { //in progress
    $request = $_POST['data'];
    
    require_once "conn.php";

    if ($request == 'update') {
        //update location_report database..
        $analysisReportID = $_POST['analysisReportID'];
        $totalUser = $_POST['totalUser'];
        $totalDonor = $_POST['totalDonor'];
        $totalDonee = $_POST['totalDonee'];
        $totalDonation = $_POST['totalDonation'];
        $totalRequest = $_POST['totalRequest'];
        $totalNews = $_POST['totalNews'];

        // get the "message" variable from the post request
// this is the data coming from the Android app
$message=$_POST["message"]; 

    
            //Update
            $sql = "UPDATE analysis_report SET total_user = '$totalUser', total_donor = '$totalDonor', total_donee = '$totalDonee', total_donation = '$totalDonation', total_request  = '$totalRequest', total_news = '$totalNews' WHERE analysis_report_id = '$analysisReportID'";
        
            if (!$conn->query($sql)) {
                $message = "Fail to update.";
                $status = "-2";
            } else {
                $message = "Update successfully";
                $status = "0";
            }

        }

        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);



    $conn->close();
}

?>