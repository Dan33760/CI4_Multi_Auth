<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-xl-12">
                  <h6 class="text-muted">Filled Pills</h6>
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                            <i class='bx bxs-shopping-bag'></i> Articles
                          <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger"><?= $count_produit; ?></span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
                            <i class='bx bxs-group'></i> Clients 
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger"><?= $count_client; ?></span>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Produits</h5>
                                    <div class="table">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                <th>Designation</th>
                                                <th>Prix unitaire</th>
                                                <th>Quantite</th>
                                                <th>Marge</th>
                                                <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php foreach($produits as $produit): ?>
                                                <tr>
                                                    <td> <?= $produit->DESIGNATION_PRODUIT; ?> </td>
                                                    <td> <?= $produit->PU_PRODUIT; ?> </td>
                                                    <td> <?= $produit->QUANTITE_PRODUIT; ?> </td>
                                                    <td> <?= $produit->MARGE_PRODUIT; ?> </td>
                                                    <td> <?= $produit->DATE_ENR_PRODUIT; ?> </td>
                                                    
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Clients</h5>
                                    <div class="table">
                                        <table class="table table-sm">
                                        <thead>
                                            <tr>
                                            <th>Nom</th>
                                            <th>Post nom</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <?php foreach($clients as $client): ?>
                                            <tr>
                                                <td> <?= $client->NOM_USER; ?> </td>
                                                <td> <?= $client->POSTNOM_USER; ?> </td>
                                                <td> <?= $client->EMAIL_USER; ?> </td>
                                                <td> <?= $client->DATE_ENR_USER; ?> </td>
                                                
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pills -->
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