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
            <h4 class="page-title">Edit User <?= esc(ucfirst($user->firstname)) ?></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('User/user-management') ?>" class="btn btn-primary float-end">Back</a>
                <img src="<?= base_url() ?>/uploads/<?= esc($user->profile) ?>" class="rounded-circle" id="previewFile" width="50" height="50">
            </div>
            <div class="card-body">
                
            <form action="<?= base_url() ?>/User/update/<?=$user->id?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" name="firstname" value="<?= set_value('firstname', esc($user->firstname)) ?>" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'firstname') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" name="middlename" value="<?= set_value('middlename', esc($user->middlename)) ?>" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'middlename') : '' ?></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" name="lastname" value="<?= set_value('lastname', esc($user->lastname)) ?>" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'lastname') : '' ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email', esc($user->email)) ?>" class="form-control">
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'email') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Show/Hide Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Leave empty to keep old password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'password') : '' ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">User Access</label>
                        <select class="form-select" name="user_access">
                            <option value="<?= esc($user->user_access) ?>"><?= esc(ucfirst($user->user_access)) ?></option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                        </select>
                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'user_role') : '' ?></span>
                    </div>

                    <div class="col-md-6 mb3">
                        <label for="example-fileinput" class="form-label">Upload user profile (optional)</label>
                        <input type="file" id="fileInput" name="profile" class="form-control">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>

                
            </form>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<?= $this->endSection() ?>