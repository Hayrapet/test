<?php
include('connection.php');



$mail_search = $_POST['sign_in_mail'];
$password = sha1(md5($_POST['sign_in_password']));
$sign_in_mail = "SELECT  * FROM `users` WHERE `email` = '$mail_search' ";
$sign_in = mysqli_query($conn, $sign_in_mail);
$row = mysqli_fetch_assoc($sign_in);

if(!$row){
    header('location:login.php');
    $_SESSION['error']['sign_in_mail'] = 'You have not registered with such E-Mail';
    die;
}else{
    foreach ( $_POST as $key =>$value ) {
        $$key = $value;
        if($key !== 'sign_in_password') {
            $_SESSION[$key] = $value;
        }
    }

    if($row['password'] != $password ){
        $_SESSION['error']['sign_in_password'] = 'Password incorrect';
        header('location:login.php');die;
    }


    $_SESSION['user_id']=$row['id'];
    header('location:home.php');die;


}

