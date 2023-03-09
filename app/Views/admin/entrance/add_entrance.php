<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
 <!-- Start Content-->
 <div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                
            </div>
            <h4 class="page-title">Add entrance fee page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Entrance/entrance-list') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('Entrance/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                    <div class=" mb-3">
                        <label for="adult_price" class="form-label">Adul Price</label>
                        <input type="number" name="adult_price" value="<?= set_value('adult_price') ?>" class="form-control" placeholder="Adult Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adult_price') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="child_price" class="form-label">Child Price</label>
                        <input type="number" name="child_price" value="<?= set_value('child_price') ?>" class="form-control" placeholder="Child Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'child_price') : '' ?></span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Entrance Fee</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>