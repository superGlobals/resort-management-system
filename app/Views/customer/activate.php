<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-lg-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h4>Activation process</h4>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                        <a class="btn btn-primary" href="<?= base_url('Customer/register') ?>">Register again</a>
                    <?php endif; ?>

                    <?php if(isset($success)): ?>
                        <div class="alert alert-success">
                            <?= $success ?>
                        </div>

                        <a class="btn btn-primary" href="<?= base_url('Customer/login') ?>">Login now</a>
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