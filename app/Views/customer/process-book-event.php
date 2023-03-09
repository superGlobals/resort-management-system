<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">
   
  <section>
    <div class="container">
       <h4 class="mt-3 mb-3">Events & Place Reservation Form</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-body shadow-lg p-4" style="border: none">
                        <form action="<?= base_url() ?>/Customer/process-booking-event/<?= esc($event->id) ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="customer_id" value="<?= $customer->id ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="event_name" class="form-label">Event Place Name</label>
                                    <input type="text" name="event_name" value="<?= esc(ucwords($event->events_name)) ?>" readonly class="form-control" style="background-color: #e9ecef;">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'event_name') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="">Customer Name</label>
                                        <input type="text" name="customer_name" class="form-control" value="<?= esc(ucwords($customer->name)) ?>" readonly style="background-color: #e9ecef;">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'customer_name') : '' ?></span>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="date_book" class="form-label">Date Booked</label>
                                    <input type="date" name="date_book" value="<?= $date ?>" class="form-control" readonly required style="background-color: #e9ecef;">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'date_book') : '' ?></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="time_arrival" class="form-label">Number of Person <span>Max(<?= $event->max_capacity ?>)</span></label>
                                    <input type="number" name="total_person" class="form-control" max="<?= $event->max_capacity ?>" placeholder="Enter number of person">
                                    <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'total_person') : '' ?></span>
                                </div>
                            </div>
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-body shadow-lg p-4" style="border: none">
                        <h4>Your Total Bill</h4>
                        <hr>
                        <div class="mb-2">
                            <label>Events Place Rate: </label>
                            <input type="text" id="cottage_price" value="<?= esc(number_format($event->rate)) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="mb-2">
                                <label>Total Payment:</label>
                                <input type="text" id="total_bill" class="form-control" value="<?= esc(number_format($event->rate)) ?>" readonly style="background-color: #e9ecef;">
                                <input type="hidden" name="total_bill" id="total_bill" class="form-control" value="<?= esc($event->rate) ?>" readonly style="background-color: #e9ecef;">
                            </div>
                            <div class="mb-2">
                                <label>Please pay half of your total payment:</label>
                                <input type="text" id="deposit" value="<?= esc(number_format($half)) ?>" class="form-control" readonly style="background-color: #e9ecef;">
                                <input type="hidden" name="deposit" id="deposit" value="<?= esc($half) ?>" class="form-control" readonly style="background-color: #e9ecef;">

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
                        </div>
                    </form>
                </div>

             
            </div>
        </div>
     </section>

  

    

  </main><!-- End #main -->

  <?= $this->endSection() ?>
