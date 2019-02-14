<?php
include('connection.php');


if(!isset($_SESSION['user_id'])){
    header('location:register.php');die;
}

if (isset($_GET['page']) && file_exists('pages/'.$_GET['page'].'.php')) {
    $page = $_GET['page'];
} else {
    $page = 'user';
}

include('layouts/home_header.php');



$user_id = $_SESSION['user_id'];


$sign_in_mail = "SELECT  * FROM `users` WHERE `id` = '$user_id ' ";
$sign_in = mysqli_query($conn, $sign_in_mail);
$row = mysqli_fetch_assoc($sign_in);



function gender()
{
    global $row;
    if($row['user_photo'] == '') {
        if ($row['gender'] == 'male') {
            echo '<img src=img/user_photo/male.png >';
        } elseif ($row['gender'] == 'female') {
            echo '<img src=img/user_photo/female.png >';
        }
    }else {
            echo "<img src=img/user_photo/".$row['user_photo']. ">";
    }
}




?>

<nav>
<ul>
    <li><a href="?page=user" <?php if ($page == 'user') {?>class="active"<?php }?> >Home</a></li>
    <li><a href="?page=posts" <?php if ($page == 'posts') {?>class="active"<?php }?> >Posts</a></li>
    <li><a href="?page=images" <?php if ($page == 'images') {?>class="active"<?php }?> >Images</a></li>
    <li><a href="login.php">Log Out</a></li>
    <div style="clear: both"></div>
</ul>
</nav>


<div id="content" class="white">
    <?php include_once('pages/'.$page.'.php'); ?>
</div>




<?php

include('layouts/footer.php');

?>
