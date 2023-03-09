<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
    <div class="container mt-4">
        <h4 class="mb-4">Entrance & Cottage Reservation List</h4>
        <?php if(!empty(session()->getFlashdata('success'))): ?>
            <div class="bg-success text-white" style="text-align:center; padding: 5px; margin-bottom: 10px">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="card shadow-lg p-3" style="border: none">
          
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="pill" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="accepted-tab" data-bs-toggle="pill" data-bs-target="#accepted" type="button" role="tab" aria-controls="accepted" aria-selected="false">Accepted</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="pill" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rejected-tab" data-bs-toggle="pill" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">Cancelled</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        
                        <div class="row">
                            <?php if(count($pendings) > 0): ?>
                                <?php foreach($pendings as $pending): ?>
                                    <div class="col-md-4">
                                        <div class="card shadow border-0 mt-3">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?= esc(ucwords($pending->cottage_name)) ?></h5>
                                                <p>
                                                    <span class="fw-bold">Date of visit: </span><?= esc(get_date($pending->date_visit)) ?><br>
                                                    <span class="fw-bold">Time arrival:</span> <?= esc($pending->time_arrival) ?><br>
                                                    <span class="fw-bold">Visit type:</span> <?= esc(ucfirst($pending->visit_type)) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Cottage Price:</span> <?= esc($pending->cottage_price) ?><br>
                                                    <span class="fw-bold">Total Adult:</span> <?= esc($pending->total_adult) ?><br>
                                                    <span class="fw-bold">Total Child:</span> <?= esc($pending->total_child) ?><br>
                                                    <span class="fw-bold">Total Payment:</span> <i class="fa-solid fa-peso-sign"></i> <?= esc(number_format((int)$pending->total_bill)) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Transaction Date:</span> <?= esc(get_date($pending->transaction_date)) ?><br>
                                                    <span class="fw-bold">Transaction ID:</span> <?= esc($pending->unique_id) ?><br>
                                                </p>

                                                <span class="badge bg-warning"><?= esc(ucwords($pending->transaction_status)) ?></span>
                                                <!-- <a href="#cancelPending<?= $pending->unique_id ?>" data-bs-toggle="modal" class="badge btn btn-danger btn-sm float-end">Cancel Reservation</a> -->

                                            </div>
                                        </div>
                                    </div>
                                
                            <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="text-center">No Pending Reservation</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>