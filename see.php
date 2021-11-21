<html>
    <head>
        <meta http-equiv="refresh" content="3" />
    </head>
<?php
include_once 'encrypt.php';
include_once 'database.php';
$user = (isset($_COOKIE['token'])) ? Decrypt_str($_COOKIE['token']) : '';

if (strpos($user,":")){
        $tokenv = explode(":", $user);
        $check_token = $tokenv[count($tokenv)-1];
        if ($check_token != 'VALID'){
                setcookie("token", '');
                header('Location: index.php');
                exit();
        }

}else{
        setcookie("token", '');
        header('Location: index.php');
        exit();

}

$sql = "select * from thechat ORDER BY id DESC";
$chat = $pdo->prepare($sql);
$chat->execute();

while ($user = $chat->fetch(PDO::FETCH_ASSOC)) {
        print_r($user['chat']);
        echo "<br>";
}



?>
