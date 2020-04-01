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

function storeJiraNotes() {
    var timer;
    var timeout = 500;

    $('.f_jira_notes').keyup(function(){
        clearTimeout(timer);
        if ($(this).val) {
            var f_id = $(this).data('f_id');
            var f_jira_notes = $(this).val();
            timer = setTimeout(function(){
                $.ajax({
                    type: "GET",
                    url    : wroot +'/ajax.php',
                    data: "action=update-feature-jira-notes&f_id=" + f_id + "&f_jira_notes=" + f_jira_notes,
                    cache: false,
                    success: function(html) {
                    }
                });
            }, timeout);
        }
    });
}
storeJiraNotes();

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
            storeJiraNotes();
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