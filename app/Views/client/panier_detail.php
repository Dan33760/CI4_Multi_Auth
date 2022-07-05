<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <a class="btn btn-outline-primary" href="<?= base_url('client/boutique') ?>">Boutiques</a>
        <a class="btn btn-outline-primary" href="<?= base_url('client/panier_client/'.$uri->getSegment(3)) ?>">Paniers</a>
        <a class="btn btn-outline-primary" href="<?= base_url('/client/panier_detail/'.$uri->getSegment(3).'/'.$uri->getSegment(4)); ?>">Details</a>
    </div>
</nav>

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

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-12">
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Panier :

                    <?= $panier['DESIGNATION_PANIER'].' - '.$panier['DATE_ENR_PANIER']; ?>
                    <?php if($panier['ETAT_PANIER'] == 1): ?>
                        <span class="badge bg-warning badge-sm">En attente</span>
                    <?php elseif($panier['ETAT_PANIER'] == 2): ?>
                        <span class="badge bg-info badge-sm">Valider</span>
                    <?php endif; ?>
                    
                </h5>
              </div>
              <div class="card-body">
                <form action="<?= base_url('/client/panier_detail/'.$uri->getSegment(3).'/'.$panier['ID_PANIER']); ?>" method="post">
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Designation</label>
                      <input type="text" name="designation" value="<?= $panier['DESIGNATION_PANIER']; ?>" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                  </div>
                    <table class="table table-condensed" id="myTable">
                         <thead>
                             <tr>
                                 <td>Article</td>
                                 <td>Prix U</td>
                                 <td>Quantite</td>
                             </tr>
                         </thead>
                         <tbody id="tbody">
                            <?php
                            $total_general = 0;
                            foreach($produits as $produit): ?>
                                <tr>
                                    <td><input type="hidden" class="form-control form-control-sm" id="id_produit" name="id_produit[]" value="<?= $produit->ID_PRODUIT; ?>"><?= $produit->DESIGNATION_PRODUIT; ?></td>
                                    <td><input type="number" class="form-control form-control-sm" id="pu_produit" name="pu_produit[]" value="<?= $produit->PU_PANIER; ?>" readonly></td>
                                    <td><input type="number" class="form-control form-control-sm qu_produit" id="qu_produit" name="qu_produit[]" value="<?= $produit->QUANTITE_PRODUIT_PANIER; ?>"></td>
                                    <td><input type="number" class="form-control form-control-sm total_produit" id="total_produit" name="total_produit[]" value="<?= $produit->QUANTITE_PRODUIT_PANIER * $produit->PU_PANIER; ?>" readonly></td>
                                    <td>
                                        <?php if($panier['ETAT_PANIER'] == 1): ?>
                                            <a href="<?= base_url('client/panier_delete_produit/'.$uri->getSegment(3).'/'.$uri->getSegment(4).'/'.$produit->REF_PRODUIT) ?>" id="btn_del" class="btn btn-danger btn-xs del"><i class='bx bx-x'></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $total_general +=$produit->QUANTITE_PRODUIT_PANIER * $produit->PU_PANIER;  ?>
                                <?php endforeach; ?>
                                <tr>
                                   <td><span class="badge bg-dark badge-sm">Total</span></td>
                                   <td></td>
                                   <td></td>
                                   <td><input type="number" class="form-control form-control-sm" value="<?= $total_general; ?>" readonly></td>
                                   <td></td>
                                </tr>
                         </tbody>
                    </table> 
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
                    <?php if($panier['ETAT_PANIER'] == 1): ?>
                        <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                        <a href="<?= base_url('client/valider_panier/'.$uri->getSegment(3).'/'.$panier['ID_PANIER']) ?>" class="btn btn-info btn-sm">Valider</a>
                    <?php endif; ?>
                </form>
                
              </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
<script>

var myArray = [];

$('.idP').click(function() {
    // let id = $(this).closest('tr').find('.idA').val();
    alert('Dan');
});

$('.btn_add').click(function() {
    let id = $(this).attr('id');
    if(myArray.includes(id)) {
        // swal('Desole!', 'Ce produit existe deja dans le panier', 'warning');
        alert("Ce produit existe deja dans le panier");
        return false;
    }
    myArray.push(id);
    var tbody = document.getElementById('tbody');
    var num = tbody.children.length;

    let newProduit = '';

    newProduit = `<tr>
                        <td><input type="hidden" class="form-control form-control-sm" id="id_produit" name="id_produit[]" value="${$(this).attr('id')}">${$(this).attr('name')}</td>
                        <td><input type="number" class="form-control form-control-sm" id="pu_produit" name="pu_produit[]" value="${$(this).attr('pu')}" readonly></td>
                        <td><input type="number" class="form-control form-control-sm qu_produit" id="qu_produit" name="qu_produit[]" value=""></td>
                        <td>
                            <input type="hidden" value="${$(this).attr('id')}" class="idP">
                            <a id="btn_del" class="btn btn-danger btn-xs del"><i class='bx bx-x'></i></a>
                        </td>
                    </tr>`;
    tbody.innerHTML += newProduit;
});

// $('.del').click(function() {
//     // let id = $(this).closest('tr').find('.idA').val();
//     alert('Dan');
// });

// $('#qu_produit').keyup(function(event) {

//     alert('Dan');
//     var total = 0;
//     let qte = $(this).closest('tr').find('input.qu_produit').val();
//     let qte = $(this).closest('tr').find('#qu_produit').val();
//     console.log(qte)
// })

</script>

<?= $this->endSection(); ?>