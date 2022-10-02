<?php

if (isset($_POST['request'])) {
    $request = $_POST['request'];

    $message = "error";
    $status = "-1";

    require_once "conn.php";

    if ($request == "login" && isset($_POST['email']) && isset($_POST['password'])) {

        $account = array();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM account where email = '$email' && password = '$password' LIMIT 1";

        $result = mysqli_query($conn, $sql);

        if ((mysqli_num_rows($result) <= 0)) {
            $message = "no data";
            $status = "1";
        } else {

            while ($row = mysqli_fetch_assoc($result)) {

                $image = $row['image'] . ".jpg";
                $row['image'] = "http://10.0.2.2/foodhub_server/image/" . "account/" . $image;

                $account[] = $row;
            }

            $message = "account retrived success";
            $status = "0";
        }

        $json_body = array(
            "data" => $account,
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);

    } else if (
        $request == "register"
        && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['accountType'])
    ) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['accountType'];
        $image = $id;
        $date = date("Y-m-d");

        //check account
        $sql = "SELECT * FROM account where email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {

            //register
            $sql = "insert into account(account_id, name, image, dob, email, password, account_type) values('$id', '$name', '$image', $date, '$email', '$password', '$type')";
            $result = mysqli_query($conn, $sql);

            $file = './image/account/' . $type . '.jpg';
            $newfile = './Image/account/' . $id . '.jpg';

            if (!copy($file, $newfile)) {
                $message = "failed to save file";
                $status = "-3";
            } else if (!$result) {
                $message = "Fail to register.";
                $status = "-2";
            } else {
                $message = "Register successfully";
                $status = "0";
            }

        } else {
            $message = "This email has already been registered.";
            $status = "1";
        }

        $json_body = array(
            "message" => $message,
            "status" => $status,
        );

        echo $json = json_encode($json_body);
    } else if (
        $request == "UpdateAccount"
        && isset($_POST['accountID']) && isset($_POST['accountName'])  && isset($_POST['accountImage'])  && isset($_POST['accountAddress'])  && isset($_POST['accountState'])
        && isset($_POST['accountDOB']) && isset($_POST['accountGender']) && isset($_POST['accountEmail']) && isset($_POST['accountPassword']) && isset($_POST['accountType'])
    ) {

        //Account Variables
        $accountID = $_POST['accountID'];
        $accountName = $_POST['accountName'];
        $accountImage = $_POST['accountImage'];
        $accountAddress = $_POST['accountAddress'];
        $accountState = $_POST['accountState'];
        $accountDOB = $_POST['accountDOB'];
        $accountGender = $_POST['accountGender'];
        $accountEmail = $_POST['accountEmail'];
        $accountPassword = $_POST['accountPassword'];
        $accountType = $_POST['accountType'];

        //Update Status
        $sql = "UPDATE account SET name = '$accountName', image = '$accountImage', address = '$accountAddress', state = '$accountState', dob = '$accountDOB',
        gender = '$accountGender', email = '$accountEmail', password = '$accountPassword', account_type = '$accountType' WHERE account_id = '$accountID'";


        if (!$conn->query($sql)) {
            $message = "Fail to update into Remote DB";
            $status = "-2";
        } else {
            $message = "Succesfully update into Remote DB successfully";
            $status = "0";
        }
        $json_body = array(
            "message" => $message,
            "status" => $status
        );

        echo $json = json_encode($json_body);
    }

    $conn->close();
} else if (isset($_GET['request'])) {
    $request = $_GET['request'];
    require_once "conn.php";

    if ($request == "registerGetId" && isset($_GET['accountType'])) {
        $type = $_GET['accountType'];

        $sql = "SELECT account_id FROM account where account_type = '$type' Order By created_at Desc LIMIT 1";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {

            $getID;

            while ($row = mysqli_fetch_assoc($result)) {
                $getID = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $getID,
                "message" => $message,
                "status" => $status
            );

            echo $json = json_encode($json_body);
        }
    } else if ($request == "intializedReport") {
        $sql = "SELECT `state`, `account_type` FROM `account` WHERE account_type != 'admin'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            $message = "no data";
            $status = "1";
        } else {

            $account = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $account[] = $row;
            }

            $message = "data retrived success";
            $status = "0";

            $json_body = array(
                "data" => $account,
                "message" => $message,
                "status" => $status
            );

            echo $json = json_encode($json_body);
        }
    }

    $conn->close();
}
