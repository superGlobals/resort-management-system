<!-- Modal -->
<div class="modal fade" id="checkin<?=$row->transaction_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel">Assigned Room Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url() ?>/room-checkin-now/<?= $row->transaction_id ?>" method="POST">
        <?= csrf_field() ?>
       
            <div class="mb-3">
                <label for="">Please select a room number</label>
                <select name="room_number" class="form-select" id="">
                    <option value=""></option>
                    <?php if(count($room_number) > 0):?>
                        <?php foreach($room_number as $number_room): ?>
                            <option value="<?= $number_room->room_number_id ?>"><?= $number_room->room_number ?></option>
                        <?php endforeach ?>
                    <?php else: ?>
                        <h6>No room number available</h6>
                    <?php endif; ?>
                </select>
            </div>
      </div>
      <div class="modal-footer text-center border-0">
        <button type="submit" class="btn btn-success">Checkin now</button>
      </div>
      </form>
    </div>
  </div>
</div>