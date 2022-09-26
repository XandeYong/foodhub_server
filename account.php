<?php 

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    require_once "conn.php";

    if ($request == "login" && isset($_POST['email']) && isset($_POST['password'])) {
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM account where email = '$email' && password = '$password' LIMIT 1";
    
        if (!$conn->query($sql)) {
            echo "failure";
        } else {
    
            $account = array();
            while($row = mysqli_fetch_assoc($result)) {
                
                $image = $row['image'] . ".jpg";
                $row['image'] = "http://localhost/foodhub_server/image/" . "account/" . $image;
    
                $account[] = $row;
            }
    
            echo json_encode($account);
        }
    
        
    } else if ($request == "register" && 
    isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        //check account
        $sql = "SELECT * FROM account where email = '$email'";
    
        if (!$conn->query($sql)) {
            
            //register
            $sql = "insert into account(account_id, name, email, password) values('$id', '$name', '$email', '$password')";
        
            if (!$conn->query($sql)) {
                echo "Fail to register.";
            } else {
                echo "Register successfully";
            }

        } else {
            echo "This email has already been registered.";
        }

    }


    $conn->close();
}




?>