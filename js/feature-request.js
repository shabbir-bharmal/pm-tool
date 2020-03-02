$(function () {
  function formValidation() {
    $("#feature_request_form").validate({
      rules   : {
        f_title: {
          required : true,
          maxlength: 55

        }
      },
      // Setting error messages for the fields
      messages: {
        f_title: {
          required : "Please enter feature title.",
          maxlength: "Feature title must be less than 55 characters."
        }
      }
    });
  }

  $('#f_due_date').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('[data-toggle="popover"]').popover();

  formValidation();
});


