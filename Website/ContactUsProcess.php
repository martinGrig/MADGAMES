<?php

session_start();

  $username = 'dbi410102';
  $password = 'prop17';
  
  $message = htmlspecialchars($_POST['message']);
  $name = $_POST['name'];
  $email = $_POST['email'];

  $con = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi410102', $username, $password);

  $sql = "INSERT INTO contact ( name, email, message) VALUES (?, ?, ?)";
  $statement = $con->prepare($sql);
  $statement->bindParam('1', $name);
  $statement->bindParam('2', $email);
  $statement->bindParam('3', $message);
  $result = $statement->execute();

  header('Location:Home.php');

// $firstname = $_POST['firstname'];
// $email = $_POST['email'];
// $number = $_POST['number'];
// $comment = $_POST['comment'];

// $to = 'madprojects17@gmail.com'; // note the comma

// // Subject
// $subject = 'Contacting us';

// // Message
// $message = "
// <html>
// <head>
// <title></title>
// </head>
// <body>
// <p>Name: $firstname</p>
// <p>Email: $email</p>
// <p>Telephone number: $number</p>
// <p>Message: $comment</p>
// </body>
// </html>
// ";
// //add picture with link from the server

// // To send HTML mail, the Content-type header must be set
// $headers[] = 'MIME-Version: 1.0';
// $headers[] = 'Content-type: text/html; charset=iso-8859-1';

// // Additional headers
// $headers[] = 'To: Support Team <prop17team@hotmail.com>';
// $headers[] = "From: $firstname <$email>";

// // Mail it
// mail($to, $subject, $message, implode("\r\n", $headers));
// header('Location:Home.php');

?> 

