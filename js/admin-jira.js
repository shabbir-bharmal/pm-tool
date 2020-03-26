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

function displayRecordsforNonMatchedPM(numRecords, pageNum) {

    var epic = $('#epic').val();
    var f_status_id = $('#f_status_id').val();


    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-non-matched-pm&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id,
        cache: false,
        success: function(html) {
            $("#non_matched_pm").html(html);
        }
    });
}

function displayRecordsforMatchedPM(numRecords, pageNum) {

    var epic = $('#epic').val();
    var f_status_id = $('#f_status_id').val();


    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-matched-pm&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id,
        cache: false,
        success: function(html) {
            $("#matched_jira_pm").html(html);
        }
    });
}

function displayRecordsforNonMatchedJira(numRecords, pageNum) {

    var epic = $('#epic').val();
    var f_status_id = $('#f_status_id').val();


    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-non-matched-jira&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id,
        cache: false,
        success: function(html) {
            $("#non_matched_jira").html(html);
        }
    });
}