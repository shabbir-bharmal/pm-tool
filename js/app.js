$(function () {
    var shown = false;

    function formFilter() {
        $('#topic').on('change', function () {
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
            var pi_id = $(this).data('pi_id');
            if (feature_id == 0) {
                $('.modal-title').html('Add Feature');
            } else {
                $('.modal-title').html('Edit Feature');
            }
            // AJAX request
            $.ajax({
                url    : wroot + '/ajax.php?action=manage-feature&feature_id=' + feature_id + '&pi_id=' + pi_id + '&topic_id=' + topic_id,
                type   : 'GET',
                success: function (response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);
                    // Display Modal
                    $('#feature').modal('show');
                    $('#f_due_date').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    calculateWSJF();
                    formValidation();
                    deleteFile();
                    updateMehrLink();
                    popover();
                }
            });
        });
        $('.delete_feature').on('click', function () {
            var feature_id = $(this).data('feature_id');
            bootbox.confirm("Bist Du sicher, dass Du die Datei löschen willst?", function (result) {
                if (result == '1') {
                    $('#delete_feature #f_id').val(feature_id);
                    $('form[name="delete_feature"]').submit();
                }
            });
        });

        $('.print_option').on('change', function () {
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
                    maxlength: 55

                },
                f_storypoints: {
                    number  : true
                }
            },
            // Setting error messages for the fields
            messages      : {
                f_title      : {
                    required : "Please enter feature title.",
                    maxlength: "Feature title must be less than 55 characters."
                },
                f_storypoints: {
                    number  : "Please enter numeric value."

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
        var pi_id = own_pi.attr('id').split('_')[2];
        var f_ids = element.sortable("toArray");


        $.ajax({
            url    : wroot + '/ajax.php?action=update-feature-ranking&feature_id=' + f_ids + '&pi_id=' + pi_id,
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

        piElement.find('.card').each(function (i, v) {
            var sp = $(this).data('sp');
            total_sp = total_sp + parseFloat(sp);
        });

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
        $('#show_all').on('click', function () {
            if ($(".product-increment").hasClass("scrollable")) {
                $(".product-increment").removeClass("scrollable");
                $("#show_all").html("H<span>&#246;</span>he minimieren");

            } else {
                $(".product-increment").addClass("scrollable");
                $("#show_all").html("H<span>&#246;</span>he vergr<span>&#246;</span>ssern");
            }

        });
    }

    function expandDetails() {
        $('#expand').on('click', function () {
            if ($(".card-body ").hasClass("height0")) {
                $(".card-body ").removeClass("height0");
                $("#expand").text("Kurzbeschreibung ausblenden");

            } else {
                $(".card-body").addClass("height0");
                $("#expand").text("Kurzbeschreibung anzeigen");
            }

        });
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
            bootbox.confirm("Bist Du sicher, dass Du die Datei löschen willst?", function (result) {
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
        $('#incpi').on('click', function () {
            $('.table tr').each(function () {
                $(this).find(".d-none:first").removeClass('d-none');
                var far = $( '.roadmap-planning' ).width();
                var pos = $('.roadmap-planning').scrollLeft() + far;
                $('.roadmap-planning').animate( { scrollLeft: pos }, 50, 'easeOutQuad' );
            });
            if ($("td").hasClass("d-none")) {
                $('#incpi').show();
            } else {
                $('#incpi').hide();
            }
        });
    }

    function decrementPI() {
        $('#decpi').on('click', function () {
            $('.table tr').each(function () {
                $(this).find("td:visible").last().addClass('d-none');
                $(this).find("th:visible").last().addClass('d-none');
            });

            if ($("td").hasClass("d-none")) {
                $('#incpi').show();
            } else {
                $('#incpi').hide();
            }
        });
    }

    formFilter();
    updateStaffCapacity();
    manageFeature();
    sortFeature();
    showAll();
    expandDetails();
    showHideCapacity();
    loginFormValidation();
    incrementPI();
    decrementPI();
});


