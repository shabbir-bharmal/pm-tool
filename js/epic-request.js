$(function () {
    var showerror = 'no';
    function validateForm(){

        $("#epic_request_form").validate({
            rules:{

            },
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
                if(showerror == 'yes'){
                    showerror = 'no';
                    $('#errorshow').modal('show');
                }
            }
        });
    }

    $('#f_due_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('[data-toggle="popover"]').popover();
    validateForm();
});


