<div class="modal fade" id="visit_type<?= $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">Choose the appropriate visit type below.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <a href="<?= base_url() ?>/Customer/process-entrance-cottage/<?= esc($cottage->id) ?>/day" class="btn btn-primary btn-lg">Day</a>
        <a href="<?= base_url() ?>/Customer/process-entrance-cottage/<?= esc($cottage->id) ?>/night" class="btn btn-dark btn-lg">Night</a>
          
      </div>
      <!-- <div class="modal-footer" style="border: none;">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div> -->
    </div>
  </div>
</div>