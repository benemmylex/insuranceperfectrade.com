// JavaScript Document
var base_url = window.location.protocol + "//" + window.location.hostname + "/";
//base_url += "FXTMART/"; //IF IT'S ON LOCALHOST

// function to go back to the previous page
function goBack() {
    window.history.back();
}
// ----------------------------------------------------------------------------------------

// Function to show msg
function msg(msg, type, dis, ele) { //msg = The message; type = The type of msg to show (danger,warning etc); dis = Weather it will have dismiss button; ele = The element it will show on
    dis = (!dis) ? 0 : dis;
    var view;
    if (dis == 1) {
        view = "<div class='row'><div class='col-lg-12'><div class='alert " + type + " alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" + msg + "</div></div></div>";
    } else {
        view = "<div class='row'><div class='col-lg-12'><div class='alert " + type + "'>" + msg + "</div></div></div>";
    }
    setTimeout(function () {
        ele.html("");
    }, 3000);
    ele.html(view);
    scrollUp();
}
// ------------------------------------------------------------------------------------------------------

// function to reload page
function reloadPage(delay) {
    setTimeout(function () {
        location.reload(true);
    }, delay);
}
// -------------------------------------------------------------------------------------------------------------------

// Loading functions
function loader() {
    _("loader").modal("toggle");
}
// -------------------------------------------------------------------------------------------
function scrollUp() {
    $("html, body").stop().animate({ scrollTop: 0 }, '1000', 'swing');
}

function autoSync(url, obj, ele, interval, load) {
    if (load) {
        processAjax(url, obj, ele);
    }
    setInterval(function () {
        processAjax(url, obj, ele);
    }, interval);
}

function scrollEndLoad(url, obj, ele, scroll, load) {
    var last = false;
    if (!scroll) scroll = 0.7;
    if (load) {
        ele.html("<div class='col-sm-12 text-center' id='buffer-loading'><i class='fa fa-circle-o-notch fa-spin fa-3x'></i></div>");
        $.ajax({
            'type': 'post',
            'url': url,
            'data': '',
            'dataType': 'json',
            'success': function (data) {
                ele.html(data['return']);
                last = data['last'];
            }
        });
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() >= ($(document).height() - $(window).height()) * scroll) {
            if (!_('buffer-loading').is(':visible')) {
                if (!last) {
                    ele.append("<div class='col-sm-12 text-center' id='buffer-loading'><i class='fa fa-circle-o-notch fa-spin fa-3x'></i></div>");
                    $.ajax({
                        'type': 'post',
                        'url': url,
                        'data': '',
                        'dataType': 'json',
                        'success': function (data) {
                            _('buffer-loading').remove();
                            ele.append(data['return']);
                            last = data['last'];
                        }
                    });
                }
            }
        }
    });
}

function resetForm(ele) {
    ele[0].reset();
}

function _(el) {
    return $("#" + el);
}

function __(el) {
    return $("." + el);
}

function ___(el, t) { //Use to get the value of an element and trim the value
    if (!t) t = "i"; //Where i=ID and c=Class
    if (t == "i") return $("#" + el).val().trim();
    else if (t == "c") return $("." + el).val().trim();
}

function ____(el, t) { //Use to get the text of an element and trim the text
    if (!t) t = "i"; //Where i=ID and c=Class
    if (t == "i") return $("#" + el).text().trim();
    else if (t == "c") return $("." + el).text().trim();
}

function isArray(myArray) {
    return myArray.constructor.toString().indexOf("Array") > -1;
}

