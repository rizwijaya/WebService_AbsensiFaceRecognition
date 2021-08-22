</div>
</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Content -->
    <div class="card mb-12">
        <!-- Table dimulai -->
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <?= $this->session->flashdata('pesan'); ?>
                    <h3 class="mb-0">Data Presensi Kuliah</h3>
                </div>
            </div>
        </div>
        <!-- Isi Tabel -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="pekan">Pekan Kuliah</th>
                        <th scope="col" class="sort" data-sort="mata_kuliah">Mata Kuliah</th>
                        <th scope="col" class="sort" data-sort="mulai_kuliah">Hari</th>
                        <th scope="col" class="sort" data-sort="mulai_kuliah">Mulai Kuliah</th>
                        <th scope="col" class="sort" data-sort="selesai_kuliah">Selesai Kuliah</th>
                        <th scope="col" class="sort" data-sort="Dosen"> Status</th>
                        <th scope="col" class="sort" data-sort="absensi"> Aksi</th>
                        <th scope="col" class="sort" data-sort="mahasiswa"> Daftar Mahasiswa</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <?php foreach ($pertemuan as $mk) : 
                            $this->load->model('dosen_model');
                            $running = $this->dosen_model->running($mk['id_pertemuan']);
                            ?>
                            <th scope="row">Pekan ke - <?= $mk['pekan']; ?></th>
                            <td><?= $mk['nama_matkul']; ?></td>
                            <td><?= $mk['hari_kuliah']; ?></td>
                            <td><?= $mk['start_kuliah']; ?> WIB</td>
                            <td><?= $mk['end_kuliah']; ?> WIB</td>
                            <td><?php
                                if (empty($running[0]['sts_running'])) {
                                    echo 'Belum Terlaksana';
                                } else if($running[0]['sts_running'] == 1) {
                                    echo 'Sedang Berjalan';
                                } else if($running[0]['sts_running'] == 2) {
                                    echo 'Selesai';
                                } else if ($mk['sts_pertemuan'] == 1){
                                    echo 'Belum Terlaksana';
                                } else {
                                    // echo $mk['end_kuliah'];
                                    echo 'Selesai';
                                }

                                ?></td>
                            <td>
                                <?php if(empty($running[0]['sts_running'])) { ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_data<?= $mk['id_pertemuan']; ?>"><i class="fas fa-eye"></i>
                                        mulai</button>
                                <?php } else if($running[0]['sts_running'] == 1) { ?>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url(); ?>dosen/stop/<?php echo $mk['id_matkul'] ?>">
                                        Hentikan</a>
                                <?php  } else if($running[0]['sts_running'] == 2) { ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_data<?= $mk['id_pertemuan']; ?>"><i class="fas fa-eye"></i>
                                        mulai</button>
                                <?php  } else { ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_data<?= $mk['id_pertemuan']; ?>"><i class="fas fa-eye"></i>
                                        mulai</button>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?= base_url(); ?>dosen/ceksiswa/<?php echo $mk['id_matkul'] ?>/<?php echo $mk['pekan'] ?>">
                                    <i class="fas fa-user"></i>
                                    Daftar
                                </a>
                            </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Ini table nya -->
        <!-- Modal Tambah Data -->
        <?php foreach ($pertemuan as $mk) : 
            $this->load->model('dosen_model');
            $running = $this->dosen_model->running($mk['id_pertemuan']);
            ?>
            <div class="modal fade" id="tambah_data<?= $mk['id_pertemuan']; ?>" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="judulModal">Mulai Perkuliahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url(); ?>dosen/startabsen/" method="post">
                                <input type="hidden" class="form-control" id="id_pertemuan" name="id_pertemuan" value="<?= $mk['id_pertemuan'] ?>">
                                <input type="hidden" class="form-control" id="id_matkul" name="id_matkul" value="<?= $mk['id_matkul'] ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mulai_run">Mulai Absensi</label>
                                            <input type="datetime-local" class="form-control" id="mulai_run" name="mulai_run">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="end_run">Selesai Absensi</label>
                                            <input type="datetime-local" class="form-control" id="end_run" name="end_run">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-danger">reset</button>
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Mulai Absensi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!--End Modal Tambah -->
    </div> <!-- Div Class Container Content-->
    <!-- End Content -->