<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                        <p class="text-muted mb-4">Enter your email address and password</p>
                    </div>

                    <?php if(!empty(session()->getFlashdata('invalid'))): ?>
                        <div class="bg-danger text-white" style="text-align:center; padding: 5px; margin-bottom: 10px">
                            <?= session()->getFlashdata('invalid') ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty(session()->getFlashdata('success'))): ?>
                        <div class="bg-success text-white" style="text-align:center; padding: 5px; margin-bottom: 10px">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/Customer/auth') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3 ">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
                            <span class="text-danger text-sm"><?= isset($validation) ? $validation->getError('email') : '' ?></span>
                        </div>

                        <div class="mb-3 ">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                            <span class="text-danger text-sm"><?= isset($validation) ? $validation->getError('password') : '' ?></span>
                            <a class="fs-6" href="<?= base_url('Customer/forgot-password') ?>">Forgot password?</a>
                        </div>
                        

                        <div class="mb-3 mb-0 text-center">
                        <?php if($website->login == 0): ?>
                            <button class="btn btn-primary" type="submit"> Sign In </button>
                        <?php else: ?>
                            <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary">Sign In</a>
                        <?php endif ?>
                        </div>
                        <div class="mb-3 mb-0 text-center">
                            <span>Not Registered? </span><a href="<?= base_url('Customer/register') ?>" type="submit"> Sign up </a>
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
</section>

<div class="modal fade" id="room_shutdown" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Website Reminder</h4>
        <p class="text-center">
            Sorry logging in temporarily unavailable
        </p>
      </div>
      <div class="modal-footer border-0">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>




<?= $this->endSection() ?>