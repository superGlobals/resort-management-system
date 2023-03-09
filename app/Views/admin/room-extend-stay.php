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
            <h4 class="page-title">Room Reservation Transaction</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
               
            </div>
            <div class="card-body">
                
             <form action="<?= base_url() ?>/process-room-extend-stay/<?= $extend->transaction_id ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="current_checkout" value="<?= $extend->checkout ?>">

                    <div class="row">
                
                        <div class="col-md-6 mb-3">
                            <label for="room_name" class="form-label">Room Name</label>
                            <input type="text" name="room_name" value="<?= esc(ucwords($extend->room_name)) ?>" readonly class="form-control" style="background-color: #e9ecef;">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_name') : '' ?></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="">Customer Name</label>
                                <input type="text" name="name" class="form-control" value="<?= esc(ucwords($extend->name)) ?>" readonly style="background-color: #e9ecef;">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                        </div>
                    
                
                
                    <div class="col-md-6 mb-3">
                        <label for="checkin" class="form-label">Checkin</label>
                        <input type="date" name="checkin" id="checkout" value="<?= set_value('checkin', $extend->checkin) ?>" class="form-control" readonly required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkin') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="checkout2" class="form-label">Checkout</label>
                        <input type="date" name="checkout" id="checkout2" onchange="getNights()" value="<?= set_value('checkout', $extend->checkout) ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkout') : '' ?></span>
                    </div>

                    
                </div>

            </div>
        </div>
    </div>
        <div class="col-md-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h4>Your Total Bill</h4>
                    <hr>
                    <div class="mb-2">
                        <label>Rate per night: </label>
                        <input type="text" id="rate_per_night" value="<?= esc($extend->rate_per_night) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>
                    <div class="mb-2">
                        <label>Total Stay:</label>
                        <input type="text" id="total_stay" class="form-control" name="total_stay" value="<?= set_value('total_stay') ?>" readonly style="background-color: #e9ecef;">
                    </div>
                    <div class="mb-2">
                        <label>Total Bill:</label>
                        <input type="text" name="total_bill" id="total_bill" class="form-control" value="<?= set_value('total_bill') ?>" readonly style="background-color: #e9ecef;">
                    </div>
                    <input type="hidden" id="current_checkout_date" onchange="getNights()" value="<?= $extend->checkout ?>">
                    <div class="mb-2">
                        <label>Please Pay:</label>
                        <input type="text" id="additional" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>
                    
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </div> 
              </form>  
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>