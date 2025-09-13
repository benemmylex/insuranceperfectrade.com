// JavaScript Document

// Function to validate inputs with the same class based on the number of composery fields
function validateInputByClass(field,required) {
	var empty = 0;
	var count = 0;
	var data = '';
	field.each(function() {
		data = data +","+ ++count +":"+ $(this).val();
		if ($(this).val() != 0) empty = parseInt(empty) + 1;		
	});
	if (empty != required) {
		showErrMsg("Required field(s) empty");
		exit;
	}
}
// ------------------------------------------------------------------------------------------

// Function to validate form submition
function checkValidityAjax(url,obj,data,element,errMsg) {
	$.post(url,{"action":obj+data},function(data) { if (data != 0) element.html(data); else showErrMsg(errMsg); });
}
// ---------------------------------------------------------------------------------------------

//Function to process a dialog
function processDialog(obj){
	switch (obj) {
		case "delItem":
			if(showDialog("Are you sure you want to delete this/these item(s)?")){	
				document.obj.submit();
				return true;
			}
			return false;
		case "submit":
			if(showDialog("NB: \n Pls, are you sure that all input with red asteriks \n are correctly entered?")){
				document.obj.submit();
				return true;
			}
			return false;
			break;
		case "logout":
			if(confirmDialog("Are you sure you want to Logout form your account")){
				alert("Ok");
				return true;
			}
			return false;
			break;
	}
}
// ------------------------------------------------------	

// function to process test
function processTest(url,obj,dest) {
	$.post(url,{"action":obj,"session":getSession(),"semester":getSemester(),"course":getCourse(),"test":getTest()},function(data) { 
		dest.html(data); 
	});
}
// -------------------------------------------------------------------------------------

// function to process test boolean
function processTest1(url,obj) {
	$.post(url,{"action":obj,"session":getSession(),"semester":getSemester(),"course":getCourse(),"test":getTest()},function(data) { 
		if (data == 1) return true;
		else return false; 
	});
}
// -------------------------------------------------------------------------------------

// function to process ajax
function processAjax(url,obj,ele,input) {
	$.post(url,obj,function(data){
		if (!input) {
            ele.html(data);
		} else {
			ele.val(data);
		}
	});
}

function _processAjax(url,obj,ele,ms,type,ms_ele) {
	//loader();
	$.post(url,obj,function(data){
		if (ms && type && ms_ele) {
            msg(ms,"alert-"+type,1,ms_ele);
		}
		ele.html(data);
		//loader();
	});
}

function __processAjax(url,obj,ele,input) {
    loader();
    $.post(url,obj,function(data){
        if (!input) {
            ele.html(data);
        } else {
            ele.val(data);
        }
        loader();
    });
}

function ___processAjax(url,obj,ele,input) {
    if (input) {
    	if (input == 'text') {
    		ele.val("Loading, please wait...");
		} else if (input == 'select') {
    		ele.val("<option value=''>Loading, please wait...</option>");
		} else {
            ele.val("Loading, please wait...");
		}
	} else {
    	ele.html("<i class='fa fa-spinner fa-spin'></i> Loading, please wait...");
	}
    $.post(url,obj,function(data){
        if (!input) {
            ele.html(data);
        } else {
            ele.val(data);
        }
    });
}
// -------------------------------------------------------

// function to process ajax and show msg
function processAjax1(url,obj) {
	$.post(url,obj,function(data){ 
		if (data == 1 || data) {
			result = true;
		}
		else {
			result = false;
		}
	});
	return result;
}
// ------------------------------------------------------------------------

// function to process ajax and show msg
function processAjax2(url,obj,obj1,dis) {
	$.post(url,{"action":obj,"obj":obj1},function(responseText){ dis.html(responseText); });
}
// ------------------------------------------------------------------------

// function to process ajax and show msg
function processAjax3(url,obj,obj1,obj2,dis) {
	$.post(url,{"action":obj,"obj":obj1,"obj1":obj2},function(responseText){ dis.html(responseText); });
}
// ------------------------------------------------------------------------

// function to load external file
function loadExtFile(url,obj,pg) {
	obj.html("");
	setPage(pg);
	obj.load(url);
}
// -----------------------------------------------------------

// Function to output a loading message on a form
function showFormLoadMsg(src,msg,obj) {
	obj.html('<span id="msgFormLoader"><img src="'+src+'" alt="Loading..." /> ' + msg + '</span>');
}
// -----------------------------------------------------------------------------------------
//Function to output a loading message.
function showLoadMsg (src,msg,obj){
	//var addobj = '';
	obj.html('<div style="width:100%"><img src="'+src+'" alt="Loading..." /> ' + msg + '</div>'); 
}
// ---------------------------------------------------------

// function to show loading page 
function showLoadPage (obj) {
	obj.html('<img style="margin:10% 45% 0%" src="icons/ajax-loader.gif" alt="Loading Page" />');
}
// --------------------------------------------------------------

// Login function 	
function loginSubmit(userId,pass,url,redirect,obj) {
	$.ajax({
		'type': 'post',
		'url': url,
		'data': {'action':'login','regNo':userId,'password':pass},
		'success': function(responseText) {
			if (responseText == 1) {
				obj.hide();
				window.location = redirect;
			}
			else if (responseText == 0) {
				obj.hide();
				alert('Incorrect username or password');
			}
		}
	});
}
// ----------------------------------------------------------------------------

// function to load view
function loadView1(imgurl,url,obj,obj1,ele) {
	showLoadMsg(imgurl,"Please wait...",ele);
	setTimeout(function() {
		processAjax2(url,obj,obj1,ele);
	},300);
}
// --------------------------------------------------------------------


