    <div class="masuk">
        <!-- FORM -->
        <div class="container-fluid vertical-center">
            <div class="container py-5 d-flex align-items-center justify-content-center">
                <div class=" col-4 py-4">
                    <div class="row align-items-center justify-content-center">
                        <div class="position-relative">
                            <div class="position-absolute top-100 start-50 translate-middle">
                                <img class="img-thumbnail bg-transparent border-0 " src="<?= base_url(); ?>assets/img/ludaringin/logoludaringin.png" alt="logoludaringin">
                            </div>
                        </div>
                        <form action="<?php echo base_url(); ?>users/checkinglogin" method="post" role="form" class="shadow-sm rounded-3 pt-5 px-4 pb-4 loginCard">
                            <div class="my-3 mx-3 py-3 text-white">
                                <label for="exampleInputEmail1" class="form-label fw-bold  font-monospace text-white">Ludaringin ID</label>
                                <input type="text" class="form-control bg-transparent  border-0 border-bottom " aria-describedby="nomorinduk" id="nomorinduk"  name="nomorinduk" required style="color: white;">
                                <?php echo form_error('nomorinduk', '<div style="font-size:13px" class="text-danger">', '</div>') ?>
                            </div>
                            <div class="mb-3 mx-3 py-3 text-white">
                                <label for="exampleInputPassword1" class="form-label fw-bold  font-monospace text-white">Kata sandi</label>
                                <input type="password" class="form-control bg-transparent  border-0 border-bottom " type="password" id="password" name="password" required style="color: white;">
                                <?php echo form_error('password', '<div style="font-size:13px" class="text-danger">', '</div>') ?>
                            </div>

                            <div class="d-grid gap-2 my-3 text-center py-3 ">
                                <button type="submit" class="btn text-white rounded-3 fw-bold shadow" name="submit" style="background-color: #0099C4;">Masuk</button>
                            </div>

                            <div class="card-body">
                                <a href="#" class="text-decoration-none">
                                    <h6 class="card-title text-white">Lupa Kata sandi?</h6>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- FORM -->
    </div>