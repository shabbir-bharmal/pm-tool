$(function () {
    function storeJiraNotes() {
        var timer;
        var timeout = 500;

        $('.f_note').keyup(function () {
            clearTimeout(timer);
            if ($(this).val) {

                var f_id = $(this).parent('td').parent('tr').data('f_id');
                var f_note = $(this).val();
                timer = setTimeout(function () {

                    $.ajax({
                        type   : "GET",
                        url    : wroot + '/ajax.php',
                        data   : "action=update-feature-notes&f_id=" + f_id + "&f_note=" + f_note,
                        cache  : false,
                        success: function (html) {
                        }
                    });
                }, timeout);
            }
        });
    }

    function calculateWSJF() {

        $(".fp_BV,.fp_TC,.fp_RROE,.fp_JS").on('change', function () {

            var fp_id = $(this).data('fp_id');

            var fp_BV = $(".fp_BV[data-fp_id='" + fp_id + "']").val();
            var fp_TC = $(".fp_TC[data-fp_id='" + fp_id + "']").val();
            var fp_RROE = $(".fp_RROE[data-fp_id='" + fp_id + "']").val();
            var fp_JS = $(".fp_JS[data-fp_id='" + fp_id + "']").val();

            if (fp_JS == 0) {
                $(".fp_WSJF[data-fp_id='" + fp_id + "']").html('0');
            } else {
                var wsjf = (parseInt(fp_BV) + parseInt(fp_TC) + parseInt(fp_RROE)) / parseInt(fp_JS);
                wsjf = wsjf.toFixed(3);
                wsjf = parseFloat(wsjf);

                $(".fp_WSJF[data-fp_id='" + fp_id + "']").html(wsjf);
            }

            $.ajax({
                type   : "GET",
                url    : wroot + '/ajax.php',
                data   : "action=update-fp_ranking&fp_id=" + fp_id + "&fp_BV=" + fp_BV + "&fp_TC=" + fp_TC + "&fp_RROE=" + fp_RROE + "&fp_JS=" + fp_JS,
                cache  : false,
                success: function (html) {
                }
            });


        });
    }

    function storeDeptranking() {
        $(".dr_rankingvalue").on('change', function () {
            var oe = $(this).data('oe_id');
            var fp_id = $(this).data('fp_id');
            var dr_rankingvalue = $(this).val();

            if(dr_rankingvalue == '0'){
                $(this).parent('td').css('background-color','white');
            }else if(dr_rankingvalue == '1'){
                $(this).parent('td').css('background-color','blue');
            }else if(dr_rankingvalue == '2'){
                $(this).parent('td').css('background-color','green');
            }else if(dr_rankingvalue == '3'){
                $(this).parent('td').css('background-color','yellow');
            }else if(dr_rankingvalue == '4'){
                $(this).parent('td').css('background-color','orange');
            }else if(dr_rankingvalue == '5'){
                $(this).parent('td').css('background-color','red');
            }

            $.ajax({
                type   : "GET",
                url    : wroot + '/ajax.php',
                data   : "action=save-dr_ranking&oe=" + oe + "&fp_id=" + fp_id + "&dr_rankingvalue=" + dr_rankingvalue,
                cache  : false,
                success: function (html) {
                }
            });
        });
    }

    function storeDrNotes() {
        var timer;
        var timeout = 500;

        $('.dr_notes').keyup(function () {
            clearTimeout(timer);
            if ($(this).val) {

                var oe = $(this).data('oe_id');
                var fp_id = $(this).data('fp_id');
                var dr_notes = $(this).val();

                timer = setTimeout(function () {

                    $.ajax({
                        type   : "GET",
                        url    : wroot + '/ajax.php',
                        data   : "action=save-dr-notes&oe=" + oe + "&fp_id=" + fp_id + "&dr_notes=" + dr_notes,
                        cache  : false,
                        success: function (html) {
                        }
                    });
                }, timeout);
            }
        });
    }

    storeJiraNotes();
    calculateWSJF();
    storeDeptranking();
    storeDrNotes();
});