//************************* Start Feature ***************************************

function showEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function saveToDatabase(editableObj, column, f_id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/save-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&f_id=' + f_id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//************************* End Feature ***************************************

//************************* Start Epics ***************************************

function epicshowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function epicsaveToDatabase(editableObj, column, e_id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/epic-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&e_id=' + e_id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//************************* End Epics ***************************************

//************************* Start Staff ***************************************
function staffhowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function staffsaveToDatabase(editableObj, column, staff_id) {
	$(editableObj)
			.css("background", "#FFF url(./datagrid/images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./datagrid/ajax-end-point/staff-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&staff_id=' + staff_id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}

//************************* End Staff ***************************************

//************************* Start Topics ***************************************
function topicsShowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function topicssaveToDatabase(editableObj, column, id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/topics-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&id=' + id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//******************************* End Topics *****************************************************


//************************* Start Product Incriment ***************************************
function productIncShowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function productIncsaveToDatabase(editableObj, column, pi_id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/productInc-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&pi_id=' + pi_id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//************************* End Product Incriment *******************************************

//************************* Start Help Text *************************************************

function helpTextShowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function helptextsaveToDatabase(editableObj, column, id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/helptext-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&id=' + id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//************************* End Help Text *************************************************


//************************* Start Feature Types *************************************************

function featureTypesShowEdit(editableObj) {
	$(editableObj).css("background", "#FFF");
}

function featuretypessaveToDatabase(editableObj, column, id) {
	$(editableObj)
			.css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
	$.ajax({
		url : "./ajax-end-point/featuretypes-edit.php",
		type : "POST",
		data : 'column=' + column + '&editval=' + editableObj.innerHTML
				+ '&id=' + id,
		success : function(data) {
			$(editableObj).css("background", "#FDFDFD");
		}
	});
}
//************************* End Feature Types *************************************************