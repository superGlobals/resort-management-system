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
            <h4 class="page-title">Shutdown Website</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <h3>Login</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <h3><a href="#login<?= $website->id ?>" data-bs-toggle="modal" class="<?= $website->login == 0 ? 'badge bg-success' : 'badge bg-danger' ?>"><?= $website->login == 0 ? 'Active' : 'Inactive' ?></a></h3>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <h3>Register</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <h3><a href="#register<?= $website->id ?>" data-bs-toggle="modal" class="<?= $website->register == 0 ? 'badge bg-success' : 'badge bg-danger' ?>"><?= $website->register == 0 ? 'Active' : 'Inactive' ?></a></h3>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <h3>Room Reservation</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <h3><a href="#room<?= $website->id ?>" data-bs-toggle="modal" class="<?= $website->room_reservation == 0 ? 'badge bg-success' : 'badge bg-danger' ?>"><?= $website->room_reservation == 0 ? 'Active' : 'Inactive' ?></a></h3>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <h3>Event Reservation</h3>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <h3><a href="#event<?= $website->id ?>" data-bs-toggle="modal" class="<?= $website->event_reservation == 0 ? 'badge bg-success' : 'badge bg-danger' ?>"><?= $website->event_reservation == 0 ? 'Active' : 'Inactive' ?></a></h3>
                    </div>
                    
                    <div class="text-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-2">
                                <label for="">Shutdown All</label>
                                <h3><a href="#shutdownAll<?= $website->id ?>" class="badge bg-danger" data-bs-toggle="modal">Shutdown All</a></h3>
                            </div>
                            <div class="col-md-2">
                                <label for="">Activate All</label>
                                <h3><a href="#activateAll<?= $website->id ?>" class="badge bg-success" data-bs-toggle="modal">Activate All</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<!-- shutdown login -->
<div class="modal fade" id="login<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2><?= $website->login == 0 ? 'Shutdown login page?' : 'Activate login page?' ?></h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Shutdown/login') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="<?= $website->login ?>">
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- shutdown register -->
<div class="modal fade" id="register<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2><?= $website->register == 0 ? 'Shutdown register page?' : 'Activate register page?' ?></h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Shutdown/register') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="<?= $website->register ?>">
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- shutdown room reservation -->
<div class="modal fade" id="room<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2><?= $website->room_reservation == 0 ? 'Shutdown room reservation page?' : 'Activate room reservation page?' ?></h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Shutdown/room') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="<?= $website->room_reservation ?>">
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- shutdown evenet reservation -->
<div class="modal fade" id="event<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2><?= $website->event_reservation == 0 ? 'Shutdown event reservation page?' : 'Activate event reservation page?' ?></h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Shutdown/event') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="<?= $website->event_reservation ?>">
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- shutdown all -->
<div class="modal fade" id="shutdownAll<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2>Shutdown all in website?</h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Shutdown/all') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- activate all -->
<div class="modal fade" id="activateAll<?= $website->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h2>Activate all in website?</h2>
      </div>
      <div class="text-center mb-3" style="border: none;">
        <form action="<?= base_url('Activate/all') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script>
        $(document).ready(function () {
            $('.confirm_del').click(function (e) { 
                e.preventDefault();
                
                let id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn
                Swal.fire({
                title: 'Are you sure?',
                text:  "Room category will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/Room/delete/"+id,
                            success: function (response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })

                                    Toast.fire({
                                    text: response.status_text,
                                    icon: response.status_icon,
                                }).then((success) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })

            });
        });

        $(document).ready(function () {
            $('.checkout').click(function (e) { 
                e.preventDefault();
                
                let id = $(this).val(); //"this" means it will get the value of .confirm_del_btn once the user click that btn
                Swal.fire({
                title: 'Are you sure?',
                text:  "Room category will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax({
                            url: "<?=base_url()?>/ReservationTransaction/checkout/"+id,
                            success: function (response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })

                                    Toast.fire({
                                    text: response.status_text,
                                    icon: response.status_icon,
                                }).then((success) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })

            });
        });
    </script>


<?= $this->endSection() ?>