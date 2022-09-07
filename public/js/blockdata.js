$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#show_block_data').hide();
    $('#load_users_list').hide();
    $(document).on('click','#show_block_btn',function(){
        let block_id=$(this).data('id');
        $('#show_block_data').show();
        $('#show_blocks').hide();
        $("#block_table > tbody").empty();
        // console.log(block_id);
        $.ajax({
            type: "get",
            url: "/admin/blocks/"+block_id,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if(response.status==200){
                    let i = 1;
                    var block_questions = "";
                    $.each(response.block, function (key, value) {
                        block_questions += `<tr>
                                            <td>`+ i + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        i++;

                    });
                    $('#block_table').append(block_questions);
                    $("#block_table > tfoot").empty();
                    $("#block_table > tfoot").html('<button type="button" id="assign_users_btn" data-id="'+block_id+'" class="btn btn-info"><i class="fa-solid fa-eye"></i>&nbsp;Assign</button>');

                }else
                if (response.status == 404) {
                    // $('#pageloader_quiz_button').hide();
                    // $("#users_detail_table > tbody").empty();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No record Found!',
                        timer: 1000
                      })
                    // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                }

            }
        });
    });
    var users_count=0;
    $(document).on('click', '#assign_users_btn', function (e) {
        e.preventDefault();
        $('#load_users_list').show();
        $('#show_block_data').hide();
        $('#show_blocks').hide();
        let block_id = $(this).data('id');
        let limit = $('#users_page_limit').find(":selected").text();
        // console.log(limit);
        $("#users_detail_table > tbody").empty();
        users_count = 0;
        $.ajax({
            type: "get",
            url: "/admin/blockusers",
            data: {
                limit: limit,
                users_count: users_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = 1;
                    var users_data = "";
                    $.each(response.users, function (key, value) {
                        users_data += `<tr>
                                            <td><input type="checkbox" class="get_value" data-id="`+ value.id + `"></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.name + `</td>
                                            <td>`+ value.email + `</td>
                                         </tr>`;
                        i++;
                    });
                    $('#users_detail_table').append(users_data);
                    $("#users_detail_table > tfoot").html(`<tr>
                    <td colspan="2">
                        <input type="checkbox" id="select-all"><span>&nbsp;&nbsp;&nbsp;&nbsp; Select All</span>
                    </td>
                    <td colspan="2">
                        <form>
                        <button id="assign_block" data-id="`+block_id+`"type="submit" class="btn btn-primary">Assign Block</button>
                        </form>
                    </td>
                </tr>`);
                    // $('#pageloader_quiz_button').show();
                    if (response.users.length == limit) {
                        $('#pageloader_quiz_button').show();
                    } else {
                        $('#pageloader_quiz_button').hide();
                    }
                }
                else
                    if (response.status == 404) {
                        $('#pageloader_quiz_button').hide();
                        $("#users_detail_table > tbody").empty();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                            timer: 1000
                          })
                        // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                    }
            }
        });

    });


    $(document).on('click','#assign_block', function (e) {
        e.preventDefault();
        let block_id=$(this).data('id');
        // console.log(block_id);
        var user_id = [];
        $(':checkbox').each(function () {
            if ($(this).is(":checked")) {
                user_id.push($(this).data('id'));
            }
        });
        user_id=user_id.toString();
        // console.log(user_id);
        $.ajax({
            type: "post",
            url: "/admin/asssignblock",
            data: {
                user_id:user_id,
                block_id:block_id
            },
            dataType: "json",
            success: function (response) {
                if(response.status==200){
                    swal.fire({
                        title: "Block Assigned!",
                        text: "Block Assigned Successfully.",
                        icon:'success',
                        timer: 1000
                    }).then(function () {
                        location.reload(true);
                    });
                }else if(response.status==404){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        timer: 1000
                      })
                }
            }
        });
    });

});
