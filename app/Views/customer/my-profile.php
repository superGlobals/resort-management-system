<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <?php if(!empty(session()->getFlashdata('success'))): ?>
            <div class="bg-success text-white" style="text-align:center; padding: 5px; margin-bottom: 10px">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body pt-4 d-flex flex-column align-items-center">
                  
                        <img src="<?= base_url() ?>/uploads/<?= esc($profile->profile) ?>" id="previewFile" alt="" class="rounded-circle" width="200" height="200">
                        
                        <h5 class="text-center mt-3">Change Profile</h5>
                        <form action="<?= base_url('Customer/change-profile') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $profile->id ?>">
                            <input type="file" class="form-control form-control-sm" name="profile" id="fileInput">
                            <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'profile') : '' ?></span>
                            <div class="mt-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Save </button>
                            </div>
                        </form>
              
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow border-0 p-3">
                    
                    <div class="card-body">
                        
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button onclick="set_tab(this.getAttribute('data-bs-target'))"  class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic-info" id="basic-info-tab">Profile</button>
                            </li>
                            <li class="nav-item">
                                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#change-pass" id="change-pass-tab">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active basic-info" id="basic-info">
                                <div class="row">
                                    <h3 class="mt-3">Basic Information</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" class="form-control" readonly value="<?= esc(ucwords($profile->name)) ?>" style="background-color: #e9ecef;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control" readonly value="<?= esc($profile->email) ?>" style="background-color: #e9ecef;">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Gender</label>
                                            <input type="text" class="form-control" readonly value="<?= esc(ucwords($profile->gender)) ?>" style="background-color: #e9ecef;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Contact</label>
                                            <input type="number" class="form-control" readonly data-bs-toggle="modal" data-bs-target="#changeContact<?= $profile->id ?>" value="<?= esc(ucwords($profile->contact)) ?>" style="background-color: #e9ecef;">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Birthdate</label>
                                            <input type="text" class="form-control" readonly value="<?= esc(ucwords($profile->birthdate)) ?>" style="background-color: #e9ecef;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Age</label>
                                            <input type="number" class="form-control" readonly value="<?= esc(ucwords($profile->age)) ?>" style="background-color: #e9ecef;">
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" readonly value="<?= esc(ucwords($profile->address)) ?>" style="background-color: #e9ecef;">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="change-pass">
                                <h3 class="mt-3">Change Password</h3>
                                <form action="<?= base_url('Customer/change-pass') ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $profile->id ?>">
                                    <div class="mb-3">
                                        <label for="">Current Password</label>
                                        <input type="text" class="form-control" name="current_pass" value="<?= set_value('current_pass') ?>" placeholder="Enter your current password">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'current_pass') : '' ?>  <?= isset($validation2) ? $validation2 : '' ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">New Password</label>
                                        <input type="text" class="form-control" name="new_pass" value="<?= set_value('new_pass') ?>" placeholder="Enter your new password">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'new_pass') : '' ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Confirm new Password</label>
                                        <input type="text" class="form-control" name="confirm_pass" value="<?= set_value('confirm_pass') ?>" placeholder="Enter your new password">
                                        <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'confirm_pass') : '' ?></span>
                                    </div>

                                    <div class="text-center">
                                    <button class="btn btn-primary mt-3">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="changeContact<?= $profile->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">Change Contact Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <?= csrf_field() ?>
        <form action="<?= base_url('Customer/change-contact') ?>" method="POST">
            <input type="hidden" name="id" value="<?= $profile->id ?>">
            <div>
                <input type="number" name="contact" class="form-control" value="<?= set_value('contact') ?>" placeholder="New Contact Number" required>
                <span class="text-danger text-sm"><?= isset($validation) ? show_error($validation, 'contact') : '' ?></span>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Save</button>
        </form>
          
      </div>
      <!-- <div class="modal-footer" style="border: none;">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div> -->
    </div>
  </div>
</div>



<?= $this->endSection() ?>