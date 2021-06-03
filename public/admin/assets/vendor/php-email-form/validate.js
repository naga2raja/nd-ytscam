/**
 * PHP Email Form Validation - v2.3
 * URL: https://bootstrapmade.com/php-email-form/
 * Author: BootstrapMade.com
 */
!(function($) {
    "use strict";

    $('form.php-email-form').submit(function(e) {
        e.preventDefault();

        var f = $(this).find('.form-group'),
            ferror = false,
            emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

        f.children('input').each(function() { // run all inputs

            var i = $(this); // current input
            var rule = i.attr('data-rule');

            if (rule !== undefined) {
                var ierror = false; // error flag for current input
                var pos = rule.indexOf(':', 0);
                if (pos >= 0) {
                    var exp = rule.substr(pos + 1, rule.length);
                    rule = rule.substr(0, pos);
                } else {
                    rule = rule.substr(pos + 1, rule.length);
                }

                switch (rule) {
                    case 'required':
                        if (i.val() === '') {
                            ferror = ierror = true;
                        }
                        break;

                    case 'minlen':
                        if (i.val().length < parseInt(exp)) {
                            ferror = ierror = true;
                        }
                        break;

                    case 'email':
                        if (!emailExp.test(i.val())) {
                            ferror = ierror = true;
                        }
                        break;

                    case 'checked':
                        if (!i.is(':checked')) {
                            ferror = ierror = true;
                        }
                        break;

                    case 'regexp':
                        exp = new RegExp(exp);
                        if (!exp.test(i.val())) {
                            ferror = ierror = true;
                        }
                        break;
                }
                i.next('.validate').html((ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
            }
        });
        f.children('textarea').each(function() { // run all inputs

            var i = $(this); // current input
            var rule = i.attr('data-rule');

            if (rule !== undefined) {
                var ierror = false; // error flag for current input
                var pos = rule.indexOf(':', 0);
                if (pos >= 0) {
                    var exp = rule.substr(pos + 1, rule.length);
                    rule = rule.substr(0, pos);
                } else {
                    rule = rule.substr(pos + 1, rule.length);
                }

                switch (rule) {
                    case 'required':
                        if (i.val() === '') {
                            ferror = ierror = true;
                        }
                        break;

                    case 'minlen':
                        if (i.val().length < parseInt(exp)) {
                            ferror = ierror = true;
                        }
                        break;
                }
                i.next('.validate').html((ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
            }
        });
        if (ferror) return false;

        var this_form = $(this);
        var action = $(this).attr('action');

        if (!action) {
            this_form.find('.loading').slideUp();
            this_form.find('.error-message').slideDown().html('The form action property is not set!');
            return false;
        }

        this_form.find('.sent-message').slideUp();
        this_form.find('.error-message').slideUp();
        this_form.find('.loading').slideDown();

        if ($(this).data('recaptcha-site-key')) {
            var recaptcha_site_key = $(this).data('recaptcha-site-key');
            grecaptcha.ready(function() {
                grecaptcha.execute(recaptcha_site_key, { action: 'php_email_form_submit' }).then(function(token) {
                    php_email_form_submit(this_form, action, this_form.serialize() + '&recaptcha-response=' + token);
                });
            });
        } else {
            php_email_form_submit(this_form, action, this_form.serialize());
        }

        return true;
    });

    function php_email_form_submit(this_form, action, data) {

        $.ajax({
            type: "POST",
            url: action,
            data: data,
            timeout: 40000
        }).done(function(msg) {
            if (msg.trim() == 'OK') {
                this_form.find('.loading').slideUp();
                this_form.find('.sent-message').slideDown();

                var recipient_name = this_form.find('input[id=recipient_name]').val();
                var token_value = this_form.find('input[name=_token]').val();
                console.log(recipient_name, 'recipient_name');
                this_form.find("input:not(input[type=submit]), input:not(input[id=recipient_name]), textarea").val('');
                //alert('Your message has been sent successfully. we will contact you soon. Thank You!');
                // location.reload();
                this_form.find('input[id=recipient_name]').val(recipient_name);
                this_form.find('input[name=_token]').val(token_value);
            } else {
                this_form.find('.loading').slideUp();
                if (!msg) {
                    msg = 'Form submission failed and no error message returned from: ' + action + '<br>';
                }
                this_form.find('.error-message').slideDown().html(msg);
            }
        }).fail(function(data) {
            console.log(data);
            var error_msg = ''; //"Form submission failed!<br>";
            if (data.statusText || data.status) {
                //error_msg += 'Status:';
                // if (data.statusText) {
                //     error_msg += ' ' + data.statusText;
                // }
                // if (data.status) {
                //     error_msg += ' ' + data.status;
                // }
                // error_msg += '<br>';
            }
            if (data.responseJSON && data.responseJSON.errors) {
                var allErrors = data.responseJSON.errors;
                if (allErrors.email) {
                    error_msg += data.responseJSON.errors.email + '<br>';
                }
                if (allErrors.name) {
                    error_msg += data.responseJSON.errors.name + '<br>';
                }
                if (allErrors.subject) {
                    error_msg += data.responseJSON.errors.subject + '<br>';
                }
                if (allErrors.message) {
                    error_msg += data.responseJSON.errors.message;
                }

            }
            this_form.find('.loading').slideUp();
            this_form.find('.error-message').slideDown().html(error_msg);
        });
    }

})(jQuery);