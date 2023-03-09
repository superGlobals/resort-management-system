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
    <div class="col-12">
        <div class="card">
            <div class="card-header">Room reservation:</div>
            <div class="card-body">

                <div class="row text-center">
                    <div class="col">
                        <a href="<?= base_url('Reports/custom-reports') ?>" class="btn btn-outline-primary">Custom Reports</a>
                        <a href="<?= base_url('Reports/daily-reports') ?>" class="btn btn-outline-success">Daily Reports</a>
                        <a href="<?= base_url('Reports/weekly-reports') ?>" class="btn btn-outline-danger">Weekly Reports</a>
                        <a href="<?= base_url('Reports/monthly-reports') ?>" class="btn btn-outline-warning">Monthly Reports</a>
                        <a href="<?= base_url('Reports/yearly-reports') ?>" class="btn btn-outline-dark">Yearly Reports</a>
                        <br><br>
                        <a href="<?= base_url('Reports/completed-room-reservation') ?>" class="btn btn-outline-success">Completed Room Reservation</a>
                        <!-- <a href="<?= base_url('Reports/cancelled-room-reservation') ?>" class="btn btn-outline-danger">Cancelled Room Reservation</a> -->
                        
                    </div>
                </div>
                
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-12">
        <div class="card">
            <div class="card-header">Events & Place reservation:</div>
            <div class="card-body">

                <div class="row text-center">
                    <div class="col">
                        <a href="<?= base_url('Reports-event/custom-reports') ?>" class="btn btn-outline-primary">Custom Reports</a>
                        <a href="<?= base_url('Reports-event/daily-reports') ?>" class="btn btn-outline-success">Daily Reports</a>
                        <a href="<?= base_url('Reports-event/weekly-reports') ?>" class="btn btn-outline-danger">Weekly Reports</a>
                        <a href="<?= base_url('Reports-event/monthly-reports') ?>" class="btn btn-outline-warning">Monthly Reports</a>
                        <a href="<?= base_url('Reports-event/yearly-reports') ?>" class="btn btn-outline-dark">Yearly Reports</a>
                    </div>
                </div>
                
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>



<?= $this->endSection() ?>