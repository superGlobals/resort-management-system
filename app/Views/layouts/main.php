<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Resort Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

        <!-- third party css -->
        <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style">
        <link href="<?= base_url('assets/css/app-dark.min.css') ?>" rel="stylesheet" type="text/css" id="dark-style">
        
        <!-- Datatables css -->
        

        <!-- third party css -->
        <link href="<?= base_url('assets/css/vendor/dataTables.bootstrap5.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/vendor/responsive.bootstrap5.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/vendor/buttons.bootstrap5.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/vendor/select.bootstrap5.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">


        <div class="h-100" id="leftside-menu-container" data-simplebar="">

            <!--- Sidemenu -->
            <?= $this->include('layouts/inc/sidebar') ?>

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <?= $this->include('layouts/inc/topbar') ?>
            <!-- end Topbar -->
            
           
                <!-- end page title -->

                <?= $this->renderSection('content') ?>

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer shadow-lg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script> © PMP
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

        <script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

        <!-- third party js -->
        <script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery-jvectormap-world-mill-en.js') ?>"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="<?= base_url('assets/js/pages/demo.dashboard.js') ?>"></script>
        <!-- end demo js-->

        <!-- Datatables js -->
    
        <script src="<?= base_url('assets/js/vendor/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.bootstrap5.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.responsive.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/responsive.bootstrap5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.buttons.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.bootstrap5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.html5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.flash.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.print.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.keyTable.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.select.min.js') ?>"></script>

        <script src="<?= base_url('assets/js/pages/demo.datatable-init.js') ?>"></script>


        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>


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
                        timer: 6000,
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
        $(function() {
            $("#bdate").datepicker({
            onSelect: function(value, ui) {
                today = new Date(),
                birthDate = new Date($('#bdate').val());
                m = today.getMonth() - birthDate.getMonth();
                    age = today.getFullYear() - ui.selectedYear;
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


        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        $(document).ready(function() {
            $('.js-example-basic-multiples').select2();
        });

        // auto preview image file
        fileInput.onchange = evt => 
        {
            const [file] = fileInput.files
            if (file) 
            {
                previewFile.src = URL.createObjectURL(file)
            }
        }

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

        var current_checkout_date = new Date(document.getElementById('current_checkout_date').value);
        var time_difference2 =  checkout.getTime() - current_checkout_date.getTime()
        var days_difference2 = time_difference2 / (1000*3600*24);
        var total_stay2 = days_difference2;
       

        var total_bill = total_stay * rate
        var additional = total_stay2 * rate

        document.getElementById('total_bill').value = total_bill
        document.getElementById('additional').value = additional

        var res = total_bill

        var deposit = res / 2
        document.getElementById('deposit').value = deposit
        document.getElementById('deposit2').innerHTML = deposit
        }

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

        <script>
             // activating ckeditor textarea
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
            

        </script>

        <script>
        // print divs
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            }                    
        </script>

    <?= $this->renderSection('scripts') ?>
    </body>
</html>