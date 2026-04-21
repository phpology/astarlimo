$(document).ready(function () {
    $('body').on('mouseenter', '.tooltip_hospital_notes', function (e) {
        $('.tooltip_hospital_notes').easyTooltip({
            xOffset: -160,
            yOffset: -30
        });
    });

    $('body').on('click', '.request-availability', function (e) {
        var candidate_sha1 = $(this).data('candidate_sha1');

        if (confirm('Are you sure you want to request availability')) {
            $.ajax({
                type: 'GET',
                url: '/dashboard/calendar?do=request-availability&is_json=1&candidate_sha1=' + candidate_sha1,
                dataType: 'json',
                data: {},
                success: function (data) {

                    Notification.create(
                        // Title
                        'Availability SMS Notification',
                        // Text
                        'You have sent an availability notification to ' + data.candidate.eclipse_firstname + ' ' + data.candidate.eclipse_lastname + '.',
                        // Illustration
                        null,
                        // Effect
                        'bounceIn',
                        // Position
                        4,
                        //delay in secs
                        4
                    );

                    return true;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        }
        return false;
    });

    //Show/hide filters (mobile only)
    $('body').on('click', '.actions .fa-filter', function (e) {
        $(".actions .fa-filter").next(".hidemob").slideToggle("fast");
    });

    //Mobile nav (mobile only)
    $('body').on('click', '#mobile-nav', function (e) {
        $("header .hidemob").toggleClass("showmob");
    });

    //collapse sidebar (desktop only)
    $('body').on('click', '#sidebar-collapse', function (e) {
        $("header").toggleClass("collapse");
        $(".wrapper.main").toggleClass("expand");
    });

    //Expand / collapse menu for nav to show/hide subnav
    $("a[data-collapsed='true']").click(function () {
        $(this).next(".subnav").slideToggle("fast");
        $(this).toggleClass("subnav-open");
    });

    //window resize stuff
    $(window).on("load resize", function () {
        var screenwidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if (screenwidth <= 767) {
            $("header").removeClass("collapse");
            $(".wrapper.main").removeClass("expand");
        }
        if (screenwidth >= 768) {
            $(".actions .fa-filter").next(".hidemob").slideDown("fast");
            $("header .hidemob").removeClass("showmob");
        }
    });
    $('body').on('click', '.modal', function (e) {
        if ($(e.target).closest(".modal-content").length === 0) {
            $(".modal").addClass("hidden");

        }
    });

    $(".modal").on("click", "#close", function () {
        $(".modal").addClass("hidden");
    });

    $('body').on('click', '.bookings-edit', function (e) {
        e.preventDefault();
        $("#booking-edit-new-form").load($(this).attr('href'));
        setTimeout(myTimer1, 1000);

        function myTimer1() {
            var script = "<script>$('.modal').on('click', '#close', function() {$('.modal').addClass('hidden');});$('#booking-edit-new-form').validate({errorClass: 'invalid',submitHandler: function(form) {return true;}});</script>";
            $("#booking-edit-new-form").append(script);
            $("#model_ed_view").show();
            $("#model_ad_view").html('');
            $("#model_ed_view").find("form#booking-edit-form").contents().unwrap();
        }

        $(".react_modal").modal('show');
    });

    $('body').on('click', '.candidate-sms', function (e) {
        e.preventDefault();
        $(".modal-content").load($(this).attr('href'));
        $(".modal").modal('show');
    });

    $(".context-menu").on("click", ".bookings-edit", function (e) {
        $(".modal-content").load($(this).attr('href'));
        $(".modal").modal('show');
        e.preventDefault();
    });

    $(".context-menu-availability").on("click", ".bookings-edit", function (e) {
        $(".modal-content").load($(this).attr('href'));
        $(".modal").modal('show');
        e.preventDefault();
    });

    $("#modal-alx-criteria").click(function (e) {
        if ($(e.target).closest("#modal-alx-criteria-content").length === 0) {
            $("#modal-alx-criteria").addClass("hidden");
        }
    });

    $('body').on('click', '.candidate-alx-status', function (e) {
        e.preventDefault();
        $("#modal-alx-criteria-content").html("");
        $("#modal-alx-criteria-content").html("<div class='text-center'><img class='w-c-5' src='/assets/images/loading.gif'></div>");
        $("#modal-alx-criteria-content").load($(this).attr('href'));
        $("#modal-alx-criteria").modal('show');
    });

    $('body').on('click', '.add-notes', function (e) {
        $(".modal-content").html($('#addnote').html());
        $(".modal").modal('show');
        e.preventDefault();
    });
    $('body').on('click', '#candidates .bookings-edit, #sms .bookings-edit, #bookings .bookings-edit, .reengage.bookings-edit, .load-eclipse.bookings-edit', function (e) {
        $(".modal-content").load($(this).attr('href'));
        $(".modal").modal('show');
        e.preventDefault();
    });

    // for react js page
    $('body').on('click', '.candidate-alx-status', function (e) {
        $('.ui.dropdown').dropdown();
    });

    //for other page
    $('.ui.dropdown').dropdown();

    //Jump to select list in calendar
    var outerDivPos;
    var scrolltoid;
    var divTop;
    var scrollVal;

    $('body').on('change', 'select#jumpto-candidate', function () {

        outerDivPos = $('.fixedTable-body').offset().top;
        scrolltoid = "#candidate" + this.value;
        divTop = $(scrolltoid).offset().top;
        scrollVal = divTop - outerDivPos;
        $('.fixedTable-body').animate({scrollTop: '+=' + scrollVal}, 200);
        //code
    });


    var availability_id; //global var so that if they add an availability, we can also delete it without refreshing
    var booking_id; //global var so that if they add a booking, we can reuse on right click menu
    var booking_sha1; //global var so that if they add a booking, we can reuse on right click menu
    var current_status; //global var so that if they add a booking, we can reuse on right click menu
    var hospital_id; //global var so that if they add a booking, we can reuse on right click menu

    //Right Click context menu (JQuery UI)
    /*$(".context-menu").menu();*/

    $('body').on('contextmenu taphold', '.booking-status', function (e) {
        $(".context-menu").hide();

        //get the data parameters from the calendar td to push into the menu to reduce code

        booking_id = $(this).attr('data-booking_id');
        booking_sha1 = $(this).attr('data-booking_sha1');

        var candidate_sha1 = $(this).data('candidate_sha1');
        var is_block_dates = $(this).data('is_block_dates');
        var date = $(this).data('date');

        current_status = $(this).attr('data-current_status');

        hospital_id = $(this).data('hospital_id');

        $('.tooltip').easyTooltip();

        var page_url_edit = $('#page_url_edit').val();
        var redirect = $('#redirect').val();

        var menu_html = '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="3" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="0">Confirm booking?</a></div></li>';

        if (hospital_id > 0) {
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="3" data-candidate_email="1" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="0">Confirm booking & notify candidate?</a></div></li>';
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="3" data-candidate_email="1" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="send-whatsapps" data-cancelled_by="0">WhatsApp booking info</a></div></li>';
        }

        menu_html += '<li class="menu-divider"><div>-</div></li>';
        menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="3" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="1" class="status_update_context" data-cancelled_by="0">Confirm break glass booking?</a></div></li>';

        if (hospital_id > 0) {
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="3" data-candidate_email="1" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="1" class="status_update_context" data-cancelled_by="0">Confirm break glass & notify candidate?</a></div></li>';
        }

        if (hospital_id > 0) {
            menu_html += '<li class="menu-divider"><div>-</div></li>';
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="4" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="1">Cancelled by candidate</a></div></li>';
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="4" data-candidate_email="1" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="1">Cancelled by candidate & notify candidate?</a></div></li>';
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="4" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="2">Cancelled by client</a></div></li>';
            menu_html += '<li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="4" data-candidate_email="1" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-is_escalated="0" class="status_update_context" data-cancelled_by="2">Cancelled by client & notify candidate?</a></div></li>';
        }


        menu_html += '<li class="menu-divider"><div>-</div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="7" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" class="status_update_context" data-cancelled_by="0">Timesheet received?</a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="11" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" class="status_update_context" data-cancelled_by="0">Timesheet dropped?</a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="8" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" class="status_update_context" data-cancelled_by="0">Timesheet processed?</a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="9" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" class="status_update_context" data-cancelled_by="0">Timesheet rejected?</a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_sha1="' + booking_sha1 + '" class="request-timesheet">Request timesheet?</a></div></li>\
            <li class="menu-divider"><div>-</div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_status="12" data-candidate_email="0" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" class="status_update_context" data-cancelled_by="0">Did Not Attend (DNA)</a></div></li>\
            <li class="menu-divider"><div>-</div></li>\
            <li><div><a href="' + page_url_edit + '' + booking_id + '?redirect=' + redirect + ' "data-booking_id="' + booking_id + '" class="bookings-edit-click" style="color: #000000">Edit booking?</a></div></li>\
            <li><div><a href="' + page_url_edit + '' + booking_id + '?do=duplicate&redirect=' + redirect + '" data-booking=' + booking_id + ' class="bookings-edit" style="color: #000000">Duplicate booking?</a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="' + booking_id + '" data-booking_sha1="' + booking_sha1 + '" data-current_status="' + current_status + '" data-deleted_by="0" class="status_delete_context">Delete booking?</a></div></li>\
            <li><div><a href="/dashboard/bookings-multi-delete?candidate_sha1=' + candidate_sha1 + '&date_start=' + date + '" target="_blank">Bulk Delete...</a></div></li>';

        //basically, if a booking exists and is a block booking, then so the option to basically intercept an adhoc booking inbetween BUT dont break the block booking date range

        if (booking_id > 0 && is_block_dates == 1) {
            menu_html += '<li class="menu-divider"><div>-</div></li>\
                <li><div><a href="' + page_url_edit + '0?modal=1&candidate_sha1=' + candidate_sha1 + '&date_start=' + date + '&is_adhoc_booking=1&adhoc_booking_parent_id=' + booking_id + '&redirect=' + redirect + '" class="bookings-edit">Interrupt booking on this date?</a></div></li>';
        }

        $(this).find(".context-menu").html(menu_html);
        $(this).find(".context-menu").show();

        var x = e.pageX - $(this).offset().left;
        var y = e.pageY - $(this).offset().top;

        $(this).find(".context-menu").css({left: x, top: y});

        e.preventDefault();
        e.stopPropagation();
    });

    $('body').on('click', '.bookings-edit-click', function (e) {
        e.preventDefault();
        var booking_id = this.getAttribute('data-booking_id');
        var id = "a[data-mode='" + booking_id + "']";
        $(id)[0].click();
    });

    $('body').on('click', '.context-menu', function (e) {
        $(".context-menu").hide();
        e.stopPropagation();
    });

    $('body').on('click', document, function () {
        $(".context-menu").hide();
    });

    /*
    so I changed it to say on an event that its after dom change or already exists do something but its not working for when it already exists.
    i thought maybe another eye, you could spot somethign stupid i did.
    SO this code does both? New and exisitng ? new only, existing is buggered.
    Where? Yeah so there's no other code I mean, it's all in this function? ans phone
    */

    $('body, .context-menu').on('click', '.status_update_context', function () {
        var t = $(this);

        var booking_status = t.data('booking_status');
        var candidate_email = t.data('candidate_email');
        var booking_id = t.data('booking_id');
        var booking_sha1 = t.data('booking_sha1');
        var current_status = t.data('current_status');
        var is_escalated = t.data('is_escalated');
        var cancelled_by = t.data('cancelled_by');

        var candidate_email_icon = '';
        if (candidate_email == 1) {
            if (!confirm('An SMS will be sent with this request.')) {
                candidate_email_icon = '';
                return false;
            }

            candidate_email_icon = '<i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;';
        }

        $.ajax({
            type: 'POST',
            url: '/dashboard/bookings-edit/' + booking_id,
            dataType: 'json',
            data: {
                'do': 'update-status',
                'booking_status': booking_status,
                'candidate_email': candidate_email,
                'is_escalated': is_escalated,
                'cancelled_by': cancelled_by,
                'is_json': 1
            },
            success: function (data) {
                //get the style_css to update the colour
                var style_status = data.style_status;

                //previous style
                var previous_style_status = data.previous_style_status;

                switch (data.booking.booking_status) {
                    //if its timesheet related status, show the timesheet title
                    case "7":
                    case "8":
                    case "9":
                    case "11":
                    case "12":
                        var status_title = data.status;
                    break;
                    default:
                        //get the hospital abbr, if set
                        var status_title = (data.booking.hospital_id > 0) ? data.hospital.eclipse_abbr : "";
                        //status_title += (data.booking.hospital_id > 0) ? '<br>' + data.booking.ward : "";
                    break;
                }

                //find the class where booking_sha1 is found and add in the new class
                $('.' + data.booking.booking_sha1).removeClass(previous_style_status).removeClass(previous_style_status + '_weekend').removeClass('is_escalated').addClass(style_status);

                //if escalated
                if (data.booking.is_escalated == "1") 
                {
                    $('.' + data.booking.booking_sha1).addClass('is_escalated');
                    candidate_email_icon += '<i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;';
                }

                if(data.booking.eclipse_contract_ref != '' && data.booking.eclipse_contract_ref !== null)
                {
                    candidate_email_icon += '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
                }
                candidate_email_icon += '<br />';

               // console.log(data.booking.eclipse_contract_ref);

                $('.' + data.booking.booking_sha1).attr('data-current_status', style_status);
                $('.' + data.booking.booking_sha1).children('a').html(candidate_email_icon + status_title); //+data.status
            }
        });
    });

    $('body, .context-menu').on('click', '.status_delete_context', function () {
        var t = $(this);

        var booking_id = t.data('booking_id');
        var booking_sha1 = t.data('booking_sha1');
        var current_status = t.attr('data-current_status');

        if (confirm('Are you sure you want to delete this booking?')) {
            $.ajax({
                type: 'get',
                url: '/dashboard/bookings-edit/' + booking_id + '?do=delete-booking&is_json=1',
                /*dataType: 'json',
                data: { 'do': 'update-status', 'booking_status': booking_status, 'candidate_email': candidate_email, 'is_json': 1 },*/
                success: function (data) {
                    //console.log(data);
                    //find the class where booking_sha1 is found and add in the new class
                    //$('.' + booking_sha1).removeClass(current_status).removeClass(current_status + '_weekend').removeClass('is_escalated'); //.addClass('booking-status');
                    //$('.' + booking_sha1).html('<a href="javascript:;" class="tooltip" data-title="Please reload the page to add a booking!"><i class="fa fa-plus"></i></a><ul class="context-menu-availability ui-menu ui-widget ui-widget-content ui-corner-all"></ul>'); //<ul class="context-menu-availability ui-menu ui-widget ui-widget-content ui-corner-all"></ul>

                    /*console.log(data);
                    console.log(data.availability.length);
                    console.log(data.availability[0].availability_id);*/

                    //check to see if there is any availability found after this booking was deleted
                    var availability_count = data.availability.length;
                    if(availability_count == 1)
                    {
                        //find the class where booking_sha1 is found and add in the new class
                        $('.'+booking_sha1).removeClass(current_status).removeClass(current_status+'_weekend').removeClass('is_escalated'); //.addClass('booking-status');
                        $('.'+booking_sha1).attr('data-availability_id', data.availability[0].availability_id);
                        $('.'+booking_sha1).html('<div class="candidate_availability '+data.availability[0].class_styles_candidate+' '+data.availability[0].added_by_candidate+' '+data.availability[0].class_styles_breakglass+' '+data.availability[0].class_styles_holiday+'"><span><span>'+data.availability[0].shift_type_abbr+'</span></span></div><ul class="context-menu-availability ui-menu ui-widget ui-widget-content ui-corner-all"></ul>');
                    }
                    else
                    {
                        //find the class where booking_sha1 is found and add in the new class
                        $('.'+booking_sha1).removeClass(current_status).removeClass(current_status+'_weekend').removeClass('is_escalated'); //.addClass('booking-status');
                        $('.'+booking_sha1).html('<a href="javascript:;" class="tooltip" title="Please reload the page to add a booking!"><i class="fa fa-plus"></i></a><ul class="context-menu-availability ui-menu ui-widget ui-widget-content ui-corner-all"></ul>'); //<ul class="context-menu-availability ui-menu ui-widget ui-widget-content ui-corner-all"></ul>
                    }
                }
            });
        }
        $(".context-menu").hide();
        return false;
    });

    $('body, .context-menu-availability').on('click', '.quick_register_context', function () {
        var t = $(this);
        var booking_status = t.data('booking_status');
        var candidate_id = t.data('candidate_id');
        var booking_id = t.data('booking_id');
        var booking_sha1 = t.data('booking_sha1');
        var current_status = t.data('current_status');
        var date = t.data('date');
        var hospital_id = t.data('hospital_id');
        var is_escalated = t.data('is_escalated');
        var page_url_edit = $('#page_url_edit').val();
        var redirect = $('#redirect').val();

        $.ajax({
            type: 'POST',
            url: '/dashboard/bookings-edit/' + booking_id,
            dataType: 'json',
            data: {
                'do': 'quick-booking',
                'booking_status': booking_status,
                'candidate_id': candidate_id,
                'date_start': date,
                'date_end': date,
                'hospital_id': hospital_id,
                'is_escalated': is_escalated,
                'is_json': 1
            },
            success: function (data) {

                //set the booking id
                booking_id = data.booking.booking_id;
                booking_sha1 = data.booking.booking_sha1;

                //as there is no booking, try and td against this where the candidate_id and date is set
                var td_el = $('.booking-status[data-date="' + date + '"][data-candidate_id="' + candidate_id + '"]');
                td_el.addClass(data.style_status);
                td_el.addClass(booking_sha1);

                var is_escalated_icon = '';
                if (data.booking.is_escalated == "1") {
                    td_el.addClass('is_escalated');
                    is_escalated_icon = '<i class="fa fa-bolt" aria-hidden="true"></i><br />';
                }

                //get the hospital abbr, if set
                var status_title = (data.hospital.eclipse_abbr != null) ? data.hospital.eclipse_abbr : "";

                td_el.html('<a href="/dashboard/bookings-edit/' + data.booking.booking_id + '?redirect=' + redirect + '" data-mode="' + data.booking.booking_id + '" title="Click to modify this booking?" class="bookings-edit tooltip">' + is_escalated_icon + status_title + '</a><ul class="context-menu ui-menu ui-widget ui-widget-content ui-corner-all"></ul>'); //'+data.status+'

                td_el.attr('data-booking_id', data.booking.booking_id);
                td_el.attr('data-booking_sha1', data.booking.booking_sha1);
                td_el.attr('data-current_status', data.style_status);
            }
        });
    });

    //Right Click context menu (JQuery UI)
   // $(".context-menu-availability").menu();

    $('body').on('contextmenu taphold', '.booking-status', function (e) {
        $(".context-menu-availability").hide();

        //get the data parameters from the calendar td to push into the menu to reduce code
        var date = $(this).data('date');
        var candidate_id = $(this).data('candidate_id');
        var candidate_availability_css = $(this).data('candidate_availability_css');
        //availability_id = $(this).data('availability_id');
        availability_id = $(this).attr('data-availability_id');
        var availability_delete_block_booking = $(this).data('availability_delete_block_booking');
        var hospital_id = $(this).data('hospital_id');
        var page_url_edit = $('#page_url_edit').val();
        var redirect = $('#redirect').val();

        var menu_html = '\
            <li><div><a href="javascript:;" data-booking_id="0" data-booking_status="3" data-candidate_email="0" data-is_escalated="0" data-booking_sha1="" data-current_status="" class="quick_register_context" data-date="' + date + '" data-candidate_id="' + candidate_id + '" data-hospital_id="' + hospital_id + '" data-redirect="' + redirect + '" style="font-size: 11px;"><strong>Quick Book (Confirmed)</strong></a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="0" data-booking_status="3" data-candidate_email="0" data-is_escalated="1" data-booking_sha1="" data-current_status="" class="quick_register_context" data-date="' + date + '" data-candidate_id="' + candidate_id + '" data-hospital_id="' + hospital_id + '" data-redirect="' + redirect + '" style="font-size: 11px;"><strong>Quick Book (Break Glass)</strong></a></div></li>\
            <li><div><a href="javascript:;" data-booking_id="0" data-booking_status="1" data-candidate_email="0" data-is_escalated="0" data-booking_sha1="" data-current_status="" class="quick_register_context" data-date="' + date + '" data-candidate_id="' + candidate_id + '" data-hospital_id="' + hospital_id + '" data-redirect="' + redirect + '" style="font-size: 11px;"><strong>Quick Book (Pending)</strong></a></div></li>\
            <li class="menu-divider"><div>-</div></li>\
            <li><div><a href="/dashboard/bookings-edit-reoccuring/0?date_start=' + date + '&candidate_id=' + candidate_id + '&redirect=' + redirect + '&is_availability=0" class="bookings-edit" style="color: #000000; font-size: 11px;"><strong>Re-Occuring Booking</strong></a></div></li>\
            <li><div><a href="/dashboard/bookings-edit-reoccuring/0?date_start=' + date + '&candidate_id=' + candidate_id + '&redirect=' + redirect + '&is_availability=1" class="bookings-edit" style="color: #000000; font-size: 11px;"><strong>Re-Occuring Availability</strong></a></div></li>\
            <li class="menu-divider"><div>-</div></li>\
            <li><div style="margin-left: 10px; font-size: 11px;">Quick Set Availability</div></li>\
            <li><div><a href="javascript:;" data-booking_status="6" data-shift_type="SELF ISOLATION" data-candidate_availability_css="'+candidate_availability_css+'" data-candidate_id="'+candidate_id+'" data-date="'+date+'" data-adhoc_booking_parent_id="'+availability_id+'" class="availability_update_context">Self Isolation</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="ANY" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Any</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="ALL DAY" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Day</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="LONG DAY" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Long Day</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="EARLY" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Early</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="LATE" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Late</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="NIGHT" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Night</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="TWILIGHT" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Twilight</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="BREAK GLASS" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Break Glass</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="6" data-shift_type="" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Unavailable</a></div></li>\
            <li><div><a href="javascript:;" data-booking_status="5" data-shift_type="HOLIDAY" data-candidate_availability_css="' + candidate_availability_css + '" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context">Holiday</a></div></li>\
            ';

        //if its a block booking, then dont show remove button as pressing remove, will delete the whole booking
        if (availability_delete_block_booking == 1) {
            //removes the whole block booking
            menu_html += '<li class="menu-divider"><div>-</div></li>\
                <li><div><a href="javascript:;" data-booking_status="remove-block-booking" data-shift_type="" data-candidate_availability_css="" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-availability_id="' + availability_id + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context"><strong>Remove Block Booking</strong></a></div></li>';
        } else if (availability_id > 0) {
            //individual day
            menu_html += '<li class="menu-divider"><div>-</div></li>\
                <li><div><a href="javascript:;" data-booking_status="remove" data-shift_type="" data-candidate_availability_css="" data-candidate_id="' + candidate_id + '" data-date="' + date + '" data-availability_id="' + availability_id + '" data-adhoc_booking_parent_id="' + availability_id + '" class="availability_update_context"><strong>Remove</strong></a></div></li>';
        }

        $(this).find(".context-menu-availability").html(menu_html);
        $(this).find(".context-menu-availability").show();
        var x = e.pageX - $(this).offset().left;
        var y = e.pageY - $(this).offset().top;
        $(this).find(".context-menu-availability").css({left: x, top: y});
        e.preventDefault();
        e.stopPropagation();
    });

    //prep the message to send via whatsapps
    $('body, .context-menu').on('click', '.send-whatsapps', function (e) {
        var t = $(this);

        var booking_status = t.data('booking_status');
        var candidate_email = t.data('candidate_email');
        var booking_id = t.data('booking_id');
        var booking_sha1 = t.data('booking_sha1');
        var current_status = t.data('current_status');
        var is_escalated = t.data('is_escalated');
        var cancelled_by = t.data('cancelled_by');

        var candidate_email_icon = '';

        if (candidate_email == 1) {
            if (!confirm('Are you sure you want to WhatsApp this candidate?')) {
                return false;
            }
        }

        $.ajax({
            type: 'POST',
            url: '/dashboard/bookings-edit/' + booking_id,
            dataType: 'json',
            data: {'do': 'get-whatsapp-message', 'is_json': 1},
            success: function (data) {
                //console.log(data);
                window.open('https://wa.me/' + data.mobile + '&text=' + data.message + '', 'whatsapp');
                return true;
            }
        });
    });

    $('body').on('click', '.context-menu-availability', function (e) {
        $(".context-menu-availability").hide();
        e.stopPropagation();
    });

    $('body').on('click', document, function (e) {
        $(".context-menu-availability").hide();
    });

    $('body, .context-menu-availability').on('click', '.availability_update_context', function () {
        var t = $(this);
        var booking_status = t.data('booking_status');
        var shift_type = t.data('shift_type');
        var candidate_id = t.data('candidate_id');
        var candidate_availability_css = t.data('candidate_availability_css');
        var adhoc_booking_parent_id = t.data('adhoc_booking_parent_id');
        var date = t.data('date');

        $.ajax({
            type: 'POST',
            url: '/dashboard/bookings-edit/0',
            dataType: 'json',
            data: {
                'do': 'update-availability-status',
                'booking_status': booking_status,
                'shift_type': shift_type,
                'candidate_id': candidate_id,
                'date': date,
                'is_json': 1,
                'adhoc_booking_parent_id': adhoc_booking_parent_id
            },
            success: function (data) {

                switch (data.booking_status) {
                    case "5":
                        var booking_status_css = 'css_available';
                    break;
                    case "6":
                        switch(data.shift_type)
                        {
                            case 'SELF ISOLATION':
                                var booking_status_css = 'css_unavailable self-isolation';
                                data.shift_type = 'UN';
                            break;
                            default:
                                var booking_status_css = 'css_unavailable';
                                data.shift_type = 'UN';
                                data.shift_type_abbr = 'U';
                            break;
                        }
                    break;
                }

                //as there is no booking, try and td against this where the candidate_id and date is set
                var td_el = $('.booking-status[data-date="' + data.date + '"][data-candidate_id="' + data.candidate_id + '"]');

                if (data.booking_status == 'remove-block-booking') {
                    setInterval(function () {
                        window.location.reload();
                    }, 5000);
                    //if its a block booking item, reload the page
                }

                //if its break glass, add in the break-glass class
                var css_break_glass = (data.shift_type_abbr == 'BG') ? 'break-glass' : "";
                var css_holiday = (data.shift_type_abbr == 'H') ? 'holiday' : "";

                if ((data.booking_status != 'remove') && (data.booking_status != 'remove-block-booking')) {
                    td_el.append('<div class="candidate_availability ' + booking_status_css + ' ' + css_break_glass + ' ' + css_holiday + '"><span><span>' + data.shift_type_abbr + '</span></span></div>');
                    td_el.attr('data-availability_id', data.availability_id);
                    availability_id = data.availability_id;
                } else {
                    //if booking_status == remove
                    td_el.children().remove('div.candidate_availability');
                    td_el.attr('data-availability_id', 0);
                    availability_id = 0;
                }
            }
        });
    });

    $('body, .context-menu').on('click', '.request-timesheet', function () {
        if (confirm('Are you sure you want to request timesheet? A SMS will be sent!')) {
            var booking_id = $(this).data('booking_id');
            var booking_sha1 = $(this).data('booking_sha1');

            $.ajax({
                type: 'POST',
                url: '/dashboard/bookings-edit/' + booking_id,
                dataType: 'json',
                data: {'do': 'update-timesheet', 'is_json': 1},
                success: function (data) {
                    Notification.create(
                        // Title
                        'Request Timesheet SMS Notification',
                        // Text
                        'You have sent an timesheet request to ' + data.candidate.eclipse_firstname + ' ' + data.candidate.eclipse_lastname + '.',
                        // Illustration
                        null,
                        // Effect
                        'bounceIn',
                        // Position
                        4,
                        //delay in secs
                        4
                    );
                }
            });
        }
        return false;
    });

    $('body').on('click', '.candidate-alx-document-pack', function () {
        if (confirm('Are you sure you want to request the ALX Document Pack?')) {
            $("#loading").show();

            var candidate_id = $(this).data('candidate_id');

            $.ajax({
                type: 'POST',
                url: '/dashboard/candidates-alx-status/' + candidate_id + '',
                dataType: 'json',
                data: {'do': 'request-pack', 'is_json': 1},
                success: function (data) {
                    $("#loading").hide();

                    if (data.status == 'success') {
                        var text = 'You have sent a request for a Document Pack from ALX for ' + data.candidate.eclipse_firstname + ' ' + data.candidate.eclipse_lastname + '. Please monitor your Inbox for your documents!';
                    } else {
                        var text = data.message;
                    }

                    Notification.create(
                        // Title
                        'Document Pack from ALX',
                        // Text
                        text,
                        // Illustration
                        null,
                        // Effect
                        'bounceIn',
                        // Position
                        4,
                        //delay in secs
                        4
                    );
                }
            });
        }
        return false;
    });

    $('body').on('click', '.candidate-archive-request', function () {
        if (confirm('Are you sure you want to remove this candidate?\nThis will make your candidate \'Pre-screened\' in Eclipse and \'In-active\' in ALX.\nIf this action is not required, please speak to your compliance officer!')) {
            $("#loading").show();

            var candidate_id = $(this).data('candidate_id');

            $.ajax({
                type: 'POST',
                url: '/dashboard/reengage-candidate/' + candidate_id + '',
                dataType: 'json',
                data: {'do': 'start-archive', 'is_json': 1},
                success: function (data) {
                    $("#loading").hide();

                    if (data.status == 'success') {
                        var text = 'Your request to remove candidate ' + data.candidate.eclipse_firstname + ' ' + data.candidate.eclipse_lastname + ' has been submitted.';
                    } else {
                        var text = data.message;
                    }

                    Notification.create(
                        // Title
                        'Candidate Removal Request',
                        // Text
                        text,
                        // Illustration
                        null,
                        // Effect
                        'bounceIn',
                        // Position
                        4,
                        //delay in secs
                        4
                    );

                    setTimeout(function () 
                    {
						$('.modal').hide();
						//window.location.href = window.location.href;
					}, 2000);
                }
            });
        }
        return false;
    });

    $('body').on('click', '.request-idbadge', function(e) {
        e.preventDefault();
        $("#candidateloadcontent").html("");
        $("#candidateloadcontent").html("<div class='text-center'><img class='w-c-5' src='/assets/images/loading.gif'></div>");
        $('#candidateloadcontent').load($(this).attr('href'));
        $('#candidateloadmodal').modal('show');
        fetch_date_picker('date-picker');
    });
    $('body').on('click', '.ftw-info', function(e) {
        $('.modal-content').load($(this).attr('href'));
        $(".modal").modal('show');
        e.preventDefault();
    });
    $('body').on('click', '.policecheck-info', function(e) {
        e.preventDefault();
        $("#candidateloadcontent").html("");
        $("#candidateloadcontent").html("<div class='text-center'><img class='w-c-5' src='/assets/images/loading.gif'></div>");
        $('#candidateloadcontent').load($(this).attr('href'));
        $('#candidateloadmodal').modal('show');
    });
    $('body').on('click', '.influenza-info', function(e) {
        e.preventDefault();
        $("#candidateloadcontent").html("");
        $("#candidateloadcontent").html("<div class='text-center'><img class='w-c-5' src='/assets/images/loading.gif'></div>");
        $('#candidateloadcontent').load($(this).attr('href'));
        $('#candidateloadmodal').modal('show');
    });
});

/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
    var ua = window.navigator.userAgent;

    // Test values; Uncomment to check result Ã¢â‚¬Â¦

    // IE 10
    // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';

    // IE 11
    // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';

    // Edge 12 (Spartan)
    // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';

    // Edge 13
    // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}

$(window).bind("load", function () {
    $("#loading").hide();
});