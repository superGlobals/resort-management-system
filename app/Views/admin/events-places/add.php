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
            <h4 class="page-title">Add Room</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Events/events-places') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('Events/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="mb-3">
                        <label for="events_name" class="form-label">Event Name</label>
                        <input type="text" name="events_name" value="<?= set_value('events_name') ?>" class="form-control" placeholder="Event Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'events_name') : '' ?></span>
                    </div>

                    
                    <div class="mb-3">
                        <label for="max_capacity" class="form-label">Max capacity</label>
                        <input type="number" name="max_capacity" value="<?= set_value('max_capacity') ?>" class="form-control" placeholder="Enter max capacity">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'max_capacity') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" name="rate" value="<?= set_value('rate') ?>" class="form-control" placeholder="Enter Rate">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'rate') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Event Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'status') : '' ?></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Upload Event Image</label>
                            <input type="file" id="fileInput" name="image" class="form-control">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'image') : '' ?></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <img src="<?= base_url() ?>/uploads/no_image.jpg" id="previewFile" width="100" height="100">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="editor" name="description"><?= set_value('description') ?></textarea>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'description') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Event</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>