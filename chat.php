<html>

<head>
  <link rel="stylesheet" href="chat.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>AnonCHAT - CONVERSA</title>
</head>
<body style="background-color:#B6F7B4;">
<?php
include_once 'encrypt.php';
include_once 'database.php';

$user = (isset($_COOKIE['token'])) ? Decrypt_str($_COOKIE['token']) : '';
$chat = (isset($_REQUEST['chat'])) ? $_REQUEST['chat'] : '';
$sair = (isset($_REQUEST['logout'])) ? $_REQUEST['logout'] : '';

if (strpos($user,":")){
        $tokenv = explode(":", $user);
        $check_token = $tokenv[count($tokenv)-1];
        if ($check_token != 'VALID'){
                setcookie("token", '');
                header('Location: index.php');
                exit();
        }else{
		$user = $tokenv[0];
	}
}else{
	setcookie("token", '');
	header('Location: index.php');
	exit();

}


echo "<div  align='right' style='height:10px;'><a href='?logout=True'<code><h3><b>SAIR</b></h3></code></a></div>";

if ($sair == 'True'){
	setcookie("token", "none.none");
	header('Location: index.php');
	exit();
}


if ($chat != ""){
	$chat = "<b>".filtro($user).":</b> <i>".filtro($chat).'</i>';
	$sql = "INSERT INTO thechat (chat) VALUES ('$chat')";
	$chat = $pdo->prepare($sql);
	$chat->execute();
}


function filtro($text){
        $NewStr=str_replace("'",        "&#x27;",$text);
        $NewStr=str_ireplace('"',        '&#x22;',$NewStr);
        $NewStr=str_ireplace("´",        "&#xb4;",$NewStr);
        $NewStr=str_ireplace("`",        "&#x60;",$NewStr);
        $NewStr=str_ireplace("(",        "&#x28;",$NewStr);
        $NewStr=str_ireplace(")",        "&#x29;",$NewStr);
        $NewStr=str_ireplace("<",        "&#x3c;",$NewStr);
        $NewStr=str_ireplace(">",        "&#x3e;",$NewStr);
        $NewStr=str_ireplace("{",        "&#x7b;",$NewStr);
        $NewStr=str_ireplace("/",        "&#x2f;",$NewStr);
        $NewStr=str_ireplace("}",        "&#x7d;",$NewStr);
        $NewStr=str_ireplace("\\",       "&#x5c;",$NewStr);
        $NewStr=str_ireplace(";",        "&#x3b;",$NewStr);

        return $NewStr;
}


?>
<br><hr>

<iframe id="iframe" name='chatframe' src="see.php" style="width:100%;height:80%;" scrolling="yes"></iframe>

<form action="" method="POST">
<div class="sms-box"><br>
<center><input class="sms-send" name="chat" autofocus='' placeholder="Digite"/>
<button class="send">Enviar</button><br><br><br></div>
</form>

