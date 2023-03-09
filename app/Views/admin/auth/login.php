<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Log In</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
            <meta content="Coderthemes" name="author" />
            <!-- App favicon -->
            <link rel="shortcut icon" href="assets/images/favicon.ico">
            
            <!-- App css -->
            <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
            <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style" />

        </head>

        <body>
            <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-lg-5">
                            <div class="card shadow-lg">
                                <div class="card-body p-4">
                                    
                                    <div class="text-center w-75 m-auto">
                                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                        <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                                    </div>

                                    <?php if(!empty(session()->getFlashdata('invalid'))): ?>
                                        <div class="bg-danger text-white" style="text-align:center; padding: 5px; margin-bottom: 10px">
                                            <?= session()->getFlashdata('invalid') ?>
                                        </div>
								    <?php endif; ?>

                                    <form action="<?= base_url('/Auth/loggedUser') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email address</label>
                                            <input class="form-control" type="email" id="emailaddress" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
                                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                                
                                            </div>
                                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                                        </div>

                                        <div class="mb-3 mb-0 text-center">
                                            <button class="btn btn-primary" type="submit"> Log In </button>
                                        </div>

                                    </form>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                            <!-- end row -->

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->

            <footer class="footer footer-alt text-white">
                <script>document.write(new Date().getFullYear())</script> © PMP
            </footer>

            <!-- bundle -->
            <script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
            
        </body>
    </html>
