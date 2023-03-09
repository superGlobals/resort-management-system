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
            <h4 class="page-title">Edit gcash</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Payment/gcash-info') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/Payment/update/<?= $payment->id ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $payment->id ?>">
                <input type="hidden" name="file_name" value="<?= $payment->gcash_qr ?>">
                <div class="row">
                    <div class="mb-3">
                        <label for="gcash_number" class="form-label">Gcash Number</label>
                        <input type="number" name="gcash_number" value="<?= set_value('gcash_number', $payment->gcash_number) ?>" class="form-control" placeholder="Please enter gcash number">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'gcash_number') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="gcash_qr" class="form-label">Gcash Qr</label>
                        <input type="file" id="fileInput" name="gcash_qr" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'gcash_qr') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <img src="<?= base_url() ?>/uploads/<?= $payment->gcash_qr ?>" id="previewFile" width="100" style="height:100% ;">
                    </div>
                    
                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Gcash</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>