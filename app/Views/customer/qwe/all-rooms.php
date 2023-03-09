<!DOCTYPE HTML>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>RedPlanet &mdash; A Onepage Hotel HTML Bootstrap Website Template by Colorlib </title>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/animate.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/owl.carousel.min.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/aos.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/bootstrap-datepicker.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/jquery.timepicker.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/fancybox.min.css">
      
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/fonts/ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/fonts/fontawesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Theme Style -->
      <link rel="stylesheet" href="<?= base_url() ?>/guest-assets/css/style.css">
    </head>
    <body data-spy="scroll" data-target="#templateux-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="templateux-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">PMP</a>
        <div class="site-menu-toggle js-site-menu-toggle  ml-auto"  data-aos="fade" data-toggle="collapse" data-target="#templateux-navbar-nav" aria-controls="templateux-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

        <div class="collapse navbar-collapse" id="templateux-navbar-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#section-home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-rooms">Rooms</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-contact">Entrance & Cottages</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-events">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-contact">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-contact">Register</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <section class="rooms-hero overlay" data-stellar-background-ratio="0.5" id="section-home" style="max-height: 100px; background-color: #282A3A">
        <div class="container">
            <div class="row rooms-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade-up">
                    <h1 class="heading text-white">All Rooms</h1>
                </div>
            </div>
        </div>
      </section>

      <section class="section pb-0 mt-5">
        <div class="container">
         
          <div class="row check-availabilty" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

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
      </section>

      <?php if(isset($_POST['adults']) && isset($_POST['children'])): ?>
        <section class="section" id="section-rooms">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">Search Results</h2>
                    <a class="btn btn-primary btn-sm text-white" href="<?= base_url('Customer/all-rooms') ?>">View All Rooms</a>
                    </div>
                </div>
                <div class="row">
                    <?php if(count($filters) > 0 ): ?>

                        <?php foreach($filters as $room): ?>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            <a href="<?= base_url() ?>/Customer/single-room/<?= $room->id ?>" class="room">
                                <figure class="img-wrap">
                                <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" alt="Free website template" class="img-fluid mb-3" style="height: 260px; width: 100%">
                                </figure>
                                <div class="p-3 text-center room-info">
                                <h2><?= esc(ucwords($room->room_name)) ?></h2>
                                <span class="text-uppercase letter-spacing-1"><?= esc($room->rate_per_night) ?> / per night</span>
                                <?php if($room->available_rooms > 0): ?>
                                    <h5><?= esc($room->available_rooms) ?> Available <?= $room->available_rooms > 1 ? 'Rooms' : 'Room' ?> </h5>
                                <?php else: ?>
                                    <h5>All Rooms are reserved</h5>
                                <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    <?php else: ?>

                    <h1 class="text-center">No Results</h1>

                    <?php endif; ?>
                </div>
            </div>
        </section>  
    <?php endif; ?>



            
        <?php if(!isset($_POST['adults']) && !isset($_POST['children'])): ?>
            <section class="section" id="section-rooms">
                <div class="container">
                    <div class="row justify-content-center text-center mb-5">
                        <div class="col-md-7">
                        <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
                        <!-- <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p> -->
                        </div>
                    </div>
                    <div class="row">
                        <?php if(count($rooms) > 0): ?>
                            <?php foreach($rooms as $room): ?>
                                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                                    <a href="<?= base_url() ?>/Customer/single-room/<?= $room->id ?>" class="room">
                                        <figure class="img-wrap">
                                        <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" alt="Free website template" class="img-fluid mb-3" style="height: 260px; width: 100%">
                                        </figure>
                                        <div class="p-3 text-center room-info">
                                        <h2><?= esc(ucwords($room->room_name)) ?></h2>
                                        <span class="text-uppercase letter-spacing-1"><?= esc($room->rate_per_night) ?> / per night</span>
                                        <?php if($room->available_rooms > 0): ?>
                                            <h5><?= esc($room->available_rooms) ?> Available <?= $room->available_rooms > 1 ? 'Rooms' : 'Room' ?> </h5>
                                        <?php else: ?>
                                            <h5>All Rooms are reserved</h5>
                                        <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <h1>No Rooms Available</h1>
                        <?php endif; ?>
                    </div>
                </div>
            </section>  
        <?php endif; ?>

      <footer class="section footer-section">
        <div class="container">
          <div class="row mb-4">
            <div class="col-md-3 mb-5">
              <ul class="list-unstyled link">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Terms &amp; Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
               <li><a href="#">Rooms</a></li>
              </ul>
            </div>
            <div class="col-md-3 mb-5">
              <ul class="list-unstyled link">
                <li><a href="#">The Rooms &amp; Suites</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Restaurant</a></li>
              </ul>
            </div>
            <div class="col-md-3 mb-5 pr-md-5 contact-info">
              <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
              <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> 198 West 21th Street, <br> Suite 721 New York NY 10016</span></p>
              <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 435 3533</span></p>
              <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@yourdomain.com</span></p>
            </div>
            <div class="col-md-3 mb-5">
              <p>Sign up for our newsletter</p>
              <form action="#" class="footer-newsletter">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email...">
                  <button type="submit" class="btn"><span class="fa fa-paper-plane"></span></button>
                </div>
              </form>
            </div>
          </div>
          <div class="row pt-5">
            <p class="col-md-8 text-left">
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart text-primary" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
              
            <p class="col-md-4 text-right social">
              <a href="#"><span class="fa fa-tripadvisor"></span></a>
              <a href="#"><span class="fa fa-facebook"></span></a>
              <a href="#"><span class="fa fa-twitter"></span></a>
              <a href="#"><span class="fa fa-linkedin"></span></a>
              <a href="#"><span class="fa fa-vimeo"></span></a>
            </p>
          </div>
        </div>
      </footer>

    
      <!-- Modal -->
      <div class="modal fade " id="reservation-form" tabindex="-1" role="dialog" aria-labelledby="reservationFormTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
                  
                  <form action="index.html"  method="post" class="bg-white p-4">
                    <div class="row mb-4"><div class="col-12"><h2>Reservation</h2></div></div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="name">Name</label>
                        <input type="text" id="name" class="form-control ">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control ">
                      </div>
                    </div>
                
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label class="text-black font-weight-bold" for="email">Email</label>
                        <input type="email" id="email" class="form-control ">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                        <input type="text" id="checkin_date" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                        <input type="text" id="checkout_date" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="adults" class="font-weight-bold text-black">Adults</label>
                        <div class="field-icon-wrap">
                          <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                          <select name="" id="adults" class="form-control">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4+</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="children" class="font-weight-bold text-black">Children</label>
                        <div class="field-icon-wrap">
                          <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                          <select name="" id="children" class="form-control">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4+</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-12 form-group">
                        <label class="text-black font-weight-bold" for="message">Notes</label>
                        <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <input type="submit" value="Reserve Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                      </div>
                    </div>
                  </form>

                </div>
                
              </div>
            </div>
           
          </div>
        </div>
      </div>
      
      <script src="<?= base_url() ?>/guest-assets/js/jquery-3.3.1.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/jquery-migrate-3.0.1.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/popper.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/bootstrap.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/owl.carousel.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/jquery.stellar.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/jquery.fancybox.min.js"></script>
      <script src="<?= base_url() ?>/guest-assets/js/jquery.easing.1.3.js"></script>
      
      
      
      <script src="<?= base_url() ?>/guest-assets/js/aos.js"></script>
      
      <script src="<?= base_url() ?>/guest-assets/js/bootstrap-datepicker.js"></script> 
      <script src="<?= base_url() ?>/guest-assets/js/jquery.timepicker.min.js"></script> 

      <script src="<?= base_url() ?>/guest-assets/js/main.js"></script>
      <script type="text/javascript">
            //restricting past date in input type date
            $(function(){
                var dtToday = new Date();
            
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                day = '0' + day.toString();
                var maxDate = year + '-' + month + '-' + day;
                $('#checkout').attr('min', maxDate);
                $('#checkout2').attr('min', maxDate);

            });
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {

                
                <?php if(session()->getFlashdata('status')): ?>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: "<?= session()->getFlashdata('status_icon') ?>",
                        title: "<?= session()->getFlashdata('status_text') ?>",

                        })
                <?php endif; ?>

                <?php if(session()->getFlashdata('warning')): ?>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 7000,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: "<?= session()->getFlashdata('status_icon') ?>",
                        title: "<?= session()->getFlashdata('status_text') ?>",

                        })
                <?php endif; ?>
                <?php 
                unset($_SESSION['warning']);
                ?>

            });
        </script>
    </body>
  </html>