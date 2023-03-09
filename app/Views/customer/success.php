<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-5 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto p-3">
                        <i class="fa-solid fa-circle-check fs-1 text-success mb-3"></i>
                        <h5>Rating succesfully added. We appreciate your rating.</h5>
                        <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm mt-3">Back</a>
                    </div>

                   
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