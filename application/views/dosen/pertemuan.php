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
                            <h3 class="mb-0">Data Presensi Kuliah</h3>
                        </div>
                        <!-- Button trigger modal -->
                        <!-- <div class="col text-right">
                            <a class="btn btn-primary mb-0" href="daftarpeserta/cetak_sesi/"><i class="fa fa-print"></i> Cetak Laporan</a>
                        </div> -->
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
                                <?php foreach ($pertemuan as $mk) : ?>
                                <th scope="row">Pekan ke - <?= $mk['pekan']; ?></th>
                                <td><?= $mk['nama_matkul']; ?></td>
                                <td><?= $mk['hari_kuliah']; ?></td>
                                <td><?= $mk['start_kuliah']; ?> WIB</td>
                                <td><?= $mk['end_kuliah'];?> WIB</td>
                                <td><?php 
                                    if($mk['sts_pertemuan'] == 1) {
                                        echo 'Belum Terlaksana';
                                    } else {
                                        echo $mk['end_kuliah'];
                                        echo 'Selesai';
                                    }
                                
                                ?></td>
                                <td>
                                    <a class="btn btn-primary"
                                     href="#">
                                     <i class="fas fa-eye"></i> 
                                     Ubah
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                     href="<?= base_url(); ?>dosen/ceksiswa/<?php echo $mk['id_matkul'] ?>/<?php echo $mk['pekan'] ?>">
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
            </div> <!-- Div Class Container Content-->
            <!-- End Content -->