<html>
<header>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title>AnonCHAT - Login</title>
<?php
include_once 'database.php';
include_once 'encrypt.php';

$user = (isset($_REQUEST['user'])) ? filtro($_REQUEST['user']) : '';


$lus = '';

if($user != ""){
	if(strlen($user) > 2){
		$cookieiftrue = $user.":"."VALID";
		$token = Encrypt_Str($cookieiftrue);
		setcookie("token", $token);

		$chat = "<code>[!]<i> ".$user." acabou de entrar</i></code>";
		$sql = "INSERT INTO thechat (chat) VALUES ('$chat')";
		$chat = $pdo->prepare($sql);
		$chat->execute();

		header('Location: chat.php');

	}else{$lus = 'ops';}
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

<html>

<head>
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
	<div class="main">
		<p class="sign" align="center">AnonCHAT - Login</p>
		<form class="form1" action="" method="POST">
		<input class="un " type="text" name="user" align="center" placeholder="Usuario">
		<input class="submit" type="submit" align="center" value='Entrar'>
		<?php if($lus != ''){echo "<br><center>Usuario deve ter mais de 2 caracteres</center>";}?>
	</div>
</body>

</html>
