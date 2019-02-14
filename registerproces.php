<?php
include('connection.php');

foreach ( $_POST as $key =>$value ) {
    $$key = $value;
    if($key !== 'password') {
        $_SESSION[$key] = $value;
    }
}

$check_mail = "SELECT  * FROM `users` WHERE 1";
$sql = mysqli_query($conn, $check_mail);
while ($row = mysqli_fetch_assoc($sql)) {
    if ($email == $row['email'] && $email != '') {
        $_SESSION['error']['email'] = 'This mail is busy';
        header('location:register.php');
        die;
    }
}

if($firstname == ''){
    $_SESSION['error']['firstname'] = 'Fill out your First name';
    header('location:register.php');die;
}elseif ($lastname == ''){
    $_SESSION['error']['lastname'] = 'Fill out your Last name';
    header('location:register.php');die;
}elseif ($email == ''){
    $_SESSION['error']['email'] = 'Fill out your E-Mail';
    header('location:register.php');die;
}elseif ($gender == ''){
    $_SESSION['error']['gender'] = 'Please choose a gender';
    header('location:register.php');die;
}elseif ($password == ''){
    $_SESSION['error']['password'] = 'Enter a password';
    header('location:register.php');die;
}elseif ($c_pass == ''){
    $_SESSION['error']['password'] = 'Enter a confirm password';
    header('location:register.php');die;
}elseif ($password != $c_pass) {
    $_SESSION['error']['password'] = 'Confirm password incorrect';
    header('location:register.php');
    die;
}



if($password === $c_pass) {
    $password = sha1(md5($password));
    $insert = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `gender`, `password` , `user_photo`) VALUES ('$firstname','$lastname','$email','$gender','$password' , '')";
    $query = mysqli_query($conn, $insert);
}else{
    header('location:register.php');
}
if($query){
    header('location:login.php');
    $_SESSION['ok'] = '<div class=ok><img src=img/ok.png width=100><span>I congratulate you are registered</span></div>';
}




