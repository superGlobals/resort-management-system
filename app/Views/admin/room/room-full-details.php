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
            <h4 class="page-title"><?= esc(ucwords($room->room_name)) ?></h4>
        </div>
    </div>
</div>

<div class="row ">
   <div class="col-md-5 mt-2">
        <img src="<?= base_url() ?>/uploads/<?= $room->room_image ?>" height="300" style="width: 100%;">

        <?php if($room->max_adults_capacity > 0): ?>
            <br>
            <h5><i class="fa-regular fa-user"></i> Max <?= esc($room->max_adults_capacity) ?> <?= $room->max_adults_capacity > 1 ? 'adults' : 'adult' ?></h5>
        <?php endif; ?>
        
        <?php if($room->max_children_capacity > 0): ?>
            <br>
            <h5><i class="fa-solid fa-children"></i> Max <?= esc($room->max_children_capacity) ?> <?= $room->max_children_capacity > 1 ? 'children' : 'child' ?></h5>
          
        <?php endif; ?>

        <?php $total_fax = $room->max_adults_capacity + $room->max_children_capacity  ?>
        <h5>Total of <?= $total_fax ?> person room capacity</h5>
        <h5>Rate Per Night: <i class="fa-solid fa-peso-sign"></i><?= esc($room->rate_per_night) ?></h5>
        <div class="mt-3 mb-2 text-center">
            <a href="<?= base_url() ?>/ReservationTransaction/checkin/<?= $room->id ?>" class="btn btn-primary">Checkin Now</a>
        </div>
   </div>
   <div class="col-md-7">
        <h3>Room Descrition</h3>
        <hr>
        <p><?= ucwords($room->room_description) ?></p>
   </div>
</div>


<?= $this->endSection() ?>