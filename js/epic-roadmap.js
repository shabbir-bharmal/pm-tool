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

    formFilterTeam();
});
