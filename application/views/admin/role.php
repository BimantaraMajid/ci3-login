<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="flash-data" data-alert="<?= $this->session->flashdata('flash'); ?>"></div>

            <a class="btn btn-primary mb-3 buttonAdd" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($role as $r) : ?>
                    <tr>
                        <td scope="row"><?= $r['id']; ?></td>
                        <td><?= $r['role']; ?></td>
                        <td>
                            <a class="badge badge-warning"
                                href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">Access</a>
                            <a class="badge badge-success buttonEdit" href="" data-toggle="modal"
                                data-target="#newRoleModal">Edit</a>
                            <a class="badge badge-danger buttonDelete"
                                href="<?= base_url('admin/deleteRole/') . $r['id']; ?>">delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="<?= base_url('admin/role'); ?>">
                <input type="text" name="id" id="id" readonly hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit" id="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    $('#newRoleModal').on('shown.bs.modal', function() {
        $('#role').focus();
    });

    $('.buttonAdd').on('click', function() {
        $('#submit').val('add');
        $('#role').val('');
        $('#id').val('');
    });

    $('.buttonEdit').on('click', function() {
        $('#submit').val('edit');
        var row = $(this).parents('tr');
        var cols = row.children('td');
        $('#id').val($(cols[0]).html());
        $('#role').val($(cols[1]).html());
    });

    $('.buttonDelete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this User Role!",
            icon: "error",
            buttons: [true, "delete!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            }
        });
    });
}
</script>