var adminPanelUrl = $("#admin_url").val();
var adminImageUrl = $("#admin_image_url").val();
var ajaxCheck = false;

var somethingWrongMessage       = 'Something went wrong, please try again later.';
var confirmChangeStatusMessage  = 'Are you sure, you want to change the status?';

var confirmActiveStatusMessage  = 'Are you sure, you want to active?';
var confirmInactiveStatusMessage= 'Are you sure, you want to inactive?';
var confirmDeleteMessage        = 'Are you sure, you want to delete?';
var confirmCancelMessage        = 'Are you sure, you want to cancel?';
var confirmCompleteMessage      = 'Are you sure, you want to complete?';

var confirmParentDeleteMessage  = 'Are you sure, you want to delete? Related records will also delete.';

var confirmActiveSelectedMessage    = 'Are you sure, you want to active selected records?';
var confirmInactiveSelectedMessage  = 'Are you sure, you want to inactive selected records?';
var confirmDeleteSelectedMessage    = 'Are you sure, you want to delete selected records?';
var confirmCancelSelectedMessage    = 'Are you sure, you want to cancel selected records?';
var confirmCompleteSelectedMessage  = 'Are you sure, you want to complete selected records?';
var confirmDefaultMessage           = 'Are you sure, you want to set it default?';

var overallErrorMessage         = '';
var pleaseFillOneField          = 'You missed 1 field. It has been highlighted.';
var pleaseFillMoreFieldFirst    = 'You have missed ';
var pleaseFillMoreFieldLast     = ' fields. Please fill before submitted.';

var copiedToClipBoard           = 'Copied to clipboard';

var btnYes              = 'Yes';
var btnNo               = 'No';
var btnOk               = 'Ok';
var btnConfirmYesColor  = '#22ca80';
var btnCancelNoColor    = '#6c757d';
var successMessage      = 'Success';
var errorMessage        = 'Error';
var warningMessage      = 'Warning';
var infoMessage         = 'Info';
var btnSubmitting       = 'Submitting...';
var btnUpdating         = 'Updating...';
var btnSubmitPreloader  = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Submitting...';
var btnUpdatePreloader  = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...';
var btnSavingPreloader  = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...';
var btnCreatingPreloader= '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Creating...';
var btnUpdatingPreloader= '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...';
var btnLoadingPreloader = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...';
var btnSendingPreloader = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Sending...';

$.validator.addMethod("valid_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid email.");

