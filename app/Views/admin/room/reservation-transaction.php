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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url() ?>/Room/view-room-full-details/<?= $room->id ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('ReservationTransaction/store_room_reservation') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="room_id" value="<?= $room->id ?>">
                <div class="row">
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Name</label>
                        <input type="text" name="room_name" id="checkin" value="<?= esc(ucwords($room->room_name)) ?>" readonly class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_name') : '' ?></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="">Select Customer</label>
                                <select name="customer" class="js-example-basic-multiple" required> 
                                    <option value=""></option>
                                    <?php foreach($customers as $customer): ?> 
                                            <option value="<?= esc($customer->id) ?>"><?= esc(ucwords($customer->name)) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="">Select Paymnent Method</label>
                                <select name="payment_method" class="form-select form-select-sm" required> 
                                    <option value=""></option>
    
                                     <option value="cash">Cash</option>
                                     <option value="gcash">Gcash</option>

                                </select>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'payment_method') : '' ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="adults" class="form-label">Total Adults</label>
                        <input type="number" name="adults" value="<?= set_value('adults') ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adults') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="children" class="form-label">Total Children</label>
                        <input type="number" name="children" value="<?= set_value('children') ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'children') : '' ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="checkin" class="form-label">Checkin</label>
                        <input type="date" name="checkin" id="checkout" value="<?= set_value('checkin') ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkin') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="checkout" class="form-label">Checkout</label>
                        <input type="date" name="checkout" id="checkout2" value="<?= set_value('checkout') ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkout') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Checkin</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>