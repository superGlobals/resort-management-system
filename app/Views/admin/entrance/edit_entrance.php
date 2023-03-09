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
            <h4 class="page-title">Edit entrance fee page</h4>
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
                
            <form action="<?= base_url() ?>/Entrance/update/<?= $entrance->id ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class=" mb-3">
                        <label for="adult_price" class="form-label">Day Adult Price</label>
                        <input type="number" name="adult_price" value="<?= set_value('adult_price', esc($entrance->adult_price)) ?>" class="form-control" placeholder="Adult Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'adult_price') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="child_price" class="form-label">Day Child Price</label>
                        <input type="number" name="child_price" value="<?= set_value('child_price', esc($entrance->child_price)) ?>" class="form-control" placeholder="Child Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'child_price') : '' ?></span>
                    </div>
                    <div class=" mb-3">
                        <label for="adult_price" class="form-label">Night Adult Price</label>
                        <input type="number" name="night_adult" value="<?= set_value('night_adult', esc($entrance->night_adult)) ?>" class="form-control" placeholder="Adult Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'night_adult') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="child_price" class="form-label">Night Child Price</label>
                        <input type="number" name="night_child" value="<?= set_value('night_child', esc($entrance->night_child)) ?>" class="form-control" placeholder="Child Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'night_child') : '' ?></span>
                    </div>
                    <div class=" mb-3">
                        <label for="adult_price" class="form-label">Overnight Adult Price</label>
                        <input type="number" name="overnight_adult" value="<?= set_value('overnight_adult', esc($entrance->overnight_adult)) ?>" class="form-control" placeholder="Adult Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'overnight_adult') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="child_price" class="form-label">Overnight Child Price</label>
                        <input type="number" name="overnight_child" value="<?= set_value('overnight_child', esc($entrance->overnight_child)) ?>" class="form-control" placeholder="Child Price here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'overnight_child') : '' ?></span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Entrance Fee</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>