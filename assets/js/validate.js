$("#submit").click(function() {
    
var name        = $('#fname').val();
var unvregdno   = $('#unvregdno').val();
var password    = $('#password').val();
var cpassword   = $('#cpassword').val();
var email       = $('#email').val();

name            = name.trim();
unvregdno       = unvregdno.trim();
password        = password.trim();
cpassword       = cpassword.trim();
email           = email.trim();


function validateEmail(emailaddress){
    var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    var valid = emailReg.test(emailaddress);

    if(!valid) {
        return false;
    } else {
        return true;
    }
}



if(name.length==0){

    $.Notification.autoHideNotify('error', 'top right', 'FULLNAME', 'Missing');
}
else if($.isNumeric(name)==true){

    $.Notification.autoHideNotify('error', 'top right', 'FULLNAME', 'We want alphabets not numbers');

}else if(name.length > 40){
 
    $.Notification.autoHideNotify('error', 'top right', 'FULLNAME', 'Name too big');

}else if(unvregdno.length==0){

    $.Notification.autoHideNotify('error', 'top right', 'UNIVERSITY NUMBER', 'Missing');

}else if(unvregdno.length < 10 || unvregdno.length > 10){
 
    $.Notification.autoHideNotify('error', 'top right', 'UNIVERSITY NUMBER', 'Invalid Number');

}else if($.isNumeric(unvregdno)==false){

    $.Notification.autoHideNotify('error', 'top right', 'UNIVERSITY NUMBER', 'It must contain Digits');

}else if(password.length==0){

     $.Notification.autoHideNotify('error', 'top right', 'PASSWORD', 'Missing');

}else if(password.length <=9){

     $.Notification.autoHideNotify('error', 'top right', 'PASSWORD', 'At least 10 characters long');

}else if(password.length > 50){

     $.Notification.autoHideNotify('error', 'top right', 'PASSWORD', 'Exceeding more than 50 characters');

}else if(cpassword.length==0){

     $.Notification.autoHideNotify('error', 'top right', 'CONFIRM PASSWORD', 'Missing');

}else if(cpassword.length > 50){

     $.Notification.autoHideNotify('error', 'top right', 'CONFIRM PASSWORD', 'Exceeding more than 50 characters');

}else if(cpassword != password){

     $.Notification.autoHideNotify('error', 'top right', 'PASSWORD MATCHING', 'Failed');


}else if(email.length==0){

    $.Notification.autoHideNotify('error', 'top right', 'EMAIL', 'Missing');

}else if(email.length > 300){

    $.Notification.autoHideNotify('error', 'top right', 'EMAIL', 'This email is not acceptable');

}else if(validateEmail(email)==false){

     $.Notification.autoHideNotify('error', 'top right', 'EMAIL', 'Invalid E-Mail');
}
else{
   
     $.ajax({

            type: "post",
            url: "regsuc.php",
            data: $('#form').serialize(),
            cache: false,
            success: function(data,status) {
                var msg= data;
                  $('#form')[0].reset();
                if(status!="success") {

                    $.Notification.autoHideNotify('error', 'top right', 'ERROR', 'Something Went Wrong');
                }else{
                    if(msg=="success")
                    {
                        $.Notification.autoHideNotify("success", "top left", "Hi", "Congratulations! You have successfully registered")
                    }else
                    {
                        $.Notification.autoHideNotify('error', 'top right', 'ERROR', '' + msg + '');
                    }

                }




               
            }
        });



}


return false;
});