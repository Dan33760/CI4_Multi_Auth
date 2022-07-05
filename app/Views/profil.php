<?= $this->extend("template/app"); ?>

<?= $this->section("body"); ?>

<?php $uri = service('uri'); ?>

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

<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="<?= base_url($user['IMAGE_USER']) ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                        <!-- <div class="button-wrapper"> -->
                            <form id="formAccountSettings2" action="<?= base_url('/'.$uri->getSegment(1).'/update_picture') ?>" method="post" enctype="multipart/form-data">
                                <label for="upload" class="btn btn-primary btn-sm me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Changer la photo de profil</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <!-- <input type="file" id="upload" name="image_user" class="" accept="image/*"/> -->
                                    <input type="file" name="image_user" accept="image/*" class="form-control form-control-sm" id="basic-default-fullname" />
                                </label>

                                <input type="submit" name="dan" class="btn btn-info btn-sm" value="Modifier">
                                <!-- <input type="file" name="user_file" id="file"> -->
                                    <!-- <input type="submit" class="" value="Modifier"> -->
                            </form>
                        <!-- </div> -->
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="<?= base_url('/'.$uri->getSegment(1).'/profil') ?>" method="post">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Role</label>
                                <input class="form-control form-control-sm" type="text" id="firstName" name="role" value="<?= session()->get('role') ?>" readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nom</label>
                                <input class="form-control form-control-sm" type="text" id="firstName" name="nom" value="<?= $user['NOM_USER'] ?>" autofocus/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Post Nom</label>
                                <input class="form-control form-control-sm" type="text" name="postnom" id="postnom" value="<?= $user['POSTNOM_USER'] ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control form-control-sm" type="email" id="email" name="email" value="<?= $user['EMAIL_USER'] ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Mot de passe</label>
                                <div class="input-group input-group-merge">
                                <input type="password" name="mdp" id="phoneNumber" name="phoneNumber" class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Confirmer mot de passe</label>
                                <div class="input-group input-group-merge">
                                <input type="password" name="mdp_confirm" id="phoneNumber" name="phoneNumber" class="form-control form-control-sm" />
                                </div>
                            </div>

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
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Modifier</button>
                          <a type="reset" href="<?=  base_url('profil'); ?>" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Supprimer le compte</h5>
                    <div class="card-body">
                        <a href="<?= base_url('delete_count') ?>" class="btn btn-danger btn-sm deactivate-account">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
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