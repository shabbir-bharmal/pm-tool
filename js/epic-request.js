$(function () {
  function validateForm() {

    $("#epic_request_form").validate({
      rules   : {
        e_title               : {
          required : true,
          maxlength: 30
        },
        e_status_id           : {
          required: true
        },
        e_hs_for              : {
          required: true
        },
        e_hs_for_desc         : {
          required: true
        },
        e_hs_solution         : {
          required: true
        },
        e_hs_how              : {
          required: true
        },
        e_hs_value            : {
          required: true
        },
        e_hs_unlike           : {
          required: true
        },
        e_hs_oursoluion       : {
          required: true
        },
        e_hs_businessoutcome  : {
          required: true
        },
        e_hs_leadingindicators: {
          required: true
        },
        e_hs_nfr              : {
          required: true
        },
        e_owner               : {
          required: true
        }
      },
      // Setting error messages for the fields
      messages: {
        e_title               : {
          required : "Please enter epic title.",
          maxlength: "Epic title must be less than 30 characters."
        },
        e_status_id           : {
          required: "Please choose epic status.",
        },
        e_hs_for              : {
          required: "Please enter epic F&#xFC;r.",
        },
        e_hs_for_desc         : {
          required: "Please enter epic die.",
        },
        e_hs_solution         : {
          required: "Please enter epic ist.",
        },
        e_hs_how              : {
          required: "Please enter epic ein.",
        },
        e_hs_value            : {
          required: "Please enter epic welche.",
        },
        e_hs_unlike           : {
          required: "Please enter epic im Vergleich zu.",
        },
        e_hs_oursoluion       : {
          required: "Please enter epic macht unsere L&#xF6;sung.",
        },
        e_hs_businessoutcome  : {
          required: "Please enter epic Schl&#xFC;sselergebnisse (Hypothese).",
        },
        e_hs_leadingindicators: {
          required: "Please enter epic Zielf&#xFC;hrende Indikatoren.",
        },
        e_hs_nfr              : {
          required: "Please enter epic Nicht-funktionale Anforderungen.",
        },
        e_owner               : {
          required: "Please choose epic owner.",
        }
      },
      errorPlacement: function () {
        $('#errorshow').modal('show');
      }
    });
  }

  function formValidation() {
    $('#EINREICHEN').on('click', function () {
      $("#e_title").rules("add", {
        required : true,
        maxlength: 30
      });
      $("#e_status_id").rules("add", "required");
      $("#e_hs_for").rules("add", "required");
      $("#e_hs_for_desc").rules("add", "required");
      $("#e_hs_solution").rules("add", "required");
      $("#e_hs_how").rules("add", "required");
      $("#e_hs_value").rules("add", "required");
      $("#e_hs_unlike").rules("add", "required");
      $("#e_hs_oursoluion").rules("add", "required");
      $("#e_hs_businessoutcome").rules("add", "required");
      $("#e_hs_leadingindicators").rules("add", "required");
      $("#e_hs_nfr").rules("add", "required");
      $("#e_owner").rules("add", "required");
      $("#team_id").rules("add", "required");
      var form = $('form[name="epic_request_form"]');
      form.find('input[name="action"]').val('epic-request');

    });
    $('#SPEICHERN').on('click', function () {

      $("#e_title").rules("add", {
        required : true,
        maxlength: 30
      });
      $("#e_status_id").rules("remove");
      $("#e_hs_for").rules("remove");
      $("#e_hs_for_desc").rules("remove");
      $("#e_hs_solution").rules("remove");
      $("#e_hs_how").rules("remove");
      $("#e_hs_value").rules("remove");
      $("#e_hs_unlike").rules("remove");
      $("#e_hs_oursoluion").rules("remove");
      $("#e_hs_businessoutcome").rules("remove");
      $("#e_hs_leadingindicators").rules("remove");
      $("#e_hs_nfr").rules("remove");
      $("#e_owner").rules("remove");
      $("#team_id").rules("remove");

      var form = $('form[name="epic_request_form"]');
      form.find('input[name="action"]').val('epic-request');
    });
    $('#feature_antrag').on('click', function () {
      $("#e_title").rules("add", {
        required : true,
        maxlength: 30
      });
      $("#e_status_id").rules("add", "required");
      $("#e_hs_for").rules("add", "required");
      $("#e_hs_for_desc").rules("add", "required");
      $("#e_hs_solution").rules("add", "required");
      $("#e_hs_how").rules("add", "required");
      $("#e_hs_value").rules("add", "required");
      $("#e_hs_unlike").rules("add", "required");
      $("#e_hs_oursoluion").rules("add", "required");
      $("#e_hs_businessoutcome").rules("add", "required");
      $("#e_hs_leadingindicators").rules("add", "required");
      $("#e_hs_nfr").rules("add", "required");
      $("#e_owner").rules("add", "required");
      $("#team_id").rules("add", "required");
      var form = $('form[name="epic_request_form"]');
      form.find('input[name="action"]').val('print-feature');
      form.submit();
    });
  }

  $('[data-toggle="popover"]').popover();
  validateForm();
  formValidation();
});