// Phone number eg. (+91)9876543210
$.validator.addMethod("valid_number", function(value, element) {
    if (/^(?=.*[0-9])[- +()0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid phone number.");

// Minimum 8 digit,small+capital letter,number,specialcharacter
$.validator.addMethod("valid_password", function(value, element) {
    if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value)) {
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

// Positive number
$.validator.addMethod("valid_positive_number", function(value, element) {
    if (/^[0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Integer and decimal
$.validator.addMethod("valid_amount", function(value, element) {
    if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Integer and decimal
$.validator.addMethod("valid_amount_not_empty", function(value, element) {
    if (value) {
        if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
});

// Youtube url checking
$.validator.addMethod("valid_youtube_url", function(value, element) {
    if (/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Alphanumeric without space special characters
$.validator.addMethod("valid_alphanumeric_without_space_special_characters", function(value, element) {
    if (/^[a-zA-Z0-9_]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Ckeditor
$.validator.addMethod("ckrequired", function (value, element) {  
    var idname = $(element).attr('id');  
    var editor = CKEDITOR.instances[idname];  
    var ckValue = GetTextFromHtml(editor.getData()).replace(/<[^>]*>/gi, '').trim();  
    if (ckValue.length === 0) {  
        //if empty or trimmed value then remove extra spacing to current control  
        $(element).val(ckValue);
    } else {  
        //If not empty then leave the value as it is  
        $(element).val(editor.getData());  
    }  
    return $(element).val().length > 0;  
}, "Please enter description.");
  
function GetTextFromHtml(html) {  
    var dv = document.createElement("DIV");
    dv.innerHTML = html;  
    return dv.textContent || dv.innerText || "";  
}


$(document).ready(function() {
    setTimeout(function() {
        $('.notification').slideUp(1000).delay(3000);
    }, 3000);

    // Password checker
    $('.password-checker').on('keyup', function () {
        var getVal = $(this).val();
        var dataAttrId = $(this).data('pcid');        
        if (getVal != '') {
            if (/^[a-zA-Z_\-]+$/.test(getVal)) {  // weak
                $('#'+dataAttrId).html('<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>');
            }
            if (/^(?=.*?[a-z])(?=.*?[A-Z]).{3,}$/.test(getVal)) {   // medium
                $('#'+dataAttrId).html('<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>');
            }
            if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9]).{5,}$/.test(getVal)) {   // strong
                $('#'+dataAttrId).html('<div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>');
            }
            if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(getVal)) {    // very strong
                $('#'+dataAttrId).html('<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>');
            }
        } else {
            $('#'+dataAttrId).html('<div class="progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
        }
    });

    // Start :: Admin Login Form //
    $("#adminLoginForm").validate({
        ignore: [],
        debug: false,
        rules: {
            credential: {
                required: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            credential: {
                required: "Please enter email or username.",
            },
            password: {
                required: "Please enter password.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnLoadingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Admin Login Form //
    
    // Start :: Forgot Password Form //
    $("#forgotPasswordForm").validate({
        ignore: [],
        debug: false,
        rules: {
            email: {
                required: true,
                valid_email: true
            },
        },
        messages: {
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email."
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSendingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Forgot Password Form //

    // Start :: Reset Password Form //
    $("#resetPasswordForm").validate({
        ignore: [],
        debug: false,
        rules: {
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Reset Password Form //

    // Start :: Profile Form //
    $("#updateProfileForm").validate({
        ignore: [],
        debug: false,
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                valid_email: true
            },
            phone_no: {
                required: true,
            },
            username: {
                required: true,
                valid_alphanumeric_without_space_special_characters: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter first name."
            },
            last_name: {
                required: "Please enter last name."
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            phone_no: {
                required: "Please enter phone number.",
            },
            username: {
                required: "Please enter username.",
                valid_alphanumeric_without_space_special_characters: "Please enter username (alphanumeric without space and special characters).",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Profile Form //

    // Start :: Admin Password Form //
    $("#updateAdminPassword").validate({
        ignore: [],
        debug: false,
        rules: {
            current_password: {
                required: true,
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            }
        },
        messages: {
            current_password: {
                required: "Please enter current password.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Admin Password Form //

    // Start :: Role Assignment Form //
    $("#createRoleAssignmentForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distributor_id: {
                required: true
            },
            'role[]': {
                required: true,
            },
        },
        messages: {
            distributor_id: {
                required: "Please select distributor/seller."
            },
            'role[]': {
                required: "Please select role.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'role' || $(element).attr('id') == 'distributor_id') {
                error.insertAfter($(element).parents('div.form-group'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateRoleAssignmentForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distributor_id: {
                required: true
            },
            'role[]': {
                required: true,
            },
        },
        messages: {
            distributor_id: {
                required: "Please select distributor/seller."
            },
            'role[]': {
                required: "Please select role.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'role' || $(element).attr('id') == 'distributor_id') {
                error.insertAfter($(element).parents('div.form-group'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Role Assignment Form //

    // Start :: Role Form //
    $("#createRoleForm").validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter role."
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateRoleForm").validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter role."
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Role Form //

    // Start :: Site Settings Form //
    $("#updateWebsiteSettingsForm").validate({
        ignore: [],
        debug: false,
        rules: {
            from_email: {
                required: true,
                valid_email: true
            },
            to_email: {
                required: true,
                valid_email: true
            },
            'website_title': {
                required: true
            },
        },
        messages: {
            from_email: {
                required: "Please enter from email."
            },
            to_email: {
                required: "Please enter to email."
            },
            'website_title': {
                required: "Please enter website title."
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Site Settings Form //

    // Start :: Distribution Area Form //
    $("#createDistributionAreaForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
            definition: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter area name.",
            },
            definition: {
                required: "Please enter definition.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateDistributionAreaForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
            definition: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter area name.",
            },
            definition: {
                required: "Please enter definition.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Distribution Area Form //

    // Start :: Distributor Form //
    $("#createDistributorForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            job_title_1: {
                required: true
            },
            full_name: {
                required: true
            },
            company: {
                required: true
            },
            username: {
                required: true,
                valid_alphanumeric_without_space_special_characters: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            job_title_1: {
                required: "Please enter job title 1."
            },
            full_name: {
                required: "Please enter name 1."
            },
            company: {
                required: "Please enter company."
            },
            username: {
                required: "Please enter username.",
                valid_alphanumeric_without_space_special_characters: "Please enter username (alphanumeric without space and special characters).",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateDistributorForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            job_title_1: {
                required: true
            },
            full_name: {
                required: true
            },
            company: {
                required: true
            },
            username: {
                required: true,
                valid_alphanumeric_without_space_special_characters: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            job_title_1: {
                required: "Please enter job title 1."
            },
            full_name: {
                required: "Please enter name 1."
            },
            company: {
                required: "Please enter company."
            },
            username: {
                required: "Please enter username.",
                valid_alphanumeric_without_space_special_characters: "Please enter username (alphanumeric without space and special characters).",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Distributor Form //

    // Start :: Seller Form //
    $("#createSellerForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            full_name: {
                required: true
            },
            username: {
                required: true,
                valid_alphanumeric_without_space_special_characters: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
            'distribution_area_ids[]': {
                required: true,
            },
        },
        messages: {
            full_name: {
                required: "Please enter name."
            },
            username: {
                required: "Please enter username.",
                valid_alphanumeric_without_space_special_characters: "Please enter username (alphanumeric without space and special characters).",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            },
            'distribution_area_ids[]': {
                required: "Please select distribution area.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateSellerForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            full_name: {
                required: true
            },
            username: {
                required: true,
                valid_alphanumeric_without_space_special_characters: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
            'distribution_area_ids[]': {
                required: true,
            },
        },
        messages: {
            full_name: {
                required: "Please enter name."
            },
            username: {
                required: "Please enter username.",
                valid_alphanumeric_without_space_special_characters: "Please enter username (alphanumeric without space and special characters).",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Min. 8, alphanumeric and special character."
            },
            confirm_password: {
                required: "Please enter confirm password",
                valid_password: "Min. 8, alphanumeric and special character.",
                equalTo: "Password should be same as new password.",
            },
            'distribution_area_ids[]': {
                required: "Please select distribution area.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Seller Form //

    // Start :: Beat Form //
    $("#createBeatForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            title: {
                required: true,
            },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            title: {
                required: "Please enter title.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateBeatForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            title: {
                required: true,
            },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            title: {
                required: "Please enter title.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else {
                error.insertAfter(element);   
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Beat Form //

    // Start :: Store Form //
    $("#createStoreForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            name_1: {
                required: true
            },
            store_name: {
                required: true
            },
            beat_id: {
                required: true
            },
            // email: {
            //     required: true,
            //     valid_email: true
            // },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            name_1: {
                required: "Please enter name 1."
            },
            store_name: {
                required: "Please enter store name."
            },
            beat_id: {
                required: "Please select beat."
            },
            // email: {
            //     required: "Please enter email.",
            //     valid_email: "Please enter valid email.",
            // },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else if ($(element).attr('id') == 'beat_id') {
                error.insertAfter($(element).parents('div#beat-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateStoreForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            distribution_area_id: {
                required: true
            },
            name_1: {
                required: true
            },
            store_name: {
                required: true
            },
            beat_id: {
                required: true
            },
            // email: {
            //     required: true,
            //     valid_email: true
            // },
        },
        messages: {
            distribution_area_id: {
                required: "Please select distribution area."
            },
            name_1: {
                required: "Please enter name 1."
            },
            store_name: {
                required: "Please enter store name."
            },
            company: {
                required: "Please enter company."
            },
            beat_id: {
                required: "Please select beat."
            },
            // email: {
            //     required: "Please enter email.",
            //     valid_email: "Please enter valid email.",
            // },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution-area-div'));
            } else if ($(element).attr('id') == 'beat_id') {
                error.insertAfter($(element).parents('div#beat-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Store Form //

    // Start :: Category Form //
    $("#createCategoryForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter title.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateCategoryForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter title.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Category Form //

    // Start :: Product Form //
    $("#createProductForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            category_id: {
                required: true,
            },
            title: {
                required: true,
            },
            rate_per_pcs: {
                required: true,
                valid_amount: true,
            },
            mrp: {
                // required: true,
                valid_amount_not_empty: true,
            },
            retailer_price: {
                required: true,
                valid_amount: true,
            },
        },
        messages: {
            category_id: {
                required: "Please select category.",
            },
            title: {
                required: "Please enter title.",
            },
            rate_per_pcs: {
                required: "Please enter rate per pcs.",
                valid_amount: "Please enter valid amount.",
            },
            mrp: {
                // required: "Please enter mrp.",
                valid_amount_not_empty: "Please enter valid amount.",
            },
            retailer_price: {
                required: "Please enter retailer price.",
                valid_amount: "Please enter valid amount.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'category_id') {
                error.insertAfter($(element).parents('div#category-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateProductForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            category_id: {
                required: true,
            },
            title: {
                required: true,
            },
            rate_per_pcs: {
                required: true,
                valid_amount: true,
            },
            mrp: {
                // required: true,
                valid_amount_not_empty: true,
            },
            retailer_price: {
                required: true,
                valid_amount: true,
            },
        },
        messages: {
            category_id: {
                required: "Please select category.",
            },
            title: {
                required: "Please enter title.",
            },
            rate_per_pcs: {
                required: "Please enter rate per pcs.",
                valid_amount: "Please enter valid amount.",
            },
            mrp: {
                // required: "Please enter mrp.",
                valid_amount_not_empty: "Please enter valid amount.",
            },
            retailer_price: {
                required: "Please enter retailer price.",
                valid_amount: "Please enter valid amount.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
                $('#lang-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'category_id') {
                error.insertAfter($(element).parents('div#category-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Product Form //
    
    // Start :: Area Analysis Form //
    $("#createAreaAnalysisForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            season_id: {
                required: true,
            },
            year: {
                required: true,
            },
            analysis_date: {
                required: true,
            },
            distribution_area_id: {
                required: true,
            },
            distributor_id: {
                required: true,
            },
            store_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            product_id: {
                required: true,
            },
            target_monthly_sales: {
                required: true,
            },
            type_of_analysis: {
                required: true,
            },
            action: {
                required: true,
            },
            result: {
                required: true,
            },
            why: {
                required: true,
            },
            comment: {
                required: true,
            },
        },
        messages: {
            season_id: {
                required: "Please select season.",
            },
            year: {
                required: "Please select year.",
            },
            analysis_date: {
                required: "Please select date.",
            },
            distribution_area_id: {
                required: "Please select distribution area.",
            },
            distributor_id: {
                required: "Please select distributor.",
            },
            store_id: {
                required: "Please select store.",
            },
            category_id: {
                required: "Please select category.",
            },
            product_id: {
                required: "Please select product.",
            },
            target_monthly_sales: {
                required: "Please enter target monthly sales.",
            },
            type_of_analysis: {
                required: "Please enter type of analysis.",
            },
            action: {
                required: "Please enter action.",
            },
            result: {
                required: "Please enter result.",
            },
            why: {
                required: "Please enter why.",
            },
            comment: {
                required: "Please enter comment.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution_area-div'));
            } else if($(element).attr('id') == 'distributor_id') {
                error.insertAfter($(element).parents('div#distributor_id-div'));
            } else if($(element).attr('id') == 'store_id') {
                error.insertAfter($(element).parents('div#store_id-div'));
            } else if($(element).attr('id') == 'category_id') {
                error.insertAfter($(element).parents('div#category_id-div'));
            } else if($(element).attr('id') == 'product_id') {
                error.insertAfter($(element).parents('div#product_id-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateAreaAnalysisForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            season_id: {
                required: true,
            },
            year: {
                required: true,
            },
            analysis_date: {
                required: true,
            },
            distribution_area_id: {
                required: true,
            },
            distributor_id: {
                required: true,
            },
            store_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            product_id: {
                required: true,
            },
            target_monthly_sales: {
                required: true,
            },
            type_of_analysis: {
                required: true,
            },
            action: {
                required: true,
            },
            result: {
                required: true,
            },
            why: {
                required: true,
            },
            comment: {
                required: true,
            },
        },
        messages: {
            season_id: {
                required: "Please select season.",
            },
            year: {
                required: "Please select year.",
            },
            analysis_date: {
                required: "Please select date.",
            },
            distribution_area_id: {
                required: "Please select distribution area.",
            },
            distributor_id: {
                required: "Please select distributor.",
            },
            store_id: {
                required: "Please select store.",
            },
            category_id: {
                required: "Please select category.",
            },
            product_id: {
                required: "Please select product.",
            },
            target_monthly_sales: {
                required: "Please enter target monthly sales.",
            },
            type_of_analysis: {
                required: "Please enter type of analysis.",
            },
            action: {
                required: "Please enter action.",
            },
            result: {
                required: "Please enter result.",
            },
            why: {
                required: "Please enter why.",
            },
            comment: {
                required: "Please enter comment.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'distribution_area_id') {
                error.insertAfter($(element).parents('div#distribution_area-div'));
            } else if($(element).attr('id') == 'distributor_id') {
                error.insertAfter($(element).parents('div#distributor_id-div'));
            } else if($(element).attr('id') == 'store_id') {
                error.insertAfter($(element).parents('div#store_id-div'));
            } else if($(element).attr('id') == 'category_id') {
                error.insertAfter($(element).parents('div#category_id-div'));
            } else if($(element).attr('id') == 'product_id') {
                error.insertAfter($(element).parents('div#product_id-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Area Analysis Form //

    // Start :: Analyses Form //
    $("#createAnalysesForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            result: {
                required: true,
            },
            why: {
                required: true,
            },
        },
        messages: {
            result: {
                required: "Please enter result.",
            },
            why: {
                required: "Please enter why.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateAnalysesForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            result: {
                required: true,
            },
            why: {
                required: true,
            },
        },
        messages: {
            result: {
                required: "Please enter result.",
            },
            why: {
                required: "Please enter why.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Analyses Form //

    // Start :: Analysis Season Form //
    $("#createAnalysisSeasonForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
            year: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter title.",
            },
            year: {
                required: "Please select year.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });

    $("#updateAnalysisSeasonForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            title: {
                required: true,
            },
            year: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter title.",
            },
            year: {
                required: "Please select year.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Analysis Season Form //

    // Start :: Area Analysis Form //
    $("#updateAnalysisForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            analysis_date: {
                required: true,
            },
        },
        messages: {
            analysis_date: {
                required: "Please select date.",
            },
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Area Analysis Form //

    // Start :: Seller Analysis Form //
    $("#updateSellerAnalysesForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            qty: {
                required: true,
                valid_positive_number: true
            },
            why: {
                required: true
            },
            result: {
                required: true
            }
        },
        messages: {
            qty: {
                required: "Please enter order quantity.",
                valid_positive_number:  "Please enter number.",
            },
            why: {
                required: "Please enter why.",
            },
            result: {
                required: "Please enter result.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Seller Analysis Form //

    // Start :: Order Form //
    $("#updateOrderForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            qty: {
                required: true,
                valid_positive_number: true
            },
            why: {
                required: true
            },
            result: {
                required: true
            }
        },
        messages: {
            qty: {
                required: "Please enter order quantity.",
                valid_positive_number:  "Please enter number.",
            },
            why: {
                required: "Please enter why.",
            },
            result: {
                required: "Please enter result.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnSavingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Order Form //

    // Start :: Create invoice single step order Form //
    $("#createInvoiceSingleStepOrderForm").validate({
        ignore: [],
        rules: {
            'category[]': {
                required: true
            },
            'product_id[]': {
                required: true
            },
            'qty[]': {
                required: true
            },
            'unit_price[]': {
                required: true
            },
            'status[]': {
                required: true
            },
        },
        messages: {
            'category[]': {
                required: "Please select category.",
            },
            'product_id[]': {
                required: "Please select product.",
            },
            'qty[]': {
                required: "Please enter quantity.",
            },
            'unit_price[]': {
                required: "Please enter unit price.",
            },
            'status[]': {
                required: "Please select status.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-processing').html(btnCreatingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Create invoice single step order Form //

    // Start :: Update invoice Form //
    $("#updateInvoiceForm").validate({
        ignore: [],
        rules: {
            'category[]': {
                required: true
            },
            'product_id[]': {
                required: true
            },
            'qty[]': {
                required: true
            },
            'unit_price[]': {
                required: true
            },
            'status[]': {
                required: true
            },
        },
        messages: {
            'category[]': {
                required: "Please select category.",
            },
            'product_id[]': {
                required: "Please select product.",
            },
            'qty[]': {
                required: "Please enter quantity.",
            },
            'unit_price[]': {
                required: "Please enter unit price.",
            },
            'status[]': {
                required: "Please select status.",
            }
        },
        errorClass: 'error invalid-feedback',
        errorElement: 'div',
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(form, validator) {
            var numberOfInvalids = validator.numberOfInvalids();
            if (numberOfInvalids) {
                overallErrorMessage = numberOfInvalids == 1 ? pleaseFillOneField : pleaseFillMoreFieldFirst + numberOfInvalids + pleaseFillMoreFieldLast;
            } else {
                overallErrorMessage = '';
            }
            toastr.error(overallErrorMessage, errorMessage+'!');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('#btn-updating').html(btnUpdatingPreloader);
            $('.preloader').show();
            form.submit();
        }
    });
    // End :: Update invoice Form //

    /***************************** Start :: Data table and Common Functionalities ****************************/
    // Start :: Check / Un-check all for Admin Bulk Action (DO NOT EDIT / DELETE) //
	$('.checkAll').click(function() {
		if ($(this).is(':checked')) {
			$('.delete_checkbox').prop('checked', true);
		} else {
			$('.delete_checkbox').prop('checked', false);
		}
	});
	$(document).on('click', '.delete_checkbox', function(){
		var length = $('.delete_checkbox').length;
		var totalChecked = 0;
		$('.delete_checkbox').each(function() {
			if ($(this).is(':checked')) {
				totalChecked += 1;
			}
		});
		if (totalChecked == length) {
			$(".checkAll").prop('checked', true);
		}else{
			$('.checkAll').prop('checked', false);
		}
	});
    // End :: Check / Un-check all for Admin Bulk Action (DO NOT EDIT / DELETE) //

    /*************************************** End :: Data table and Common Functionalities ***************************************/

    /*Date range used in Admin user listing (filter) section*/
    //Restriction on key & right click
    // $('#registered_date').keydown(function(e) {
    //     var keyCode = e.which;
    //     if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 8 || keyCode === 122 || keyCode === 32 || keyCode == 46) {
    //         e.preventDefault();
    //     }
    // });
    // $('#registered_date').daterangepicker({
    //     autoUpdateInput: false,
    //     timePicker: false,
    //     timePicker24Hour: true,
    //     timePickerIncrement: 1,
    //     startDate: moment().startOf('hour'),
    //     //endDate: moment().startOf('hour').add(24, 'hour'),
    //     locale: {
    //         format: 'YYYY-MM-DD'
    //     }
    // }, function(start_date, end_date) {
    //     $(this.element[0]).val(start_date.format('YYYY-MM-DD') + ' - ' + end_date.format('YYYY-MM-DD'));
    // });

    // $('#purchase_date').daterangepicker({
    //     autoUpdateInput: false,
    //     timePicker: false,
    //     timePicker24Hour: true,
    //     timePickerIncrement: 1,
    //     startDate: moment().startOf('hour'),
    //     //endDate: moment().startOf('hour').add(24, 'hour'),
    //     locale: {
    //         format: 'YYYY-MM-DD'
    //     }
    // }, function(start_date, end_date) {
    //     $(this.element[0]).val(start_date.format('YYYY-MM-DD') + ' - ' + end_date.format('YYYY-MM-DD'));
    // });

    // $('#contract_duration').daterangepicker({
    //     autoUpdateInput: false,
    //     timePicker: false,
    //     timePicker24Hour: true,
    //     timePickerIncrement: 1,
    //     startDate: moment().startOf('hour'),
    //     //endDate: moment().startOf('hour').add(24, 'hour'),
    //     locale: {
    //         format: 'YYYY-MM-DD'
    //     }
    // }, function(start_date, end_date) {
    //     $(this.element[0]).val(start_date.format('YYYY-MM-DD') + ' - ' + end_date.format('YYYY-MM-DD'));
    // });

    /*Date range used in Coupon listing (filter) section*/
    //Restriction on key & right click
    // $('.date_restriction').keydown(function(e) {
    //     var keyCode = e.which;
    //     if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 8 || keyCode === 122 || keyCode === 32 || keyCode == 46) {
    //         e.preventDefault();
    //     }
    // });
    // $('.date_restriction').daterangepicker({
    //     autoUpdateInput: false,
    //     timePicker: true,
    //     timePicker24Hour: true,
    //     timePickerIncrement: 1,
    //     startDate: moment().startOf('hour'),
    //     //endDate: moment().startOf('hour').add(24, 'hour'),
    //     locale: {
    //         format: 'YYYY-MM-DD HH:mm'
    //     }
    // }, function(start_date, end_date) {
    //     $(this.element[0]).val(start_date.format('YYYY-MM-DD HH:mm') + ' - ' + end_date.format('YYYY-MM-DD HH:mm'));
    // });

    $('.datePicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: false,
        showWeekNumbers: false,
        showISOWeekNumbers: false,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: false,
        autoApply: true,
        autoUpdateInput: true,
        alwaysShowCalendars: false,
        // startDate: moment().startOf('hour'),
        // endDate: moment().startOf('hour').add(24, 'hour'),
        // minDate: moment().startOf('hour'),
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    }, function(start, end, label) {
        // $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('.datePickerInEdit').daterangepicker({
        singleDatePicker: true,
        showDropdowns: false,
        showWeekNumbers: false,
        showISOWeekNumbers: false,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: false,
        autoApply: true,
        autoUpdateInput: true,
        alwaysShowCalendars: false,
        // startDate: moment().startOf('hour'),
        // endDate: moment().startOf('hour').add(24, 'hour'),
        minDate: moment().startOf('hour'),
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    }, function(start, end, label) {
        // $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    // $('.dateRangePicker').daterangepicker({
    //     singleDatePicker: false,
    //     showDropdowns: false,
    //     showWeekNumbers: false,
    //     showISOWeekNumbers: false,
    //     timePicker: true,
    //     timePicker24Hour: true,
    //     timePickerSeconds: false,
    //     autoApply: true,
    //     autoUpdateInput: false,
    //     alwaysShowCalendars: false,
    //     startDate: moment().startOf('hour'),
    //     // endDate: moment().startOf('hour').add(24, 'hour'),
    //     ranges: {
    //         'Today': [moment(), moment()],
    //         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //         'This Month': [moment().startOf('month'), moment().endOf('month')],
    //         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     },
    //     locale: {
    //         format: 'YYYY-MM-DD HH:mm'
    //     }
    // }, function(start, end, label, picker) {
    //     $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
    //     // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    // });

    $(".dateRangePicker").daterangepicker({
        singleDatePicker: false,
        showDropdowns: true,
        showWeekNumbers: false,
        showISOWeekNumbers: false,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        autoUpdateInput: false,
        alwaysShowCalendars: false,
        minYear: 2022,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
    });

    $('.dateRangePickerInEdit').daterangepicker({
        singleDatePicker: false,
        showDropdowns: false,
        
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: false,
        autoApply: true,
        autoUpdateInput: true,
        alwaysShowCalendars: false,
        // startDate: moment().startOf('hour'),
        // endDate: moment().startOf('hour').add(24, 'hour'),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    }, function(start, end, label) {
        // $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    // $("#settlement_status").select2();
});

// Start :: Admin List Actions //
function listActions(routePrefix, actionRoute, id, actionType, dTable) {
    var message = actionUrl = '';

    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute+'/'+id;
    }

    if (actionType == 'active') {
        message = confirmActiveStatusMessage;
    } else if (actionType == 'inactive') {
        message = confirmInactiveStatusMessage;
    } else if (actionType == 'cancel') {
        message = confirmCancelMessage;
    } else if (actionType == 'complete') {
        message = confirmCompleteMessage;
    } else if (actionType == 'delete') {
        message = confirmDeleteMessage;
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'GET',
                    data: {},
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            dTable.draw();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin List Actions //

// Start :: Admin List Bulk Actions //
function bulkActions(routePrefix, actionRoute, selectedIds, actionType, dTable) {
    var message = actionUrl = '';
    
    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute;
    }

    if (actionType == 'active') {
        message = confirmActiveSelectedMessage;
    } else if (actionType == 'inactive') {
        message = confirmInactiveSelectedMessage;
    } else if (actionType == 'cancel') {
        message = confirmCancelSelectedMessage;
    } else if (actionType == 'complete') {
        message = confirmCompleteSelectedMessage;
    } else if (actionType == 'delete') {
        message = confirmDeleteSelectedMessage;
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        actionType: actionType,
                        selectedIds: selectedIds,
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            $('.checkAll').prop('checked', false);
                            dTable.draw();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            $('.checkAll').prop('checked', false);
                            dTable.draw();
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin List Bulk Actions //

// Start :: Admin List Actions With Filter //
function listActionsWithFilter(routePrefix, actionRoute, id, actionType) {
    var message = actionUrl = '';

    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute+'/'+id;
    }

    if (actionType == 'active') {
        message = confirmActiveStatusMessage;
    } else if (actionType == 'inactive') {
        message = confirmInactiveStatusMessage;
    } else if (actionType == 'cancel') {
        message = confirmCancelMessage;
    } else if (actionType == 'complete') {
        message = confirmCompleteMessage;
    } else if (actionType == 'delete') {
        message = confirmDeleteMessage;
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'GET',
                    data: {},
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            getList();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin List Actions With Filter //

// Start :: Admin List Store Status Actions With Filter //
function listStoreStatusActionsWithFilter(routePrefix, actionRoute, id, actionType) {
    var message = actionUrl = '';

    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute+'/'+id;
    }

    if (actionType == 'IP') {            // In-Progress
        message = 'Are you sure, to set status to In-Progress?';
    } else if (actionType == 'CP') {            // Complete
        message = 'Are you sure, to set status to Complete?';
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'GET',
                    data: {
                        'actionType': actionType
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            getStoreList();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin List Store Status Actions With Filter //

// Start :: Admin List Bulk Actions With Filter //
function bulkActionsWithFilter(routePrefix, actionRoute, selectedIds, actionType) {
    var message = actionUrl = '';
    
    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute;
    }

    if (actionType == 'active') {
        message = confirmActiveSelectedMessage;
    } else if (actionType == 'inactive') {
        message = confirmInactiveSelectedMessage;
    } else if (actionType == 'cancel') {
        message = confirmCancelSelectedMessage;
    } else if (actionType == 'complete') {
        message = confirmCompleteSelectedMessage;
    } else if (actionType == 'delete') {
        message = confirmDeleteSelectedMessage;
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        actionType: actionType,
                        selectedIds: selectedIds,
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            $('.checkAll').prop('checked', false);
                            getList();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            $('.checkAll').prop('checked', false);
                            getList();
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin List Bulk Actions With Filter //

// Start :: Admin Gallery Actions //
function galleryAction(routePrefix, actionRoute, id, albumId, rowId, actionType, selectedDefaultImage) {
    var message = actionUrl = '';

    if (actionRoute != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+actionRoute;
    }

    if (actionType == 'set-default') {
        message = confirmDefaultMessage;
    } else if (actionType == 'delete-image') {
        message = confirmDeleteMessage;
    } else {
        message = somethingWrongMessage;
    }
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        id: id,
                        albumId: albumId,
                        actionType: actionType
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            if (actionType == 'delete-image') {
                                $('#image_'+rowId).remove();
                                toastr.success(response.message, response.title+'!');
                            } else if (actionType == 'set-default') {
                                $('.delete_block_'+rowId).remove();
                                window.location.reload();
                            }                            
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            } else {
                window.location.reload();
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Admin Gallery Actions //

// Start :: Admin Delete uploaded image //
$(document).on('click', '.delete-uploaded-preview-image', function() {
    var primaryId   = $(this).data('primaryid');
    var imageId     = $(this).data('imageid');
    var dbField     = $(this).data('dbfield');
    var routePrefix = $(this).data('routeprefix');
    var message = actionUrl = '';

    if (primaryId != '' && routePrefix != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+'delete-uploaded-image';
    }

    message = confirmDeleteMessage;
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        primaryId: primaryId,
                        dbField: dbField,
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            $('.preview_img_div_'+dbField).html('');
                            $('.preview_img_div_'+dbField).html('<img id="'+dbField+'_preview" class="mt-2" style="display: none;" />');
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
});
// Start :: Admin Delete upladed image //

// Start :: Delete uploaded cropped image //
$(document).on('click', '.delete-uploaded-cropped-image', function() {
    var primaryId       = $(this).data('primaryid');
    var dbField         = $(this).data('dbfield');
    var imgContainer    = $(this).data('img-container');
    var routePrefix     = $(this).data('routeprefix');
    var message = actionUrl = '';

    if (primaryId != '' && routePrefix != '') {
        actionUrl = adminPanelUrl+'/'+routePrefix+'/'+'delete-uploaded-image';
    }
    
    message = confirmDeleteMessage;
    
    if (actionUrl != '') {
        swal.fire({
            text: message,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        primaryId: primaryId,
                        dbField: dbField,
                    },
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
                            $('#preview-crop-image').html('');
                            $('#preview-crop-image').removeAttr('style');
                            $('#preview-crop-image').attr('style', 'height:'+imgContainer+'px; padding: 42px 2px 20px 2px; position: relative;');
                            if (dbField == 'profile_pic') {
                                $('#profile-pic-holder').html('<img id="admin-avatar" src="'+adminImageUrl+'/users/avatar5.png" class="rounded-circle" width="40" />');
                            }
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
});
// End :: Delete upladed cropped image //

// Start :: Slug generation on key up event //
$('.slug-generation').focusout(function () {
    var modelName   = $(this).data('model');
    var getTitle    = $(this).val();    
    var id          = '';
    if ($('#id').length) {
        var id = $('#id').val();
    }
    generateSlug(modelName, getTitle, id);
});
function generateSlug(modelName, title, id) {
    if (title.length > 3) {
        var actionUrl = adminPanelUrl+'/'+'generate-slug';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: actionUrl,
            method: 'POST',
            data: {
                modelName: modelName,
                title: title,
                id: id
            },
            success: function (response) {
                if (response.type === 'success') {
                    $('#slug').val(response.slug);
                } else {
                    $('#slug').val('');
                }
            }
        });
    } else {
        $('#slug').val('');
    }
}
// End :: Slug generation on key up event //

function sweetalertMessageRender(target, message, type, confirm = false) {
    let options = {
        icon: type,
        title: 'warning!',
        text: message,
        
    };
    if (confirm) {
        options['showCancelButton'] = true;
        options['confirmButtonText'] = 'Yes';
    }

    return Swal.fire(options)
    .then((result) => {
        if (confirm == true && result.value) {
            window.location.href = target.getAttribute('data-href'); 
        } else {
            return (false);
        }
    });
}

// Click to copy
$(document).on('click', '.clickToCopy', function(e) {
    e.preventDefault();
    var type        = $(this).data('type');
    var copyText    = $(this).data('values');

    document.addEventListener('copy', function(e) {
        e.clipboardData.setData('text/plain', copyText);
        e.preventDefault();
    }, true);
  
    document.execCommand('copy');

    $(".copied").html('<div id="toast-container" class="toast-top-right"><div class="toast toast-success" aria-live="assertive" style=""><button class="toast-close-button" role="button"><i class="fa fa-times" aria-hidden="true"></i></button><div class="toast-message">'+copiedToClipBoard+'</div></div></div>').show().fadeOut(2000);

    if (type == 'credential') {
        $('#credential').focus();
    } else {
        $('#password').focus();
    }
});

// Start :: Remove Invoice Product //
function removeInvoiceProduct(divId, type) {
    if (divId != '') {
        if (type != 'new') {
            confirmDeleteMessage = 'Are you sure, you want to delete saved data?';
        }
        swal.fire({
            text: confirmDeleteMessage,
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                if (type == 'new') {
                    $('#append_div_'+divId).remove();
                } else {
                    var actionUrl = adminPanelUrl + '/singleStepOrder/ajax-delete-invoice-detail';

                    $('.preloader').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: actionUrl,
                        method: 'GET',
                        data: {
                            'id': divId,
                            'type': type
                        },
                        success: function (response) {
                            $('.preloader').hide();
                            if (response.type == 'success') {
                                if (response.allDeleted == 1) {
                                    window.location.href = adminPanelUrl + '/singleStepOrder';
                                    $('.preloader').hide();
                                } else {
                                    $('#section_id_'+divId).remove();
                                    calculateTotalQuantityAndAmount();
                                    $('.preloader').hide();
                                }
                            } else if (response.type == 'warning') {
                                $('.preloader').hide();
                                toastr.warning(response.message, response.title+'!');
                            } else {
                                $('.preloader').hide();
                                toastr.error(response.message, response.title+'!');
                            }
                        }
                    });
                }

                calculateTotalQuantityAndAmount();
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Remove Invoice Product //

// Start :: Delete Invoice //
function deleteInvoice(id, type) {
    if (id != '') {
        swal.fire({
            text: 'Are you sure, you want to delete saved data?',
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: btnConfirmYesColor,
            cancelButtonColor: btnCancelNoColor,
            showCancelButton: true,
            confirmButtonText: btnYes,
            cancelButtonText: btnNo,
        }).then((result) => {
            if (result.value) {
                var actionUrl = adminPanelUrl + '/singleStepOrder/ajax-delete-invoice';

                $('.preloader').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: actionUrl,
                    method: 'GET',
                    data: {
                        'id': id,
                        'type': type
                    },
                    success: function (response) {
                        if (response.type == 'success') {
                            window.location.href = adminPanelUrl + '/singleStepOrder';
                            $('.preloader').hide();
                        } else if (response.type == 'warning') {
                            $('.preloader').hide();
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            $('.preloader').hide();
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
                
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Delete Invoice //

// Start :: Update invoice //
function updateInvoice(invoiceDetailId, itemId, categoryId, productId, qty, unitPrice, discountPercent, discountAmount, totalPrice, status) {
    if (invoiceDetailId != '') {
        var actionUrl = adminPanelUrl + '/singleStepOrder/ajax-update-invoice';

        $('.preloader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: actionUrl,
            method: 'GET',
            data: {
                'invoiceDetailId': invoiceDetailId,
                'categoryId': categoryId,
                'productId': productId,
                'qty': qty,
                'unitPrice': unitPrice,
                'discountPercent': discountPercent,
                'discountAmount': discountAmount,
                'totalPrice': totalPrice,
                'status': status
            },
            success: function (response) {
                $('.preloader').hide();
                if (response.type == 'success') {
                    toastr.success(response.message, response.title+'!');
                } else if (response.type == 'warning') {
                    toastr.warning(response.message, response.title+'!');
                } else {
                    toastr.error(response.message, response.title+'!');
                }
            }
        });
    } else {
        toastr.error(message, errorMessage+'!');
    }
}
// End :: Update invoice //