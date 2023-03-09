<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


<main id="main">
  <section class="contact section-bg">
      <div class="container-fluid">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Events & <span>Places</span></h3>
          <p>PMP Events & Places RATES</p>
        </div>

      </div>

      <!-- <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <div class="card shadow-lg p-4" style="border: none;">
                <form action="<?= base_url('Customer/filter-rooms') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                  <div class="col-md-8 mb-3 mb-lg-0">
                    <label for="checkin_date" class="font-weight-bold text-black">Date</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="icon-calendar"></span></div>
                      <input type="date" class="form-control" id="checkout2" name="book" value="<?= set_value('checkin') ?>">
                    </div>
                  </div>

                  <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary btn-block text-white btn-sm">Check Availabilty</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> -->
    <!-- End Contact Section -->

    <?php if(!isset($_POST['book'])): ?>


          <div class="container">   
              <div class="row d-flex justify-content-center">
              <?php if(count($results) > 0): ?>
                  <?php foreach($results as $row): ?>
                      <div class="col-sm col-md-6 col-lg-4 ftco-animate ">
                          <div class="card shadow-lg mb-3 border-0">
                              <a class="img d-flex justify-content-center align-items-center">
                              <img src="<?= base_url() ?>/uploads/<?= $row->images ?>" alt="Free website template" class="img-fluid mb-3" style="height: 260px; width: 100%">
                                  <div class="icon d-flex justify-content-center align-items-center">
                                  <span class="icon-search2"></span>
                                  </div>
                              </a>
                              <div class="text p-3 text-center">
                                  <h3 class="mb-3"><a><?= esc(ucwords($row->events_name)) ?></a></h3>
                                  <p><span class="price mr-2"><i class="fa-solid fa-peso-sign"></i> <?= esc(number_format($row->rate)) ?></span></p>
                                  <hr>
                                  <p class="pt-1">
                                  <?php if($website->event_reservation == 0): ?>
                                    <a href="<?= base_url() ?>/Customer/select-booked-date/<?= $row->id ?>/?month=<?= date('m') ?>&year=<?= date('Y') ?>" class="btn btn-primary btn-sm">Book Now</a>
                                  <?php else: ?>
                                    <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary btn-sm">Book Now</a>
                                  <?php endif ?>
                                    <a href="<?= base_url() ?>/Customer/event-place-details/<?= $row->id ?>" class="btn btn-outline-secondary btn-sm">More Details <span class="icon-long-arrow-right"></span></a></p>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php else: ?>
                  <h1 class="text-center">No Rooms Available</h1>
              <?php endif; ?>
              
              </div>
          </div>
      </section>

    <?php endif; ?>

  <!-- ======= Portfolio Section ======= -->

      

</main><!-- End #main -->
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

  