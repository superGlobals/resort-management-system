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
            <h4 class="page-title">Add User Page</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('Customer/customer-list') ?>" class="btn btn-primary float-end">Back</a>
                <img src="<?= base_url() ?>/uploads/user_male.jpg" class="rounded-circle" id="previewFile" width="50" height="50">
            </div>
            <div class="card-body">
                
            <form action="<?= base_url('Customer/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" value="<?= set_value('name') ?>" class="form-control" placeholder="Full Name here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'name') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="number" name="contact" value="<?= set_value('contact') ?>" class="form-control" placeholder="Contact here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'contact') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="email" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="">
                            <option value="">--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'gender') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="contact" class="form-label">Birthdate</label>
                        <input type='text' name="birthdate" placeholder="Select Birthdate" value="<?= set_value('birthdate') ?>" id="bdate"  class="form-control" />
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'birthdate') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" name="age" id="age" value="<?= set_value('age') ?>" class="form-control" readonly>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'age') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Email here...">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                    </div>

                    <div class=" mb-3">
                        <label for="password" class="form-label">Show/Hide Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Password here...">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Upload user profile (optional)</label>
                        <input type="file" id="fileInput" name="profile" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'profile') : '' ?></span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>