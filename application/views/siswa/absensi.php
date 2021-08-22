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
                            <h3 class="mb-0">Data Absensi</h3>
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
                                <th scope="col" class="sort" data-sort="dosen"> Nama Dosen</th>
                                <th scope="col" class="sort" data-sort="mulai_kuliah">Hari</th>
                                <th scope="col" class="sort" data-sort="mulai_kuliah">Mulai Kuliah</th>
                                <th scope="col" class="sort" data-sort="selesai_kuliah">Selesai Kuliah</th>
                                <th scope="col" class="sort" data-sort="sts_kehadiran">Kehadiran</th>
                                <th scope="col" class="sort" data-sort="tgl_absen">Tanggal Absen</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <?php foreach ($matkul as $mk) : ?>
                                <th scope="row">Pekan ke-<?= $mk['pekan']; ?></th>
                                <td><?= $mk['nama_matkul']; ?></td>
                                <td><?= $mk['dosen'];?></td>
                                <td><?= $mk['hari_kuliah']; ?></td>
                                <td><?= $mk['start_kuliah']; ?> WIB</td>
                                <td><?= $mk['end_kuliah'];?> WIB</td>
                                <td><?php
                                    if($mk['sts_kehadiran'] == 1) {
                                        echo "Belum Terlaksana";
                                    } else if($mk['sts_kehadiran'] == 2) {
                                        echo "Hadir";
                                    } else if($mk['sts_kehadiran'] == 3) {
                                        echo "Alfa";
                                    } else if($mk['sts_kehadiran'] == 4) {
                                        echo "Izin";
                                    }
                                ?></td>
                                <td><?php 
                                    echo date('H:i', strtotime($mk["tgl_absen"]));
                                    echo " WIB ";
                                    echo date('(d/m/Y)', strtotime($mk["tgl_absen"]));
                                ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Ini table nya -->
            </div> <!-- Div Class Container Content-->
            <!-- End Content -->