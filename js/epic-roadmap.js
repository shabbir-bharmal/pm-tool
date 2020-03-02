$(function () {
    function formFilterTeam() {
        $('#team').on('change', function () {
            $('form[name="filter_team"]').submit();
        });
    }

    formFilterTeam();
});
