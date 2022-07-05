<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-4"></div>

        <div class="col-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ajouter un article</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/tenant/produit_edit/'.$uri->getSegment(3).'/'.$produit['ID_PRODUIT'].''); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $produit['ID_PRODUIT']; ?>">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Designation</label>
                            <input type="text" name="designation" value="<?= $produit['DESIGNATION_PRODUIT']; ?>" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Prix unitaire</label>
                            <input type="number" name="pu" value="<?= $produit['PU_PRODUIT']; ?>" class="form-control form-control-sm" id="basic-default-fullname"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Quantite</label>
                            <input type="number" name="quantite" value="<?= $produit['QUANTITE_PRODUIT']; ?>" class="form-control form-control-sm" id="basic-default-fullname" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Marge</label>
                            <input type="number" name="marge" value="<?= $produit['MARGE_PRODUIT']; ?>" class="form-control form-control-sm" id="basic-default-fullname" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Image</label>
                            <input type="file" name="image_produit" accept="image/*" class="form-control form-control-sm" id="basic-default-fullname" />
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

        <div class="col-4"></div>

    </div>
</div>

<?= $this->endSection(); ?>