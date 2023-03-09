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
            <h4 class="page-title">Generate Reports</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-dark btn-border btn-round btn-sm float-end" onclick="printDiv('printThis')">
                    <i class="fa fa-print"></i>
                    Print List
                </button>
            </div>
            <div class="card-body" id="printThis">
                <h4>List of today's event booking</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Events Name</th>
                            <th>Customer Name</th>
                            <th>Date Book</th>
                            <th>Payment Deposit</th>
                        </tr>
                    </thead>
                   
                    <?php if(count($daily_reports) > 0): ?>
                    <tbody>
                        <?php foreach($daily_reports as $daily):?>
                            <tr>
                                <td><?= $daily->unique_id ?></td>
                                <td><?= esc(ucwords($daily->events_name)) ?></td>
                                <td><?= esc(ucwords($daily->name)) ?></td>
                                <td><?= esc(get_date2($daily->date_book)) ?></td>
                                <td><i class="fa-solid fa-peso-sign"></i><?= esc(number_format((int)$daily->payment_deposit)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                    
                    <tfoot >
                        <th colspan="3"> 
                            <td class="fs-5 fw-bold">Total : </td>
                            <td class="fs-5 fw-bold"><span style="text-decoration: underline;"><i class="fa-solid fa-peso-sign"></i> <?= number_format((int)$daily_revenue->daily_revenue) ?></span></td>
                        </th>
                    </tfoot>

                    <?php else: ?>
                        <td colspan="6" class="text-center">No Data Found</td>
                    <?php endif; ?>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>



<?= $this->endSection() ?>