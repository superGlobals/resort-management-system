<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">
  <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h3>Check our <span>Rides</span></h3>
          <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
        </div>
        
        <div class="row portfolio-container ">

          <div class="col-xl-10">
            <div class="row justify-content-center">

              <?php if(count($rides) > 0): ?>

                <?php foreach($rides as $ride): $id = $ride->id?>
                    <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-app">
                        
                      <div class="portfolio-wrap">
                        <img src="<?= base_url() ?>/uploads/<?= $ride->image ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= esc(ucwords($ride->rides_name)) ?></h4>

                            <div class="portfolio-links">
                            <a href="<?= base_url() ?>/uploads/<?= $ride->image ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= esc(ucwords($ride->description)) ?>"><i class="fa-solid fa-eye fs-4"></i></a>
                            </div>
                        </div>
                      </div>
                    </div><!-- End portfolio item -->
                <?php endforeach; ?>


              <?php else: ?>

              <?php endif; ?>

              

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

 <?= $this->endSection() ?>