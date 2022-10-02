
<?php 

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    $message = "error";
    $status = "-1";
    
    require_once "conn.php";

    if ($request == "login" 
    && isset($_POST['email']) && isset($_POST['password'])) {
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM account where email = '$email' && password = '$password' LIMIT 1";
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
        }else if ($request == "register" 
    && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['accountType']) ) {
    
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['accountType'];
    
        //check account
        $sql = "SELECT * FROM account where email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            
            //register
            $sql = "insert into account(account_id, name, email, password, account_type) values('$id', '$name', '$email', '$password', '$type')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                $message = "Fail to register.";
                $status = "-2";
            } else {
                $message = "Register successfully";
                $status = "0";
            }
        }
        else {
            $message = "This email has already been registered.";
            $status = "1";
        }

        $json_body = array(
            "message" => $message,
            "status" => $status,
        );

        echo $json = json_encode($json_body);

    }

} else if (isset($_GET['request']))
{  
   $request = $_GET['request'];  
   require_once "conn.php";

   if($request == "registerGetId" && isset($_GET['accountType'])) {
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

    } else if ($request == "locationReport") {
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

}

$conn->close();


?>