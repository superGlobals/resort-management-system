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
            <h4 class="page-title">List of ready to checkout today </h4>
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
                                <th>Room Number</th>
                                <th>Transaction ID</th>
                                <th>Customer Name</th>
                                <th>Date Checkin</th>
                                <th>Date Checkout</th>
                                <th>Total Person</th>
                                <th>Total Payment</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> 

                            <?php foreach($all_checkout as $row): ?>
                                <tr>
                                    <td><?= esc(ucwords($row->room_name)) ?></td>
                                    <td><?= esc(ucwords($row->room_number)) ?></td>
                                    <td><?= esc(ucwords($row->unique_id)) ?></td>
                                    <td><?= esc(ucwords($row->name)) ?></td>
                                    <td><?= esc(get_date($row->checkin)) ?></td>
                                    <td><?= esc(get_date($row->checkout)) ?></td>
                                    <td><?= esc($row->total_person) ?></td>
                                    <td><?= esc(number_format($row->total_bill)) ?></td>
                                    <td><?= $row->payment_status == '' ? "<span class='badge bg-danger'>Not Fully Paid</span>" : "<span class='badge bg-success'>Fully Paid</span>" ?></td>
                                    <td>
                                        
                                        <a href="<?= base_url() ?>/checkout-process/<?= $row->transaction_id ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-cart-shopping"></i> Checkout</a>
                                        <a href="<?= base_url() ?>/room-extend-stay/<?= $row->transaction_id ?>" class="btn btn-primary btn-sm"> Extend Stay</a>
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