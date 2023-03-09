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
            <h4 class="page-title">Events places</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Events/add') ?>" class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i> New Events</a>
            </div>
            <div class="card-body">
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                        <div class="table-responsive">
                            <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>Events Name</th>
                                        <th>Capacity</th>
                                        <th>Rate</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($events as $row): ?>
                                        <tr>
                                            <td><img src="<?= base_url() ?>/uploads/<?= $row->images ?>" alt="" width="50" height="50"></td>
                                            <td><?= esc(ucwords($row->events_name)) ?></td>
                                            <td><?= esc($row->max_capacity) ?></td>
                                            <td><?= esc($row->rate) ?></td>
                                            <td>
                                                <a href="<?=base_url()?>/Events/edit/<?= $row->id ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                <button type="button" class="confirm_del btn btn-danger btn-sm" value="<?= $row->id ?>"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>

                            </table> 
                        </div>                                          
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->
                
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
                            url: "<?=base_url()?>/Room/delete/"+id,
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