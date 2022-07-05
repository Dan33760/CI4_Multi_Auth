<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-8">
          <div class="card mb-4">
              <h5 class="card-header">Boutiques</h5>
              <div class="table">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Boutique</th>
                      <th>Description</th>
                      <th>Date d'enregistrement</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php foreach($boutiques as $boutique): ?>
                      <tr>
                        <td> <?= $boutique->DESIGNATION_BOUTIQUE; ?> </td>
                        <td> <?= $boutique->DESCRIPTION_BOUTIQUE; ?> </td>
                        <td> <?= $boutique->DATE_ENR_BOUTIQUE; ?> </td>
                        <td>
                          <?php if($boutique->ETAT_BOUTIQUE == 1): ?>
                            <span class="badge bg-label-primary me-1">Active</span></td>
                          <?php elseif($boutique->ETAT_BOUTIQUE == 2): ?>
                            <span class="badge bg-label-warning me-1">Non active</span>
                          <?php endif; ?>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="/tenant/boutique_edit/<?= $boutique->ID_BOUTIQUE ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <?php if($boutique->ETAT_BOUTIQUE == 1): ?>
                                <a class="dropdown-item" href="/tenant/boutique_active/<?= $boutique->ID_BOUTIQUE ?>"><i class='bx bx-x'></i> Desactive</a>
                              <?php elseif($boutique->ETAT_BOUTIQUE == 2): ?>
                                <a class="dropdown-item" href="/tenant/boutique_active/<?= $boutique->ID_BOUTIQUE ?>"><i class='bx bx-check-square'></i> Active</a>
                              <?php endif; ?>
                              <a class="dropdown-item" href="/tenant/boutique_view/<?= $boutique->ID_BOUTIQUE ?>"><i class='bx bx-notepad'></i> Details</a>
                              <a class="dropdown-item" href="/tenant/boutique_delete/<?= $boutique->ID_BOUTIQUE ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
                  <h5 class="mb-0">Ajouter une boutique</h5>
              </div>
              <div class="card-body">
                <form action="<?= base_url('/tenant/boutique'); ?>" method="post">
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Designation</label>
                      <input type="text" name="designation" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-message">Message</label>
                      <textarea id="basic-default-message" name="description" class="form-control form-control-sm" placeholder="Description" ></textarea>
                  </div>
                  <div class="mb-3">
                    <div class="form-check">
                      <?php if(isset($validation)): ?>
                          <div class="col-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                  <?= $validation->listErrors(); ?>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                          </div>
                          <?php elseif(isset($error)): ?>
                            <div class="col-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                  <?= $error; ?>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                          </div>
                          <?php elseif(isset($success)): ?>
                            <div class="col-12">
                              <div class="alert alert-info alert-dismissible" role="alert">
                                  <?= $success; ?>
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

<?= $this->endSection(); ?>