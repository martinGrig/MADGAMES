<?php
  session_start();
  $_SESSION['ready']=false
  $username = 'dbi410102';
  $password = 'prop17';

  $email = $_POST['email'];
  $pass = $_POST['password'];
  $_SESSION['buttonDisabled'] = true;

  $ready = false;

  $con = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi410102', $username, $password);

  //get all users with data provided by post
  $sql = "select * from account where email = ? and password = ?";
  $statement = $con->prepare($sql);
  $statement->bindParam('1', $email);
  $statement->bindParam('2', $pass);
  $statement->execute();
  $result = $statement->fetchAll();

  //if we have any user with these username and pass
  if(count($result) > 0){
    $_SESSION['loggedin'] = true;

    //getting info about just logged in user
    $sql = "select * from account where email = ? and password = ?";
    $statement = $con->prepare($sql);
    $statement->bindParam('1', $email);
    $statement->bindParam('2', $pass);
    $statement->execute();
    $result = $statement->fetchAll();
    $_SESSION['currentUser'] = $result[0];
    $_SESSION['currentUser']['name'] = $result[0]['name'];

    //check if person has a ticket
    $username = 'dbi410102';
    $password = 'prop17';
    $con = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi410102', $username, $password);

    $sql = "select * from visitor where accountEmail = ?";
    $statement = $con->prepare($sql);
    $email= $_SESSION['currentUser']['email'];
    $statement->bindParam('1', $email);
    $statement->execute();
    $result = $statement->fetchAll();
    if ($result) {
      $_SESSION['currentUser']['ticketNr'] = $result[0]['ticketNr'];
      $_SESSION['currentUser']['balance'] = $result[0]['balance'];
      $_SESSION['currentUser']['hasReview'] = $result[0]['hasReview'];
    }
    if(!empty($_POST['g-recaptcha-response']))
    {
      $secret = 'GOOGLE_CAPTACH_SECRET_KEY';
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      $responseData = json_decode($verifyResponse);
      if($responseData->success){
        header("location:Profile.php");
      }
      else {
        echo('ne stava tei');
      }
    }
    
  }

  //if we don't have users with such data
  else {
    header("location:LogIn.php");
  }

?>
