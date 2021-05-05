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
        <div class="col-lg">
            <div class="flash-data" data-alert="<?= $this->session->flashdata('flash'); ?>"></div>

            <a class="btn btn-primary mb-3 buttonAdd" data-toggle="modal" data-target="#newSubMenuModal"
                data-url="<?= base_url('menu/submenu'); ?>">Add New Submenu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submenu as $sm) : ?>
                    <tr>
                        <td scope="row"><?= $sm['smid']; ?></td>
                        <td><?= $sm['title']; ?></td>
                        <td hidden><?= $sm['id']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
                            <a class="badge badge-success buttonEdit" href="javascript:void(0)"
                                data-url="<?= base_url('menu/submenu'); ?>" data-toggle="modal"
                                data-target="#newSubMenuModal">edit</a>
                            <a class="badge badge-danger buttonDelete"
                                href="<?= base_url('menu/deleteSubMenu/') . $sm['smid']; ?>">delete</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub-menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                <input type="text" name="id" id="id" readonly hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" id="menu_id" name="menu_id">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="icon">
                    </div>
                    <div class="form-group text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" type="text" name="is_active" id="is_active"
                                checked onchange="$(this).val(this.checked ? 1 : 0);" value='1'>
                            <label class="form-check-label" for="is_active"> Active? </label>
                        </div>
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
$this->load->view('menu/script_submenu');
?>