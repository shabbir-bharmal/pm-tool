$(function () {
    var shown = false;

    if ($('.table').hasClass('not_move')) {
        $(".table td .product-increment").removeAttr('id', 'none');
    }

    function formFilter() {
        $('#topic').on('change', function () {
            $('form[name="filter_topic"]').submit();
        });
        $('#team').on('change', function () {
            $('#topic').prop('selectedIndex', -1);
            $('form[name="filter_topic"]').submit();
        });
    }

    function updateStaffCapacity() {
        $('.capacity_input').on('keypress', function (event) {
            return event.charCode >= 48 && event.charCode <= 57
        });
        $('.capacity_input').on('blur', function () {
            var capacity = $(this).val();
            var col_index = $(this).closest('td').index();
            var total_capacity_row = $('.total-capacity-row').find('td').eq(col_index);
            var total_capacity = 0;
            var input_name = $(this).attr('name').split('_');
            var staff_id = input_name[1];
            var pi_id = input_name[2];
            var total_sp_row = $('.total-sp-row').find('td').eq(col_index);
            var total_sp = total_sp_row.find('span.pi_total_sp').html();

            $('tr.capacity-row').each(function (i, v) {
                var capacity_col = $(this).find('td').eq(col_index);
                total_capacity = total_capacity + parseInt(capacity_col.find('.capacity_input').val());
            });
            if (total_capacity <= total_sp) {
                if (total_sp_row.find('span.pi_total_sp').hasClass('text-success')) {
                    total_sp_row.find('span.pi_total_sp').removeClass('text-success');
                    total_sp_row.find('span.pi_total_sp').addClass('text-danger');
                }
            } else {
                if (total_sp_row.find('span.pi_total_sp').hasClass('text-danger')) {
                    total_sp_row.find('span.pi_total_sp').removeClass('text-danger');
                    total_sp_row.find('span.pi_total_sp').addClass('text-success');
                }
            }
            // Update the total capacity of PI
            total_capacity_row.find('span.pi_total_capacity').html(total_capacity);


            // Fire ajax to update staff pi capacity
            $.ajax({
                url       : wroot + '/ajax.php?action=update-staff-pi-capacity&staff_id=' + staff_id + '&pi_id=' + pi_id + '&capacity=' + capacity,
                type      : 'GET',
                beforeSend: function () {
                    var div = document.createElement("div");
                    div.className += "overlay";
                    document.body.appendChild(div);
                },
                complete  : function () {
                    $('.overlay').remove();
                }
            });
        });
    }

    function validateStoryPointInput() {
        $('#f_storypoints').on('keypress', function (event) {
            return event.charCode >= 48 && event.charCode <= 57
        });
    }

    function manageFeature() {
        $('.manage_feature').on('click', function () {

            var feature_id = $(this).data('feature_id');
            var topic_id = $(this).data('topic_id');
            var team_id = $(this).data('team_id');
            var pi_id = $(this).data('pi_id');
            if (feature_id == 0) {
                $('#feature .modal-title').html('Add Feature');
            } else {
                $('#feature .modal-title').html('Edit Feature');
            }
            // AJAX request
            $.ajax({
                url    : wroot + '/ajax.php?action=manage-feature&feature_id=' + feature_id + '&pi_id=' + pi_id + '&topic_id=' + topic_id + '&team_id=' + team_id,
                type   : 'GET',
                success: function (response) {
                    // Add response in Modal body
                    $('#feature .modal-body').html(response);
                    // Display Modal
                    $('#feature').modal('show');
                    $('#f_due_date').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    manageWatcherAction();
                    calculateWSJF();
                    formValidation();
                    deleteFile();
                    updateMehrLink();
                    popover();
                    checkPermission();
                    commnetFunctionality();
                    copyFeature();
                }
            });
        });
        $('.delete_feature').on('click', function () {
            var feature_id = $(this).data('feature_id');
            bootbox.confirm("Bist Du sicher, dass Du das Feature l&ouml;schen willst?", function (result) {
                if (result == '1') {
                    $('#delete_feature #f_id').val(feature_id);
                    $('form[name="delete_feature"]').submit();
                }
            });
        });

        $('#feature_form .print_option').on('change', function () {
            if ($(this).val() != '') {
                var form = $('form[name="feature_form"]');
                var actual_action = form.find('input[name="action"]').val();
                form.find('input[name="action"]').val('print-feature');
                form.submit();
                form.find('input[name="action"]').val(actual_action);
                $('.print_option').prop('selectedIndex', 0);
            }
        });
    }

    function formValidation() {

        $("#feature_form").validate({
            rules         : {
                f_title      : {
                    required : true,
                    maxlength: 100

                },
                f_storypoints: {
                    number: true
                }
            },
            // Setting error messages for the fields
            messages      : {
                f_title      : {
                    required : "Please enter feature title.",
                    maxlength: "Feature title must be less than 100 characters."
                },
                f_storypoints: {
                    number: "Please enter numeric value."

                }

            },
            ignore        : "",
            invalidHandler: function () {
                setTimeout(function () {
                    $('.nav-tabs a small.error').remove();
                    var validatePane = $('.tab-content .tab-pane:has(input.error)').each(function () {
                        var id = $(this).attr('id');
                        $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="error">***</small>');
                    });
                });
            },
            // Setting submit handler for the form
            submitHandler : function (form) {
                form.submit();
            }
        });

    }

    function sortFeature() {
        $('[id^=pi_sortable_]').sortable({
            placeholderClass: 'card',
            connectWith     : '.product-increment',
            stop            : function (event, ui) {
                // Own list
                updateFeatureRanking($(this));
            },
            receive         : function (event, ui) {
                // receiver list
                updateFeatureRanking($(this));
            }
        });
    }

    function updateFeatureRanking(element) {
        var own_pi = element.closest('.product-increment');
        var topic_id = element.closest('.product-increment').data('topic_id');
        var pi_id = own_pi.attr('id').split('_')[2];
        var f_ids = element.sortable("toArray");
        $.ajax({
            url    : wroot + '/ajax.php?action=update-feature-ranking&feature_id=' + f_ids + '&pi_id=' + pi_id + '&topic_id=' + topic_id,
            type   : 'GET',
            success: function (response) {

                calculateTotalSP(own_pi);

            }
        });
    }

    function calculateTotalSP(piElement) {

        var col_index = piElement.closest('td').index();
        var total_sp_row = $('.total-sp-row').find('td').eq(col_index);
        var total_sp = 0;

        var pi_id = piElement.attr('id');
        $('.' + pi_id).find('.card').each(function (i, v) {
            var sp = $(this).data('sp');
            total_sp = total_sp + parseFloat(sp);
        });

        /*piElement.find('.card').each(function (i, v) {
            var sp = $(this).data('sp');
            total_sp = total_sp + parseFloat(sp);
        });*/

        // Update the total capacity of PI
        total_sp_row.find('span.pi_total_sp').html(total_sp);

        var total_capacity_row = $('.total-capacity-row').find('td').eq(col_index);
        var total_capacity = total_capacity_row.find('span.pi_total_capacity').html();

        if (total_capacity <= total_sp) {
            if (total_sp_row.find('span.pi_total_sp').hasClass('text-success')) {
                total_sp_row.find('span.pi_total_sp').removeClass('text-success');
                total_sp_row.find('span.pi_total_sp').addClass('text-danger');
            }
        } else {
            if (total_sp_row.find('span.pi_total_sp').hasClass('text-danger')) {
                total_sp_row.find('span.pi_total_sp').removeClass('text-danger');
                total_sp_row.find('span.pi_total_sp').addClass('text-success');
            }
        }
    }


    function setFeatureHeight() {
        $(".product-increment").height($(".feature-information").height());
    }

    function showAll() {

        if ($(".product-increment").hasClass("scrollable")) {
            $(".product-increment").removeClass("scrollable");
            $('#event option[value="show_all"]').html("H<span>&#246;</span>he minimieren");
        } else {
            $(".product-increment").addClass("scrollable");
            $('#event option[value="show_all"]').html("H<span>&#246;</span>he vergr<span>&#246;</span>ssern");
        }
    }

    function expandDetails() {

        if ($(".card-body ").hasClass("height0")) {
            $(".card-body ").removeClass("height0");
            $('#event option[value="expand"]').html("Kurzbeschreibung ausblenden");

        } else {
            $(".card-body").addClass("height0");
            $('#event option[value="expand"]').html("Kurzbeschreibung anzeigen");

        }


    }

    function showHideCapacity() {
        $('.total-capacity-row a').on('click', function () {
            if (!shown) {
                $('.capacity-row td').slideDown();
            } else {
                $('.capacity-row td').slideUp();
            }
            shown = !shown;
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
    function manageWatcherAction(){
        $('.watch-icon').on('click', function(){
            var watcher = $('#watcher');
            if(watcher.val() == 1){ // already watching so unwatch now
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

    function loginFormValidation() {
        $("#login_form").validate({
            rules         : {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            // Setting error messages for the fields
            messages      : {
                username: {
                    required: "Please enter username.",
                },
                password: {
                    required: "Please enter password.",
                }


            },
            ignore        : "",
            invalidHandler: function () {
                setTimeout(function () {
                    $('.nav-tabs a small.error').remove();
                    var validatePane = $('.tab-content .tab-pane:has(input.error)').each(function () {
                        var id = $(this).attr('id');
                        $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="error">***</small>');
                    });
                });
            },
            // Setting submit handler for the form
            submitHandler : function (form) {
                form.submit();
            }
        });

    }

    function popover() {
        $('[data-toggle="popover"]').popover();

        $(".nav-tabs").on('click', function () {
            $('[data-toggle="popover"]').popover('hide');
        });

    }

    function incrementPI() {

        $('.table tr').each(function () {
            $(this).find(".d-none:first").removeClass('d-none');
            var far = $('.roadmap-planning').width();
            var pos = $('.roadmap-planning').scrollLeft() + far;
            $('.roadmap-planning').animate({scrollLeft: pos}, 50, 'easeOutQuad');
        });
        if ($("td").hasClass("d-none")) {
            $('#incpi').show();
        } else {
            $('#incpi').hide();
        }

    }

    function decrementPI() {

        $('.table tr').each(function () {
            $(this).find("td:visible").last().addClass('d-none');
            $(this).find("th:visible").last().addClass('d-none');
        });

        if ($("td").hasClass("d-none")) {
            $('#incpi').show();
        } else {
            $('#incpi').hide();
        }

    }
    function showPrevPI() {

        $('.table tr').each(function () {
            $(this).find(".hide-prev:last").removeClass('hide-prev');
        });

    }


    function changeEvent() {
        $("#event").on('change', function () {
            var eveName = $(this).val();
            $.ajax({
                url    : wroot + '/ajax.php?action=event-store-in-session&event=' + eveName,
                type   : 'GET',
                success:  function (response) {

                }
            });
            if (eveName == 'incpi') {
                incrementPI();
            } else if (eveName == 'decpi') {
                decrementPI();
            } else if (eveName == 'show_all') {
                showAll();
            } else if (eveName == 'expand') {
                expandDetails();
            }else if (eveName == 'prev_pi') {
                showPrevPI();
            }
            $('#event').prop('selectedIndex', 0);
        });
    }

    function avtarUpload() {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#avatarImg").change(function () {
            var ext = this.value.match(/\.(.+)$/)[1];
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    break;
                default:
                    $('#img-upload').attr('src','');
                    alert('This is not an allowed file type.');
                    this.value = '';
            }
            readURL(this);
        });

    }

    function manageAccount() {
        $("#my_account_form").validate({
            rules         : {
                staff_firstname: {
                    required: true
                },
                confirm_password: {
                    equalTo: "#password_new"
                }
            },
            // Setting error messages for the fields
            messages      : {
                staff_firstname: {
                    required: "Please enter firstname.",
                },
                confirm_password: " Enter Confirm Password Same as Password"
            },
            ignore        : "",
            invalidHandler: function () {
                setTimeout(function () {
                    $('.nav-tabs a small.error').remove();
                    var validatePane = $('.tab-content .tab-pane:has(input.error)').each(function () {
                        var id = $(this).attr('id');
                        $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="error">***</small>');
                    });
                });
            },
            // Setting submit handler for the form
            submitHandler : function (form) {
                form.submit();
            }
        });
    }

    function checkPermission(){
        if($('#feature_form #f_title').is(':disabled')){
            console.log('yes');
            $( "#feature_submit" ).prop( "disabled", true );
            $( ".print_option" ).prop( "disabled", true );
        }else{
            console.log('no');
            $( "#feature_submit" ).prop( "disabled", false );
            $( ".print_option" ).prop( "disabled", false );
        }
    }
    function printAllfeaturesFromPI() {

        $('.print_pi i').on('click', function(){
            $('.bd-print-modal-sm').modal('show');
            var pi = $(this).data('pi');
            var features = [];
            $('.pi_sortable_'+pi+' .card').each(function () {
                features.push($(this).attr('id'));
            });
            $("#print_pi_features #features").val(features);
            //$("#print_pi_features").submit();
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
                    }, 100);
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
    function copyFeature(){
        $('.copy-icon').on('click', function () {
          var f_id = $(this).data('f_id');
            $.ajax({
                url    : wroot + '/ajax.php?action=copy-feature&f_id=' + f_id,
                type   : 'GET',
                success:  function (response) {
                    window.location.href = response;

                }
            });
        });
    }

    formFilter();
    updateStaffCapacity();
    manageFeature();
    sortFeature();
    showHideCapacity();
    loginFormValidation();
    changeEvent();
    popover();
    avtarUpload();
    manageAccount();
    printAllfeaturesFromPI();
    copyFeature();

});


