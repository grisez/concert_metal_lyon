<?php
require_once 'db/pdo.php';



$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO users VALUES (null, :lastName_user, :firstName_user, :mail_user, :pwd_user, null)";

$stmt = $pdo->prepare($query);

$insert = $stmt->execute([
  'lastName_user' => $lastName,
  'firstName_user' => $firstName,
  'mail_user' => $email,
  'pwd_user' => password_hash($password, PASSWORD_DEFAULT)
]);

//A modifier plus tard
// if ($insert) {
//   echo "Inscription réussi !";
// } else {
//   echo "Échec lors de l'inscription'";
// }
