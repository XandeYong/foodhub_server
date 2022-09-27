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
    
        if (!$conn->query($sql)) {
            $message = "no data";
            $status = "1";
        } else {
    
            $account = array();
            while($row = mysqli_fetch_assoc($result)) {
                
                $image = $row['image'] . ".jpg";
                $row['image'] = "http://10.0.2.2/foodhub_server/image/" . "account/" . $image;
    
                $account[] = $row;
            }

            $message = "account retrived success";
            $status = "0";
    
            $json_body = array(
                "data" => $account,
                "message" => $message,
                "status" => $status
            );
    
            echo $json = json_encode($json_body);
        }
    
        
    } else if ($request == "register" 
    && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['accountType']) ) {
    
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['accountType'];
    
        //check account
        $sql = "SELECT * FROM account where email = '$email'";
    
        if (!$conn->query($sql)) {
            
            //register
            $sql = "insert into account(account_id, name, email, password, account_type) values('$id', '$name', '$email', '$password', '$account_type')";
        
            if (!$conn->query($sql)) {
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
            "status" => $status
        );

        echo $json = json_encode($json_body);
    }


    $conn->close();
}




?>