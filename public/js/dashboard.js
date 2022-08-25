$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "/admin/dashboard-data",
        dataType: "json",
        success: function (response) {
            // console.log(response);
            if(response != null || response != undefined){
                if(response.technologies != null || response.technologies != undefined){
                    $('#technologies_count').html(response.technologies);
                }
                if(response.users != null || response.users != undefined){
                    $('#users_count').html(response.users);
                }
                if(response.questions != null || response.questions != undefined){
                    $('#questions_count').html(response.questions);
                }
            }
        }
    });
});
