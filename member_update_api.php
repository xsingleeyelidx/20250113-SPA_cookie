<?php

// input: {"username": "Champion", "password": "5566", "email": "abc@gmail.com"}

$data = file_get_contents('php://input', 'r');
$myData = [];
$myData = json_decode($data, true); // 將 json 拆成字串陣列

// test
// echo $myData['username'].'<br>'; // Champion<br>
// echo $myData['password'].'<br>'; // 5566<br>
// echo $myData['email'].'<br>'; // abc@gmail.com<br>

if(isset($myData['username']) && isset($myData['password']) && isset($myData['email'])){
    if($myData['username'] != '' && $myData['password'] !='' && $myData['email'] != ''){
        $serverName = 'localhost';
        $userName = 'root';
        $password = '';
        $DataBaseName = 'testdb';

        $link = mysqli_connect($serverName, $userName, $password, $DataBaseName);
        if (!$link) { die('連線失敗！' . mysqli_connect_error()); }

        $p_username = $myData['username'];
        $p_password = $myData['password'];
        $p_email = $myData['email'];

        $sql = "INSERT INTO member(Username, Password, Email) VALUES ('$p_username', '$p_password', '$p_email')";
        if(mysqli_query($link, $sql)){
            echo '{"state": true, "message": "註冊成功"}';
        }else{
            echo '{"state": false, "message": "註冊失敗"}';
        }
    }else{
        echo '{"state": false, "message": "格式錯誤"}'; // 不須返回詳細說明，API 本是給特定對象使用
    }
}else{
    echo '{"state": false, "message": "格式錯誤"}'; // 給對方前應說明正確格式，若無法傳遞代表傳遞者不是你給的人
}
?>