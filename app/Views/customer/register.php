<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign up</h4>
                        <p class="text-muted mb-4">Enter your basic info to create an account.</p>
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

                    <form action="<?= base_url('/Customer/register-process') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input class="form-control" type="text" name="name" value="<?= set_value('name') ?>" placeholder="Enter your full name">
                            <span class="text-danger"><?= isset($validation) ? show_error($validation, 'name') : '' ?></span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Gender</label>
                                <select name="gender" id="" class="form-select">
                                    <option value="<?= set_value('gender') ?>"><?= isset($_POST['gender']) ? ucwords(set_value('gender')) : '--Select Gender--' ?></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'gender') : '' ?></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type='number' name="contact" placeholder="Enter your contact" value="<?= set_value('contact') ?>" class="form-control" />
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'contact') : '' ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact" class="form-label">Birthdate</label>
                                <input type='text' name="birthdate" placeholder="Select Birthdate" value="<?= set_value('birthdate') ?>" id="bdate" readonly="readonly" class="form-control" />
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'birthdate') : '' ?></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" name="age" id="age" value="<?= set_value('age') ?>" class="form-control" readonly style="background-color: #e9ecef;">
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'age') : '' ?></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    
                                </div>
                                <span class="text-danger"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="<?= set_value('address') ?>" placeholder="Enter your address">
                            <span class="text-danger"><?= isset($validation) ? show_error($validation, 'address') : '' ?></span>
                        </div>

                        <div class="mb-3 mb-0 text-center">
                        <?php if($website->register == 0): ?>
                            <button class="btn btn-primary" type="submit"> Sign up </button>
                        <?php else: ?>
                            <a href="#room_shutdown" data-bs-toggle="modal" class="btn btn-primary">Sign up</a>
                        <?php endif ?>
                        </div>
                        <div class="mb-3 mb-0 float-end">
                            <a class="" type="submit"> Sign in </a>
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
            Sorry registering is temporarily unavailable
        </p>
      </div>
      <div class="modal-footer border-0">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>