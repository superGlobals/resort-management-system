<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">
   
  <section>
    <div class="container">
       <h4 class="mt-3 mb-3">Entrance & Cottage Reservation Form</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-body shadow-lg p-4" style="border: none">
                        <form action="<?= base_url('Customer/process-entrance-cottage-transaction') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="cottage_id" value="<?= $cottage->id ?>">
                            <input type="hidden" name="customer_id" value="<?= $customer->id ?>">
                            <input type="hidden" name="visit_type" value="<?= $visit_type ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cottage_name" class="form-label">Cottage Name</label>
                                    <input type="text" name="cottage_name" value="<?= esc(ucwords($cottage->cottage_name)) ?>" readonly class="form-control" style="background-color: #e9ecef;">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'cottage_name') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="">Customer Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= esc(ucwords($customer->name)) ?>" readonly style="background-color: #e9ecef;">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="adults" class="form-label">Adult Entrance Fee (<?= isset($day) ? esc($entrance_fee->adult_price) : esc($entrance_fee->night_adult) ?>)</label>
                                    <input type="number" id="total_adult" name="adults" class="form-control" onchange="total_per()" required>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adults') : '' ?></span>
                                </div>
                                <input type="hidden" id="adult_price" value="<?= isset($day) ? esc($entrance_fee->adult_price) : esc($entrance_fee->night_adult) ?>">
                                <input type="hidden" id="child_price" value="<?= isset($day) ? esc($entrance_fee->child_price) : esc($entrance_fee->night_child) ?>">

                                <div class="col-md-6 mb-3">
                                    <label for="children" class="form-label">Children Entrance Fee (<?= isset($day) ? esc($entrance_fee->child_price) : esc($entrance_fee->night_child) ?>)</label>
                                    <input type="number" id="total_child" name="children" class="form-control" onchange="total_per()">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'children') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_visit" class="form-label">Date of your visit</label>
                                    <input type="date" name="date_visit" value="<?= set_value('date_visit') ?>" class="form-control" required>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'date_visit') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="time_arrival" class="form-label">Time of your arrival</label>
                                    <select name="time_arrival" class="form-select" required> 
                                            <option value=""></option>
                                            <option value="i don't know">I don't know</option>
                                            <?php if(isset($day)): ?>
                                                <option value="8:00AM - 9:00AM">8:00AM - 9:00AM</option>
                                                <option value="9:00AM - 10:00AM">9:00AM - 10:00AM</option>
                                                <option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                                                <option value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>
                                                <option value="12:00PM - 1:00PM">12:00PM - 1:00PM</option>
                                                <option value="1:00PM - 2:00PM">1:00PM - 2:00PM</option>
                                                <option value="2:00PM - 3:00PM">2:00PM - 3:00PM</option>

                                            <?php else: ?>
                                                <option value="12:00">3:00PM - 4:00PM</option>
                                                <option value="12:00">4:00PM - 5:00PM</option>
                                                <option value="12:00">5:00PM - 6:00PM</option>
                                                <option value="12:00">6:00PM - 7:00PM</option>
                                                <option value="12:00">7:00PM - 8:00PM</option>
                                                <option value="12:00">8:00PM - 9:00PM</option>
                                                <option value="12:00">9:00PM - 10:00PM</option>

                                            <?php endif; ?>

                                        </select>
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'time_arrival') : '' ?></span>
                                </div>
                            </div>
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-body shadow-lg p-4" style="border: none">
                        <h4>Your Total Bill</h4>
                        <hr>
                        <div class="mb-2">
                            <label>Cottage price: </label>
                            <input type="text" id="cottage_price" value="<?= esc($cottage->cottage_price) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="mb-2">
                            <label>Total Person:</label>
                            <input type="text" id="total_persons" name="total_person" class="form-control" readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="mb-2">
                            <h4>Total Bill:</h4>
                            <input type="text" name="total_bill" id="total_bill" class="form-control" readonly required style="background-color: #e9ecef;">
                        </div>
              
                        <h5 class="mt-3">Pay via Gcash</h5>
                        <hr>
                        <p>Gcash Number: 09999999999 <br> or Scan Gcash QR</p>

                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <img src="<?= base_url() ?>/uploads/gcashqr.jpg" class="p-3" width="100%" height="100%">
                            <label class="form-label mt-2">Gcash Reference Number</label>
                            <input type="text" class="form-control" name="reference_number" placeholder="Enter Gcash Reference Number" required>
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'reference_number') : '' ?></span>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Proceed Transaction</button>
                        </div>
          
                    </div>
                    </form>
                </div>

                <!-- <div class="col-md-4 mt-3">
                    <h4>Your Total Bill</h4>
                    <hr>
                    <div class="mb-2">
                        <label>Rate per night: </label>
                        <input type="text" id="rate_per_night" value="<?= esc($cottage->cottage_price) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>
                    <div class="mb-2">
                        <label>Total Stay:</label>
                        <input type="text" id="total_stay" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>
                    <div class="mb-2">
                        <h4>Total Bill:</h4>
                        <input type="text" name="total_bill" id="total_bill" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" id="cash_btn" class="btn btn-primary">Proceed Transaction</button>
                    </div>
                    <div id="opt1">
                    <h5>Gcash Information <span style="font-size: 12px;">(if you choose gcash payment)</span></h5>
                    <hr>
                    <p id="gcash_number">Gcash Number: 09999999999 <br> or Scan Gcash QR</p>

                    <div class="col-md-12 form-group mt-3 mt-md-0">
                    <img src="<?= base_url() ?>/uploads/gcashqr.jpg" class="p-3" width="100%" height="100%">
                     <label class="form-label mt-2">Gcash Reference Number</label>
                    <input type="text" class="form-control" name="reference_number" placeholder="Enter Gcash Reference Number" id="required">
                    
                  </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Proceed Transaction</button>
                    </div>
                  </div>
                    </div>
                    
                    </form>
                </div> -->
            </div>
        </div>
     </section>

  

    

  </main><!-- End #main -->

  <?= $this->endSection() ?>
