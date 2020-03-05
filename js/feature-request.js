$(function () {
    var showerror = 'no';
    function validationForm(){

        $("#feature_request_form").validate({

            rules         : {
                f_title       : {
                    required : true,
                    maxlength: 55
                },
                f_epic        : {
                    required: true,
                },
                f_desc        : {
                    required: true,
                },
                f_currentstate: {
                    required: true,
                },
                f_targetstate : {
                    required: true,
                },
                f_benefit     : {
                    required: true,
                },
                f_inscope     : {
                    required: true,
                },
                f_outofscope  : {
                    required: true,
                },
                f_due_date    : {
                    required: true,
                },
                f_SME         : {
                    required: true,
                },
                f_dependencies: {
                    required: true,
                }


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

    function formValidation() {
        $('#EINREICHEN').on('click', function () {
            $(document).find("#f_epic").rules("add", "required");
            $(document).find("#f_desc").rules("add", "required");
            $(document).find("#f_currentstate").rules("add", "required");
            $(document).find("#f_targetstate").rules("add", "required");
            $(document).find("#f_benefit").rules("add", "required");
            $(document).find("#f_inscope").rules("add", "required");
            $(document).find("#f_outofscope").rules("add", "required");
            $(document).find("#f_due_date").rules("add", "required");
            $(document).find("#f_SME").rules("add", "required");
            $(document).find("#f_dependencies").rules("add", "required");
            showerror = 'yes';
        });
        $('#SPEICHERN').on('click', function () {
            $(document).find("#f_epic").rules("remove");
            $(document).find("#f_desc").rules("remove");
            $(document).find("#f_currentstate").rules("remove");
            $(document).find("#f_targetstate").rules("remove");
            $(document).find("#f_benefit").rules("remove");
            $(document).find("#f_inscope").rules("remove");
            $(document).find("#f_outofscope").rules("remove");
            $(document).find("#f_due_date").rules("remove");
            $(document).find("#f_SME").rules("remove");
            $(document).find("#f_dependencies").rules("remove");
            showerror = 'no';
        });
    }

    $('#f_due_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('[data-toggle="popover"]').popover();


    formValidation();
    validationForm();
});


