
<?php
session_start();
require_once 'function/redirect.php';
require_once 'classes/ConnexionMessage.php';

if (isset($_POST['email'])){
  $_SESSION['email']=$_POST['email'];
}

if (empty($_POST) || !isset($_POST['email']) || !isset($_POST['password'])) {
    redirect('index.php');
  }
  
  require_once __DIR__ . '/db/pdo.php';
  
  $login = $_POST['email'];
  $password = $_POST['password'];
  
  $query = "SELECT pwd_user FROM users WHERE mail_user=:mail_user";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['mail_user' => $login]);
  
  $user = $stmt->fetch();
  
  if ($user === false) {
    redirect('login.php?msg=' . ConnexionMessages::INVALID_EMAIL);
  }
  
  $hashedPassword = $user['pwd_user'];
  if (password_verify($password, $hashedPassword) === false) {
    redirect('login.php?msg=' . ConnexionMessages::INVALID_PASSWORD);
  }

  if ($user === false && password_verify($password, $hashedPassword) === false) {
    redirect('login.php?msg=' . ConnexionMessages::INVALID_EMAIL . '&' . 'msg2='. ConnexionMessages::INVALID_PASSWORD);
  }
  
  $_SESSION['isConnected'] = true;
  redirect('index.php?msg=' . ConnexionMessages::CONNEXION_IS_VALID);




