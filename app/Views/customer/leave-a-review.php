<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-11 col-lg-11">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Rate & Reviews</h4>
                        <p class="text-muted mb-4">Select a star</p>
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

                    <form action="<?= base_url('Customer/process-rates-reviews') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="username" value="<?= esc($username) ?>">
                        <input type="hidden" name="profile" value="<?= esc($profile) ?>">
                        <div class="row mb-3 mt-4">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rate" value="1" id="flexRadioDefault1" >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Terrible <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rate" value="2" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Poor <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rate" value="3" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Fair <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rate" value="4" id="flexRadioDefault4">
                                    <label class="form-check-label" for="flexRadioDefault4">
                                        Good <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rate" value="5" id="flexRadioDefault5" checked>
                                    <label class="form-check-label" for="flexRadioDefault5">
                                        Amazing <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Your Review here</label>
                            <textarea class="form-control" type="text" name="review" required></textarea>
                        </div>

                        <div class="mb-3 mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Submit </button>
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