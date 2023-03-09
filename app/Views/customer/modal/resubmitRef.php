
<div class="modal fade" id="resubmit<?= $pending->transaction_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
      <form action="<?= base_url() ?>/Customer/update-ref-no" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <h5>Please resubmit gcash ref no.</h5>
        <input type="text" name="reference_number" id="" class="form-control" required></input>
      </div>
      <div class="modal-footer border-0 justify-content-center">
            <input type="hidden" name="id" value="<?= $pending->transaction_id ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>