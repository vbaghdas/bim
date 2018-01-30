/*==========================================================

                    CONTACT FORM

===========================================================*/

$(document).ready(function(){
    $(".btn-submit-voucher").click(function(){

        //get input field values
        var user_name = $('#name-voucher').val();
        var user_email = $('#email-voucher').val();
        var user_subject = $('#subject-voucher').val();
        var user_message = $('#message-voucher').val();
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
                'userMessage': user_message,
                'userSubject': user_subject
            };
            //Ajax post data to server
            $.ajax({
                type: "POST",
                url: url,
                data: $("#voucher-form").serialize(), // serializes the form's elements.
                success: function (data) {
                    $('#voucher-form').hide();
                    $('.modal-content').css({
                        'border-bottom': 'solid #555 1px',
                        'padding-bottom': '10px'
                    });
                    $('.modal-title').text('');
                    $('.modal-body > h2').text('Thank You For Opting in For Your Voucher!');
                    $('.modal-body > h1').text('');
                    $('.modal-body > .vouchers').text('Due to the limited number of vouchers available, they will be redeemable on a first-call basis so call to book your appointment today!');
                    $('.modal-body > .bonus').text('BONUS! Call to schedule now and get 4 adjustments for only $79!');
                    $('.modal-body > .call-now').text('Call NOW: (818) 782-2225');
                    $('.modal-footer > p').text('Voucher Code to redeem offer is BIMChiro.');
                },
                error: function(response){

                }
            });
        }

        return false;
    });

    //reset previously set border colors and hide all message on .keyup()
    $("#voucher-form #name-voucher").keyup(function(){
        $("#voucher-form #name-voucher").css('border-color', '');
    });

    $("#voucher-form #email-voucher").keyup(function(){
        $("#voucher-form #email-voucher").css('border-color', '');
    });

});