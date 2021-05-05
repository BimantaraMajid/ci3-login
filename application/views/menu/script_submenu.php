<script>
window.onload = function() {

    // confirm delete
    $('.buttonDelete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Sub-Menu!",
            icon: "error",
            buttons: [true, "delete!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            }
        });
    });

    // button edit menu name
    $('.buttonEdit').on('click', function() {
        var row = $(this).parents("tr");
        var cols = row.children("td");
        const url = $(this).data('url');
        $('.modal-title').html('Update Sub-Menu');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-content form').attr('action', url);
        $('#submit').val("update");
        $('#id').val($(cols[0]).html());
        $('#menu_id').val($(cols[2]).html());
        $('#title').val($(cols[1]).html());
        $('#url').val($(cols[4]).html());
        $('#icon').val($(cols[5]).html());

        const val_active = $(cols[6]).html();
        $('#is_active').val(val_active);
        $('#is_active').attr('checked', val_active == 1 ? true : false);
    });

    $('.buttonAdd').on('click', function() {
        const url = $(this).data('url');
        $('.modal-title').html('Add New Sub-Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-content form').attr('action', url);
        $('#submit').val("add");
        $('#id').val("");
        $('#menu_id').val("");
        $('#title').val("");
        $('#url').val("");
        $('#icon').val("");
        $('#is_active').attr('checked', false);
        $('#is_active').val(0);
    })

    $('#newSubMenuModal').on('shown.bs.modal', function() {
        $('#menu_id').focus();
    });

};
</script>