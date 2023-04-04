<?php
require_once 'db/pdo.php';
require_once 'function/redirect.php';
require_once 'classes/RegisterMessages.php';

// var_dump($_POST);

if (empty($_POST) || !isset($_POST['lastName']) || !isset($_POST['firstName'])|| !isset($_POST['email'])
|| !isset($_POST['password'])) {
  redirect('index.php');
}


$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$email = $_POST['email'];
$password = $_POST['password'];
    
$query = "SELECT mail_user FROM users WHERE mail_user = :email";
$stmt = $pdo->prepare($query);
$stmt->execute(['email' => $email]);

$emailSearchIfAlreadyexist = $stmt->fetch();
var_dump($emailSearchIfAlreadyexist);

if (empty($lastName) || empty($firstName) || empty($email) || empty($password) ) {
  redirect('register.php?msgRegister=' . RegisterMessages::INVALID_FORM);
}

if (!empty($emailSearchIfAlreadyexist)){
  redirect('register.php?msgRegister=' . RegisterMessages::INVALID_EMAIL);
}

if (strlen($password) < 8 ) {
  redirect('register.php?msgRegister=' . RegisterMessages::INVALID_PASSWORD);
}

$query = "INSERT INTO users VALUES (null, :lastName_user, :firstName_user, :mail_user, :pwd_user, null)";

$stmt = $pdo->prepare($query);

$insert = $stmt->execute([
  'lastName_user' => $lastName,
  'firstName_user' => $firstName,
  'mail_user' => $email,
  'pwd_user' => password_hash($password, PASSWORD_DEFAULT)
]);

redirect('index.php?msgRegister=' . RegisterMessages::REGISTER_IS_VALID);

