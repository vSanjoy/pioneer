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
    var selectedUserIds = [];

    // Get regions
    var registrationCity = $('.registrationCity').val();
    if (registrationCity) {
        getRegions(registrationCity);
    }

    /* Account Registration Form */
    $("#leagueRegistrationForm").validate({
        ignore: [],
        rules: {
            city_id: {
                required: true,
            },
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            // phone_no: {
            //     required: true,
            // },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
            gender: {
                required: true,
            },
            day: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
            player_rating: {
                required: true,
            },
            // preferred_level: {
            //     required: true,
            // },
            playing_region: {
                required: true,
            },
            preferred_home_court: {
                required: true,
            },
            // how_did_you_find_us: {
            //     required: true
            // },
            agree: {
                required: true
            },
            // waiver: {
            //     required: true
            // },
        },
        messages: {
            city_id: {
                required: "Please select city.",
            },
            first_name: {
                required: "Please enter first name.",
            },
            last_name: {
                required: "Please enter last name.",
            },
            email: {
                required: "Please enter email.",
            },
            // phone_no: {
            //     required: "Please enter phone.",
            // },
            password: {
                required: "Please enter password.",
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should be same as create password.",
            },
            gender: {
                required: "Please select gender.",
            },
            day: {
                required: "Please select day.",
            },
            month: {
                required: "Please select month.",
            },
            year: {
                required: "Please select year.",
            },
            player_rating: {
                required: "Please select player rating.",
            },
            // preferred_level: {
            //     required: "Please select league division.",
            // },
            playing_region: {
                required: "Please select playing region.",
            },
            preferred_home_court: {
                required: "Please select preferred home court.",
            },
            // how_did_you_find_us: {
            //     required: "Please enter how did you find us.",
            // },
            agree: {
                required: "Please accept our Terms of Use.",
            },
            // waiver: {
            //     required: "Please read and signed the Waiver.",
            // },
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'agree') {
                error.insertAfter($(element).parents('div#leagueAgree'));
            }
            // else if ($(element).attr('id') == 'waiver') {
            //     error.insertAfter($(element).parents('div#accountWaiver'));
            // }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var firstName   = $('#first_name').val();
            var lastName    = $('#last_name').val();
            var email       = $('#email').val();
            var gender      = 'Male';
            if ($('#gender').val() == 'F') {
                var gender  = 'Female';
            }
            var birthDate = $('#month').val() + '/' + $('#day').val() + '/' + $('#year').val();

            var registrationSubmitUrl = websiteLink + '/ajax-registration-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: registrationSubmitUrl,
                method: 'POST',
                data: $('#leagueRegistrationForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('#leagueRegistrationForm')[0].reset();
                        // window.location.href = websiteLink + '/thank-you/' + response.loginId;

                        // Start :: Waiver Sign In
                        var waiverRequest = new XMLHttpRequest();
                        waiverRequest.open('POST', 'https://app.waiversign.com/ws/api/session/session');
                        waiverRequest.setRequestHeader('Content-Type', 'application/json');
                        waiverRequest.onreadystatechange = function () {
                            if (this.readyState === 4) {
                                // console.log('Status:', this.status);
                                // console.log('Headers:', this.getAllResponseHeaders());
                                // console.log('Body:', this.responseText);

                                var waiverResult = JSON.parse(this.responseText);
                                window.location.href = waiverResult.payload.url;
                            }
                        };

                        var requestBody = {
                        'documentIdList': [
                            '621ea1abf965ee0018494c24'
                        ],
                        'personInfoList': [
                            {
                                'isAdult': true,
                                'firstName': firstName,
                                'lastName': lastName,
                                'gender': gender,
                                'birthDate': birthDate,
                                'email': email,
                            },
                        ],
                        'referenceId': '19540',
                        'returnUrl': websiteLink + '/registration-call-back/' + response.loginId,
                        // 'callbackUrl': '',
                        'expiresAt': '2099-12-31'
                        };
                        waiverRequest.send(JSON.stringify(requestBody));
                        // End :: Waiver Sign In

                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage+'!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, response.title+'!');
                    }
                }
            });
        }
    });

    /* League Registration Form */
    $("#leagueForm").validate({
        ignore: [],
        rules: {
            selected_league: {
                required: true
            },            
        },
        messages: {
            selected_league: {
                required: "Please select league(s).",
            },
        },
        errorPlacement: function(error, element) {
            if ($(element).attr('id') == 'agree') {
                error.insertAfter($(element).parents('div#leagueAgree'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('.preloader').show();
            form.submit();
        }
    });

    /* Partner Program Registration Form */
    // $("#partnerProgramRegistrationForm").validate({
    //     ignore: [],
    //     rules: {
    //         city_id: {
    //             required: true,
    //         },
    //         first_name: {
    //             required: true,
    //         },
    //         last_name: {
    //             required: true,
    //         },
    //         email: {
    //             required: true,
    //             valid_email: true
    //         },
    //         phone_no: {
    //             required: true,
    //         },
    //         password: {
    //             required: true,
    //             valid_password: true,
    //         },
    //         confirm_password: {
    //             required: true,
    //             valid_password: true,
    //             equalTo: "#pp_password"
    //         },
    //         gender: {
    //             required: true,
    //         },
    //         preferred_level: {
    //             required: true,
    //         },
    //         preferred_home_court: {
    //             required: true,
    //         },
    //         playing_region: {
    //             required: true,
    //         },
    //         how_did_you_find_us: {
    //             required: true
    //         },
    //         agree: {
    //             required: true
    //         },            
    //     },
    //     messages: {
    //         city_id: {
    //             required: "Please select city.",
    //         },
    //         first_name: {
    //             required: "Please enter first name.",
    //         },
    //         last_name: {
    //             required: "Please enter last name.",
    //         },
    //         email: {
    //             required: "Please enter email.",
    //         },
    //         phone_no: {
    //             required: "Please enter phone.",
    //         },
    //         password: {
    //             required: "Please enter password.",
    //             valid_password: "Minimum 8 characters."
    //         },
    //         confirm_password: {
    //             required: "Please enter confirm password.",
    //             valid_password: "Minimum 8 characters.",
    //             equalTo: "Password should be same as create password.",
    //         },
    //         gender: {
    //             required: "Please select gender.",
    //         },
    //         preferred_level: {
    //             required: "Please select league division.",
    //         },
    //         preferred_home_court: {
    //             required: "Please select preferred home court.",
    //         },
    //         playing_region: {
    //             required: "Please select playing region.",
    //         },
    //         how_did_you_find_us: {
    //             required: "Please enter how did you find us.",
    //         },
    //         agree: {
    //             required: "Please select terms of service.",
    //         },
    //     },
    //     errorPlacement: function(error, element) {
    //         if ($(element).attr('id') == 'pp_agree') {
    //             error.insertAfter($(element).parents('div#ppAgree'));
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     },
    //     submitHandler: function(form) {
    //         // var response = grecaptcha.getResponse();
    //         // if (response.length == 0) {     // recaptcha failed validation
    //         //     $('#recaptcha-error').html('Please verify that you are human');
    //         //     $('#recaptcha-error').show();
    //         //   return false;
    //         // } else {    //recaptcha passed validation
    //         //     $('#recaptcha-error').html('');
    //         //     $('#recaptcha-error').hide();
    //         //     form.submit();
    //         // }
            
    //         $('.preloader').show();
    //         var registrationSubmitUrl = websiteLink + '/ajax-registration-submit';
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: registrationSubmitUrl,
    //             method: 'POST',
    //             data: $('#partnerProgramRegistrationForm').serialize(),
    //             dataType: 'json',
    //             success: function (response) {
    //                 $('.preloader').hide();
    //                 if (response.type == 'success') {
    //                     $('#partnerProgramRegistrationForm')[0].reset();
    //                     toastr.success(response.message, response.title+'!');
    //                     setTimeout(function() {
    //                         // window.location.href = websiteLink + '/city/' + response.citySlug;
    //                         window.location.href = websiteLink + '/users/edit-profile';
    //                     }, 3000);
    //                 } else if (response.type == 'validation') {
    //                     toastr.error(response.message, errorMessage+'!');
    //                 } else {
    //                     toastr.error(response.message, response.title+'!');
    //                 }
    //             }
    //         });
    //     }
    // });

    /* User Login Form */
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter password.",
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var loginSubmitUrl = websiteLink + '/ajax-login-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: loginSubmitUrl,
                method: 'POST',
                data: $('#loginForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('#loginForm')[0].reset();
                        $('#loginModal').modal('toggle');

                        if (response.redirectTo == '') {
                            window.location.href = websiteLink + '/users/profile';
                        } else {
                            window.location.href = websiteLink + '/users/join-a-league';
                        }
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage+'!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage+'!');
                    }
                }
            });
        }
    });

    /* Edit Profile Form */
    $("#editProfileForm").validate({
        ignore: [],
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            // phone_no: {
            //     required: true,
            // },
            // preferred_level: {
            //     required: true,
            // },
            preferred_home_court: {
                required: true,
            },
            playing_region: {
                required: true,
            },
            day: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter first name.",
            },
            last_name: {
                required: "Please enter last name.",
            },
            email: {
                required: "Please enter email.",
            },
            // phone_no: {
            //     required: "Please enter phone number.",
            // },
            // preferred_level: {
            //     required: "Please select league division.",
            // },
            preferred_home_court: {
                required: "Please select preferred home court.",
            },
            playing_region: {
                required: "Please select playing region.",
            },
            day: {
                required: "Please select day.",
            },
            month: {
                required: "Please select month.",
            },
            year: {
                required: "Please select year.",
            },
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    /* Forgot Password Form */
    $("#forgotPasswordForm").validate({
        rules: {
            email: {
                required: true,
                valid_email: true,
            },
        },
        messages: {
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email."
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var forgotPasswordSubmitUrl = websiteLink + '/ajax-forgot-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: forgotPasswordSubmitUrl,
                method: 'POST',
                // data: {
                //     email: $('#email').val(),
                // },
                data: $('#forgotPasswordForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    ajax_check = false;
                    if (response.type == 'success') {
                        $('#forgotPasswordForm')[0].reset();
                        toastr.success(response.message, successMessage+'!');

                        $('#forgotPasswordModal').modal('hide');
                        $('#loginModal').modal('hide');
                        $('#resetPasswordModal').modal('show');
                    } else if (response.type == 'validation') {
                        toastr.error(response.message, errorMessage+'!');
                    } else {
                        toastr.error(response.message, errorMessage+'!');
                    }
                }
            });
        }
    });

    /* Reset Password Form */
    $("#resetPasswordForm").validate({
        rules: {
            otp: {
                required: true,
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#reset_password"
            }
        },
        messages: {
            otp: {
                required: "Please enter OTP.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should match in both fields.",
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var changePasswordSubmitUrl = websiteLink + '/ajax-reset-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: changePasswordSubmitUrl,
                method: 'POST',
                /*data: {
                    otp: $('#otp').val(),
                    password: $('#reset_password').val(),
                    confirm_password: $('#confirm_password').val(),
                },*/
                data: $('#resetPasswordForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    if (response.type == 'success') {
                        $('#resetPasswordForm')[0].reset();
                        toastr.success(response.message, successMessage+'!');

                        $('#forgotPasswordModal').modal('hide');
                        $('#loginModal').modal('show');
                        $('#resetPasswordModal').modal('hide');
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage+'!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage+'!');
                    }
                }
            });
        }
    });

    /* Change Password Form */
    $("#changePasswordForm").validate({
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
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should match in both fields.",
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var changePasswordSubmitUrl = websiteLink + '/users/ajax-change-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: changePasswordSubmitUrl,
                method: 'POST',
                data: {
                    current_password: $('#current_password').val(),
                    password: $('#password').val(),
                    confirm_password: $('#confirm_password').val(),
                },
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    ajax_check = false;
                    if (response.type == 'success') {
                        $('#changePasswordForm')[0].reset();
                        toastr.success(response.message, successMessage+'!');
                        setTimeout(function() {
                            window.location.href = websiteLink + '/users/profile';
                        }, 2000);
                    } else if (response.type == 'validation') {
                        toastr.error(response.message, errorMessage+'!');
                    } else {
                        toastr.error(response.message, errorMessage+'!');
                    }
                }
            });
        }
    });

    // Contact form
    $("#contactForm").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true,
            },
            message: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter name.",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            message: {
                required: "Please enter message.",
            }
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var contactSubmitUrl = websiteLink + '/ajax-contact-submit';
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: contactSubmitUrl,
                method: 'POST',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    message: $('#message').val(),
                },
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    if (response.type == 'success') {
                        $('#contactForm')[0].reset();
                        toastr.success(formSuccessMessage, thankYouMessage+'!');
                    } else {
                        toastr.error(somethingWrongMessage, errorMessage+'!');
                    }
                }
            });
        }
    });

    // Send league message form
    $("#leagueMessageForm").validate({
        rules: {
            // message: {
            //     required: true,
            // }
        },
        messages: {
            // message: {
            //     required: "Please enter message.",
            // }
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            var currentCity = $('#current_city').val();
            if (selectedUserIds.length == 0) {
                // toastr.error('You must select at least one player below.', 'Error!');
                $('#player-selection-error-message').html('<span style="color: #ff0000;"><i>You must select at least one player below.</i></span>');
            } else {
                $('#player-selection-error-message').html('');
                $('.preloader').show();
                var cityLeagueMessageSubmitUrl = websiteLink + '/city/' + currentCity + '/ajax-city-league-message-submit';
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: cityLeagueMessageSubmitUrl,
                    method: 'POST',
                    data: {
                        league_id: $('#league_id').val(),
                        is_doubles: $('#is_doubles').val(),
                        // message: $('#message').val(),
                        selected_user_ids: selectedUserIds
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);

                        $('.preloader').hide();
                        if (response.type == 'success') {
                            $('#leagueMessageForm')[0].reset();
                            selectedUserIds = [];
                            $('.selectDeselectAll, .individualCheckboxes').prop('checked', false);

                            var toEmail     = response.emailIds;
                            var subject     = response.messageDetails.subject;
                            var emailBody = response.messageDetails.emailBody.replace(/<br\s*\/?>/mg,"%0D%0A");
                            
                            document.location = "mailto:"+toEmail+"?subject="+subject+"&body="+emailBody;

                            // toastr.success(formSuccessMessage, thankYouMessage+'!');
                        } else {
                            toastr.error(somethingWrongMessage, errorMessage+'!');
                        }
                    }
                });
            }
        }
    });

    /* Submit Score Form */
    $("#submitScoreForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            day: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
            preferred_home_court: {
                required: true,
            },
            matchFormat: {
                required: true,
            },
            loser_id: {
                required: true,
            },
            loser_team_id: {
                required: true,
            },
            game_1_winner_score: {
                required: true,
            },
            game_1_loser_score: {
                required: true,
            },
            game_2_winner_score: {
                required: true,
            },
            game_2_loser_score: {
                required: true,
            },
            game1winnerscore: {
                required: true,
            },
            game1loserscore: {
                required: true,
            },
        },
        messages: {
            day: {
                required: "Please select day.",
            },
            month: {
                required: "Please select month.",
            },
            year: {
                required: "Please select year.",
            },
            preferred_home_court: {
                required: "Please select preferred home court.",
            },
            matchFormat: {
                required: "Please select match format."
            },
            loser_id: {
                required: "Please select opponent.",
            },
            loser_team_id: {
                required: "Please select opponent.",
            },
            game_1_winner_score: {
                required: "Please select game 1 winner score.",
            },
            game_1_loser_score: {
                required: "Please select game 1 opponent score.",
            },
            game_2_winner_score: {
                required: "Please select game 2 winner score.",
            },
            game_2_loser_score: {
                required: "Please select game 2 opponent score.",
            },
            game1winnerscore: {
                required: "Please select game 1 winner score.",
            },
            game1loserscore: {
                required: "Please select game 1 opponent score.",
            },
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            $('.preloader').show();
            var currentCity         = $('#current_city').val();
            var playerAssignmentId  = $('#player_assignment_id').val();
            var cityLeagueMessageSubmitUrl = websiteLink + '/city/' + currentCity + '/ajax-city-league-submit-score';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: cityLeagueMessageSubmitUrl,
                method: 'POST',
                data: $('#submitScoreForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    if (response.type == 'success') {
                        // $('.preloader').hide();
                        $('#submitScoreForm')[0].reset();
                        // toastr.success(response.message, response.title+'!');

                        setTimeout(function() {
                            window.location.href = websiteLink + '/city/' + currentCity + '/league/submit-score/thank-you/' + playerAssignmentId;
                        }, 2000);
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, response.title+'!');
                    }
                }
            });
        }
    });


    // Home page to city page functionality
    $(document).on('click', '.cityCLick', function(){
		var state = $(this).data('state');
        var city = $(this).data('city');
		
        if (state != '' && city != '') {
            $('.preloader').show();
            var changePasswordSubmitUrl = websiteLink + '/ajax-redirection-to-city-page';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: changePasswordSubmitUrl,
                method: 'POST',
                data: {
                    state_id: state,
                    city_id: city,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        if (response.redirectTo == 'city') {
                            // window.location.href = websiteLink + '/city/' + response.redirectCitySlug;
                            window.location.href = websiteLink + '/users/profile';
                        } else {
                            window.location.href = websiteLink + '/registration';
                        }
                    } else {
                        toastr.error(response.message, errorMessage+'!');
                    }
                }
            });
        }
	});
    
    // Select city in registration page
    $(document).on('click', '.citySelect', function() {
		var state   = $(this).data('state');
        var city    = $(this).data('city');
        var cityName= $(this).data('cityname');

        if (state != '' && city != '' && cityName != '') {
            $('#selectedCity').text(cityName);
            $(".a11yAccordion").slideToggle();
            $('#city_id').val(city);
            $('#city_id-error').hide();

            $('#playing_region').html('<option value="">Playing Region*</option>');
            $('#preferred_home_court').html('<option value="">Preferred Home Court*</option>');

            // Getting regions
            getRegions(city);
        } else {
            $('#playing_region').html('<option value="">Playing Region*</option>');
            $('#preferred_home_court').html('<option value="">Preferred Home Court*</option>');
        }
	});

    // Get preferred home court in registration
    $('#playing_region').on('change', function() {
        var city    = $('#city_id').val();
        var region  = $('#playing_region').val();

        if (city != '' && region != '') {
            $('.preloader').show();
            var regionWisePreferredHomeCourtUrl = $('#website_link').val() + '/ajax-region-wise-preferred-home-court-and-league';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: regionWisePreferredHomeCourtUrl,
                method: 'POST',
                data: {
                    city_id: city,
                    region_id: region,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('.preloader').hide();
                        $('#preferred_home_court').html(response.options);

                        // Select your league
                        $('#select-league').show(500);
                        $('#league-checkboxes').html(response.leagues);
                    } else {
                        $('#preferred_home_court').html('<option value="">Preferred Home Court*</option>');

                        $('#select-league').hide(500);
                        $('#league-checkboxes').html('');
                    }
                }
            });
        } else {
            $('#preferred_home_court').html('<option value="">Preferred Home Court*</option>');

            $('#select-league').hide(500);
            $('#league-checkboxes').html('');
        }
    });
    
    // Select city in registration page (Partner Program)
    $(document).on('click', '.citySelectPartnerProgram', function() {
		var state   = $(this).data('state');
        var city    = $(this).data('city');
        var cityName= $(this).data('cityname');
		
        if (state != '' && city != '' && cityName != '') {
            $('#selectedCityPartnerProgram').text(cityName);
            $(".a11yAccordionPartnerProgram").slideToggle();
            $('#city_id_partner_program').val(city);
            $('#city_id_partner_program-error').hide();
        } else {
            $('#city_id_partner_program').val('');
        }
	});

    // Hide Login modal, open forgot password modal
    $(document).on('click', '#openForgotPasswordModal', function() {
        $('#loginModal').modal('hide');
        $('#resetPasswordModal').modal('hide');
        $('#forgotPasswordModal').modal('show');
    });
    
    // Hide forgot password modal, open login modal
    $(document).on('click', '#openLoginModal', function() {
        $('#forgotPasswordModal').modal('hide');
        $('#resetPasswordModal').modal('hide');
        $('#loginModal').modal('show');
    });


    // Start :: Select / Deselect all in city league page
    var totalCheckboxCount = $('input[type=checkbox]').length;
    totalCheckboxCount = totalCheckboxCount - 1;
	$('.selectDeselectAll').click(function() {
		if ($(this).is(':checked')) {
			$('.individualCheckboxes').prop('checked', true);
            // set user ids
            $('.individualCheckboxes').each(function () {
                selectedUserIds.push($(this).val());
            });
		} else {
			$('.individualCheckboxes').prop('checked', false);
            selectedUserIds = [];
		}
	});
    $('.individualCheckboxes').click(function() {
		if ($(this).prop('checked') == true) {
            selectedUserIds.push($(this).val());

			// If total checkbox (except top checkbox) == all checked checkbox then "Check" the Top checkbox
			var totalCheckedCheckbox = $('input[type=checkbox]:checked').length;
			if (totalCheckedCheckbox == totalCheckboxCount) {
				$('.selectDeselectAll').prop('checked', true);
			}
		} else {
            const index = selectedUserIds.indexOf($(this).val());
            if (index > -1) {
                selectedUserIds.splice(index, 1);   // 2nd parameter means remove one item only
            }
			// select/deselect checkbox un-check
			$('.selectDeselectAll').prop('checked', false);
		}
	});
    // End :: Select / Deselect all in city league page

    // Date of birth in edit profile
    $('#dob').datepicker({
        format: 'mm-dd-yyyy',
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
        endDate: '-18Y',
    });
    $('#dob').bind('keypress', function(e) {
        e.preventDefault(); 
    });

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

// Get Regions
function getRegions(city) {
    if (city != '') {
        $('.preloader').show();
        var cityWiseRegionUrl = $('#website_link').val() + '/ajax-city-wise-region';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: cityWiseRegionUrl,
            method: 'POST',
            data: {
                city_id: city,
            },
            dataType: 'json',
            success: function (response) {
                if (response.type == 'success') {
                    $('.preloader').hide();
                    $('#playing_region').html(response.options);
                } else {
                    $('#playing_region').html('<option value="">Playing Region*</option>');
                    $('#preferred_home_court').html('<option value="">Preferred Home Court*</option>');
                }
            }
        });
    }
}
