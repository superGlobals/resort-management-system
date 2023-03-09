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
                <a href="<?= base_url('Room-number/room-number') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/Room-number/update/<?= $number->room_number_id ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="mb-3">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" name="room_number" value="<?= set_value('room_number', esc($number->room_number)) ?>" class="form-control" placeholder="Room Number here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'room_number') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Room Number Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="<?= esc($number->room_number_status) ?>"><?= esc($number->room_number_status) ?></option>
                            <option value="available">Available</option>
                            <option value="not available">Not Available</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'description') : '' ?></span>
                    </div>

                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Room Number</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>