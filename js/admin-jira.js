$(function () {
    function formFilter() {
        $('#epic').on('change', function () {
            $('form[name="filter_epic_feature"]').submit();
        });
        $('#f_status_id').on('change', function () {
            $('form[name="filter_epic_feature"]').submit();
        });
    }
    formFilter();
});
