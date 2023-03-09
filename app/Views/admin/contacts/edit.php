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
            <h4 class="page-title">Edit contacts</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Contacts') ?>" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/Contacts/update/<?= $contact->id ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="number" name="contact" value="<?= set_value('contact', $contact->contact) ?>" class="form-control" placeholder="Please enter gcash number" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'contact') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" value="<?= set_value('address', $contact->address) ?>" class="form-control" placeholder="Please enter gcash number" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'address') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email', $contact->email) ?>" class="form-control" placeholder="Please enter gcash number" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="working_hours" class="form-label">Working Hours</label>
                        <input type="working_hours" name="working_hours" value="<?= set_value('working_hours', $contact->working_hours) ?>" class="form-control" placeholder="Please enter gcash number" required>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'working_hours') : '' ?></span>
                    </div>

                
                    
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Contacts</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>