$(function () {
    var showerror = 'no';

    function validateForm() {

        $("#feature_request_form").validate({

            // Setting error messages for the fields
            messages      : {
                f_title       : {
                    required : "Please enter feature title.",
                    maxlength: "Feature title must be less than 100 characters."
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
            $("#f_title").rules("add", {
                required : true,
                maxlength: 100
            });
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

            $("#f_title").rules("add", {
                required : true,
                maxlength: 100
            });
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

        $('#feature_request_form .print_option').on('change', function () {

            //alert('yes');

            if ($(this).val() != '') {

                $("#f_title").rules("add", {
                    required : true,
                    maxlength: 100
                });
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
                $('.print_option').prop('selectedIndex', 0);
            }
        });
    }

    function calculateWSJF() {

        $("#f_BV,#f_TC,#f_RROE,#f_JS").on('change', function () {
            var f_BV = $("#f_BV").val();
            var f_TC = $("#f_TC").val();
            var f_RROE = $("#f_RROE").val();
            var f_JS = $("#f_JS").val();
            if (f_JS == 0) {
                $(".f_WSJF").html('= 0');
            } else {
                var wsjf = (parseInt(f_BV) + parseInt(f_TC) + parseInt(f_RROE)) / parseInt(f_JS);
                $(".f_WSJF").html('= ' + wsjf);
            }
        });
    }

    function manageWatcherAction() {
        $('.watch-icon').on('click', function () {
            var watcher = $('#watcher');
            if (watcher.val() == 1) { // already watching so unwatch now
                watcher.val(0);
                $('.watch-icon').toggleClass('text-success');
                $('.watch-icon').addClass('text-secondary');
            } else { // unwatching so watch now
                watcher.val(1);
                $('.watch-icon').toggleClass('text-secondary');
                $('.watch-icon').addClass('text-success');
            }
        });
    }

    function deleteFile() {
        $('.delete_file').on('click', function () {
            var file_id = $(this).data('file_id');
            var file_name = $(this).data('file_name');
            bootbox.confirm("Bist Du sicher, dass Du die Datei l&ouml;schen willst?", function (result) {
                if (result == '1') {
                    $.ajax({
                        url    : wroot + '/ajax.php?action=delete-file&file_id=' + file_id + '&file_name=' + file_name,
                        type   : 'GET',
                        success: function (response) {
                            $("tr[data-row_id=" + file_id + "]").remove();
                        }
                    });
                }
            });
        });
    }

    function updateMehrLink() {
        $("input#f_mehr_details").on('blur', function () {
            if ($(this).val() != '') {
                $('.f_mehr_link').attr('href', $(this).val());
            }
        });
    }
    function commnetFunctionality() {
        $(function () {
            var saveComment =  function (data) {

                // ************ Save Comment Start ***********//
                return  data;
                // Convert pings to human readable format

                // ************ Save Comment End ***********//
            }
            $('#comments-container').comments({
                profilePictureURL   : staff_avatar,
                currentUserId       : login_id,
                roundProfilePictures: true,
                textareaRows        : 1,
                enableAttachments   : false,
                enableHashtags      : true,
                enablePinging       : true,
                searchUsers         : function (term, success, error) {
                    setTimeout(function () {
                        success(usersArray.filter(function (user) {
                            var containsSearchTerm = user.fullname.toLowerCase().indexOf(term.toLowerCase()) != -1;
                            var isNotSelf = user.id != login_id;
                            return containsSearchTerm && isNotSelf;
                        }));
                    }, 500);
                },
                getComments         : function (success, error) {
                    setTimeout(function () {
                        success(commentsArray);
                    }, 500);
                },
                postComment      : function (data, success, error) {
                    setTimeout(function () {

                        $(Object.keys(data.pings)).each(function (index, userId) {
                            var fullname = data.pings[userId];
                            var pingText = '@' + fullname;
                            data.content = data.content.replace(new RegExp('@' + userId, 'g'), pingText);
                        });

                        $.ajax({
                            url    : wroot + '/ajax.php?action=save-comment&modal=' + modal + '&modal_id=' + modal_id + '&login_id=' + login_id,
                            data   : {data: data},
                            type   : 'POST',
                            success:  function (response) {
                                data.id = parseInt(response);

                                console.log(data.id);
                                console.log(data);
                                success(saveComment(data));

                            }
                        });

                    }, 500);
                },
                putComment       : function (data, success, error) {
                    setTimeout(function () {
                        $(Object.keys(data.pings)).each(function (index, userId) {
                            var fullname = data.pings[userId];
                            var pingText = '@' + fullname;
                            data.content = data.content.replace(new RegExp('@' + userId, 'g'), pingText);
                        });

                        $.ajax({
                            url    : wroot + '/ajax.php?action=save-comment&modal=' + modal + '&modal_id=' + modal_id + '&login_id=' + login_id,
                            data   : {data: data},
                            type   : 'POST',
                            success:  function (response) {
                                data.id = parseInt(response);
                                console.log(data.id);
                                console.log(data);
                                success(saveComment(data));

                            }
                        });
                        // success(saveComment(data));
                    }, 500);
                },
                deleteComment    : function (data, success, error) {
                    setTimeout(function () {
                        $.ajax({
                            url    : wroot + '/ajax.php?action=delete-comment&modal=' + modal + '&modal_id=' + modal_id + '&login_id=' + login_id,
                            data   : {data: data},
                            type   : 'POST',
                            success:  function (response) {
                                data.id = parseInt(response);
                                console.log(data.id);
                                console.log(data);
                                success(saveComment(data));

                            }
                        });
                        success();
                    }, 500);
                },
                upvoteComment    : function (data, success, error) {
                    setTimeout(function () {
                        success(data);
                    }, 500);
                },
                uploadAttachments: function (dataArray, success, error) {
                    setTimeout(function () {
                        success(dataArray);
                    }, 500);
                },
            });
        });
    }



    $('#f_due_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('[data-toggle="popover"]').popover();

    formValidation();
    validateForm();
    calculateWSJF();
    deleteFile();
    updateMehrLink();
    manageWatcherAction();
    commnetFunctionality();
});