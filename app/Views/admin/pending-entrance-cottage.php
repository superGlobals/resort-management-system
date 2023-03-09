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
            <h4 class="page-title">List of pending rooms reservation </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Room Name</th>
                                <th>Transaction ID</th>
                                <th>Customer Name</th>
                                <th>Date Visit</th>
                                <th>Time Arrival</th>
                                <th>Total Person</th>
                                <th>Payment Method</th>
                                <th>Total Bill</th>
                                <th>Gcash Reference #</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> 

                            <?php foreach($pending_entrance_cottage as $row): ?>
                                <tr>
                                    <td><?= esc(ucwords($row->cottage_name)) ?></td>
                                    <td><?= esc(ucwords($row->unique_id)) ?></td>
                                    <td><?= esc(ucwords($row->name)) ?></td>
                                    <td><?= esc(get_date($row->date_visit)) ?></td>
                                    <td><?= esc($row->time_arrival) ?></td>
                                    <td><?= esc($row->total_person) ?></td>
                                    <td><?= esc($row->total_bill) ?></td>
                                    <td><?= esc($row->gcash_reference_number) ?></td>
                                    <td>
                                        <a href="<?=base_url()?>/accept-room-reservation/<?= $row->id ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Accept</a>
                                        <a href="#reject<?= $row->id ?>" class="confirm_del btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Reject</button>
                                    </td>
                                </tr>
                                
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