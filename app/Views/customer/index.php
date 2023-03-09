<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="10000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(<?= base_url('guest-assets/assets/img/2.jpg') ?>)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Welcome to <span>PMP</span></h2>
              <p class="animated fadeInUp">Farm & Resort</p>
              <!-- <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(<?= base_url('guest-assets/assets/img/1.jpg') ?>)">
          <div class="carousel-container">
            <!-- <div class="container">
              <h2 class="animated fadeInDown">Lorem Ipsum Dolor</h2>
              <p class="animated fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
            </div> -->
          </div>
        </div>

        <!-- Slide 3 -->
        <!-- <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Sequi ea ut et est quaerat</h2>
              <p class="animated fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div> -->

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">





    <!-- ======= Counts Section ======= -->
   <section id="counts" class="counts section-bg">
      <div class="container-fluid">

        <div class="row counters">

          <div class="text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?= $today ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Expected Customer Today in PMP</p>
          </div>
        </div>

      </div>
      <!-- <div class="container">
        <div class="row">
          <div class="col-md-11 mx-auto">
            <div class="card shadow-lg p-4" style="border: none;">
                <form action="<?= base_url('Customer/filter-rooms') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                  <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                    <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="icon-calendar"></span></div>
                      <input type="date" class="form-control" id="checkout2" name="checkin" value="<?= set_value('checkin') ?>">
                    </div>
                  </div>
                  <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                    <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="icon-calendar"></span></div>
                      <input type="date" class="form-control" id="checkout" name="checkout" value="<?= set_value('checkout') ?>">
                    </div>
                  </div>
                  <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                    <div class="row">
                      <div class="col-md-6 mb-3 mb-md-0">
                        <label for="adults" class="font-weight-bold text-black">Adults</label>
                        <input type="number" class="form-control" name="adults" value="<?= set_value('adults') ?>">
                      </div>
                      <div class="col-md-6 mb-3 mb-md-0">
                        <label for="children" class="font-weight-bold text-black">Children</label>
                        <input type="number" class="form-control" name="children" value="<?= set_value('children') ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3 align-self-end">
                    <button type="submit" class="btn btn-primary btn-block text-white">Check Availabilty</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> -->
    </section><!-- End Counts Section -->

    <?php if(!isset($_POST['adults']) && !isset($_POST['children'])): ?>

        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Check Our <span>Rooms</span></h3>
                </div>
                    <a href="<?= base_url('Customer/all-rooms') ?>" class="btn btn-primary">View All Rooms</a>
                </div>
                </div>        
                <div class="row d-flex justify-content-center">
                <?php if(count($rooms) > 0): ?>
                    <?php foreach($rooms as $room): ?>
                        <div class="col-sm col-md-6 col-lg-4 ftco-animate ">
                            <div class="card shadow-lg mb-3 border-0">
                                <a class="img d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" alt="Free website template" class="img-fluid mb-3" style="height: 260px; width: 100%">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                    </div>
                                </a>
                                <div class="text p-3 text-center">
                                    <h3 class="mb-3"><a><?= esc(ucwords($room->room_name)) ?></a></h3>
                                    <p><span class="price mr-2"><?= esc($room->rate_per_night) ?></span> <span class="per">per night</span></p>
                                    <hr>
                                    <p class="pt-1"><a  href="<?= base_url() ?>/Customer/single-room/<?= $room->id ?>" class="btn-custom">View Room Details <span class="icon-long-arrow-right"></span></a></p>
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

    <!-- ======= Services Section ======= -->
    <section class="contact section-bg">
      <div class="container-fluid">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Entrance & <span>Cottages</span></h3>
          <p>PMP RESORT ENTRANCE FEE / SWIMMING RATES</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-12">
            <div class="row">

              <div class="col-lg-12">

                <div class="row justify-content-center">

                  <div class="col-md-4 info d-flex flex-column align-items-stretch">
                  <i class="bi bi-brightness-high"></i>
                    <h4>Day Tour</h4>
                    <h4>8AM-5PM</h5>
                    <p>Adult: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->adult_price ?> <br> Child: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->child_price ?></p>
                  </div>
                  <div class="col-md-4 info d-flex flex-column align-items-stretch">
                  <i class="bi bi-moon"></i>
                    <h4>Night Swimming</h4>
                    <h4>5PM-12MN</h4>
                    <p>Adult: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->night_adult ?><br>Child: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->night_child ?></p> 
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>

      </div>
    </section>

   

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container-fluid">

        <div class="section-title">
          <h2>Rates & Reviews</h2>
          <h3>What They <span>Are Saying</span> About Us</h3>
          <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-10">

            <div class="row">

             <?php if(count($rates) > 0): ?>
              <?php foreach($rates as $review): ?>
                <div class="col-lg-6 mt-3">
                  <div class="testimonial-item">
                    <img src="<?= base_url() ?>/uploads/<?= esc($review->picture) ?>" class="testimonial-img" alt="">
                    <h3><?= esc(ucfirst($review->rate_by)) ?></h3>
                    <h4>
                      <?php if($review->rates == '1'): ?>
                        <i class="fa-solid fa-star text-warning"></i>

                      <?php elseif($review->rates == '2'): ?>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>

                      <?php elseif($review->rates == '3'): ?>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>

                      <?php elseif($review->rates == '4'): ?>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>

                      <?php elseif($review->rates == '5'): ?>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                      <?php endif ?>
                    </h4>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        <?= esc(ucwords($review->reviews)) ?>
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial-item -->
              <?php endforeach ?>

             <?php else: ?>

              <h4 class="text-center">No Rates & Reviews</h4>

             <?php endif ?>

              

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container-fluid">

        <div class="section-title">
          <h2>Contact</h2>
          <h3>Get In Touch With <span>Us</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <?php 

          $db = db_connect();

          $builder = $db->table('tbl_contacts');
          $builder->select('*');
          $result = $builder->get()->getRow();

        ?>

        <div class="row justify-content-center">
          <div class="col-xl-8">
            <div class="row">

              <div class="col-lg-12">

                <div class="row justify-content-center">

                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-map"></i>
                    <h4>Address</h4>
                    <p><?= esc(ucwords($result->address)) ?></p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-phone"></i>
                    <h4>Call Us</h4>
                    <p><?= esc($result->contact) ?></p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-envelope"></i>
                    <h4>Email Us</h4>
                    <p><?= esc($result->email) ?></p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-time-five"></i>
                    <h4>Working Hours</h4>
                    <p><?= esc(ucwords($result->working_hours)) ?></p>
                  </div>

                </div>

              </div>

              

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?= $this->endSection() ?>