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
                                <div class="col-8">
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
                                                <th>Actions</th>
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
                                                    <td>
                                                    <?php if($produit->ETAT_PRODUIT == 1): ?>
                                                        <span class="badge bg-label-primary me-1">Disponible</span></td>
                                                    <?php elseif($produit->ETAT_PRODUIT == 2): ?>
                                                        <span class="badge bg-label-warning me-1">Non dipsonible</span>
                                                    <?php endif; ?>
                                                    <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/tenant/produit_edit/<?= $uri->getSegment(3) .'/'.$produit->ID_PRODUIT ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <?php if($produit->ETAT_PRODUIT == 1): ?>
                                                            <a class="dropdown-item" href="/tenant/produit_active/<?= $uri->getSegment(3) .'/'.$produit->ID_PRODUIT ?>"><i class='bx bx-x'></i> Desactive</a>
                                                        <?php elseif($produit->ETAT_PRODUIT == 2): ?>
                                                            <a class="dropdown-item" href="/tenant/produit_active/<?= $uri->getSegment(3) .'/'.$produit->ID_PRODUIT ?>"><i class='bx bx-check-square'></i> Active</a>
                                                        <?php endif; ?>
                                                        <a class="dropdown-item" href="/tenant/produit_delete/<?= $uri->getSegment(3) .'/'.$produit->ID_PRODUIT ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Ajouter un article</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?= base_url('/tenant/produit_add/'.$id.''); ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Designation</label>
                                                <input type="text" name="designation" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Prix unitaire</label>
                                                <input type="number" name="pu" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Quantite</label>
                                                <input type="number" name="quantite" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Marge</label>
                                                <input type="number" name="marge" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Image</label>
                                                <input type="file" name="image_produit" accept="image/*" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                <?php if(session()->get('validation')): ?>
                                                    <div class="col-12">
                                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                                            <?= session()->get('validation'); ?>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                    <?php elseif(session()->get('error')): ?>
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
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-8">
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
                                            <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <?php foreach($clients as $client): ?>
                                            <tr>
                                                <td> <?= $client->NOM_USER; ?> </td>
                                                <td> <?= $client->POSTNOM_USER; ?> </td>
                                                <td> <?= $client->EMAIL_USER; ?> </td>
                                                <td> <?= $client->DATE_ENR_USER; ?> </td>
                                                <td>
                                                <?php if($client->ETAT_USER == 1): ?>
                                                    <span class="badge bg-label-primary me-1">Actif</span></td>
                                                <?php elseif($client->ETAT_USER == 2): ?>
                                                    <span class="badge bg-label-warning me-1">No actif</span>
                                                <?php endif; ?>
                                                <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <?php if($client->ETAT_USER == 1): ?>
                                                        <a class="dropdown-item" href="/tenant/client_active/<?= $uri->getSegment(3) .'/'.$client->ID_USER ?>"><i class='bx bx-x'></i> Desactive</a>
                                                    <?php elseif($client->ETAT_USER == 2): ?>
                                                        <a class="dropdown-item" href="/tenant/client_active/<?= $uri->getSegment(3) .'/'.$client->ID_USER ?>"><i class='bx bx-check-square'></i> Active</a>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item" href="/tenant/client_delete/<?= $uri->getSegment(3) .'/'.$client->ID_USER ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Ajouter un client</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?= base_url('/tenant/client_add/'.$id.''); ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_boutique" value="<?= $id; ?>">
                                                <div class="mb-3">
                                                    <label for="smallSelect" class="form-label">Role</label>
                                                    <select id="smallSelect" name="role" class="form-select form-select-sm">
                                                        <option>Selectione le role</option>
                                                        <?php foreach($roles as $role): ?>
                                                            <option value="<?= $role->ID_ROLE; ?>"><?= $role->DESIGNATION_ROLE; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Nom</label>
                                                    <input type="text" name="nom" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Post Nom</label>
                                                    <input type="text" name="postnom" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                                    <input type="email" name="email" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="form-label" for="password">Mot de passe</label>
                                                    </div>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" name="mdp" id="mdp" class="form-control form-control-sm" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>
                                                <!-- <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Image</label>
                                                    <input type="file" name="image_client" accept="image/*" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                                                </div> -->
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                    <?php if(session()->get('validations')): ?>
                                                        <div class="col-12">
                                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                                <?= session()->get('validation'); ?>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                        <?php elseif(session()->get('errorr')): ?>
                                                            <div class="col-12">
                                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                                <?= session()->get('error'); ?>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                        <?php elseif(session()->get('successs')): ?>
                                                            <div class="col-12">
                                                            <div class="alert alert-info alert-dismissible" role="alert">
                                                                <?= session()->get('success'); ?>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                            </div>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </form>
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