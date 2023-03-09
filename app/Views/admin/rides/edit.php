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
            <h4 class="page-title">Edit Ride</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Rides') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/Rides/update/<?= $ride->id ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="mb-3">
                        <label for="rides_name" class="form-label">Ride Name</label>
                        <input type="text" name="rides_name" value="<?= set_value('rides_name', esc($ride->rides_name)) ?>" class="form-control" placeholder="Room Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'rides_name') : '' ?></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Upload Ride Image</label>
                            <input type="file" id="fileInput" name="image" class="form-control">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'image') : '' ?></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <img src="<?= base_url() ?>/uploads/<?= $ride->image ?>" id="previewFile" width="100" height="100">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Ride Description</label>
                        <textarea class="form-control" id="editor" name="description"><?= set_value('description') ?><?= esc($ride->description) ?></textarea>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'description') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Ride</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>