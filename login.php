<?php

// DEFINE('host_mysql', 'localhost');
// DEFINE('db_username_mysql', 'root');
// DEFINE('db_password_mysql', '');
// DEFINE('db_name_mysql', 'angularjs');


// $conn = new mysqli(host_mysql, db_username_mysql, db_password_mysql, db_name_mysql);
$conn = mysqli_connect("localhost","root","","angularjs");
// $array = json_decode(file_get_contents("php://input"));
$postdata = file_get_contents("php://input");
$array = json_decode($postdata);


if(isset($array)){
    $username = mysqli_real_escape_string($conn, $array->username);
    $password = mysqli_real_escape_string($conn, $array->password);
    $btnName = $array->btnName;
    $adminuser ="admin";
    $adminpass ="admin123";
    if($btnName == "login"){
        $query = "select user, pass from signup";
        $result = mysqli_query($conn,$query);
        if($username==$adminuser && $password==$adminpass){
            echo "Login Successful";
        }
        while($r = mysqli_fetch_array($result)){
            $user=$r['user'];
            $pass=$r['pass'];
            if($username == $user && $password==$pass){
                echo "Login Successful";
                exit();
                console.log("username");
            }
        }
        if($username!=$username || $password != $adminpass){
            echo "Login UnSuccessful";
        }
    }
    if($btnName == "sign up"){
        $query2 = "INSERT INTO signup(user,pass) values('$username','$password')";
        if(mysqli_query($conn,$query2)){
            echo "Successfully, Your account has been created.";
        }
        else{
            echo "Username already exists";
        }
    }
}
?>