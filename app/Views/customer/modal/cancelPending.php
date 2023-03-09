  <!-- Modal -->
  <div class="modal fade" id="cancelPending<?= $pending->transaction_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Cancellation Policy</h4>
        <p>
          Your deposited payment is not refundable after you cancel your room reservation.
        </p>
      </div>
      <div class="modal-footer border-0">

        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <a href="#cancel<?= $pending->transaction_id ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel my reservation</a>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cancel<?= $pending->transaction_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
      <form action="<?= base_url() ?>/Customer/cancel-reservation" method="POST">
        <?= csrf_field() ?>
        <h5>Please provide a brief explanation of your cancellation.</h5>
        <textarea name="description" id="" class="form-control" required></textarea>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        
            <input type="hidden" name="transaction_id" value="<?= $pending->transaction_id ?>">
            <input type="hidden" name="customer_id" value="<?= $pending->customer_id ?>">
            <input type="hidden" name="email" value="<?= $pending->email ?>">
            <input type="hidden" name="room_id" value="<?= $pending->room_id ?>">
            <input type="hidden" name="name" value="<?= $pending->name ?>">
            <input type="hidden" name="deposit" value="<?= $pending->payment_deposit ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>