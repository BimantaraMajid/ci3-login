<script>
window.onload = function() {

    $('.buttonEdit').on('click', function() {
        var row = $(this).parents("tr");
        var cols = row.children("td");
        const url = $('.buttonAdd').data('url');
        $('.modal-title').html('Update Menu');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-content form').attr('action', url);
        $('#submit').val("update");
        $('#id').val($(cols[0]).html());
        $('#menu').val($(cols[1]).html());
    });

    // confirm delete
    $('.buttonDelete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Menu!",
            icon: "error",
            buttons: [true, "delete!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            }
        });
    });

    $('.buttonAdd').on('click', function() {
        const url = $(this).data('url');
        $('.modal-title').html('Add New Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-content form').attr('action', url);
        $('#id').val("");
        $('#menu').val("");
        $('#submit').val("add");
    })

    $('#newMenuModal').on('shown.bs.modal', function() {
        $('#menu').focus();
    });
};
</script>