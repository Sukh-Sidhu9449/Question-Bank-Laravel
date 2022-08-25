$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getProfile(){
        $.ajax({
            type: "get",
            url: "/admin/profile/user",
            dataType: "json",
            success: function (response) {
                $.each(response, function (key, value) {
                    $('#profile_name').val(value.name);
                    $('#profile_email').val(value.email);
                    $('#profile_address').val(value.address);
                    // $('#profile_name').val(value.name);
                });

            }
        });
    }
    getProfile();
    // $('#update_adminprofile_form').submit(function (e) {
    //     e.preventDefault();
    //     // alert();
    //     let update_profile= new FormData(document.getElementById("update_adminprofile_form"));
    //     $.ajax({
    //         type: "put",
    //         url: '/admin/profile',
    //         data: update_profile,
    //         processData: false,
    //         contentType: false,
    //         dataType: "JSON",
    //         success: function (response) {
    //             console.log(response);
    //             if (response.status == 200) {
    //                 $('#update_adminprofile_form')[0].reset();
    //                 swal.fire({
    //                     title: "Updated!",
    //                     text: "Profile Updated.",
    //                     type: "success"
    //                 }).then(function () {

    //                     getProfile();

    //                 });
    //             }


    //         }
    //     });


    // });
});
