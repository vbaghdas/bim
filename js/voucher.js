/*==========================================================

                    CONTACT FORM

===========================================================*/

$(document).ready(function(){
    $(".btn-submit-voucher").click(function(){

        //get input field values
        var user_name = $('#name-voucher').val();
        var user_email = $('#email-voucher').val();
        var url = "./php_mailer/mail_handler.php"; // the script where you handle the form input.

        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;
        if (user_name == "" || user_name == " ") {
            $('#name-voucher').css('border-color', '#fa225b');
            proceed = false;
        }
        if (user_email == "" || user_name == " ") {
            $('#email-voucher').css('border-color', '#fa225b');
            proceed = false;
        }

        var atpos = user_email.indexOf("@");
        var dotpos = user_email.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=user_email.length) {
            $('#email-voucher').css('border-color', '#fa225b');
            proceed = false;
        }

        //everything looks good! proceed...
        if (proceed) {
            //data to be sent to server
            post_data = {
                'userName': user_name,
                'userEmail': user_email,
            };
            //Ajax post data to server
            $.ajax({
                type: "POST",
                url: url,
                data: $("#voucher-form").serialize(), // serializes the form's elements.
                success: function (data) {
                    $('#voucher-form').closest('form').find('#name-voucher').val('');
                    $('#voucher-form').closest('form').find('#email-voucher').val('');
                    $('#voucher-form').hide();
                    $('.modal-title').hide();
                    $('.modal-body > h1').text('Thank You For Opting in For Your Voucher!');
                    $('.modal-body > h6').text('Due to the limited number of vouchers available, they will be redeemable on a first-call basis so call to book your appointment today!');
                },
                error: function(response){

                }
            });
        }

        return false;
    });

    //reset previously set border colors and hide all message on .keyup()
    $("#voucher-form #name").keyup(function(){
        $("#voucher-form #name-voucher").css('border-color', '');
    });

    $("#voucher-form #email").keyup(function(){
        $("#voucher-form #email-voucher").css('border-color', '');
    });

});