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



    $('#epic_request_form .print_option').on('change', function () {

      //alert('yes');

      if ($(this).val() != '') {

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
        $('.print_option').prop('selectedIndex', 0);
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
            url    : wroot + '/ajax.php?action=delete-file-epic&file_id=' + file_id + '&file_name=' + file_name,
            type   : 'GET',
            success: function (response) {
              $("tr[data-row_id=" + file_id + "]").remove();
            }
          });
        }
      });
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



  $('[data-toggle="popover"]').popover();
  $('#e_start_date').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('#e_completion_date').datetimepicker({
    format: 'YYYY-MM-DD'
  });


  validateForm();
  formValidation();
  deleteFile();
  manageWatcherAction();
  commnetFunctionality();
});