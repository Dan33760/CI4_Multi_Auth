<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>
<?php $uri = service('uri');?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Produits</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Prix unitaire</th>
                            <th>Quantite</th>
                            <th>Marge</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach($produits as $produit): ?>
                        <tr>
                            <td> <?= $produit['DESIGNATION_PRODUIT']; ?> </td>
                            <td> <?= $produit['PU_PRODUIT']; ?> </td>
                            <td> <?= $produit['QUANTITE_PRODUIT']; ?> </td>
                            <td> <?= $produit['MARGE_PRODUIT']; ?> </td>
                            <td> <?= $produit['DATE_ENR_PRODUIT']; ?> </td>
                            <td> 
                                <?php if($produit['ETAT_PRODUIT'] == 1): ?>
                                    <span class="badge bg-label-primary me-1">Disponible</span></td>
                                <?php elseif($produit['ETAT_PRODUIT'] == 2): ?>
                                    <span class="badge bg-label-warning me-1">Non dipsonible</span>
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



<?= $this->endSection(); ?>