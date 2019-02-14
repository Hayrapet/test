<?php
session_start();
include('layouts/sign_in_header.php');
if(isset($_SESSION['ok'])){
    echo $_SESSION['ok'];
}
if(isset($_SESSION['error'])) {
    foreach ($_SESSION as $key => $value) {
        if($key !== 'error'){
            $$key = $value;
        }
    }
    foreach ($_SESSION['error'] as $val) {
        if($_SESSION['error']['sign_in_mail']) {
            echo '<div class="error">' . $val . '</div>';
        }
        if($_SESSION['error']['sign_in_password']) {
            echo '<div class="error" style="top:123px">' . $val . '</div>';
        }
    }
}
?>
    <form action="loginproces.php" method="post" class="sign_in">
        <input type="text" placeholder="E-Mail" value="<?= $sign_in_mail ?>" name="sign_in_mail">
        <input type="password" placeholder="Password" name="sign_in_password">
        <input type="submit" value="Sign in">
    </form>


    <a href="register.php" class="sign_up">Sign Up</a>





<?php
session_destroy();
include('layouts/footer.php');
