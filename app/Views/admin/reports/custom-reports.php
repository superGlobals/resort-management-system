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
            <h4 class="page-title">Generate Custom Reports</h4>
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

                <form action="<?= base_url('Reports/show-custom-reports') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Date Start</label>
                            <input type="date" name="start" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Date End</label>
                            <input type="date" name="end" class="form-control" required>
                        </div>
                        <div class="col-md-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="card-body" id="printThis">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Name</th>
                            <th>Customer Name</th>
                            <th>Checkin</th>
                            <th>Checkout</th>
                            <th>Total Bill</th>
                        </tr>
                    </thead>
                   
                   
                    <?php if(isset($_GET['start']) && isset($_GET['end'])): ?>

                        <?php if(count($custom_reports) > 0): ?>
                            <tbody>
                            <?php $id = 1 ?>
                            <?php foreach($custom_reports as $daily):?>
                                <tr>
                                    <td><?= $id++ ?></td>
                                    <td><?= esc(ucwords($daily->room_name)) ?></td>
                                    <td><?= esc(ucwords($daily->name)) ?></td>
                                    <td><?= esc(get_date2($daily->checkin)) ?></td>
                                    <td><?= esc(get_date2($daily->checkout)) ?></td>
                                    <td><i class="fa-solid fa-peso-sign"></i><?= esc(number_format((int)$daily->total_bill)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                        <tfoot >
                            <th colspan="4"> 
                                <td class="fs-5 fw-bold">Total : </td>
                                <td class="fs-5 fw-bold"><span style="text-decoration: underline;"><i class="fa-solid fa-peso-sign"></i> <?= number_format((int)$custom_revenue->custom_revenue) ?></span></td>
                            </th>
                        </tfoot>

                        <?php else: ?>

                            <td colspan="6" class="text-center">No Data Found</td>

                        <?php endif; ?>

                    <?php endif; ?>
                    
                   
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>



<?= $this->endSection() ?>