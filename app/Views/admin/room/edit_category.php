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
            <h4 class="page-title">Edit <?= esc(ucwords($room_category->category_name)) ?></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Room/all-category') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/Room/update_room_category/<?= $room_category->category_id ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $room_category->category_id ?>">
                <div class="row">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" value="<?= set_value('category_name', esc($room_category->category_name)) ?>" class="form-control" placeholder="Catgory Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'category_name') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="max_adults_capacity" class="form-label">Max Adults Capacity</label>
                        <input type="number" name="max_adults_capacity" value="<?= set_value('max_adults_capacity', esc($room_category->max_adults_capacity)) ?>" class="form-control" placeholder="Adult Capacity here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'max_adults_capacity') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="max_children_capacity" class="form-label">Max Childred Capacity</label>
                        <input type="number" name="max_children_capacity" value="<?= set_value('max_children_capacity', esc($room_category->max_children_capacity)) ?>" class="form-control" placeholder="Children Capacity here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'max_children_capacity') : '' ?></span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Room Category</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>