function clock(date) { // 2011-04-20 09:30:51.01 format
    if (!date)
        var d = new Date();
    else
        var d = new Date(data);

    _("clock").text(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
    setInterval(function () {
        if (!date)
            var d = new Date();
        else
            var d = new Date(data);
        _("clock").text(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
    }, 1000);
}

function post_comment(event, ele, id, type) {
    if (event.keyCode == 13) {
        event.preventDefault();
        var comment = ele.val().trim();
        if (comment.length > 0) {
            if (type == 1) {
                $.post(base_url + "ajax/post-comment", "comment=" + comment + "&id=" + id + "&type=" + type, function (data) {
                    _("ques-comment-box-" + id).html(data);
                    processAjax(base_url + "ajax/react-view", "&id=" + id + "&type=Q", _("react-Q" + id));
                    ele.val("");
                });
            } else {
                $.post(base_url + "ajax/post-comment", "comment=" + comment + "&id=" + id + "&type=" + type, function (data) {
                    _("comment-box-" + id).html(data);
                    processAjax(base_url + "ajax/react-view", "&id=" + id + "&type=A", _("react-A" + id));
                    ele.val("");
                });
            }
        }
    }

}

function view_comments(id, type, count) {
    if (type == 1) {
        processAjax(base_url + "ajax/view-comments", "id=" + id + "&type=" + type + "&count=" + count, _("ques-comment-box-" + id));
    } else {
        processAjax(base_url + "ajax/view-comments", "id=" + id + "&type=" + type + "&count=" + count, _("comment-box-" + id));
    }
}

function mark_as_correct(id) {
    if (confirm("You cannot undo this command once done.\n Are you sure this answers your question?")) {
        $.post(base_url + "ajax/mark-as-correct", "id=" + id, function (data) {
            reloadPage(0);
        });
    }
}

function follow_unfollow(base_url, follower, following, type, obj, ele, pack) {
    //alert(follower+" | "+following+" | "+type+" | "+obj+" | "+ele);
    loader();
    if (!pack) { pack = "user"; }
    if (type == 'follow') {
        $.post(base_url + "ajax/follow_unfollow", { "follower": follower, "following": following, "type": 'follow', "pack": pack }, function (data) {
            if (data === true) {
                if (obj == 'mini') {
                    ele.text("Following");
                    ele.attr("onclick", "");
                } else if (obj == 'list') {
                    ele.remove();
                } else if (obj == 'base') {
                    ele.remove();
                }
            }
            loader();
        });
    } else {
        $.post(base_url + "ajax/follow_unfollow", { "follower": follower, "following": following, "type": 'unfollow', "pack": pack }, function (data) {
            if (data == true) {
                if (obj == 'list') {
                    //ele.removeAttr("class");
                    ele.remove();
                } else if (obj == 'base') {
                    ele.remove();
                }
            }
            loader();
        });
    }

}

function block_unblock_follower(url, id, type, ele) {
    if (type == 'base') {
        if (ele.text() == 'Block') {
            $.post(url, "id=" + id + "&status=0$type" + type, function (data) {
                if (data) {
                    ele.removeClass('btn-warning');
                    ele.addClass('btn-danger');
                    ele.text("Unblock");
                }
            });
        } else {
            $.post(url, "id=" + id + "&status=1$type" + type, function (data) {
                if (data) {
                    ele.removeClass('btn-danger');
                    ele.addClass('btn-warning');
                    ele.text("Block");
                }
            });
        }
    }
}

//Associates -------------------------------------------------------------
function view_teams(tbl_ele, url, obj, ele, ms, type, ms_ele) {
    loader();
    $.post(url, obj, function (data) {
        if (ms && type && ms_ele) {
            msg(ms, "alert-" + type, 1, ms_ele);
        }
        ele.html(data);

        loader();
    });
    tbl_ele.DataTable();
}

// function to check a checkbox
function check_uncheck(chk) {
    var selected = 0;
    if (chk.is(":checked")) {
        $(".checkbox").each(function () {
            this.checked = true;
            selected++;
        });
        $(".checkAll").each(function () {
            this.checked = true;
        });
    } else {
        $(".checkbox").each(function () {
            this.checked = false;
            selected = 0;
        });
        $(".checkAll").each(function () {
            this.checked = false;
        });
    }
    $(".chk-selected").text(selected);
}

function checkbox(chk) {
    var selected = ____('chk-selected', 'c');

    if (chk.is(":checked")) {
        selected++;
    } else {
        selected--;
    }

    $(".chk-selected").text(selected);
}
// function ends

function update_sharing(url) {
    var obj = '';
    __('checkbox').each(function () {
        if ($(this).is(':checked')) {
            obj += ____('sportID') + "," + ____('leagueID') + "," + ____('compID') + "," + $(this).text() + "|";
        }
    });
    $.post(url, "obj=" + obj, function (data) {
        if (data) {
            msg("Teams sharing done successfully", "success", 1, _("msg-alert"));
        } else {
            msg("Teams sharing was unsuccessful", "danger", 1, _("msg-alert"));
        }
    });
}

function dialog(url, obj, ele, size) {
    $("#" + ele + " .modal-dialog").removeClass("modal-sm");
    $("#" + ele + " .modal-dialog").removeClass("modal-lg");
    if (size) {
        switch (size) {
            case "sm":
                $("#" + ele + " .modal-dialog").addClass("modal-sm");
                break;
            case "lg":
                $("#" + ele + " .modal-dialog").addClass("modal-lg");
                break;
        }
    }
    __processAjax(url, obj, $("#" + ele + " .modal-dialog .modal-content"));
    _(ele).modal('show');
    scrollUp();
}

function blink(selector) {
    selector.fadeOut('slow', function () {
        $(this).fadeIn('slow', function () {
            blink(this);
        });
    });
}

function check_base_username(url, me) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        data: "username=" + me.val(),
        success: function (data) {
            if (data[0]) {
                _("baseBtn").removeAttr("disabled");
            } else {
                _("baseBtn").attr("disabled", "disabled");
            }
            _("base-uname-check").html(data[1]);
        },
        error: function () {
            alert("Unsuccessful");
        }
    });
}

