<div class="user">
    <div class="user_img" id="user_img"><?php gender() ?></div>

    <form action="user_photo_process.php" name="user_photo_form" method="post" class="user_photo_form" enctype="multipart/form-data">
        <input type="file" name="photo_file" id="photo_file">
        <button type="submit" name="save" id="save">Save</button>

        <button type="submit" name="delete" id="delete">Delete</button>
    </form>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg change_button" data-toggle="modal" data-target="#myModal">Change Information</button>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                    <form action="change_user.php" method="post">

                        <div class="form-group">
                            <label for="change_firstname" >Change Firstname </label>
                            <input type="text" id="change_firstname" name="new_firstname" value="<?=$row['firstname']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="change_lastname" >Change Lastname</label>
                            <input type="text" id="change_lastname"  name="new_lastname" value="<?=$row['lastname']?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Change Email address</label>
                            <input type="email" name="new_email" value="<?=$row['email']?>" class="form-control" id="exampleInputEmail1">

                        </div>
                        <div class="form-group form-group-gender">
                            <label for="male">Male</label>
                            <input type="radio" id="male" name="new_gender" value="male" <?php if($row['gender'] == 'male') echo 'checked'?>  class="form-control">


                            <label for="female">FeMale</label>
                                <input type="radio" id="female" name="new_gender" value="female" <?php if($row['gender'] == 'female') echo 'checked'?> class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="new_pass" class="form-control"  >
                        </div>
                        <div class="form-group">
                            <label for="con_pass" >Confirm Password</label>
                            <input type="password" id="con_pass" name="new_pass_confirm" class="form-control" >
                        </div>

                        <button type="submit" id="sub_change" class="btn btn-primary">Submit</button>
                        <script>
                            $('#sub_change').on('click',function(event){
                                event.preventDefault();
                                var data = $(this).parent().serialize();




                                $.ajax({
                                    url:'user_change.php',
                                    method:'POST',
                                    type:'json',
                                    data:data,
                                    success:function (response) {
                                        console.log(response);

                                    }
                                })






                            })


                        </script>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>







<!--    <div class="user_mail"><span class="user_mail_mail">Mail: </span><div class="user_mail_text">--><?//=htmlspecialchars($row['email'] )?><!--<span id="change_mail"><i class="fas fa-edit"></i></span></div>-->
<!--        <form action="changeproces.php" method="post" class="user_change_mail" id="change_mail_form">-->
<!--            <textarea name="change_mail">--><?//=$row['email']?><!--</textarea>-->
<!--            <button><i class="fas fa-check"></i></button>-->
<!--        </form>-->
<!--    </div>-->

</div>



















<script>
    var photo_file = document.getElementById('photo_file');
    var user_img = document.getElementById('user_img');
    var save_button = document.getElementById('save');
    var delete_button = document.getElementById('delete');

    save_button.onclick = function() {
        if(photo_file.value == ''){
            return false;
        }
    }

    delete_button.onclick = function() {

       if(user_img.innerHTML == '<img src="img/user_photo/male.png">' || user_img.innerHTML == '<img src="img/user_photo/female.png">' ){
           return false;
       }else {
           confirm_ = confirm('Confirm');
           if (!confirm_) {
               return false;
           }
       }
    }

    photo_file.onchange = function () {
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
            photo_file.value = '';
        } else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(img.files[0]);
        }}

        function imageIsLoaded(e) {
            user_img.innerHTML = '';
            user_img.style.background = 'URL(' + e.target.result  + ')';
            user_img.style.width = '400px';
            user_img.style.height = '400px';
            user_img.style.backgroundSize = 'cover';
            user_img.style.backgroundPosition = 'center';
            user_img.style.marginBottom = '4px';

        }
</script>