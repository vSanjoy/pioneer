$.validator.addMethod("valid_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid email");

// Phone number eg. (+91)9876543210
$.validator.addMethod("valid_number", function(value, element) {    
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }

}, "Please enter a valid phone number.");

// Phone number eg. +919876543210
$.validator.addMethod("valid_site_number", function(value, element) {
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        
        if($("#phone_no").val().charAt(0) == '0') {
            return false;
        }
        if($("#phone_no").val().substring(0, 3) == '966') {
            return false;
        }
        return true;
    } else {
        return false;
    }
}, "Please enter a valid phone number.");

// Minimum 8 digit,small+capital letter,number,specialcharacter
$.validator.addMethod("valid_password", function(value, element) {
    // if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value)) {
    if (/^.{8,}$/.test(value)) {    // Minimum 8 characters only
        return true;
    } else {
        return false;
    }
});

// Alphabet or number
$.validator.addMethod("valid_coupon_code", function(value, element) {
    if (/^[a-zA-Z0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Integer and decimal
$.validator.addMethod("valid_amount", function(value, element) {
    if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

//Pack value 
$.validator.addMethod("pack_value", function(value, element) {
    //if (/^(?=.*[0-9])[- +()0-9]+$/.test(value)) {
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, 'Please enter valid pack value.');

//Pack value create bid 
$.validator.addMethod("pack_value_create_bid", function(value, element) {
    
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        $("#error_bids").html('');
        return false;
    }
}, 'Please enter valid pack value.');

// quantity value check for create bid
$.validator.addMethod("quantity_create_bid", function(value, element) {
    
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        $("#error_bids").html('');
        return false;
    }
}, 'Please enter valid quantity.');

// check value of minimum amount for create bid
$.validator.addMethod("minimum_amount_create_bid", function(value, element) {
    
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        $("#error_bids").html('');
        return false;
    }
}, 'Please enter valid minimum amount.');


//mrp
$.validator.addMethod("mrp", function(value, element) {
    if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, 'Please enter valid amount.');

//selling_price
$.validator.addMethod("selling_price", function(value, element) {
    //if (/^(?=.*[0-9])[- +()0-9]+$/.test(value)) {
    if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, 'Please enter valid amount.');

//End date should be greater than Start date
$.validator.addMethod("greaterThan", function(value, element, params) {
    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }
    return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
}, 'Must be greater than start date.');

//End date should be greater than Start date for create bid
$.validator.addMethod("greaterThanED_create_bid", function(value, element, params) {
    $("#error_bids").html('');
    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }
    return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
}, 'Must be greater than start date.');

var overallErrorMessage         = '';
var pleaseFillOneField          = 'You missed 1 field. It has been highlighted.';
var pleaseFillMoreFieldFirst    = 'You have missed ';
var pleaseFillMoreFieldLast     = ' fields. Please fill before submitted.';
var successMessage              = 'Success';
var errorMessage                = 'Error';
var warningMessage              = 'Warning';
var infoMessage                 = 'Info';
var btnSubmitting               = 'Submitting...';
var btnUpdating                 = 'Updating...';
var thankYouMessage             = 'Thank You';
var formSuccessMessage          = 'Form has been submitted successfully. We will get back to you soon.';
var somethingWrongMessage       = 'Something went wrong, please try again later.';
var labelSelect                 = 'Select';
var serviceProviderDateMessage  = 'Please select services, service provider, booking date first.';


$(document).ready(function() {
    var websiteLink = $('#website_link').val();
});

// Sweet alert render
function sweetalertMessageRender(target, message, type, confirm = false) {
    let options = {
        title: warningMessage,
        text: message,
        icon: type,
        type: type,
        confirmButtonColor: '#c8fe0a',
        cancelButtonColor: '#000000',
        showLoaderOnConfirm: true,
        animation: true,
        allowOutsideClick: false,
    };
    if (confirm) {
        options['showCancelButton'] = true;
        options['cancelButtonText'] = 'Cancel';
        options['confirmButtonText'] = 'Yes';
    }
    return Swal.fire(options).then((result) => {
        if (confirm == true && result.value) {
            $('.preloader').show();
            window.location.href = target.getAttribute('data-href'); 
        } else {
            return (false);
        }
    });
}

// Toggle password in registration
$('.toggle-password').click(function() {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));

    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

// Toggle confirm password in registration
$('.toggle-confirm-password').click(function() {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));

    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

