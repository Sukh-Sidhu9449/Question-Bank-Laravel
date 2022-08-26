$(document).ready( function () {
    $('.yajra-datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/admin/users/list",
        "columns": [
            { "data": "id" },
            { "data": "name"},
            { "data": "email"},
            { "data": "role"},
            {"data":"gender"}
        ]
    });
} );

