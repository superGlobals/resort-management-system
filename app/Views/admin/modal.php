<!-- Modal -->
<div class="modal fade" id="reject<?=$row->transaction_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Include Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url() ?>/reject-room-reservation/<?= $row->transaction_id ?>" method="POST">
        <?= csrf_field() ?>
            <div class="mb-3">
                <label for="">Include a message explaining why you cancelled this reservation. </label>
                <textarea name="message" id="" class="form-control" required></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>