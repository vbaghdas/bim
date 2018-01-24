/*==========================================================

                    CONTACT FORM

===========================================================*/

 $(document).ready(function(){
    $(".btn-submit").click(function(){

        //get input field values
        var user_name = $('input[name=name]').val();
        var user_email = $('input[name=email]').val();
        var user_subject = $('input[name=subject]').val();
        var user_message = $('textarea[name=message]').val();
        var url = "./php_mailer/mail_handler.php"; // the script where you handle the form input.

        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;
        if (user_name == "" || user_name == " ") {
            $('input[name=name]').css('border-color', '#fa225b');
            proceed = false;
        }
        if (user_email == "" || user_name == " ") {
            $('input[name=email]').css('border-color', '#fa225b');
            proceed = false;
        }
        if (user_subject == "" || user_name == " ") {
            $('input[name=subject]').css('border-color', '#fa225b');
            proceed = false;
        }
        if (user_message == "" || user_name == " ") {
            $('textarea[name=message]').css('border-color', '#fa225b');
            proceed = false;
        }
        var atpos = user_email.indexOf("@");
        var dotpos = user_email.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=user_email.length) {
            $('input[name=email]').css('border-color', '#fa225b');
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
                data: $("#contact-form").serialize(), // serializes the form's elements.
                success: function (data) {
                    $('#contact-form').closest('form').find('input[type=text], textarea').val('');
                    $('#contact-form').closest('form').find('input[type=email], textarea').val('');
                    $('.modal-title').text('Thank You!');
                    $('.modal-body > p').text('Your message has been sent successfully. We will get back to you shortly.');
                    $("#contact-modal").modal('show');
                },
                error: function(response){
                    $('.modal-title').text('Oops!');
                    $('.modal-body > p').text('There seemed to be an error. Please try again.');
                    $("#contact-modal").modal('show');
                }
            });
        }

        return false;
    });

    //reset previously set border colors and hide all message on .keyup()
    $("#contact-form #name").keyup(function(){
        $("#contact-form #name").css('border-color', '');
    });

    $("#contact-form #email").keyup(function(){
        $("#contact-form #email").css('border-color', '');
    });

    $("#contact-form #subject").keyup(function(){
        $("#contact-form #subject").css('border-color', '');
    });

    $("#contact-form #message").click(function(){
        $("#contact-form #message").css('border-color', '');
    });

});