-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Agu 2021 pada 16.45
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `device`
--

CREATE TABLE `device` (
  `id_device` int(11) NOT NULL,
  `ruangan` varchar(120) NOT NULL,
  `status` varchar(100) NOT NULL,
  `terpasang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `device`
--

INSERT INTO `device` (`id_device`, `ruangan`, `status`, `terpasang`) VALUES
(1, 'IT 64', 'aktif', '2021-08-01 16:54:01'),
(2, 'IT 65', 'nonaktif', '2021-08-17 16:54:01'),
(3, 'IT 63', 'aktif', '2021-08-18 16:54:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `id_user`, `date_created`) VALUES
(1, 2, '2021-06-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `frs`
--

CREATE TABLE `frs` (
  `id_frs` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `frs`
--

INSERT INTO `frs` (`id_frs`, `id_matkul`, `id_siswa`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(256) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `date_created`) VALUES
(1, 'admin', '2021-06-01'),
(2, 'dosen', '2021-06-01'),
(3, 'siswa', '2021-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `id_frs` int(11) NOT NULL,
  `sts_kehadiran` int(11) NOT NULL DEFAULT 1,
  `tgl_absen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `id_pertemuan`, `id_frs`, `sts_kehadiran`, `tgl_absen`) VALUES
(2, 1, 4, 2, '2021-08-21 09:44:10'),
(3, 2, 1, 4, '2021-08-21 10:49:46'),
(4, 2, 4, 2, '2021-08-21 10:49:46'),
(5, 3, 3, 3, '2021-08-21 10:49:46'),
(14, 1, 1, 2, '2021-08-22 01:55:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `nama_matkul` varchar(512) NOT NULL,
  `start_kuliah` time NOT NULL DEFAULT current_timestamp(),
  `end_kuliah` time NOT NULL DEFAULT current_timestamp(),
  `hari_kuliah` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `id_dosen`, `nama_matkul`, `start_kuliah`, `end_kuliah`, `hari_kuliah`) VALUES
