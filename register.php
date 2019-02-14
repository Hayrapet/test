<?php
session_start();
include('layouts/sign_up_header.php');
if(isset($_SESSION['error'])) {
    foreach ($_SESSION as $key => $value) {
        if($key !== 'error'){
            $$key = $value;
        }
    }
    foreach ($_SESSION['error'] as $val) {
        if($_SESSION['error']['firstname']) {
            echo '<div class="error">' . $val . '</div>';
        }
        if($_SESSION['error']['lastname']) {
            echo '<div class="error" style="top: 123px">'.$val.'</div>';
        }

        if($_SESSION['error']['email']) {
            echo '<div class="error" style="top: 183px">'.$val.'</div>';
        }

        if($_SESSION['error']['gender']) {
            echo '<div class="error" style="top: 233px">'.$val.'</div>';
        }

        if($_SESSION['error']['password']) {
            echo '<div class="error" style="top: 277px">'.$val.'</div>';
        }

    }

}
?>
    <form action="registerproces.php" method="post" class="sign_up">
        <input type="text" value="<?= $firstname ?>" name="firstname" placeholder="First name">
        <input type="text" value="<?= $lastname ?>" name="lastname" placeholder="Last name">
        <input type="text" value="<?= $email ?>" name="email" placeholder="E-Mail">
        <div class="gender">
        <input type="radio" name="gender" value="male" <?php if($gender == 'male') echo 'checked'?> id="male"><label for="male">Male</label>
        <input type="radio" name="gender" value="female" <?php if($gender == 'female') echo 'checked'?> id="female" ><label for="female">Female</label>
        </div>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="c_pass" placeholder="Confirm password">
        <input type="submit" name="submit" value="Sign Up">
    </form>


    <a href="login.php" class="sign_in">Sign In</a>
      





<?php
session_destroy();
include('layouts/footer.php');
