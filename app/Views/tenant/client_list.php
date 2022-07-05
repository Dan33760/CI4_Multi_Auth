<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Clients</h5>
                <div class="table text-nowrap">
                  <table class="table table-sm">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Post Nom</th>
                              <th>Email</th>
                              <th>Date</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                          <?php foreach($clients as $client): ?>
                          <tr>
                              <td> <?= $client['NOM_USER']; ?> </td>
                              <td> <?= $client['POSTNOM_USER']; ?> </td>
                              <td> <?= $client['EMAIL_USER']; ?> </td>
                              <td> <?= $client['DATE_ENR_USER']; ?> </td>
                              <td> 
                                  <?php if($client['ETAT_USER'] == 1): ?>
                                      <span class="badge bg-label-primary me-1">Actif</span></td>
                                  <?php elseif($client['ETAT_USER'] == 2): ?>
                                      <span class="badge bg-label-warning me-1">Non actif</span>
                                  <?php endif; ?>
                              </td>
                              
                          </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
                  <?= $pager->makeLinks($page,$perPage, $total, 'product_view') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>