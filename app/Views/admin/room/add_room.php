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
                <a href="<?= base_url('Room/all-rooms') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('Room/store_room') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Name</label>
                        <input type="text" name="room_name" value="<?= set_value('room_name') ?>" class="form-control" placeholder="Room Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_name') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="room_category" class="form-label">Room Category</label>
                        <select name="room_category" class="form-select">
                            <option value="">--Select Room Category--</option>
                            <?php foreach($room_category as $category_room): ?>
                                <option value="<?= $category_room->category_id ?>"><?= esc(ucwords($category_room->category_name)) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_category') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="available_rooms" class="form-label">How many rooms are available in this category?</label>
                        <input type="number" name="available_rooms" value="<?= set_value('available_rooms') ?>" class="form-control" placeholder="Please specify available rooms in this category...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'available_rooms') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="rate_per_night" class="form-label">Rate Per Night</label>
                        <input type="number" name="rate_per_night" value="<?= set_value('rate_per_night') ?>" class="form-control" placeholder="Rate per night here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'rate_per_night') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="room_status" class="form-label">Room Status</label>
                        <select name="room_status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_status') : '' ?></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="room_image" class="form-label">Upload Room Image</label>
                            <input type="file" id="fileInput" name="room_image" class="form-control">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_image') : '' ?></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <img src="<?= base_url() ?>/uploads/no_image.jpg" id="previewFile" width="100" height="100">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="room_description" class="form-label">Room Description</label>
                        <textarea id="editor" name="room_description"><?= set_value('room_description') ?></textarea>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_description') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Room</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>