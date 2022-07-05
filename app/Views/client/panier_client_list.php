<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" style="z-index: 4;">
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <a class="btn btn-outline-primary" href="<?= base_url('client/boutique') ?>">Boutiques</a>
        <a class="btn btn-outline-primary" href="<?= base_url('client/panier_client/'.$uri->getSegment(3)) ?>">Paniers</a>
    </div>
</nav>

<div class="content-wrapper">
            <!-- Content -->
 
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-5">
                <?php foreach($paniers as $panier): ?>
                    <div class="col-md-6 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $panier->DESIGNATION_PANIER; ?></h5>
                                    <p class="card-text"><?= $panier->DATE_ENR_PANIER; ?></p>
                                      <?php if($panier->ETAT_PANIER == 1): ?>
                                        <a href="#" class="card-link"><span class="badge bg-warning">En attente</span></a>
                                      <?php elseif($panier->ETAT_PANIER == 2): ?>
                                        <a href="#" class="card-link"><span class="badge bg-info">Valider</span></a>
                                      <?php endif; ?>
                                        <a href="<?= base_url('client/panier_detail/'.$uri->getSegment(3).'/'.$panier->ID_PANIER); ?>" class="card-link btn btn-danger btn-sm"><i class='bx bx-cart-alt'></i></a>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>

        </div>

            
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>

<?= $this->endSection(); ?>