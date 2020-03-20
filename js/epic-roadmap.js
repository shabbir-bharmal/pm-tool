$(function () {
    function formFilterTeam() {
        $('#team').on('change', function () {
            $('form[name="filter_team"]').submit();
        });

        $('#epic').on('change', function () {
             var epic = $(this).val();
             if(epic){
                 $('.epic_title').hide();
                 $( ".feature-information " ).each(function( i ) {
                     var epic_id = $(this).data('epic_id');
                     //  console.log(epic_id);
                     if(epic == epic_id){
                         $(this).removeClass('d-none');
                     }else{
                         $(this).addClass('d-none');
                     }
                 });
             }else{
                 $('.epic_title').show();
                 $( ".feature-information " ).each(function( i ) {
                     $(this).removeClass('d-none');
                 });
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

    formFilterTeam();
    commnetFunctionality();
});
