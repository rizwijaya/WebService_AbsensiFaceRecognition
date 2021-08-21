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
                            <h3 class="mb-0">Data Peserta Kuliah</h3>
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
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="no_induk">NRP</th>
                                <th scope="col" class="sort" data-sort="nama_siswa">Nama Mahasiswa</th>
                                <th scope="col" class="sort" data-sort="email">Email</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <?php $no =1; foreach ($siswa as $kh) : ?>
                                <th scope="row"><?= $no++;?></th>
                                <td><?= $kh['no_induk']; ?></td>
                                <td><?= $kh['nama']; ?></td>
                                <td><?= $kh['email']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Ini table nya -->
            </div> <!-- Div Class Container Content-->
            <!-- End Content -->