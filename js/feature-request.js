$(function () {
    var showerror = 'no';

    function validateForm() {

        $("#feature_request_form").validate({

            // Setting error messages for the fields
            messages      : {
                f_title       : {
                    required : "Please enter feature title.",
                    maxlength: "Feature title must be less than 55 characters."
                },
                f_epic        : {
                    required: "Please choose feature epic.",
                },
                f_desc        : {
                    required: "Please enter feature description.",
                },
                f_currentstate: {
                    required: "Please enter feature Ist-Zustand.",
                },
                f_targetstate : {
                    required: "Please enter feature Soll-Zustand.",
                },
                f_benefit     : {
                    required: "Please enter feature Nutzen.",
                },
                f_inscope     : {
                    required: "Please enter feature In Scope.",
                },
                f_outofscope  : {
                    required: "Please enter feature Out-Of-Scope.",
                },
                f_due_date    : {
                    required: "Please choose feature Due Date.",
                },
                f_SME         : {
                    required: "Please choose feature Subject Mater Experts.",
                },
                f_dependencies: {
                    required: "Please enter feature AbhÃ¤ngigkeit:.",
                }
            },
            errorPlacement: function () {
                if (showerror == 'yes') {
                    showerror = 'no';
                    $('#errorshow').modal('show');
                }
            }
        });
    }

    function formValidation() {
        $('#EINREICHEN').on('click', function () {
            var form = $('form[name="feature_request_form"]');
            form.find('input[name="action"]').val('feature-request');
            $("#f_title").rules("add", "required");
            $("#f_epic").rules("add", "required");
            $("#f_topic").rules("add", "required");
            $("#f_desc").rules("add", "required");
            $("#f_currentstate").rules("add", "required");
            $("#f_targetstate").rules("add", "required");
            $("#f_benefit").rules("add", "required");
            $("#f_inscope").rules("add", "required");
            $("#f_outofscope").rules("add", "required");
            $("#f_due_date").rules("add", "required");
            $("#f_SME").rules("add", "required");
            $("#f_dependencies").rules("add", "required");
            showerror = 'yes';
        });
        $('#SPEICHERN').on('click', function () {
            var form = $('form[name="feature_request_form"]');
            form.find('input[name="action"]').val('feature-request');

            $("#f_title").rules("add", "required");
            $("#f_epic").rules("remove");
            $("#f_topic").rules("remove");
            $("#f_desc").rules("remove");
            $("#f_currentstate").rules("remove");
            $("#f_targetstate").rules("remove");
            $("#f_benefit").rules("remove");
            $("#f_inscope").rules("remove");
            $("#f_outofscope").rules("remove");
            $("#f_due_date").rules("remove");
            $("#f_SME").rules("remove");
            $("#f_dependencies").rules("remove");
            showerror = 'no';
        });
        $('#feature_antrag').on('click', function () {
            $("#f_title").rules("add", "required");
            $("#f_epic").rules("add", "required");
            $("#f_topic").rules("add", "required");
            $("#f_desc").rules("add", "required");
            $("#f_currentstate").rules("add", "required");
            $("#f_targetstate").rules("add", "required");
            $("#f_benefit").rules("add", "required");
            $("#f_inscope").rules("add", "required");
            $("#f_outofscope").rules("add", "required");
            $("#f_due_date").rules("add", "required");
            $("#f_SME").rules("add", "required");
            $("#f_dependencies").rules("add", "required");
            // showerror = 'yes';
            var form = $('form[name="feature_request_form"]');
            form.find('input[name="action"]').val('print-feature');
            form.submit();
        });
    }
    $('#f_due_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('[data-toggle="popover"]').popover();
    formValidation();
    validateForm();
});