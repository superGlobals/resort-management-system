<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


<main id="main">
  <section class="contact section-bg">
      <div class="container-fluid">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Entrance & <span>Cottages</span></h3>
          <p>PMP RESORT ENTRANCE FEE / SWIMMING RATES</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-12">
            <div class="row">

              <div class="col-lg-12">

                <div class="row justify-content-center">

                  <div class="col-md-4 info d-flex flex-column align-items-stretch">
                  <i class="bi bi-brightness-high"></i>
                    <h4>Day Tour</h4>
                    <h4>8AM-5PM</h5>
                    <p>Adult: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->adult_price ?> <br> Child: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->child_price ?></p>
                  </div>
                  <div class="col-md-4 info d-flex flex-column align-items-stretch">
                  <i class="bi bi-moon"></i>
                    <h4>Night Swimming</h4>
                    <h4>5PM-12MN</h4>
                    <p>Adult: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->night_adult ?><br>Child: <i class="fa-solid fa-peso-sign fs-6 text-muted"></i> <?= $entrance->night_child ?></p> 
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h3>Check our <span>Cottages</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>
        
        <div class="row portfolio-container ">

          <div class="col-xl-10">
            <div class="row justify-content-center">

              <?php if(count($cottages) > 0): ?>

                <?php foreach($cottages as $cottage): $id = $cottage->id?>
                    <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-app">
                        
                      <div class="portfolio-wrap">
                        <img src="<?= base_url() ?>/uploads/<?= $cottage->cottage_image ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= esc(ucwords($cottage->cottage_name)) ?></h4>
                            <p>Good for <?= esc($cottage->cottage_capacity) ?> Person</p>
                            <p>For only <?= esc($cottage->cottage_price) ?></p>
                            <?php if($cottage->available_cottage > 0): ?>
                            <a href="#visit_type<?= $id ?>" data-bs-toggle="modal" class="text-white">Reserve now</a>
                            <?php else: ?>
                              <p>All Cottages like this reserved</p>
                            <?php endif; ?>
                            <div class="portfolio-links">
                            <a href="<?= base_url() ?>/uploads/<?= $cottage->cottage_image ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= esc(ucwords($cottage->cottage_name)) ?>"><i class="fa-solid fa-eye fs-4"></i></a>
                            </div>
                        </div>
                      </div>
                    </div><!-- End portfolio item -->
                    <?php require 'modal/visit_type.php' ?>
                <?php endforeach; ?>


              <?php else: ?>

              <?php endif; ?>

              

            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->

  <?= $this->endSection() ?>

  