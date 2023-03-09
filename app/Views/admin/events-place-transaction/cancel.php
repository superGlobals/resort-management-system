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
            <h4 class="page-title">List of cancelled events a& place booking </h4>
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
                                <th>Event Place Name</th>
                                <th>Transaction ID</th>
                                <th>Customer Name</th>
                                <th>Date Booked</th>
                                <th>Total Person</th>
                                <th>Total Payment</th>
                                <th>Payment Deposit</th>
                                <th>Gcash Reference #</th>
                                <th>Cancellation Message</th>

                                
                            </tr>
                        </thead>
                        <tbody> 
                            <?php foreach($cancelled as $row): ?>
                                <tr>
                                    
                                    <td><?= esc(ucwords($row->events_name)) ?></td>
                                    <td><?= esc($row->unique_id) ?></td>
                                    <td><?= esc(ucwords($row->name)) ?></td>
                                    <td><?= esc(get_date($row->date_book)) ?></td>
                                    <td><?= esc($row->total_person) ?></td>
                                    <td><?= esc($row->total_bill) ?></td>
                                    <td><?= esc($row->payment_deposit) ?></td>
                                    <td><?= esc($row->gcash_reference_number) ?></td>
                                    <td><?= esc($row->cancellation_message) ?></td>

                                    

                                </tr>
                            <?php endforeach ?>
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
                text:  "User info will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/User/delete/"+id,
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