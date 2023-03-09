<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">

    <?php if(isset($_POST['checkin']) && isset($_POST['checkout'])): ?>

      <section>
          <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <div class="section-title p-0">
                  <h2>Services</h2>
                  <h3>Room Rates & <span>Reservation</span></h3>
                </div>
            </div>
          </div> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card shadow border-0 p-2">
                      <div class="card-body">
                        <h4>Check Availability</h4>
                        <form action="<?= base_url('Customer/filter-rooms') ?>" method="POST">
                        <?= csrf_field() ?>
                          <div class="col-md-12">
                          <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                            <div class="field-icon-wrap mb-3">
                              <div class="icon"><span class="icon-calendar"></span></div>
                              <input type="date" class="form-control" id="checkout2" name="checkin" value="<?= set_value('checkin') ?>">
                            </div>

                            <label for="checkin_date" class="font-weight-bold text-black">Check Out</label>
                            <div class="field-icon-wrap mb-3">
                              <div class="icon"><span class="icon-calendar"></span></div>
                              <input type="date" class="form-control" id="checkout2" name="checkout" value="<?= set_value('checkout') ?>">
                            </div>

                            <label for="adults" class="font-weight-bold text-black">Adults</label>
                            <input type="number" class="form-control mb-3" name="adults" value="<?= set_value('adults') ?>">

                            <label for="children" class="font-weight-bold text-black">Children</label>
                            <input type="number" class="form-control mb-3" name="children" value="<?= set_value('children') ?>">
                          </div>

                          <button type="submit" class="btn btn-primary btn-block text-white ">Check Availabilty</button>
                        </form>
                      </div>
                    </div>
                  </div>

                  
                    <div class="col-md-8">
                      <?php if(count($filters) > 0): ?>
                        <?php foreach($filters as $room): ?>
                          <div class="card mb-3 shadow border-0 p-2">
                            <div class="row g-0">
                              <div class="col-md-5">
                                <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" class="img-fluid rounded-start" alt="..." style="height: 200px; width: 100%">
                              </div>
                              <div class="col-md-7">
                                <div class="card-body">
                                  <h5 class="card-title fw-bold"><?= esc(ucwords($room->room_name)) ?></h5>
                                  
                                  <label class="fw-bold">Max Guests</label>
                                  <h1 class="fw-bold" style="font-size: 13px;">
                                    <?php if($room->max_adults_capacity > 0): ?>
                                      <span class="mx-3"><?= esc($room->max_adults_capacity) ?> <?= $room->max_adults_capacity > 1 ? 'Adults' : 'Adult' ?> </span>
                                    <?php endif; ?>
                                    
                                    <?php if($room->max_children_capacity > 0): ?>

                                      <span class="mx-1"><?= esc($room->max_children_capacity) ?>  <?= $room->max_children_capacity > 1 ? 'Children' : 'Child' ?> </span>
                                    
                                    <?php endif; ?>
                                    </h1>
                                    <p><span class="price mr-2"><i class="fa-solid fa-peso-sign"></i> <?= esc($room->rate_per_night) ?></span> <span class="per">per night</span></p>
                                    <?php if($website->room_reservation == 0): ?>
                                      <?php if(session()->has('loggedCustomerId')): ?>
                                        <?php if($room->available_rooms > 0): ?>
                                            <a href="<?= base_url() ?>/Customer/process-request/<?= $room->id ?>" class="btn btn-primary btn-sm">Book Now</a>
                                        <?php else: ?>
                                            <h6>All Rooms are reserved</h6>
                                        <?php endif; ?>
                                        
                                        <?php else: ?>
                                        
                                            <a href="<?= base_url('Customer/check_auth') ?>" class="btn btn-primary btn-sm">Book Now</a>
                                    <?php endif; ?>
                                    <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary">Book Now</a>
                                  <?php endif ?>
                                  <a href="<?= base_url() ?>/Customer/single-room/<?= $room->id ?>" class="btn btn-outline-secondary btn-sm">More Details <span class="icon-long-arrow-right"></span></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center">
                          <h1>No Rooms Available</h1>
                          <a href="<?= base_url('Customer/all-rooms') ?>" class="btn btn-primary">View all rooms</a>
                        </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

    <?php endif; ?>

    
    <?php if(!isset($_POST['adults']) && !isset($_POST['children'])): ?>

        <section>
          <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <div class="section-title p-0">
                  <h2>Services</h2>
                  <h3>Room Rates & <span>Reservation</span></h3>
                </div>
            </div>
          </div> 
          <div class="container">
            <div class="row d-flex justify-content-center">
         
               
                  <!-- <div class="col-md-4">
                    <div class="card shadow border-0 p-2 mb-3">
                      <div class="card-body">
                        <h5>Check Available Rooms</h5>
                        <form action="<?= base_url('Customer/filter-rooms') ?>" method="POST">
                        <?= csrf_field() ?>
                          <div class="col-md-12">
                          <label for="checkin_date" >Check In</label>
                            <div class="field-icon-wrap mb-3">
                              <div class="icon"><span class="icon-calendar"></span></div>
                              <input type="date" class="form-control" id="checkout2" name="checkin" value="<?= set_value('checkin') ?>">
                            </div>

                            <label for="checkin_date" >Check Out</label>
                            <div class="field-icon-wrap mb-3">
                              <div class="icon"><span class="icon-calendar"></span></div>
                              <input type="date" class="form-control" id="checkout2" name="checkout" value="<?= set_value('checkout') ?>">
                            </div>

                            <label for="adults" >Adults</label>
                            <input type="number" class="form-control mb-3" name="adults" value="<?= set_value('adults') ?>">

                            <label for="children" >Children</label>
                            <input type="number" class="form-control mb-3" name="children" value="<?= set_value('children') ?>">
                          </div>

                          <button type="submit" class="btn btn-primary btn-block text-white ">Check Availabilty</button>
                        </form>
                      </div>
                    </div>
                  </div> -->

                  
    
                      <?php if(count($rooms) > 0): ?>
                        <?php foreach($rooms as $room): ?>
                          <div class="col-md-6">
                            <div class="card mb-3 shadow border-0 p-2">
                              <div class="row g-0">
                                <div class="col-md-5">
                                  <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" class="img-fluid rounded-start" alt="..." style="height: 200px; width: 100%">
                                </div>
                                <div class="col-md-7">
                                  <div class="card-body">
                                    <h5 class="card-title fw-bold"><?= esc(ucwords($room->room_name)) ?></h5>
                                    
                                    <label class="fw-bold">Max Guests</label>
                                    <h1 class="fw-bold" style="font-size: 13px;">
                                      <?php if($room->max_adults_capacity > 0): ?>
                                        <span class="mx-3"><?= esc($room->max_adults_capacity) ?> <?= $room->max_adults_capacity > 1 ? 'Adults' : 'Adult' ?> </span>
                                      <?php endif; ?>
                                      
                                      <?php if($room->max_children_capacity > 0): ?>

                                        <span class="mx-1"><?= esc($room->max_children_capacity) ?>  <?= $room->max_children_capacity > 1 ? 'Children' : 'Child' ?> </span>
                                      
                                      <?php endif; ?>
                                      </h1>
                                      <p><span class="price mr-2"><i class="fa-solid fa-peso-sign"></i> <?= esc($room->rate_per_night) ?></span> <span class="per">per night</span></p>
                                      <?php if($website->room_reservation == 0): ?>
                                        <?php if(session()->has('loggedCustomerId')): ?>
                                              <a href="<?= base_url() ?>/Customer/process-request/<?= $room->id ?>" class="btn btn-primary btn-sm">Book Now</a>
                                          <?php else: ?>
                                            <a href="<?= base_url('Customer/check_auth') ?>" class="btn btn-primary btn-sm">Book Now</a>

                                      <?php endif; ?>
                                      <?php else: ?>
                                        <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary btn-sm">Book Now</a>
                                    <?php endif ?>
                                    <a href="<?= base_url() ?>/Customer/single-room/<?= $room->id ?>" class="btn btn-outline-secondary btn-sm">More Details <span class="icon-long-arrow-right"></span></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h1>No Rooms Available</h1>
                    <?php endif; ?>
            
       
      
            </div>
          </div>
        </section>

    <?php endif; ?>

  </main><!-- End #main -->
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