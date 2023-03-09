<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Resort Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="<?= base_url() ?>/guest-assets/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>/guest-assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>/guest-assets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>/guest-assets/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?= base_url('/') ?>">PMP</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="<?= base_url() ?>/guest-assets/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="<?= base_url('/') ?>">Home</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('Customer/all-rooms') ?>">Rooms</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('Customer/events-place') ?>">Events Place</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('Customer/rides') ?>">Rides</a></li>
          <?php if(session()->has('loggedCustomerId')): ?>
            <li class="dropdown"><a href="#"><span>My Reservation</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= base_url('Customer/my-reservation') ?>">Room</a></li>
              <li><a href="<?= base_url('Customer/my-reservation-events-place') ?>">Events & Place</a></li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if(!session()->has('loggedCustomerId')): ?>
            <li><a class="nav-link scrollto" href="<?= base_url('Customer/login') ?>">Sign in</a></li>
          <?php endif; ?>
          <?php if(!session()->has('loggedCustomerId')): ?>
            <li><a class="nav-link scrollto" href="<?= base_url('Customer/register') ?>">Sign up</a></li>
          <?php endif; ?>
          <?php if(session()->has('loggedCustomerId')): ?>
            <li class="dropdown"><a href="#"><span><?= esc(ucwords(session()->get('loggedCustomerName'))) ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= base_url('Customer/my-profile') ?>">Profile</a></li>
              <li><a class="nav-link scrollto" href="<?= base_url('Customer/logout') ?>">Logout</a></li>
            </ul>
          </li>
            
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <?= $this->renderSection('content') ?>


  <!-- ======= Footer ======= -->
  <footer id="footer">


    <!-- <div class="footer-top">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="row">

              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Useful Links</h4>
                <ul>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                </ul>
              </div>

              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                </ul>
              </div>

              <div class="col-lg-3 col-md-6 footer-contact">
                <h4>Contact Us</h4>
                <p>
                  A108 Adam Street <br>
                  New York, NY 535022<br>
                  United States <br><br>
                  <strong>Phone:</strong> +1 5589 55488 55<br>
                  <strong>Email:</strong> info@example.com<br>
                </p>

              </div>

              <div class="col-lg-3 col-md-6 footer-info">
                <h3>About Hidayah</h3>
                <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                <div class="social-links mt-3">
                  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                  <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PMP</span></strong>. All Rights Reserved
      </div>
    
    </div>
  </footer><!-- End Footer -->

  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?= base_url() ?>/guest-assets/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/guest-assets/assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
    $(function() {
            $("#bdate").datepicker({
            onSelect: function(value, ui) {
                today = new Date(),
                birthDate = new Date($('#bdate').val());
                m = today.getMonth() - birthDate.getMonth();
                    age = today.getFullYear() - ui.selectedYear;

                    day = birthDate.getDay()
                    year = birthDate.getFullYear()
                    month = birthDate.getMonth()

                    agee = 18

                    var mydate = new Date();
                    mydate.setFullYear(year, month-1, day);

                    var currdate = new Date();
                    currdate.setFullYear(currdate.getFullYear() - agee);
                    if(birthDate >= today )
                    {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid Birthdate',
                            showConfirmButton: true,
                            timer: false
                            });
                            $('#bdate').val('');

                    }
                    else if(currdate < mydate)
                    {
                        Swal.fire({
                            icon: 'warning',
                            title: 'You must be at least 18 years of age.',
                            showConfirmButton: true,
                            timer: false
                            });
                            $('#bdate').val('');
                            $('#age').val('');

                    }
                    else
                    {
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
                        {
                            age--;
                        }
                        $('#age').val(age);
                    }
            },
            
            dateFormat: 'mm-dd-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+"
            });
            
        });
  </script>
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

        <script>
            jQuery(document).ready(function(){

                jQuery("#opt12").hide();
                

                jQuery("#gcash_payment").change(function(){ 
                    var x = jQuery(this).val();         
                    if(x == 'cash') {
                     
                      jQuery("#opt12").hide();
                      jQuery("#cash_btn").show();
                        $("#required").attr("required", false);
                    }
                     else if(x == 'gcash') {

                        jQuery("#opt12").show();
                        jQuery("#cash_btn").hide();
                        $("#required").attr("required", true);

                    } 
                    else {
                        jQuery("#opt11").hide();

            
                    }
                });
                
            });

            
        </script>

          
        <script>
        
        //get the days between two dates
          
        function getNights(){
        
        var checkin = new Date(document.getElementById('checkout').value);
        var checkout = new Date(document.getElementById('checkout2').value);
      
        var time_difference = checkout.getTime() - checkin.getTime();
       
        var days_difference = time_difference / (1000*3600*24);
        if(days_difference > 1)
        {
            total_night = "nights"
        }
        else
        {
          total_night = "night"
        }

        document.getElementById('total_stay').value = days_difference + ' ' + total_night;

        var total_stay = days_difference;
        var rate = document.getElementById('rate_per_night').value;

        var total_bill = total_stay * rate

        document.getElementById('total_bill').value = total_bill

        var res = total_bill

        var deposit = res / 2
        document.getElementById('deposit').value = deposit
        document.getElementById('deposit2').innerHTML = deposit
        }

        //
        function total_per(){
          // getting the value from users input
          let total_adult = document.getElementById('total_adult').value
          let total_child = document.getElementById('total_child').value

          // get the dynamic value
          let cottage_price = document.getElementById('cottage_price').value
          let adult_price = document.getElementById('adult_price').value
          let child_price = document.getElementById('child_price').value

          // adding the total person
          let total_person = (+total_adult) + (+total_child)
          let total_person_result = document.getElementById('total_persons').value = total_person

          // total price of adult per entrance
          let adult_price_result = total_adult * adult_price

          //total price of child per entrance
          let child_price_result = total_child * child_price

          let total_bill = (+cottage_price) + (+adult_price_result) + (+child_price_result)

          document.getElementById('total_bill').value = total_bill
          
        }


        </script>  

        <script>
          $(document).ready( function () {
              $('#myTable').DataTable();
          } );

          $(document).ready( function () {
              $('#myTable2').DataTable();
          } );

          // auto preview image file
          fileInput.onchange = evt => 
          {
              const [file] = fileInput.files
              if (file) 
              {
                  previewFile.src = URL.createObjectURL(file)
              }
          }
        </script>

        <script>
          var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#basic-info";

          function show_tab(tab_name)
          {
            const someTabTriggerEl = document.querySelector(tab_name +"-tab");
            const tab = new bootstrap.Tab(someTabTriggerEl);

            tab.show();

          }

          function set_tab(tab_name)
          {
            tab = tab_name;
            sessionStorage.setItem("tab", tab_name);
          }

          window.onload = function(){

            show_tab(tab);
          }
        </script>


</body>

</html>