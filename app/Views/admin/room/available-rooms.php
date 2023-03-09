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
            <h4 class="page-title">All Rooms</h4>
        </div>
    </div>
</div>

<div class="row mt-3 d-flex justify-content-center">
    <?php if(count($rooms) > 0): ?>
        <?php foreach($rooms as $room): ?>
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" height="260" style="width: 100%;">
                            </div>

                            <div class="col-md-7">
                                <h4><?= esc(ucwords($room->room_name)) ?></h4>
                                <span>Rate Per Night: <i class="fa-solid fa-peso-sign"></i><?= esc($room->rate_per_night) ?></span>
                               
                                <?php if($room->max_adults_capacity > 0): ?>
                                    <br>
                                    <span><i class="fa-regular fa-user"></i> Max <?= esc($room->max_adults_capacity) ?> <?= $room->max_adults_capacity > 1 ? 'adults' : 'adult' ?></span>
                                <?php endif; ?>
                                
                                <?php if($room->max_children_capacity > 0): ?>
                                    <br>
                                    <span><i class="fa-solid fa-children"></i> Max <?= esc($room->max_children_capacity) ?> <?= $room->max_children_capacity > 1 ? 'children' : 'child' ?></span>
                                    <br>
                                <?php endif; ?>
                                
                                <?php if($room->available_rooms > 0): ?>
                                    <p class="text-danger mt-3">Our last <?= esc($room->available_rooms) ?> <?= $room->available_rooms > 1 ? 'rooms' : 'room'; ?> </p>
                                    <a href="<?= base_url() ?>/Room/view-room-full-details/<?= $room->id ?>" class="btn btn-primary btn-sm">View full details</a>
                                <?php else: ?>
                                    <p class="text-danger mt-3">All Rooms are reserved</p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        <?php endforeach; ?>    
    <?php else: ?>
        <h2 class="text-center">Please add Rooms</h2>

    <?php endif; ?>
</div>


<?= $this->endSection() ?>