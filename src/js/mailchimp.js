/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, WP */

class Mailchimp {
  constructor() {
    this.mobileThreshold = 601;

    // Bind functions
    this.onReady = this.onReady.bind(this);
    this.submitForm = this.submitForm.bind(this);
    this.successMessage = this.successMessage.bind(this);

    $(window).on('ajaxSuccess', this.onReady); // Bind ajaxSuccess (custom event, comes from Ajaxy)

    $(document).ready(this.onReady);
  }

  onReady() {
    if (WP.mailchimp === null) {
      $('.mailchimp-form').remove();
      console.error('mailchimp action null');
    } else if ($('.mailchimp-form').length && WP.mailchimp !== null) {
      // Bind form submit event
      $('.mailchimp-form').submit(this.submitForm);
    }
  }

  submitForm(e) {
    this.$form = $(e.currentTarget);
    this.$email = this.$form.find('.mailchimp-email');
    this.$reply = this.$form.find('.mailchimp-response');

    let data = {};

    // Get form data
    const dataArray = this.$form.serializeArray();

    // Create data object from form data
    $.each(dataArray, function (index, item) {
      data[item.name] = item.value;
    });

    this.handleMailchimpAjax(data, this.successMessage);

    // Prevent default submit functionality
    return false;
  }

  handleMailchimpAjax(data, successCallback) {
    // Rewrite action URL for JSONP
    const url = WP.mailchimp.replace('/post?', '/post-json?').concat('&c=?');

    // Ajax post to Mailchimp API
    $.ajax({
      url: url,
      data: data,
      success: successCallback,
      dataType: 'jsonp',
      error: function (resp, text) {
        console.log('mailchimp ajax submit error: ' + text);
      }
    });
  }

  /**
  * Handle response message
  */
  successMessage(response) {
    let msg = '';
    let successMsg = 'You\'ve been successfully subscribed';

    if (response.result === 'success') {

      // Success message
      msg = successMsg;

      // Set class .valid on form elements
      this.$reply.removeClass('error').addClass('valid');
      this.$email.removeClass('error').addClass('valid');

      this.$email.val('').blur();

    } else {
      // Set class .error on form elements
      this.$email.removeClass('valid').addClass('error');
      this.$reply.removeClass('valid').addClass('error');

      // Make error message from API response
      let index = -1;

      try {
        let parts = response.msg.split(' - ', 2);

        if (parts[1] === undefined) {
          msg = response.msg;
        } else {
          let i = parseInt(parts[0], 10);

          if (i.toString() === parts[0]) {
            index = parts[0];
            msg = parts[1];
          } else {
            index = -1;
            msg = response.msg;
          }
        }
      }
      catch (e) {
        index = -1;
        msg = response.msg;
      }

      if (msg === 'An email address must contain a single @') {
        msg = 'Your email is missing the @';
      } else if (msg === 'The domain portion of the email address is invalid (the portion after the @: )') {
        msg = 'Your email\'s domain doesn\'t look right';
      } else if (msg === 'This email cannot be added to this list. Please enter a different email address.') {
        msg = 'Please use a different email';
      }
    }

    if (this.alreadySubscribed(response.msg)) {

      msg = successMsg;

      // Set class .valid on form elements
      this.$reply.removeClass('error').addClass('valid');
      this.$email.removeClass('error').addClass('valid');

      this.$email.val('').blur();
    }

    // Show message
    this.$reply.html(msg);
  }

  alreadySubscribed(msg) {
    let substring = "already subscribed";
    return msg.indexOf(substring) !== -1;
  }
}

export default Mailchimp;
