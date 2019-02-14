  <form name="search" method="post" action="search.php" style="margin:20px">
    <input type="search" name="query" placeholder="search">
    <button type="submit">to find</button> 
</form>
<form action="postporces.php" class="post_form" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="Title*" name="title" id="post_name">
    <input type="file" name="post_img" id="post_file">
    <textarea name="content" placeholder="Content*" id="post_content"></textarea>
    <button id="post_button">Send</button>
</form>


<?php

/*include('connection.php');


$nam=3;
$page=$_GET['page'];*/
$post = "SELECT  * FROM `posts` ORDER BY `id` DESC";
$sql_post = mysqli_query($conn, $post);

$temp=mysqli_fetch_array($sql_post);
/*$posts=$temp[0];
$total=(($posts-1)/$nam)+1;
$total=intval($total);
$page=intval($page);
if(!empty($page) or $page<0){
    $page=1;
}
if($page > $total){
    $page=$total;
}
$sart=$page*$nam-$nam;
$query= mysql_query("SELECT * FROM posts BY id DESC LIMIT $start, $nam");
$row= mysql_fetch_array($query);
do{
    echo $row['user_name'];
    echo $row['title'];
    echo $row['content'];
}*/



while($row_post = mysqli_fetch_assoc($sql_post)){




     if($row_post['img']){
         $post_img = $row_post['img'];
     }else {
         $post_img = 'no_photo.jpg';
     }
    /* while($row= mysql_fetch_array($query));
    die;*/
     ?>
     
 
<div class="post_block">
    <div class="post_title"><?=$row_post['title']?></div>
    <img src="img/post_img/<?=$post_img?>">
    <div class="post_content"><?=$row_post['content']?></div>

    <div class="post_footer">
    <div class="post_date"><?=$row_post['date']?></div>
    <div class="post_user">Send By - <?=$row_post['user_name']?></div>
        <div style="clear: both"></div>
    </div>
   

     <?php
     if($row_post['user_id'] == $_SESSION['user_id']) {
         echo "<form action='delete_post_process.php' method='post' class='post_delete_form'>",
         "<input type='hidden' name='id_post' value='".$row_post['id']."' >",
         "<button type='submit' class='delete_post_button'>Delete</button>",
         "</form>";
     }
     ?>

</div>


<?php }?>

<script>
    var post_name = document.getElementById('post_name');
    var post_content = document.getElementById('post_content');
    var post_button = document.getElementById('post_button');
    var post_file = document.getElementById('post_file');
    post_button.onclick = function () {
        if(post_name.value == '' || post_content.value == ''){
            return false;
        }

    }

    post_file.onchange = function () {
        var length = this.files.length;
        if (!length) {
            return false;
        }
        useImage(this);
    };


    // Creating the function
    function useImage(img) {
        var file = img.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alert("Invalid File Extension");
            post_file.value = '';
        }
    }


    var  delete_post_button = document.getElementsByClassName('delete_post_button');
    for(var i = 0 ; i < delete_post_button.length ; i++ ) {

        delete_post_button[i].onclick = function () {
            confirm_delete = confirm('Confirm');
            if (!confirm_delete) {
                return false;
            }
        }
    }

</script>




