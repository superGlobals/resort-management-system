<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">

  <section>
    <div class="container">
        <h1 class="text-center mt-5 mb-5"><?= esc(ucwords($single_room->room_name)) ?></h1>
            <div class="row ">
                <div class="col-md-5 mt-2">
                    <img src="<?= base_url() ?>/uploads/<?= $single_room->room_image ?>" height="300" style="width: 100%;">

                    <?php if($single_room->max_adults_capacity > 0): ?>
                        <br>
                        <h5><i class="fa-regular fa-user"></i> Max <?= esc($single_room->max_adults_capacity) ?> <?= $single_room->max_adults_capacity > 1 ? 'adults' : 'adult' ?></h5>
                    <?php endif; ?>
                    
                    <?php if($single_room->max_children_capacity > 0): ?>

                        <h5><i class="fa-solid fa-children"></i> Max <?= esc($single_room->max_children_capacity) ?> <?= $single_room->max_children_capacity > 1 ? 'children' : 'child' ?></h5>
                    
                    <?php endif; ?>
                    <h5>Rate Per Night: <i class="fa-solid fa-peso-sign"></i><?= esc($single_room->rate_per_night) ?></h5>
                    <a href="#cancellation" data-bs-toggle="modal" class="btn btn-outline-danger btn-sm">Cancellation policy</a>
                    <div class="mt-3 mb-2 text-center">
                        
                       <?php if($website->room_reservation == 0): ?>
                            <?php if(session()->has('loggedCustomerId')): ?>
                                <?php if($single_room->available_rooms > 0): ?>
                                    <a href="<?= base_url() ?>/Customer/process-request/<?= $single_room->id ?>" class="btn btn-primary">Checkin Now</a>
                                <?php else: ?>
                                    <h3>All Rooms are reserved</h3>
                                <?php endif; ?>
                                
                            <?php else: ?>
                                
                                <?php if($single_room->available_rooms > 0): ?>
                                    <a href="<?= base_url('Customer/check_auth') ?>" class="btn btn-primary">Checkin Now</a>
                                <?php else: ?>
                                    <h3 class="text-danger">All Rooms are reserved</h3>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php else: ?>
                            <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary">Checkin Now</a>
                       <?php endif ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <h3>Room Descrition</h3>
                    <hr>
                    <p><?= ucwords($single_room->room_description) ?></p>
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
          Your deposited payment is not refundable after you cancel your room reservation.
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
            Sorry Room Reservation is temporarily unavailable
        </p>
      </div>
      <div class="modal-footer border-0">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>

  <?= $this->endSection() ?>

  