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
               
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/ReservationTransaction/updateRoomReservation/<?= $reserve_room->transaction_id ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="total_bill" value="<?= $reserve_room->total_bill ?>">
                <input type="hidden" name="checkoutdate_old" value="<?= $reserve_room->checkout ?>">

                <div class="row">
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Name</label>
                        <input type="text" name="room_name" id="checkin" value="<?= esc(ucwords($reserve_room->room_name)) ?>" readonly class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_name') : '' ?></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="">Customer Name</label>
                                <input type="text" class="form-control" name="customer" value="<?= esc(ucwords($reserve_room->name)) ?>" readonly>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="">Paymnent Method</label>
                                <input type="text" name="payment_method" class="form-control" value="<?= esc(ucwords($reserve_room->payment_type)) ?>" readonly>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'payment_method') : '' ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="checkin" class="form-label">Checkin</label>
                        <input type="date" name="checkin" id="checkout" value="<?= set_value('checkin', $reserve_room->checkin) ?>" class="form-control" required readonly>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkin') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="checkout" class="form-label">Checkout</label>
                        <input type="date" name="checkout" id="checkout2" value="<?= set_value('checkout', $reserve_room->checkout) ?>" class="form-control" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkout') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Checkout date</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>