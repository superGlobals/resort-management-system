<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
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
                                                <h5 class="fw-bold"><?= esc(ucwords($pending->events_name)) ?></h5>
                                                <p>
                                                    <span class="fw-bold">Date Booked: </span><?= esc(get_date($pending->date_book)) ?><br>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Rate:</span> <?= esc($pending->rate) ?><br>
                                                    <span class="fw-bold">Total Payment:</span> <?= esc($pending->total_bill) ?><br>
                                                    <span class="fw-bold">Total Person:</span> <?= esc($pending->total_person) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Payment Deposit:</span> <?= esc($pending->payment_deposit) ?><br>
                                                    <?php if($pending->resubmit_ref == 'true'): ?>
                                                        <span class="fw-bold">Gcash Ref #:</span><a href="#resubmit<?= $pending->transaction_id ?>" data-bs-toggle='modal' class='badge btn btn-success btn-sm'>Re submit ref no.</a><br>
                                                        
                                                    <?php else: ?>
                                                        <span class="fw-bold">Gcash Ref #:</span> <?= esc($pending->gcash_reference_number) ?><br>

                                                    <?php endif ?>
                                                    
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Transaction Date:</span> <?= esc(get_date($pending->transaction_date)) ?><br>
                                                    <span class="fw-bold">Transaction ID:</span> <?= esc($pending->unique_id) ?><br>
                                                </p>

                                                <span class="badge bg-warning"><?= esc(ucwords($pending->transaction_status)) ?></span>
                                                <a href="#cancelPending<?= $pending->transaction_id ?>" data-bs-toggle="modal" class="badge btn btn-danger btn-sm float-end">Cancel Reservation</a>

                                            </div>
                                        </div>
                                    </div>
                                <?php require 'modal/resubmitRef.php' ?>
                                <?php require 'modal/cancelPendingEvent.php' ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="text-center">No Pending Reservation</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                        <div class="row">
                            <?php if(count($accepteds) > 0): ?>
                                <?php foreach($accepteds as $accepted): ?>
                                    <div class="col-md-4">
                                        <div class="card shadow border-0 mt-3">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?= esc(ucwords($accepted->events_name)) ?></h5>
                                                <p>
                                                    <span class="fw-bold">Date Booked: </span><?= esc(get_date($accepted->date_book)) ?><br>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Rate:</span> <?= esc($accepted->rate) ?><br>
                                                    <span class="fw-bold">Total Payment:</span> <?= esc($accepted->total_bill) ?><br>
                                                    <span class="fw-bold">Total Person:</span> <?= esc($accepted->total_person) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Payment Deposit:</span> <?= esc($accepted->payment_deposit) ?><br>
                                                    <?php if($accepted->resubmit_ref == 'true'): ?>
                                                        <span class="fw-bold">Gcash Ref #:</span><a href="#resubmit<?= $accepted->transaction_id ?>" data-bs-toggle='modal' class='badge btn btn-success btn-sm'>Re submit ref no.</a><br>
                                                        
                                                    <?php else: ?>
                                                        <span class="fw-bold">Gcash Ref #:</span> <?= esc($accepted->gcash_reference_number) ?><br>

                                                    <?php endif ?>
                                                    
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Transaction Date:</span> <?= esc(get_date($accepted->transaction_date)) ?><br>
                                                    <span class="fw-bold">Transaction ID:</span> <?= esc($accepted->unique_id) ?><br>
                                                </p>

                                                <span class="badge bg-success"><?= esc(ucwords($accepted->transaction_status)) ?></span>
                                               

                                            </div>
                                        </div>
                                    </div>
                                
                            <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="text-center">No Accepted Reservation</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="row">
                            <?php if(count($completed) > 0): ?>
                                <?php foreach($completed as $complete): ?>
                                    <div class="col-md-4">
                                        <div class="card shadow border-0 mt-3">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?= esc(ucwords($complete->events_name)) ?></h5>
                                                <p>
                                                    <span class="fw-bold">Date Booked: </span><?= esc(get_date($complete->date_book)) ?><br>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Rate:</span> <?= esc($complete->rate) ?><br>
                                                    <span class="fw-bold">Total Payment:</span> <?= esc($complete->total_bill) ?><br>
                                                    <span class="fw-bold">Total Person:</span> <?= esc($complete->total_person) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Payment Deposit:</span> <?= esc($complete->payment_deposit) ?><br>
                                                    <?php if($complete->resubmit_ref == 'true'): ?>
                                                        <span class="fw-bold">Gcash Ref #:</span><a href="#resubmit<?= $complete->transaction_id ?>" data-bs-toggle='modal' class='badge btn btn-success btn-sm'>Re submit ref no.</a><br>
                                                        
                                                    <?php else: ?>
                                                        <span class="fw-bold">Gcash Ref #:</span> <?= esc($complete->gcash_reference_number) ?><br>

                                                    <?php endif ?>
                                                    
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Transaction Date:</span> <?= esc(get_date($complete->transaction_date)) ?><br>
                                                    <span class="fw-bold">Transaction ID:</span> <?= esc($complete->unique_id) ?><br>
                                                </p>

                                                <span class="badge bg-primary"><?= esc(ucwords($complete->transaction_status)) ?></span>
                                               

                                            </div>
                                        </div>
                                    </div>
                                
                            <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="text-center">No Completed Reservation</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        <div class="row">
                            <?php if(count($cancelled) > 0): ?>
                                <?php foreach($cancelled as $cancell): ?>
                                    <div class="col-md-4">
                                        <div class="card shadow border-0 mt-3">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?= esc(ucwords($cancell->events_name)) ?></h5>
                                                <p>
                                                    <span class="fw-bold">Date Booked: </span><?= esc(get_date($cancell->date_book)) ?><br>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Rate:</span> <?= esc($cancell->rate) ?><br>
                                                    <span class="fw-bold">Total Payment:</span> <?= esc($cancell->total_bill) ?><br>
                                                    <span class="fw-bold">Total Person:</span> <?= esc($cancell->total_person) ?>
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Payment Deposit:</span> <?= esc($cancell->payment_deposit) ?><br>
                                                    <?php if($cancell->resubmit_ref == 'true'): ?>
                                                        <span class="fw-bold">Gcash Ref #:</span><a href="#resubmit<?= $cancell->transaction_id ?>" data-bs-toggle='modal' class='badge btn btn-success btn-sm'>Re submit ref no.</a><br>
                                                        
                                                    <?php else: ?>
                                                        <span class="fw-bold">Gcash Ref #:</span> <?= esc($cancell->gcash_reference_number) ?><br>

                                                    <?php endif ?>
                                                    
                                                </p>

                                                <p>
                                                    <span class="fw-bold">Transaction Date:</span> <?= esc(get_date($cancell->transaction_date)) ?><br>
                                                    <span class="fw-bold">Transaction ID:</span> <?= esc($cancell->unique_id) ?><br>
                                                </p>

                                                <span class="badge bg-warning"><?= esc(ucwords($cancell->transaction_status)) ?></span>
                                               

                                            </div>
                                        </div>
                                    </div>
                                
                            <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="text-center">No Completed Reservation</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>