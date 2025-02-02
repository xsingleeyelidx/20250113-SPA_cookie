<?php
// input: {"username": "Champion", "password": "5566"}
$data = file_get_contents('php://input', 'r');
$myData = [];
$myData = json_decode($data, true); // 將 json 拆成字串陣列

// test
// echo $myData['username'].'<br>'; // Champion<br>
// echo $myData['password'].'<br>'; // 5566<br>

if(isset($myData['username']) && isset($myData['password'])){
    if($myData['username'] != '' && $myData['password'] !=''){

        include 'connect_DB.php';

        $p_username = $myData['username'];
        $p_password = $myData['password'];

        $sql = "SELECT Username, Password FROM member WHERE Username = '$p_username'";
        $result = mysqli_query($link, $sql);

        if($row = mysqli_fetch_assoc($result)){
            // echo $row['Username'];
            // echo $row['Password'];

            // password_verify() 解碼密碼
            if(password_verify($p_password, $row['Password'])){
                // 比對正確，產生金鑰 Uid01 存入資料庫
                $uid01 = substr(hash('sha256', uniqid(time())), 3, 5) . substr(hash('sha256', uniqid(time())), 10, 5);
                // 用hash(), uniqid(), time() 多層嵌套產生唯一性的值
                // 可用 substr() 片段擷取做組合，做出規則複雜的金鑰
                $sql = "UPDATE member SET Uid01 = '$uid01' WHERE Username='$p_username'";

                // 若金鑰存入成功
                if(mysqli_query($link, $sql)){
                    // 撈取 DB 該使用者資訊(不含密碼)傳至前端
                    $sql = "SELECT Username, Email, Uid01, Level, Create_at FROM member WHERE Username = '$p_username'";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '{"state": true, "message": "登入成功", "data": '. json_encode($row) .'}';
                }else{
                    echo '{"state": false, "message": "登入失敗"}'; // 金鑰寫入失敗
                }
            }else{
                echo '{"state": false, "message": "登入失敗"}'; // 密碼比對錯誤
            }
        }else{
            echo '{"state": false, "message": "登入失敗"}'; // 帳號搜尋錯誤
        }
        mysqli_close($link);
    }else{
        echo '{"state": false, "message": "格式錯誤"}'; // 不須返回詳細說明，API 本是給特定對象使用
    }
}else{
    echo '{"state": false, "message": "格式錯誤"}'; // 給對方前應說明正確格式，若無法傳遞代表傳遞者不是你給的人
}
?>