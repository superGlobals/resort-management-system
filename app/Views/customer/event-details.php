<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">

  <section>
    <div class="container">
        <h1 class="text-center mt-5 mb-5"><?= esc(ucwords($event->events_name)) ?></h1>
            <div class="row ">
                <div class="col-md-5 mt-2">
                    <img src="<?= base_url() ?>/uploads/<?= $event->images ?>" height="300" style="width: 100%;">
                    <h5 class="mt-3"><i class="fa-solid fa-person"></i> Good for <?= $event->max_capacity ?></h5>
      
                    <h5>Rate: <i class="fa-solid fa-peso-sign"></i><?= esc(number_format($event->rate)) ?></h5>
                    <a href="#cancellation" data-bs-toggle="modal" class="btn btn-outline-danger btn-sm">Cancellation policy</a>
                    <div class="mt-3 mb-2 text-center">
                        
                       <?php if($website->event_reservation == 0): ?>
                            <?php if(session()->has('loggedCustomerId')): ?>
                                <a href="<?= base_url() ?>/Customer/select-booked-date/<?= $event->id ?>/?month=<?= date('m') ?>&year=<?= date('Y') ?>" class="btn btn-primary">Booked Now</a>
                            <?php else: ?>
                              <a href="<?= base_url('Customer/check_auth') ?>" class="btn btn-primary btn-sm">Book Now</a>
                            <?php endif; ?>

                        <?php else: ?>
                            <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary">Book Now</a>
                       <?php endif ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <h3>Event Place Description</h3>
                    <hr>
                    <p><?= ucwords($event->description) ?></p>
                </div>
            </div>
        </div>
     </section>

  

    

  </main><!-- End #main -->

  <!-- Modal -->
<div class="modal fade" id="cancellation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Cancellation Policy</h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
            mollit anim id est laborum
        </p>
      </div>
      <div class="modal-footer" style="border: none;">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="room_shutdown" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Website Reminder</h4>
        <p class="text-center">
            Sorry Events & Place Booking is temporarily unavailable
        </p>
      </div>
      <div class="modal-footer border-0">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>

  <?= $this->endSection() ?>

  