<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
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
                              <?php if($boutique->ETAT_BOUTIQUE == 1): ?>
                                <a class="dropdown-item" href="/admin/boutique_active/<?= $uri->getSegment(3).'/'.$boutique->ID_BOUTIQUE ?>"><i class='bx bx-x'></i> Desactive</a>
                              <?php elseif($boutique->ETAT_BOUTIQUE == 2): ?>
                                <a class="dropdown-item" href="/admin/boutique_active/<?= $uri->getSegment(3).'/'.$boutique->ID_BOUTIQUE ?>"><i class='bx bx-check-square'></i> Active</a>
                              <?php endif; ?>
                              <a class="dropdown-item" href="/admin/boutique_view/<?= $uri->getSegment(3).'/'.$boutique->ID_BOUTIQUE ?>"><i class='bx bx-notepad'></i> Details</a>
                              <a class="dropdown-item" href="/admin/boutique_delete/<?= $uri->getSegment(3).'/'.$boutique->ID_BOUTIQUE ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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

    </div>
</div>

<?= $this->endSection(); ?>