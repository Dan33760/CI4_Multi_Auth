<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>


    <?php if(session()->get('error')): ?>
        <div class="col-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <?= session()->get('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php elseif(session()->get('success')): ?>
        <div class="col-12">
        <div class="alert alert-info alert-dismissible" role="alert">
            <?= session()->get('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
<?php endif; ?>

<div class="content-wrapper">
            <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-5">
                <?php foreach($boutiques as $boutique): ?>
                    <div class="col-md-6 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $boutique->DESIGNATION_BOUTIQUE; ?></h5>
                                    <p class="card-text"><?= $boutique->DESCRIPTION_BOUTIQUE; ?></p>
                                        <a href="<?= base_url('client/add_boutique/'.$boutique->ID_BOUTIQUE); ?>" class="card-link btn btn-primary">S'incrire</a>
                                        <a href="<?= base_url('client/view_produit/'.$boutique->ID_BOUTIQUE); ?>" class="card-link btn btn-secondary">Produits</a>
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