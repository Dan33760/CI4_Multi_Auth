<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-4"></div>

        <div class="col-4">
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Modifier</h5>
              </div>
              <div class="card-body">
                <form action="<?= base_url('/tenant/boutique_edit/'.$id.''); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $boutique['ID_BOUTIQUE']; ?>">
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Designation</label>
                      <input type="text" name="designation" class="form-control form-control-sm" value="<?= $boutique['DESIGNATION_BOUTIQUE']; ?>" id="basic-default-fullname" placeholder="Designation" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-message">Description</label>
                      <textarea id="basic-default-message" name="description" value="" class="form-control form-control-sm" placeholder="Description" ><?= $boutique['DESCRIPTION_BOUTIQUE']; ?></textarea>
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

        <div class="col-4"></div>

    </div>
</div>

<?= $this->endSection(); ?>