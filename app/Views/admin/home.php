<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
 <!-- Start Content-->
<div class="container-fluid">

<!-- start page title -->
<!-- <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div> -->

<div class="col-xl-12 col-lg-12 mt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Total <?= $checkin_today > 1 ? 'Rooms' : 'Room' ?> Checkin Today </h5>
                    <h3 class="mt-3 mb-3"><i class="fa-solid fa-user-check text-primary"></i> <?= $checkin_today ?></h3>
                    <p class="mb-0 text-muted">
                        <a href="<?= base_url('room-checkin-today') ?>" class="text-nowrap badge bg-primary">View All</a>  
                    </p>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Total <?= $checkout_today > 1 ? 'Rooms' : 'Room' ?> Checkout Today </h5>
                    <h3 class="mt-3 mb-3"><i class="fa-solid fa-cart-shopping text-success"></i> <?= $checkout_today ?></h3>
                    <p class="mb-0 text-muted">
                        <a href="<?= base_url('checkout-today') ?>" class="text-nowrap badge bg-success">View All</a>  
                    </p>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-md-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Today Revenue</h5>
                <h3 class="mt-3 mb-3"><i class="fa-solid fa-peso-sign text-primary"></i> <?= number_format($daily_revenue) ?></h3>
                <p class="mb-0 text-muted">
                    <a href="" class="text-nowrap badge bg-warning">View All</a>  
                </p>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
    <div class="col-md-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Weekly Revenue</h5>
                <h3 class="mt-3 mb-3"><i class="fa-solid fa-peso-sign text-success"></i></i><?= number_format($daily_revenue) ?></h3>
                <p class="mb-0 text-muted">
                    <a href="" class="text-nowrap badge bg-warning">View All</a>  
                </p>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

        
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0">Pending Room Reservation Request</h5>

                <h3><i class="fa-solid fa-clock text-warning"></i> <?= $count_pending_room ?></h3>
                <p class="mb-0 text-muted">
                    <a href="<?= base_url('pending-room') ?>" class="text-nowrap badge bg-warning">View All</a>  
                </p>
                    
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

    <div class="col-md-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0">Pending Events & Place Booking</h5>
                <h3><i class="fa-solid fa-clock text-warning"></i> <?= $count_pending_event_booking ?></h3>
                <p class="mb-0 text-muted">
                    <a href="<?= base_url('pending-event-booking') ?>" class="text-nowrap badge bg-warning">View All</a>  
                </p>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

    
    <div class="col-lg-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Monthly Revenue</h5>
                <h3 class="mt-3 mb-3"><i class="fa-solid fa-peso-sign text-primary"></i><?= number_format($monthly_revenue) ?></h3>
                <p class="mb-0 text-muted">
                    <a href="" class="text-nowrap badge bg-warning">View All</a>  
                </p>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col-lg-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Yearly Revenue</h5>
                <h3 class="mt-3 mb-3"><i class="fa-solid fa-peso-sign text-success"></i><?= number_format($yearly_revenue) ?></h3>
                <p class="mb-0 text-muted">
                <a href="" class="text-nowrap badge bg-warning">View All</a>  
                </p>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    
    <div class="col-md-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Expected Customer today</h5>
                <h3 class="mt-3 mb-3"><i class="fa-solid fa-people-group"></i> <?= $today > 0 ? $today : 0 ?></h3>
                <p class="mb-0 text-muted">
                    <a href="" class="text-nowrap badge bg-dark">View All</a>  
                </p>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card widget-flat">
            <div class="card-body">
                <h5 class="text-dark fw-bold mt-0" title="Number of Customers">Pending Rates & Reviews</h5>
                <h3 class="mt-3 mb-3"><i class="fa-regular fa-star text-warning"></i> <?= $pending_rates ?></h3>
                <p class="mb-0 text-muted">
                    <a href="<?= base_url('pending-rates-reviews') ?>" class="text-nowrap badge bg-dark">View All</a>  
                </p>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

</div>
<!-- end row -->

<?= $this->endSection() ?>

