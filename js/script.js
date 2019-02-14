window.onload = function() {

    let ok = document.getElementsByClassName('ok');

    if(ok[0]) {
        ok[0].onclick = function () {
            this.style.left = '-1000px';
        }
    }


    let change_mail = document.getElementById('change_mail');


    if(change_mail) {
        change_mail.onclick = function () {
            this.parentElement.style.display = 'none';
            document.getElementById('change_mail_form').style.display = 'block';
        }
    }






}