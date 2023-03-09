<div class="modal fade" id="gcashStatus<?= $row->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">Choose the appropriate visit type below.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h4>Gcash number: <?= esc($row->gcash_number) ?></h4>
        <h5>Set this as active gcash?</h5>
          
      </div>
      <div class="modal-footer" style="border: none;">
        <form action="<?= base_url('Payment/set-status') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="status" value="<?= $row->status ?>">
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>