/*function add_to_slip (url, matchID, preID) {
    loader();
    $.ajax({
        type: 			"POST",
        url: 			url,
        dataType: 		"json",
        crossDomain:	true,
        data:			{"matchID":matchID, "preID":preID},
        success:		function (data) {
            _('predictions').html(data['predictions']);
            _('slip-count').text(data['slip_num']);
            loader();
        },
        error: 			function (x, e) {
            loader();
            alert(x.response);
        }
    });
}*/

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function get_percentage(total, per) {
    var percent = (total * per) / 100;
    return percent;
}

function invest_amount(ele, roi, amt_ele) {
    if (isNaN(ele.val()) || ele.val().trim() == "" || ele.val() == 0) {
        amt_ele.text("$0.00");
    } else {
        var total = parseFloat(get_percentage(ele.val(), roi));
        amt_ele.text("$" + numberWithCommas(Math.round(total, 2)));
    }
}

function invest(ele, plan, min, max) {
    var amount = ___("amt" + plan);
    if (amount < parseFloat(min)) {
        msg("<i class='fa fa-times-circle'></i> Amount must not be less than $" + numberWithCommas(min), "alert-danger", 1, _("msg"));
    } else if (amount > parseFloat(max)) {
        msg("<i class='fa fa-times-circle'></i> Amount must not be greater than $" + numberWithCommas(max), "alert-danger", 1, _("msg"));
    } else {
        ele.html("<i class='fa fa-spinner fa-spin'></i> Processing");
        __("btn-invest").attr("disabled", "disabled");
        $.post(base_url + "backend/home/invest", { "plan": plan, "amount": amount }, function (data) {
            if (data['status']) {
                msg(data['msg'], "alert-success", 1, _("msg"));
                processAjax(base_url + "ajax/get_balance", "", _("main-balance"));
            } else {
                msg(data['msg'], "alert-danger", 1, _("msg"));
            }
            ele.text("Invest");
            __("btn-invest").removeAttr("disabled");
        }, "json");
    }
}

function update_status(table, status, id) {
    $.post({
        url: base_url + "ajax/update_status",
        data: "table=" + table + "&status=" + status + "&id=" + id,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data) {
                msg("<i class='fa fa-check-circle'></i> Updated successfully. <a href='javascript:;' onclick='reloadPage()'>Reload Page</a>", "alert-success", 1, _("msg"));
            } else {
                msg("<i class='fa fa-check-circle'></i> Unsuccessful: An error occurred", "alert-danger", 1, _("msg"));
            }
        }
    });
}

