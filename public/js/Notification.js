$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log((window.location.pathname).replace('/',""));
    let currentRoute = (window.location.pathname).replace('/',"");
    countNotifications();
    if(currentRoute === "dashboard"){
        dashboardData();
        fetchPendingInterviewsData();
    }
    function dashboardData() {
        $.ajax({
            type: "get",
            url: "/dashboard-data",
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    let data = response.data;
                    $('.global-interviews-count').text(data.globalInterviews);
                    $('.attempted-interviews-count').text(data.userAttempted);
                    $('.user-interviews-count').text(data.userInterviews);
                    $('.pending-interviews-count').text(data.userPending);
                    //     $('.countNotify').hide();
                    //     // $('.count-div').hide();
                }
                // else {
                //     $('.count').text('You have '+response+' new notifications');
                //     $('.countNotify').show();
                // }
            }
        });
    }

    function countNotifications() {
        let u_id = $('#user_id').val();
        $.ajax({
            type: "get",
            url: "/get_count_value",
            data: {
                u_id: u_id
            },
            dataType: "json",
            success: function (response) {
                // console.log(response,"response");
                if (response == 0) {
                    $('.count').text('No new notifications');
                    $('.countNotify').hide();
                    // $('.count-div').hide();
                }
                else {
                    $('.count').text('You have ' + response + ' new notifications');
                    $('.countNotify').show();
                }
            }
        });
    }

    //Function for fetch pending interviews data for dashboard
    function fetchPendingInterviewsData() {
        let u_id = $('#user_id').val();
        $.ajax({
            type: "put",
            url: "/notification/" + u_id,
            success: function (response) {

                console.log(response);
                let dashboard_pending_Interviews_data = "<span> ";

                if ((response.notification.length) == 0) {
                    $('#pending-interviews-data').html('No pending interviews');
                } else {
                    $.each(response.notification, function (key, value) {
                        if (value.status == 'P') {
                            dashboard_pending_Interviews_data += `<a class="dropdown-item preview-item py-3 notify-preview2" data-id= "` + value.id + `" data-type="` + value.type + `" href="#" id="start_quiz">
                                <div class="preview-thumbnail">
                                <i class="mdi mdi-alert m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Interview Pending</h6>
                                <p class="fw-light small-text mb-0"> `+ value.block_name + `</p>
                                </div>
                            </a>`;
                            // dashboard_pending_Interviews_data += '<p><a class="notification_design" data-id= "' + value.id + '" data-type="' + value.type + '" href="#" id="start_quiz">Pending ' + value.block_name + '</a></p><hr>';
                        } else if (value.status == 'I') {
                            dashboard_pending_Interviews_data += `<a class="dropdown-item preview-item py-3 notify-preview2" data-id= "` + value.id + `" data-type="` + value.type + `" href="#" id="start_quiz">
                                <div class="preview-thumbnail">
                                <i class="mdi mdi-airballoon m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Interview Initiated</h6>
                                <p class="fw-light small-text mb-0"> `+ value.block_name + ` </p>
                                </div>
                            </a>`;
                            // notification_data += '<p><a class="notification_design" data-id= "' + value.id + '" data-type="' + value.type + '" href="#" id="start_quiz"><b>Initiated </b> ' + value.block_name + '</a></p><hr>';
                        }

                    });
                    dashboard_pending_Interviews_data += '</span>';
                    $('#pending-interviews-data').html(dashboard_pending_Interviews_data);


                }

            }
        });

    }

    $('#notificationDropdown').click(function () {
        let u_id = $('#user_id').val();
        // $('.count').hide();
        $('.countNotify').hide();

        $('.notify-preview').remove();
        $.ajax({
            type: "put",
            url: "/notification/" + u_id,
            success: function (response) {

                console.log(response);
                var notification_data = "<span> ";
                // var dashboard_pending_Interviews_data = "<span> ";

                if ((response.notification.length) == 0) {
                    $('#exampleModal').modal('hide');

                } else {
                    $('#exampleModal').modal('show');
                    $('.modal-backdrop').removeClass("modal-backdrop");
                    $.each(response.notification, function (key, value) {

                        if (value.status == 'P') {
                            notification_data += `<a class="dropdown-item preview-item py-3 notify-preview" data-id= "` + value.id + `" data-type="` + value.type + `" href="#" id="start_quiz">
                                <div class="preview-thumbnail">
                                <i class="mdi mdi-alert m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Interview Pending</h6>
                                <p class="fw-light small-text mb-0"> `+ value.block_name + `</p>
                                </div>
                            </a>`;
                            // notification_data += '<p><a class="notification_design" data-id= "' + value.id + '" data-type="' + value.type + '" href="#" id="start_quiz">Pending ' + value.block_name + '</a></p><hr>';
                            // dashboard_pending_Interviews_data +=  notification_data;
                        } else if (value.status == 'C') {
                            notification_data += '<p><a class="notification_design" data-aggregate= "' + value.block_aggregate + '" data-feedback="' + value.feedback + '" href="#" id="checked_quiz">Reviwed ' + value.block_name + '</a></p><hr>';
                        }
                        else if (value.status == 'I') {
                            notification_data += `<a class="dropdown-item preview-item py-3 notify-preview" data-id= "` + value.id + `" data-type="` + value.type + `" href="#" id="start_quiz">
                                <div class="preview-thumbnail">
                                <i class="mdi mdi-airballoon m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Interview Initiated</h6>
                                <p class="fw-light small-text mb-0"> `+ value.block_name + ` </p>
                                </div>
                            </a>`;
                            // dashboard_pending_Interviews_data +=  notification_data;
                            // notification_data += '<p><a class="notification_design" data-id= "' + value.id + '" data-type="' + value.type + '" href="#" id="start_quiz"><b>Initiated </b> ' + value.block_name + '</a></p><hr>';
                        }

                    });
                    notification_data += '</span>';
                    // dashboard_pending_Interviews_data += '</span>';
                    $('#notification').append(notification_data);
                    // $('#pending-interviews-data').html(dashboard_pending_Interviews_data);


                }

            }
        });

    });

    

});
