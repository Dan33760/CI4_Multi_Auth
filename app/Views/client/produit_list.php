<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<div class="content-wrapper">
            <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-5">
                <?php foreach($produits as $produit): ?>
                 <div class="col-md-6 col-lg-2 mb-2">
                  <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url($produit->IMAGE_PRODUIT); ?>" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title"><?= $produit->DESIGNATION_PRODUIT; ?></h5>
                      <a href="javascript:void(0)" class="btn btn-outline-primary">$ <?= $produit->PU_PRODUIT; ?></a>
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