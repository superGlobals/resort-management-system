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

                <form action="<?= base_url('Reports-event/show-custom-reports') ?>">
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
                            <th>Transaction ID</th>
                            <th>Events Name</th>
                            <th>Customer Name</th>
                            <th>Date Book</th>
                            <th>Total Bill</th>
                        </tr>
                    </thead>
                   
                   
                    <?php if(isset($_GET['start']) && isset($_GET['end'])): ?>

                        <?php if(count($custom_reports) > 0): ?>
                            <tbody>
                            <?php $id = 1 ?>
                            <?php foreach($custom_reports as $row):?>
                                <tr>
                                    <td><?= $row->unique_id ?></td>
                                    <td><?= esc(ucwords($row->events_name)) ?></td>
                                    <td><?= esc(ucwords($row->name)) ?></td>
                                    <td><?= esc(get_date2($row->date_book)) ?></td>
                                    <td><i class="fa-solid fa-peso-sign"></i><?= esc(number_format((int)$row->total_bill)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                        <tfoot >
                            <th colspan="3"> 
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