
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#sgnp_business a").on('click', function(event) {
        event.preventDefault();
        if($('#sgnp_business input').attr("type") == "text"){
            $('#sgnp_business input').attr('type', 'password');
            $('#sgnp_business i').addClass( "fa-eye-slash" );
            $('#sgnp_business i').removeClass( "fa-eye" );
        }else if($('#sgnp_business input').attr("type") == "password"){
            $('#sgnp_business input').attr('type', 'text');
            $('#sgnp_business i').removeClass( "fa-eye-slash" );
            $('#sgnp_business i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#sgnp_bsns_cnfrm a").on('click', function(event) {
        event.preventDefault();
        if($('#sgnp_bsns_cnfrm input').attr("type") == "text"){
            $('#sgnp_bsns_cnfrm input').attr('type', 'password');
            $('#sgnp_bsns_cnfrm i').addClass( "fa-eye-slash" );
            $('#sgnp_bsns_cnfrm i').removeClass( "fa-eye" );
        }else if($('#sgnp_bsns_cnfrm input').attr("type") == "password"){
            $('#sgnp_bsns_cnfrm input').attr('type', 'text');
            $('#sgnp_bsns_cnfrm i').removeClass( "fa-eye-slash" );
            $('#sgnp_bsns_cnfrm i').addClass( "fa-eye" );
        }
    });
});



$(document).ready(function() {
    $("#nrml_signup a").on('click', function(event) {
        event.preventDefault();
        if($('#nrml_signup input').attr("type") == "text"){
            $('#nrml_signup input').attr('type', 'password');
            $('#nrml_signup i').addClass( "fa-eye-slash" );
            $('#nrml_signup i').removeClass( "fa-eye" );
        }else if($('#nrml_signup input').attr("type") == "password"){
            $('#nrml_signup input').attr('type', 'text');
            $('#nrml_signup i').removeClass( "fa-eye-slash" );
            $('#nrml_signup i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#nrml_signup_cnfrm a").on('click', function(event) {
        event.preventDefault();
        if($('#nrml_signup_cnfrm input').attr("type") == "text"){
            $('#nrml_signup_cnfrm input').attr('type', 'password');
            $('#nrml_signup_cnfrm i').addClass( "fa-eye-slash" );
            $('#nrml_signup_cnfrm i').removeClass( "fa-eye" );
        }else if($('#nrml_signup_cnfrm input').attr("type") == "password"){
            $('#nrml_signup_cnfrm input').attr('type', 'text');
            $('#nrml_signup_cnfrm i').removeClass( "fa-eye-slash" );
            $('#nrml_signup_cnfrm i').addClass( "fa-eye" );
        }
    });
});



$(document).ready(function() {
    $("#pass_sec_cnfrm a").on('click', function(event) {
        event.preventDefault();
        if($('#pass_sec_cnfrm input').attr("type") == "text"){
            $('#pass_sec_cnfrm input').attr('type', 'password');
            $('#pass_sec_cnfrm i').addClass( "fa-eye-slash" );
            $('#pass_sec_cnfrm i').removeClass( "fa-eye" );
        }else if($('#pass_sec_cnfrm input').attr("type") == "password"){
            $('#pass_sec_cnfrm input').attr('type', 'text');
            $('#pass_sec_cnfrm i').removeClass( "fa-eye-slash" );
            $('#pass_sec_cnfrm i').addClass( "fa-eye" );
        }
    });
});