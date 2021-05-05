<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <div class="flash-data" data-alert="<?= $this->session->flashdata('flash'); ?>"></div>

            <a class="btn btn-primary mb-3 buttonAdd" data-toggle="modal" data-target="#newMenuModal"
                data-url="<?= base_url('menu'); ?>">Add New Menu</a>
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu as $m) : ?>
                    <tr>
                        <td scope="row"><?= $m['id']; ?></td>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <a class="badge badge-success buttonEdit" href="javascript:void(0)"
                                data-url="<?= base_url('menu/editMenu'); ?>" data-toggle="modal"
                                data-target="#newMenuModal">Edit</a>
                            <a class="badge badge-danger buttonDelete"
                                href="<?= base_url('menu/deleteMenu/') . $m['id']; ?>">delete</a>
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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                <input type="text" name="id" id="id" readonly hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit" id="submit" value="add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- script menu -->
<?php
$this->load->view('menu/script_index');
?>