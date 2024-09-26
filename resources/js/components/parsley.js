import $ from 'jquery';
import 'parsleyjs';

// Extend Parsley's default options
$.extend(window.Parsley.options, {
  focus: "first",
  excluded: "input[type=button], input[type=submit], input[type=reset], .search, .ignore",
  triggerAfterFailure: "change blur",
  successClass: "is-valid",
  errorClass: "is-invalid",
  classHandler: function (el) {
    return el.$element.closest(".form-group");
  },
  errorsContainer: function (el) {
    return el.$element.closest(".form-group");
  },
  errorsWrapper: '<div class="parsley-error"></div>',
  errorTemplate: "<span></span>"
});

// Custom email validation message (optional)
window.Parsley.addMessages('en', {
  type: {
    email: 'Format email tidak valid.'
  }
});

// Custom validation handling for Parsley
window.Parsley.addValidator('passwordMatch', {
  validateString: function (value, requirement, instance) {
    var password = $(requirement).val();
    return value === password;
  },
  messages: {
    en: 'Konfirmasi password tidak sama.',
  }
});

// Custom error message handling
window.Parsley.on("field:validated", function () {
  var elNode = this;

  // Check if the element has any validation errors
  if (elNode.validationResult !== true) {
    var fieldNode = $(elNode.element);
    var formGroupNode = fieldNode.closest(".form-group");
    var lblNode = formGroupNode.find(".form-label:first");
    var lblText = lblNode.text().trim();

    // If the label exists, customize the error message
    if (lblText) {
      var errorNode = formGroupNode.find("div.parsley-error span[class*=parsley-]");
      if (errorNode.length > 0) {
        var validationResult = elNode.validationResult;

        // Loop through validationResult and customize message
        validationResult.forEach(function(result) {
          if (result.assert.name === 'required') {
            errorNode.html(lblText + " tidak boleh kosong.");
          }
          if (result.assert.name === 'minlength') {
            errorNode.html(lblText + " harus memiliki minimal " + result.assert.requirements + " karakter.");
          }
          if (result.assert.name === 'type' && result.assert.requirements === 'email') {
            errorNode.html(lblText + " harus berupa email yang valid.");
          }
        });
      }
    }
  }
});
