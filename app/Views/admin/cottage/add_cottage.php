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
            <h4 class="page-title">Add cottage page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Cottage/cottage-list') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('Cottage/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class=" mb-3">
                        <label for="cottage_name" class="form-label">Cottage Name</label>
                        <input type="text" name="cottage_name" value="<?= set_value('cottage_name') ?>" class="form-control" placeholder="Cottage name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'cottage_name') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="cottage_capacity" class="form-label">Cottage Capacity</label>
                        <input type="number" name="cottage_capacity" value="<?= set_value('cottage_capacity') ?>" class="form-control" placeholder="Cottage capacity here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'cottage_capacity') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="available_cottage" class="form-label">Available Cottage</label>
                        <input type="number" name="available_cottage" value="<?= set_value('available_cottage') ?>" class="form-control" placeholder="Please specify how many cottage like this...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'available_cottage') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="cottage_price" class="form-label">Cottage Price</label>
                        <input type="number" name="cottage_price" value="<?= set_value('cottage_price') ?>" class="form-control" placeholder="Cottage Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'cottage_price') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="example-fileinput" class="form-label">Upload cottage image</label>
                        <input type="file" id="fileInput" name="cottage_image" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'cottage_image') : '' ?></span>
                    </div>

                    <div class="mb3">
                        <img src="<?= base_url() ?>/uploads/no_image.jpg" id="previewFile" width="150" height="150">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Cottage</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>