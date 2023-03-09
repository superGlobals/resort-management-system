<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">
   
  <section>
    <div class="container">
       <h2 class="mt-3 mb-3">Room Reservation Form</h2>
            <div class="row ">
                <div class="col-md-8">
                    <div class="card shadow-lg p-2" style="border: none">
                        <div class="card-body">
                            
                            <form action="<?= base_url() ?>/Customer/process-transaction/<?= $room->id ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="room_id" value="<?= $room->id ?>">
                            <input type="hidden" name="customer_id" value="<?= $customer->id ?>">
                                <div class="row">
                         
                                    <div class="col-md-6 mb-3">
                                        <label for="room_name" class="form-label">Room Name</label>
                                        <input type="text" name="room_name" value="<?= esc(ucwords($room->room_name)) ?>" readonly class="form-control" style="background-color: #e9ecef;">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_name') : '' ?></span>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="">Customer Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= esc(ucwords($customer->name)) ?>" readonly style="background-color: #e9ecef;">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                                    </div>
                               
                                    <!-- <div class="col-md-6 mb-3">
                                        <label class="form-label" for="">Select Paymnent Type</label>
                                            <select name="payment_type" id="gcash_payment" class="form-select" > 
                                                <option value=""></option>
                
                                                <option value="cash">Pay on arrival</option>
                                                <option value="gcash">Gcash</option>

                                            </select>
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'payment_method') : '' ?></span>
                                    </div> -->
                         
                                <?php if($room->max_adults_capacity > 0 && $room->max_children_capacity > 0): ?>
                                    <div class="col-md-6 mb-3">
                                        <label for="adults" class="form-label">Max Adults <span>(<?= esc($room->max_adults_capacity) ?>)</span></label>
                                        <input type="number" name="adults" value="<?= set_value('adults') ?>" max="<?= esc($room->max_adults_capacity) ?>" class="form-control" required>
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adults') : '' ?></span>
                                     </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="children" class="form-label">Max Children <span>(<?= esc($room->max_children_capacity) ?>)</span></label>
                                        <input type="number" name="children" value="<?= set_value('children') ?>" max="<?= esc($room->max_children_capacity) ?>" class="form-control" required>
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'children') : '' ?></span>
                                    </div>
                                
                                <?php elseif($room->max_adults_capacity > 0 && $room->max_children_capacity == 0): ?>

                                    <div class="mb-3">
                                        <label for="adults" class="form-label">Max Adult</label>
                                        <input type="number" name="adults" value="<?= esc($room->max_adults_capacity) ?>" class="form-control"  readonly style="background-color: #e9ecef;">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adults') : '' ?></span>
                                     </div>


                                <?php endif; ?> 
                                <div class="col-md-6 mb-3">
                                    <label for="checkin" class="form-label">Checkin</label>
                                    <input type="date" name="checkin" id="checkout" value="<?= set_value('checkin') ?>" class="form-control" required>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkin') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="checkout2" class="form-label">Checkout</label>
                                    <input type="date" name="checkout" id="checkout2" onchange="getNights()" value="<?= set_value('checkout') ?>" class="form-control" required>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'checkout') : '' ?></span>
                                </div>

                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow p-2">
                        <div class="card-body">
                            <h4>Your Total Bill</h4>
                            <hr>
                            <div class="mb-2">
                                <label>Rate per night: </label>
                                <input type="text" id="rate_per_night" value="<?= esc($room->rate_per_night) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                            </div>
                            <div class="mb-2">
                                <label>Total Stay:</label>
                                <input type="text" id="total_stay" class="form-control" name="total_stay" value="<?= set_value('total_stay') ?>" readonly style="background-color: #e9ecef;">
                            </div>
                            <div class="mb-2">
                                <label>Total Payment:</label>
                                <input type="text" name="total_bill" id="total_bill" class="form-control" value="<?= set_value('total_bill') ?>" readonly style="background-color: #e9ecef;">
                            </div>
                            <div class="mb-2">
                                <label>Please pay half of your total payment:</label>
                                <input type="text" name="deposit" id="deposit" value="<?= set_value('deposit') ?>" class="form-control" readonly style="background-color: #e9ecef;">
                            </div>

                            <div>
                            <p class="fw-bold">Gcash Number: <?= esc($payment->gcash_number) ?> <br> or Scan Gcash QR</p>

                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                    <img src="<?= base_url() ?>/uploads/<?= $payment->gcash_qr ?>" class="p-3" width="100%" height="100%">
                                    <label class="form-label mt-2">Gcash Reference Number</label>
                                    <input type="text" class="form-control" value="<?= set_value('reference_number') ?>" name="reference_number" placeholder="Enter Gcash Reference Number" required>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'reference_number') : '' ?></span>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div> 
                            </form>  
                        </div>
                    </div>          
                    
                </div>
                </div>
                    
                
                </div>
            </div>
        </div>
     </section>

  

    

  </main><!-- End #main -->

  <!-- Modal -->
<div class="modal fade" id="changeContact<?= $room->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">Scan to pay</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= csrf_field() ?>
        <form action="<?= base_url('Customer/process-room-transaction') ?>" method="POST">
        
            <input type="hidden" name="id" value="<?= $room->id ?>">
            <div>
                <img src="<?= base_url() ?>/uploads/gcashqr.jpg" width="100%" height="100%">
                <h6 class="fw-bold mt-2">Gcash Number: 09999999999</h6>
                <h6 class="fw-bold">Amount Payable: <span id="deposit2"></span></h6>
                <input type="text" class="form-control" placeholder="Enter Gcash Reference #" >
                
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-3" type="submit">Submit</button>
            </div>
        </form>
          
      </div>
      <!-- <div class="modal-footer" style="border: none;">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div> -->
    </div>
  </div>
</div>


  <?= $this->endSection() ?>

