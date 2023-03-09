<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
 <!-- Start Content-->
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                
            </div>
            <h4 class="page-title">List of Gcash info </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Payment/add') ?>" class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i> New Gcash</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Gcash Qr</th>
                                <th>Gcash Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                           <?php foreach($payments as $row): ?>

                                <tr>
                                    <td><img src="<?= base_url() ?>/uploads/<?= $row->gcash_qr ?>" alt="" width="100" style="height: 100% ;"></td>
                                    <td><?= esc($row->gcash_number) ?></td>
                                    <td>
                                        <?php if($row->status == 'inactive'): ?>
                                            <a href="#gcashStatus<?= $row->id ?>" data-bs-toggle="modal" class="<?= $row->status == 'inactive' ? 'badge bg-danger' : 'badge bg-success' ?>"><?= esc(ucfirst($row->status)) ?></a>
                                        <?php else: ?>
                                            <a class="badge bg-success"><?= esc(ucfirst($row->status)) ?></a>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a href="<?=base_url()?>/Payment/edit/<?= $row->id ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <button type="button" class="confirm_del btn btn-danger btn-sm" value="<?= $row->id ?>"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                                <?php require 'modal.php' ?>
                           <?php endforeach; ?>
                           
                        </tbody>
                    

                    </table> 
                </div>    

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script>
        $(document).ready(function () {
            $('.confirm_del').click(function (e) { 
                e.preventDefault();
                
                let id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn
                Swal.fire({
                title: 'Are you sure?',
                text:  "You want to checkout this?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, checkout'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/checkout-process/"+id,
                            success: function (response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })

                                    Toast.fire({
                                    text: response.status_text,
                                    icon: response.status_icon,
                                }).then((success) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })

            });
        });

        $(document).ready(function () {
            $('.checkout').click(function (e) { 
                e.preventDefault();
                
                let id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn
                Swal.fire({
                title: 'Are you sure?',
                text:  "Room category will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/ReservationTransaction/checkout/"+id,
                            success: function (response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })

                                    Toast.fire({
                                    text: response.status_text,
                                    icon: response.status_icon,
                                }).then((success) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })

            });
        });
    </script>


<?= $this->endSection() ?>