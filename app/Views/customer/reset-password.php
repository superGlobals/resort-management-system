<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Reset Password</h4>
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

                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php else: ?>
                        <?= form_open() ?>
                            <div class="mb-3 ">
                                <label for="newpass" class="form-label">Enter new password</label>
                                <input class="form-control" type="text" name="password" value="<?= set_value('password') ?>" placeholder="Enter your new password">
                                <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                            </div>
                            <div class="mb-3 ">
                                <label for="confirmpass" class="form-label">Confirm new password</label>
                                <input class="form-control" type="text" name="confirm_password" value="<?= set_value('confirm_password') ?>" placeholder="Confirm new password">
                                <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'confirm_password') : '' ?></span>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Submit </button>
                            </div>
                        <?= form_close() ?>
                    <?php endif; ?>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
            <!-- end row -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
</section>



<?= $this->endSection() ?>