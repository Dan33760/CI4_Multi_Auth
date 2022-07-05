<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-7">
            <div class="row mb-5">
                <?php foreach($produits as $produit): ?>
                 <div class="col-md-6 col-lg-4 mb-2">
                  <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url($produit->IMAGE_PRODUIT); ?>" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title"><?= $produit->DESIGNATION_PRODUIT; ?></h5>
                      <a href="javascript:void(0)" class="btn btn-outline-primary btn-xs">$ <?= $produit->PU_PRODUIT; ?></a>
                      <button class="btn btn-outline-primary btn-xs btn_add"
                              id="<?= $produit->ID_PRODUIT; ?>"
                              name="<?= $produit->DESIGNATION_PRODUIT; ?>"
                              pu="<?= $produit->PU_PRODUIT; ?>"
                              ><i class='bx bxs-cart-download' ></i></button>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-5">
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Panier</h5>
              </div>
              <div class="card-body">
                <form action="<?= base_url('/client/view_produit_client/'.$uri->getSegment(3)); ?>" method="post">
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Designation</label>
                      <input type="text" name="designation" class="form-control form-control-sm" id="basic-default-fullname" placeholder="Designation" />
                  </div>
                    <table class="table table-condensed" id="myTable">
                         <thead>
                             <tr>
                                 <td>Article</td>
                                 <td>Prix U</td>
                                 <td>Quantite</td>
                             </tr>
                         </thead>
                         <tbody id="tbody"></tbody>
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
                  <button type="submit" class="btn btn-primary">Send</button>
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

$('.del').click(function() {
    // let id = $(this).closest('tr').find('.idA').val();
    alert('Dan');
});

$('#qu_produit').keyup(function(event) {

    alert('Dan');
    // var total = 0;
    // let qte = $(this).closest('tr').find('input.qu_produit').val();
    // let qte = $(this).closest('tr').find('#qu_produit').val();
    // console.log(qte)
})

</script>

<?= $this->endSection(); ?>