function crypto_payment(amt, method) {
    if (amt == "" || amt < 1) {
        msg("<i class='fa fa-times-circle'></i> Amount must not be less than 1 USD", "alert-danger", 1, _("msg"));
    } else {
        window.location = base_url + "home/crypto_payment/" + amt + "/" + method;
    }
}

function withdraw_password(ele, amount, method, inputs, password) {
    ele.html("<i class='fa fa-spinner fa-spin'></i> Processing");
    ele.attr("disabled", "disabled");
    if (password.length == 0) {
        msg("<i class='fa fa-times-circle'></i> Password field empty", "alert-danger", 1, _("msg"));
    } else {
        $.post(base_url + "users/confirm-password", { "password": password }, function (data) {
            if (data) {
                withdraw(ele, amount, method, inputs);
            } else {
                msg("<i class='fa fa-times-circle'></i> Incorrect password. Try again", "alert-danger", 1, _("msg"));
                ele.removeAttr("disabled");
                ele.text("Withdraw Fund");
            }
        });
    }
}

function withdraw(ele, amount, method, inputs) {
    if (amount < 1) {
        msg("<i class='fa fa-times-circle'></i> Withdrawal amount must not be less than 1 USD", "alert-danger", 1, _("msg"));
    } else {
        var details = "";
        var empty_field = 0;
        for (var i = 0; i < inputs.length; i++) {
            if (inputs.eq(i).val().trim().length == 0) {
                empty_field++;
            } else {
                details += inputs.eq(i).val() + ", ";
            }
        }
        if (empty_field == 0) {
            $.post(base_url + "home/withdraw-fund", {
                "amount": amount,
                "method": method,
                "details": details
            }, function (data) {
                if (data == 1) {
                    msg("<i class='fa fa-check-circle'></i> Withdrawal booked successfully.", "alert-success", 1, _("msg"));
                    window.location = base_url + "fund-list";
                } else if (data == 0) {
                    msg("<i class='fa fa-times-circle'></i> Insufficient balance. Try later", "alert-danger", 1, _("msg"));
                } else {
                    msg("<i class='fa fa-times-circle'></i> Unable to book withdrawal at the moment. Try later", "alert-danger", 1, _("msg"));
                }
            });
        } else {
            msg("<i class='fa fa-times-circle'></i> Required field(s) is empty", "alert-danger", 1, _("msg"));
        }
    }
    ele.removeAttr("disabled");
    ele.text("Withdraw Fund");
}

function copyToClipboard(btn, element) {
    var $temp = $("<input>");
    var btn_text = btn.html();
    $("body").append($temp);
    $temp.val($(element).html()).select();
    document.execCommand("copy");
    $temp.remove();
    btn.text("Copied!");
    setTimeout(function () {
        btn.html(btn_text);
    }, 1500);
}

function cashout(url, amount, ele) {
    var caption = ele.html();
    ele.html("<i class='fa fa-spinner fa-spin'></i> Processing");
    ele.attr("disabled", "disabled");
    $.post(url, { 'amount': amount }, function (data) {
        if (data['status']) {
            msg(data['msg'], 'alert-success', 1, _('msg'));
            reloadPage(700);
        } else {
            msg(data['msg'], 'alert-danger', 1, _('msg'));
        }
        ele.html(caption);
        ele.removeAttr("disabled");
    }, 'json');
}

function calculate_roi() {
    if (___('cal-amount') >= 20 && ___('cal-amount') <= 100000) {
        _('cal-btn').html("<i class='fa fa-spinner fa-spin'></i> Calculating");
        $.post(base_url + 'ajax/calculator', { "amount": ___('cal-amount') }, function (data) {
            _('daily').html(data['daily']);
            _('weekly').html(data['weekly']);
            _('monthly').html(data['monthly']);
            _('yearly').html(data['yearly']);
            _('cal-btn').text('Calculate');
        }, 'json');
    }
}

function bot_transaction() {
    $.post(base_url + "admin/bot_transactions", "", function (data) {
        msg("Transactions added successfully", "alert-success", 1, _('msg'));
    });
}