(1, 1, 'Sistem Operasi', '09:00:00', '11:50:00', 'Senin'),
(2, 1, 'Internet of Things', '13:30:00', '16:20:00', 'Kamis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user`
--

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_user`
--

INSERT INTO `m_user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 1),
(2, 'rizqi', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `pekan` varchar(256) NOT NULL,
  `sts_pertemuan` int(11) DEFAULT 1,
  `id_device` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertemuan`
--

INSERT INTO `pertemuan` (`id_pertemuan`, `id_matkul`, `pekan`, `sts_pertemuan`, `id_device`) VALUES
(1, 1, '1', 1, 1),
(2, 1, '2', 1, 1),
(3, 2, '1', 1, 1),
(4, 2, '2', 1, 1),
(5, 1, '3', 1, 1),
(6, 2, '3', 1, 1),
(7, 1, '4', 1, 1),
(8, 2, '4', 1, 1),
(9, 2, '5', 1, 1),
(10, 2, '6', 1, 1),
(11, 1, '5', 1, 1),
(12, 2, '7', 1, 1),
(13, 1, '6', 1, 1),
(14, 2, '8', 1, 1),
(15, 1, '7', 1, 1),
(16, 1, '8', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `running`
--

CREATE TABLE `running` (
  `id_running` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `mulai_run` timestamp NULL DEFAULT NULL,
  `end_run` timestamp NULL DEFAULT NULL,
  `sts_running` int(11) NOT NULL,
  `sts_command` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `running`
--

INSERT INTO `running` (`id_running`, `id_device`, `id_pertemuan`, `mulai_run`, `end_run`, `sts_running`, `sts_command`) VALUES
(11, 1, 1, '2021-08-21 12:02:00', '2021-08-21 13:02:00', 2, 1),
(12, 1, 1, '2021-08-14 15:19:00', '2021-08-17 12:19:00', 2, 1),
(13, 1, 1, '2021-08-21 12:28:00', '2021-08-21 14:28:00', 2, 1),
(14, 1, 2, '2021-08-21 12:28:00', '2021-08-21 12:30:00', 2, 1),
(15, 1, 1, '2021-08-13 12:32:00', '2021-08-21 12:32:00', 2, 1),
(16, 1, 7, '2021-08-21 12:33:00', '2021-08-27 12:33:00', 2, 1),
(17, 1, 1, '2021-08-21 12:46:00', '2021-08-21 13:46:00', 2, 1),
(18, 1, 1, '2021-08-22 00:09:00', '2021-08-22 02:09:00', 2, 1),
(19, 1, 1, '2021-08-22 00:14:00', '2021-08-22 00:14:00', 2, 1),
(20, 1, 1, '2021-08-22 00:26:00', '2021-08-22 01:26:00', 2, 1),
(21, 1, 5, '2021-08-22 00:34:00', '2021-08-22 01:34:00', 2, 1),
(22, 1, 1, '2021-08-22 00:36:00', '2021-08-22 01:36:00', 2, 1),
(23, 1, 1, '2021-08-22 00:39:00', '2021-08-22 00:39:00', 2, 1),
(24, 1, 1, '2021-08-22 00:43:00', '2021-08-22 01:43:00', 2, 1),
(25, 1, 1, '2021-08-22 00:52:00', '2021-08-22 00:52:00', 2, 1),
(26, 1, 1, '2021-08-22 01:13:00', '2021-08-22 02:13:00', 2, 1),
(27, 1, 1, '2021-08-22 01:17:02', '2021-08-22 02:16:00', 2, 1),
(28, 1, 1, '2021-08-22 01:38:02', '2021-08-22 01:39:00', 2, 1),
(29, 1, 1, '2021-08-22 01:38:02', '2021-08-22 01:39:00', 2, 1),
(30, 1, 1, '2021-08-22 01:43:02', '2021-08-22 01:44:02', 2, 1),
(31, 1, 1, '2021-08-22 01:52:02', '2021-08-22 01:53:02', 2, 1),
(32, 1, 1, '2021-08-22 02:08:02', '2021-08-22 02:09:02', 2, 1),
(33, 1, 1, '2021-08-22 02:11:02', '2021-08-22 02:12:02', 2, 1),
(34, 1, 1, '2021-08-22 02:13:02', '2021-08-22 02:14:02', 2, 1),
(35, 1, 1, '2021-08-22 04:57:02', '2021-08-22 04:59:02', 2, 1),
(36, 1, 1, '2021-08-22 04:59:02', '2021-08-22 05:58:02', 2, 1),
(37, 1, 1, '2021-08-22 06:26:02', '2021-08-22 06:28:02', 2, 1),
(38, 1, 1, '2021-08-22 06:30:02', '2021-08-22 06:32:02', 2, 1),
(39, 1, 1, '2021-08-22 06:31:02', '2021-08-22 06:33:02', 2, 1),
(40, 1, 1, '2021-08-22 06:34:02', '2021-08-22 06:36:02', 2, 1),
(41, 1, 1, '2021-08-22 06:39:02', '2021-08-22 06:44:02', 2, 1),
(42, 1, 1, '2021-08-22 06:43:02', '2021-08-22 06:46:02', 2, 1),
(43, 1, 1, '2021-08-22 06:52:02', '2021-08-22 06:55:02', 2, 1),
(44, 1, 1, '2021-08-22 06:55:02', '2021-08-22 06:57:02', 2, 1),
(45, 1, 1, '2021-08-22 06:57:02', '2021-08-22 06:58:02', 2, 1),
(46, 1, 1, '2021-08-22 06:58:02', '2021-08-22 06:59:02', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user`, `date_created`) VALUES
(1, 1, '2021-06-03'),
(2, 3, '2021-06-03'),
(3, 4, '2021-06-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_command`
--

CREATE TABLE `s_command` (
  `sts_command` int(11) NOT NULL,
  `nama_sts_command` varchar(120) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `s_command`
--

INSERT INTO `s_command` (`sts_command`, `nama_sts_command`, `date_created`) VALUES
(1, 'Absensi', '2021-08-22 06:49:36'),
(2, 'Face Record', '2021-08-22 06:49:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_kehadiran`
--

CREATE TABLE `s_kehadiran` (
  `sts_kehadiran` int(11) NOT NULL,
  `nama_sts_kehadiran` varchar(120) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `s_kehadiran`
--

INSERT INTO `s_kehadiran` (`sts_kehadiran`, `nama_sts_kehadiran`, `date_created`) VALUES
(1, 'Belum Terlaksana', '2021-08-21 09:36:57'),
(2, 'Hadir', '2021-08-21 09:36:57'),
(3, 'Alfa', '2021-08-21 09:36:57'),
(4, 'Izin', '2021-08-21 09:36:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_pertemuan`
--

CREATE TABLE `s_pertemuan` (
  `sts_pertemuan` int(11) NOT NULL,
  `nama_sts_pertemuan` varchar(256) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `s_pertemuan`
--

INSERT INTO `s_pertemuan` (`sts_pertemuan`, `nama_sts_pertemuan`, `date_created`) VALUES
(1, 'Belum Terlaksana', '2021-06-03 21:45:39'),
(2, 'Selesai', '2021-06-03 21:45:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_running`
--

CREATE TABLE `s_running` (
  `sts_running` int(11) NOT NULL,
  `nama_sts_running` varchar(120) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `s_running`
--

INSERT INTO `s_running` (`sts_running`, `nama_sts_running`, `date_created`) VALUES
(1, 'sedang berjalan', '2021-08-17'),
(2, 'tidak digunakan', '2021-08-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `no_induk` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `id_grup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `no_induk`, `password`, `nama`, `id_grup`) VALUES
(1, 'rizwijaya@gmail.com', '05311940000014', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 'Rizqi Wijaya', 3),
(2, 'dosen@dosen.com', 'dosen1', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 'Muhammad Husni', 2),
(3, 'hilmi@gmail.com', '05311940000044', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 'Muhammad Hilmi Ramadhan', 3),
(4, 'herwinda@gmail.com', '05311940000009', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 'Herwinda Marwaa', 3),
(5, 'admin@admin.com', 'admin', '$2y$10$KUn6zkMo/7MTqDyIiGWNCeGBMk/VbM.A1epCPe.XSdDAFNd8XpTIO', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id_device`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `frs`
--
ALTER TABLE `frs`
  ADD PRIMARY KEY (`id_frs`);

--
-- Indeks untuk tabel `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`);

--
-- Indeks untuk tabel `running`
--
ALTER TABLE `running`
  ADD PRIMARY KEY (`id_running`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `s_command`
--
ALTER TABLE `s_command`
  ADD PRIMARY KEY (`sts_command`);

--
-- Indeks untuk tabel `s_kehadiran`
--
ALTER TABLE `s_kehadiran`
  ADD PRIMARY KEY (`sts_kehadiran`);

--
-- Indeks untuk tabel `s_pertemuan`
--
ALTER TABLE `s_pertemuan`
  ADD PRIMARY KEY (`sts_pertemuan`);

--
-- Indeks untuk tabel `s_running`
--
ALTER TABLE `s_running`
  ADD PRIMARY KEY (`sts_running`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `frs`
--
ALTER TABLE `frs`
  MODIFY `id_frs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `running`
--
ALTER TABLE `running`
  MODIFY `id_running` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `s_command`
--
ALTER TABLE `s_command`
  MODIFY `sts_command` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `s_kehadiran`
--
ALTER TABLE `s_kehadiran`
  MODIFY `sts_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `s_pertemuan`
--
ALTER TABLE `s_pertemuan`
  MODIFY `sts_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `s_running`
--
ALTER TABLE `s_running`
  MODIFY `sts_running` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
