$(function () {
    function formFilter() {
        $('#epic').on('change', function () {
            $('form[name="filter_epic_feature"]').submit();
        });
        $('#f_status_id').on('change', function () {
            $('form[name="filter_epic_feature"]').submit();
        });       
        $('#f_pi_id').on('change', function () {
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
function storeJiraID() {
    $('.f_jira_id').on('change', function () {
        var f_id = $(this).data('f_id');
        var f_jira_id = $(this).val();
        $.ajax({
            type: "GET",
            url    : wroot +'/ajax.php',
            data: "action=update-feature-jira-id&f_id=" + f_id + "&f_jira_id=" + f_jira_id,
            cache: false,
            success: function(html) {
            }
        });
    });
}
function storeMatchJira() {
    $('.f_jira_match').on('change', function () {
        var f_id = $(this).data('f_id');
        var f_jira_match = 1;
        if($(this).prop("checked") == true){
             f_jira_match = 1;
        }
        else if($(this).prop("checked") == false){
             f_jira_match = 0;
        }

        $.ajax({
            type: "GET",
            url    : wroot +'/ajax.php',
            data: "action=update-feature-jira-match&f_id=" + f_id + "&f_jira_match=" + f_jira_match,
            cache: false,
            success: function(html) {
            }
        });
    });
}

storeJiraNotes();
storeJiraID();
storeMatchJira();

function displayRecordsforNonMatchedPM(numRecords, pageNum) {

    var epic = $('#epic').val();
    var f_status_id = $('#f_status_id').val();    
    var f_pi_id = $('#f_pi_id').val();    

    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-non-matched-pm&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id+ "&f_pi_id="+f_pi_id,     
        cache: false,
        success: function(html) {
            $("#non_matched_pm").html(html);
            storeJiraID();
            storeJiraNotes();
            storeMatchJira();
        }
    });
}

function displayRecordsforMatchedPM(numRecords, pageNum) {

    var epic = $('#epic').val();
    var f_status_id = $('#f_status_id').val();
    var f_pi_id = $('#f_pi_id').val();

    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-matched-pm&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id+ "&f_pi_id="+f_pi_id,
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
    var f_pi_id = $('#f_pi_id').val();

    $.ajax({
        type: "GET",
        url    : wroot +'/ajax.php',
        data: "action=display-non-matched-jira&show=" + numRecords + "&pagenum=" + pageNum + "&epic=" +epic+ "&f_status_id="+f_status_id+ "&f_pi_id="+f_pi_id,
        cache: false,
        success: function(html) {
            $("#non_matched_jira").html(html);

        }
    });
}