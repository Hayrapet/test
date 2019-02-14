
<form  id="uploadimage" name="upload_img" method="post" enctype="multipart/form-data" class="user_img_form">
    <input type="file" name="img_file[]" id="img_file" multiple>
    <button  name="save_img" id="img_save"   >Save</button>
</form>
<div class="loading"></div>


<script>
    $('#img_save').on('click' , function () {

        var data = new FormData($("#uploadimage"));


        if(($('#img_file')[0].files).length != 0){

            $(".loading").html('<img src="img/loading.gif">');
            $('.loading img').css({
                'width': '100px',
                'margin': '20px auto',
                'display': 'block',

            });
            $("#uploadimage").css('display' , 'none');

            $.each($('#img_file')[0].files,function (i,file) {
                data.append('file[' + i + ']' , file);


            })
        }else{
            return false;
        }

        $.ajax({
            url:'user_img_process.php',
            method:'POST',
            data:data,
            cache: false,
            processData: false,
            contentType: false,
            success:function (response) {

                $(".loading").empty();
                $("#uploadimage").css('display' , 'table');
                $('#img_file').val('');
                $('#images_content').css('display' , 'flex');
                $('#images_content').html(response);

            }

        });

        return false;
    })
</script>


<?php

$user_id = $_SESSION['user_id'];
$sql_img = mysqli_query($conn, "SELECT * FROM `images`  WHERE `id_user` = '$user_id' ORDER BY `id` DESC");

?>


<div id="images_content">
    <?php
while($row_img = mysqli_fetch_assoc($sql_img)) {;

    $user_img = $row_img['img'];
?>

<div class="images_user">
    <div class="delete_img_user">
        <form  method="post" >
            <div  class="img_delete">x</div>
            <input type="hidden" name="user_img_name" value="<?=$user_img?>">
        </form>
    </div>
    <div class="img_user"><img src="<?="img/user_img/$user_img"?>" ></div>
    <div class="date_img_user"><?=$row_img['img_date']?></div>
</div>



<?php } ?>

</div>


<script>

    if($('.img_delete').length == 0){
        $('#images_content').css('display' , 'none');
    }


    $(document).on('click','.img_delete', function () {

        if($('.img_delete').length == 1){
            $('#images_content').css('display' , 'none');
        }

        var data2 = $(this).parent().serialize();

        $.ajax({
            url: 'user_img_delete_process.php',
            method: 'POST',
            data: data2,
            success: function (response2) {
                $('#images_content').html(response2);

            }
        })


        return false;

    })






    var img_file = document.getElementById('img_file');
    var img_save = document.getElementById('img_save');
    var img_delete = document.getElementsByClassName('img_delete');
    var images_content = document.getElementById('images_content');

    // if(img_delete.length == '0'){
    //     images_content.style.display = 'none';
    // }




    img_save.onclick = function () {
        if(img_file.value == ''){
            return false;
        }
    }


    img_file.onchange = function () {
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
            img_file.value = '';
        }
    }

</script>
