<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Forgot Password</h4>
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

                    <form action="<?= base_url('/Customer/forgot-password-process') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3 ">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                        </div>

                        
                        <div class="mb-3 mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Find </button>
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



<?= $this->endSection() ?>