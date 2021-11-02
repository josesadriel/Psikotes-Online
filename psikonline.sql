-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2021 pada 13.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psikonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_disc`
--

CREATE TABLE `jawaban_disc` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `setuju` text NOT NULL,
  `tidak_setuju` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban_disc`
--

INSERT INTO `jawaban_disc` (`id_jawaban`, `id_soal`, `id_user`, `setuju`, `tidak_setuju`) VALUES
(1, 1, 1, 'Percaya kepada orang lain', 'Mudah bergaul, ramah'),
(2, 2, 1, 'Lembut, pendiam', 'Optimis, pandangan kedepan'),
(3, 3, 1, 'Ingin mencapai tujuan', 'Bagian dari tim'),
(4, 4, 1, 'Memendam perasaan', 'Menjadi frustasi'),
(5, 5, 1, 'Hidup, banyak bicara', 'Mempertahankan keseimbangan'),
(6, 6, 1, 'Menyelesaikan apa yang dimulai', 'Meningkatkan kehidupan sosial'),
(7, 7, 1, 'Menyendiri bila tertekan', 'Tidak takut untuk berkelahi'),
(8, 8, 1, 'Pendengar yang baik', 'Penganalisa yang baik'),
(9, 24, 1, 'Handal, bisa dipercaya', 'Kreatif, unik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_papi`
--

CREATE TABLE `jawaban_papi` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban_papi`
--

INSERT INTO `jawaban_papi` (`id_jawaban`, `id_user`, `id_soal`, `jawaban`, `added_at`) VALUES
(1, 1, 1, 'A', '2021-09-14 14:04:00'),
(2, 1, 2, 'B', '2021-09-14 14:04:02'),
(3, 1, 3, 'A', '2021-09-14 14:04:03'),
(4, 1, 4, 'A', '2021-09-14 14:04:04'),
(5, 1, 5, 'B', '2021-09-14 14:04:06'),
(6, 1, 6, 'A', '2021-09-14 14:04:07'),
(7, 1, 90, 'B', '2021-09-14 14:04:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_disc`
--

CREATE TABLE `soal_disc` (
  `id_soal` int(11) NOT NULL,
  `pernyataan_1` text NOT NULL,
  `pernyataan_2` text NOT NULL,
  `pernyataan_3` text NOT NULL,
  `pernyataan_4` text NOT NULL,
  `s_1` enum('S','I','D','C','#') NOT NULL,
  `s_2` enum('S','I','D','C','#') NOT NULL,
  `s_3` enum('S','I','D','C','#') NOT NULL,
  `s_4` enum('S','I','D','C','#') NOT NULL,
  `ts_1` enum('S','I','D','C','#') NOT NULL,
  `ts_2` enum('S','I','D','C','#') NOT NULL,
  `ts_3` enum('S','I','D','C','#') NOT NULL,
  `ts_4` enum('S','I','D','C','#') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_disc`
--

INSERT INTO `soal_disc` (`id_soal`, `pernyataan_1`, `pernyataan_2`, `pernyataan_3`, `pernyataan_4`, `s_1`, `s_2`, `s_3`, `s_4`, `ts_1`, `ts_2`, `ts_3`, `ts_4`) VALUES
(1, 'Mudah bergaul, ramah', 'Percaya kepada orang lain', 'Petualang, mengambil risiko', 'Toleran, penuh hormat', 'S', 'I', '#', 'C', 'S', 'I', 'D', 'C'),
(2, 'Lembut, pendiam', 'Optimis, pandangan kedepan', 'Pusat perhatian, bersosialisasi', 'Pembuat damai, membawa ketenangan', 'C', 'D', '#', 'S', '#', 'D', 'I', 'S'),
(3, 'Mendorong orang lain', 'Berjuang untuk kesempurnaan', 'Bagian dari tim', 'Ingin mencapai tujuan', 'I', '#', '#', 'D', 'I', 'C', 'S', '#'),
(4, 'Menjadi frustasi', 'Memendam perasaan', 'Menceritakan sisi kehidupan', 'Berpihak pada oposisi', 'C', 'S', '#', 'D', 'C', 'S', 'I', 'D'),
(5, 'Hidup, banyak bicara', 'Bekerja cepat, tekun', 'Mempertahankan keseimbangan', 'Mengikuti aturan', 'I', 'D', 'S', '#', '#', 'D', 'S', 'C'),
(6, 'Mengatur waktu secara efisien', 'Terburu-buru, merasa tertekan', 'Meningkatkan kehidupan sosial', 'Menyelesaikan apa yang dimulai', 'C', 'D', 'I', 'S', '#', 'D', 'I', 'S'),
(7, 'Menolak perubahan tiba-tiba', 'Cenderung sering janji', 'Menyendiri bila tertekan', 'Tidak takut untuk berkelahi', 'C', 'I', '#', '#', '#', 'I', 'C', 'D'),
(8, 'Pendukung yang baik', 'Pendengar yang baik', 'Penganalisa yang baik', 'Pendelegasi yang baik', 'I', 'S', 'C', 'D', 'I', 'S', 'C', 'D'),
(9, 'Yang terpenting hasil', 'Berbuat yang benar, ketepatan', 'Dibuat menjadi menyenangkan', 'Melakukan bersama-sama', 'D', 'C', '#', '#', 'D', 'C', 'I', 'S'),
(10, 'Akan melakukan tanpa kontrol', 'Akan membeli berdasar hasrat', 'Akan menunggu tanpa tekanan', 'Akan membelanjakan apa yang diinginkan', '#', 'D', 'S', 'I', 'C', 'D', 'S', '#'),
(11, 'Ramah, mudah berteman', 'Unik, bosan dengan hal rutin', 'Aktif, merubah sesuatu', 'Ingin sesuatu yang pasti', 'S', '#', 'D', 'C', '#', 'I', 'D', 'C'),
(12, 'Tidak konfrontasi, mengalah', 'Terlalu banyak hal rinci', 'Berubah dalam menit terakhir', 'Penuntut, perusak', '#', 'C', 'I', 'D', 'S', '#', 'I', 'D'),
(13, 'Ingin kemajuan', 'Mudah puas', 'Terbuka', 'Rendah hati', 'D', 'S', 'I', '#', 'D', '#', '#', 'C'),
(14, 'Dingin, menahan diri', 'Bahagia, riang', 'Menyenangkan, baik', 'Tegas, berani', 'C', 'I', 'S', 'D', 'C', 'I', '#', 'D'),
(15, 'Meluangkan waktu untuk orang lain', 'Merencanakan masa depan', 'Melakukan petualangan', 'Menerima penghargaan atas pencapaian tujuan', 'S', 'C', 'I', 'D', 'S', '#', 'I', 'D'),
(16, 'Peraturan perlu dipertanyakan', 'Peraturan membuat adil', 'Peraturan membosankan', 'Peraturan membuat aman', '#', 'C', 'I', 'S', 'D', '#', 'I', 'S'),
(17, 'Pendidikan, budaya', 'Pencapaian, penghargaan', 'Keamanan, keselamatan', 'Sosial, pertemuan kelompok', '#', 'D', 'S', 'I', 'C', 'D', 'S', '#'),
(18, 'Bertanggungjawab, to the point', 'Mudah bergaul, antusias', 'Mudah diterka, konsisten', 'Berhati-hati, waspada', 'D', '#', '#', 'C', 'D', 'I', 'S', '#'),
(19, 'Tidak mudah menyerah', 'Melakukan sesuai perintah', 'Riang, ceria', 'Ingin keteraturan, rapih', 'D', 'S', 'I', '#', 'D', '#', 'I', 'C'),
(20, 'Saya akan memimpin mereka', 'Saya akan mengikuti mereka', 'Saya akan pengaruhi mereka', 'Saya akan dapatkan fakta', 'D', 'S', 'I', 'C', '#', 'S', 'I', '#'),
(21, 'Memikirkan orang lain terlebih dahulu', 'Kompetisi, senang tantangan', 'Optimis, berpikir positif', 'Berpikir logis, berurutan', 'S', 'D', 'I', '#', 'S', 'D', 'I', 'C'),
(22, 'Menyenangkan', 'Tertawa keras, ekspresif', 'Berani, tegas', 'Pendiam, menahan diri', 'S', '#', 'D', 'C', 'S', 'I', 'D', 'C'),
(23, 'Ingin kekuasaan lebih', 'Ingin kesempatan baru', 'Menghindar dari segala konflik', 'Ingin aturan yang jelas', '#', 'I', 'S', '#', 'D', '#', 'S', 'C'),
(24, 'Handal, bisa dipercaya', 'Kreatif, unik', 'Orientasi kepada hasil', 'Memegang teguh standard, akurat', '#', 'I', 'D', 'C', 'S', 'I', '#', '#');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_papi`
--

CREATE TABLE `soal_papi` (
  `id_papi` int(11) NOT NULL,
  `pernyataan1` text NOT NULL,
  `var1` varchar(1) NOT NULL,
  `pernyataan2` text NOT NULL,
  `var2` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_papi`
--

INSERT INTO `soal_papi` (`id_papi`, `pernyataan1`, `var1`, `pernyataan2`, `var2`) VALUES
(1, '<span style=\"color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;;\">Pernyataan&nbsp;</span>1A                                    ', 'G', '<span style=\"color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;;\">Pernyataan&nbsp;</span>1B                                    ', 'E'),
(2, 'Pernyataan 2A', 'A', 'Pernyataan 2B', 'N'),
(3, 'Pernyataan 3A', 'P', 'Pernyataan 3B', 'A'),
(4, 'Pernyataan 4A', 'X', 'Pernyataan 4B', 'P'),
(5, 'Pernyataan 5A', 'B', 'Pernyataan 5B', 'X'),
(6, 'Pernyataan 6A', 'O', 'Pernyataan 6B', 'B'),
(7, 'Pernyataan 7A', 'Z', 'Pernyataan 7B', 'O'),
(8, 'Pernyataan 8A', 'K', 'Pernyataan 8B', 'Z'),
(9, 'Pernyataan 9A', 'F', 'Pernyataan 9B', 'K'),
(10, 'Pernyataan 10A', 'W', 'Pernyataan 10B', 'F'),
(11, 'Pernyataan 11A', 'G', 'Pernyataan 11B', 'C'),
(12, 'Pernyataan 12A', 'L', 'Pernyataan 12B', 'E'),
(13, 'Pernyataan 13A', 'P', 'Pernyataan 13B', 'N'),
(14, 'Pernyataan 14A', 'X', 'Pernyataan 14B', 'A'),
(15, 'Pernyataan 15A', 'B', 'Pernyataan 15B', 'P'),
(16, 'Pernyataan 16A', 'O', 'Pernyataan 16B', 'X'),
(17, 'Pernyataan 17A', 'Z', 'Pernyataan 17B', 'B'),
(18, 'Pernyataan 18A', 'K', 'Pernyataan 18B', 'O'),
(19, 'Pernyataan 19A', 'F', 'Pernyataan 19B', 'Z'),
(20, 'Pernyataan 20A', 'W', 'Pernyataan 20B', 'K'),
(21, 'Pernyataan 21A', 'G', 'Pernyataan 21B', 'D'),
(22, 'Pernyataan 22A', 'L', 'Pernyataan 22B', 'C'),
(23, 'Pernyataan 23A', 'I', 'Pernyataan 23B', 'E'),
(24, 'Pernyataan 24A', 'X', 'Pernyataan 24B', 'N'),
(25, 'Pernyataan 25A', 'B', 'Pernyataan 25B', 'A'),
(26, 'Pernyataan 26A', 'O', 'Pernyataan 26B', 'P'),
(27, 'Pernyataan 27A', 'Z', 'Pernyataan 27B', 'X'),
(28, 'Pernyataan 28A', 'K', 'Pernyataan 28B', 'B'),
(29, 'Pernyataan 29A', 'F', 'Pernyataan 29B', 'O'),
(30, 'Pernyataan 30A', 'W', 'Pernyataan 30B', 'Z'),
(31, 'Pernyataan 31A', 'G', 'Pernyataan 31B', 'R'),
(32, 'Pernyataan 32A', 'L', 'Pernyataan 32B', 'D'),
(33, 'Pernyataan 33A', 'I', 'Pernyataan 33B', 'C'),
(34, 'Pernyataan 34A', 'T', 'Pernyataan 34B', 'E'),
(35, 'Pernyataan 35A', 'B', 'Pernyataan 35B', 'N'),
(36, 'Pernyataan 36A', 'O', 'Pernyataan 36B', 'A'),
(37, 'Pernyataan 37A', 'Z', 'Pernyataan 37B', 'P'),
(38, 'Pernyataan 38A', 'K', 'Pernyataan 38B', 'X'),
(39, 'Pernyataan 39A', 'F', 'Pernyataan 39B', 'B'),
(40, 'Pernyataan 40A', 'W', 'Pernyataan 40B', 'O'),
(41, 'Pernyataan 41A', 'G', 'Pernyataan 41B', 'S'),
(42, 'Pernyataan 42A', 'L', 'Pernyataan 42B', 'R'),
(43, 'Pernyataan 43A', 'I', 'Pernyataan 43B', 'D'),
(44, 'Pernyataan 44A', 'T', 'Pernyataan 44B', 'C'),
(45, 'Pernyataan 45A', 'V', 'Pernyataan 45B', 'E'),
(46, 'Pernyataan 46A', 'O', 'Pernyataan 46B', 'N'),
(47, 'Pernyataan 47A', 'Z', 'Pernyataan 47B', 'A'),
(48, 'Pernyataan 48A', 'K', 'Pernyataan 48B', 'P'),
(49, 'Pernyataan 49A', 'F', 'Pernyataan 49B', 'X'),
(50, 'Pernyataan 50A', 'W', 'Pernyataan 50B', 'B'),
(51, 'Pernyataan 51A', 'G', 'Pernyataan 51B', 'V'),
(52, 'Pernyataan 52A', 'L', 'Pernyataan 52B', 'S'),
(53, 'Pernyataan 53A', 'I', 'Pernyataan 53B', 'R'),
(54, 'Pernyataan 54A', 'T', 'Pernyataan 54B', 'D'),
(55, 'Pernyataan 55A', 'V', 'Pernyataan 55B', 'C'),
(56, 'Pernyataan 56A', 'S', 'Pernyataan 56B', 'E'),
(57, 'Pernyataan 57A', 'Z', 'Pernyataan 57B', 'N'),
(58, 'Pernyataan 58A', 'K', 'Pernyataan 58B', 'A'),
(59, 'Pernyataan 59A', 'F', 'Pernyataan 59B', 'P'),
(60, 'Pernyataan 60A', 'W', 'Pernyataan 60B', 'X'),
(61, 'Pernyataan 61A', 'G', 'Pernyataan 61B', 'T'),
(62, 'Pernyataan 62A', 'L', 'Pernyataan 62B', 'V'),
(63, 'Pernyataan 63A', 'I', 'Pernyataan 63B', 'S'),
(64, 'Pernyataan 64A', 'T', 'Pernyataan 64B', 'R'),
(65, 'Pernyataan 65A', 'V', 'Pernyataan 65B', 'D'),
(66, 'Pernyataan 66A', 'S', 'Pernyataan 66B', 'C'),
(67, 'Pernyataan 67A', 'R', 'Pernyataan 67B', 'E'),
(68, 'Pernyataan 68A', 'K', 'Pernyataan 68B', 'N'),
(69, 'Pernyataan 69A', 'F', 'Pernyataan 69B', 'A'),
(70, 'Pernyataan 70A', 'W', 'Pernyataan 70B', 'P'),
(71, 'Pernyataan 71A', 'G', 'Pernyataan 71B', 'I'),
(72, 'Pernyataan 72A', 'L', 'Pernyataan 72B', 'T'),
(73, 'Pernyataan 73A', 'I', 'Pernyataan 73B', 'V'),
(74, 'Pernyataan 74A', 'T', 'Pernyataan 74B', 'S'),
(75, 'Pernyataan 75A', 'V', 'Pernyataan 75B', 'R'),
(76, 'Pernyataan 76A', 'S', 'Pernyataan 76B', 'D'),
(77, 'Pernyataan 77A', 'R', 'Pernyataan 77B', 'C'),
(78, 'Pernyataan 78A', 'D', 'Pernyataan 78B', 'E'),
(79, 'Pernyataan 79A', 'F', 'Pernyataan 79B', 'N'),
(80, 'Pernyataan 80A', 'W', 'Pernyataan 80B', 'A'),
(81, 'Pernyataan 81A', 'G', 'Pernyataan 81B', 'L'),
(82, 'Pernyataan 82A', 'L', 'Pernyataan 82B', 'I'),
(83, 'Pernyataan 83A', 'I', 'Pernyataan 83B', 'T'),
(84, 'Pernyataan 84A', 'T', 'Pernyataan 84B', 'V'),
(85, 'Pernyataan 85A', 'V', 'Pernyataan 85B', 'S'),
(86, 'Pernyataan 86A', 'S', 'Pernyataan 86B', 'R'),
(87, 'Pernyataan 87A', 'R', 'Pernyataan 87B', 'D'),
(88, 'Pernyataan 88A', 'D', 'Pernyataan 88B', 'C'),
(89, 'Pernyataan 89A', 'C', 'Pernyataan 89B', 'E'),
(90, 'Pernyataan 90A', 'W', 'Pernyataan 90B', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `noHp` varchar(20) NOT NULL,
  `text_wa` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `noHp`, `text_wa`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '6282122127547', 'Halo, saya sudah melakukan pendaftaran di situs psikotes online milik Matahati dengan nama *nama_peserta*.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_contohsoal`
--

CREATE TABLE `tbl_contohsoal` (
  `id_soal` int(11) NOT NULL,
  `jenis_tes` text NOT NULL,
  `subtes` text NOT NULL,
  `soal` text NOT NULL,
  `penjelasan` text NOT NULL,
  `gambar` text NOT NULL,
  `jenis_jawaban` enum('Isian','Pilihan Ganda','Gambar','Aritmatika','Hafalan') NOT NULL,
  `jumlah_jawaban` int(11) NOT NULL,
  `jumlah_benar` int(11) NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban_benar` text NOT NULL,
  `paket_gambar` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_contohsoal`
--

INSERT INTO `tbl_contohsoal` (`id_soal`, `jenis_tes`, `subtes`, `soal`, `penjelasan`, `gambar`, `jenis_jawaban`, `jumlah_jawaban`, `jumlah_benar`, `pilihan`, `jawaban_benar`, `paket_gambar`, `added_at`) VALUES
(1, 'CFIT', 'Subtest 1', '', '<p>Jawaban yang benar adalah <b>C</b></p>', 'Contoh-CFIT-Subtest 1-1.png', 'Pilihan Ganda', 6, 1, '', 'c', '', '2021-04-20 17:19:10'),
(2, 'CFIT', 'Subtest 2', '', '<p>Jawaban yang benar adalah <b>A </b>dan <b>E</b></p>', 'Contoh-CFIT-Subtest 2-2.png', 'Pilihan Ganda', 5, 2, '', 'a|e', '', '2021-04-20 17:23:22'),
(3, 'CFIT', 'Subtest 3', '', 'Jawaban yang benar adalah <b>B</b>', 'Contoh-CFIT-Subtest 3-3.png', 'Pilihan Ganda', 6, 1, '', 'b', '', '2021-04-20 17:26:04'),
(4, 'CFIT', 'Subtest 3', '', '<p>Jawaban yang benar adalah <b>C</b></p>', 'Contoh-CFIT-Subtest 3-4.png', 'Pilihan Ganda', 6, 1, '', 'c', '', '2021-04-20 17:27:11'),
(27, 'CFIT', 'Subtest 4', '', '<p>Jawaban yang benar adalah <b>C</b></p>', 'Contoh-CFIT-Subtest 4-27.png', 'Pilihan Ganda', 5, 1, '', 'C', '', '2021-09-11 16:57:35'),
(44, 'IST', 'WU', '', '<p>Contoh kedua adalah kubus <b>E</b>. Cara mendapatkannya dengan digulingkan ke kiri satu kali dan diputar ke kiri satu kali, sehingga sisi kubus yang bertanda garis silang terletak di depan seperti kubus <b>E</b><br></p>', 'Contoh-IST-WU-2.png', 'Gambar', 0, 0, '', 'E', 'Contoh WU', '2021-09-13 17:46:52'),
(45, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan Q adalah suatu……………<br></p>', '<p>Quintet adalah termasuk dalam jenis <b>Kesenian</b>, sehingga jawaban yang benar adalah <b>Kesenian</b>. Oleh karena itu pilih jawaban <b>d. kesenian</b>.<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'D', '', '2021-09-13 17:51:01'),
(46, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan R adalah suatu……………<br></p>', '<p>Rusa adalah termasuk dalam jenis Hewan, sehingga jawaban yang benar adalah Hewan. Oleh karena itu pilih jawaban <b>e. hewan</b>.<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'E', '', '2021-09-13 17:51:35'),
(43, 'IST', 'WU', '', '<p>Contoh ini memperlihatkan kubus A dengan kedudukan yang berbeda. Mendapatkannya adalah dengan cara menggulingkan lebih dahulu kubus itu ke kiri satu kali kemudian diputar ke kiri satu kali, sehingga sisi kubus yang bertanda dua segi empat hitam terletak di depan seperti kubus <b>A</b>.<br></p>', 'Contoh-IST-WU-1.png', 'Gambar', 0, 0, '', 'A', 'Contoh WU', '2021-09-13 17:45:43'),
(41, 'IST', 'FA', '', '<p>Jika potongan-potongan pada contoh 3 (kotak ketiga) diatas setelah disusun (digabungkan), maka akan menghasilkan bentuk (<b>B</b>)<br></p>', 'Contoh-IST-FA-3.PNG', 'Gambar', 0, 0, '', 'B', 'Contoh FA', '2021-09-13 15:32:22'),
(42, 'IST', 'FA', '', '<p>Jika potongan-potongan pada contoh 4 (kotak keempat) diatas setelah disusun (digabungkan), maka akan menghasilkan bentuk (<b>D</b>)<br></p>', 'Contoh-IST-FA-4.PNG', 'Gambar', 0, 0, '', 'D', 'Contoh FA', '2021-09-13 15:38:09'),
(39, 'IST', 'FA', '', '<p>Jika potongan-potongan pada contoh 1 (kotak pertama) diatas setelah disusun (digabungkan), maka&nbsp;<span style=\"font-size: 1rem;\">akan menghasilkan bentuk (<b>A</b>)</span></p>', 'Contoh-IST-FA-1.PNG', 'Gambar', 0, 0, '', 'A', 'Contoh FA', '2021-09-13 15:16:32'),
(40, 'IST', 'FA', '', '<p>Jika potongan-potongan pada contoh 2 (kotak kedua) diatas setelah disusun (digabungkan), maka akan menghasilkan bentuk (<b>E</b>)<br></p>', 'Contoh-IST-FA-2.PNG', 'Gambar', 0, 0, '', 'E', 'Contoh FA', '2021-09-13 15:27:14'),
(37, 'IST', 'ZR', '<p>2&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;?<br></p>', '<p>Pada deret ini angka berikutnya selalu didapat jika angka didepannya ditambah dengan <b>2</b>. </p><p>Jawabannya adalah : <b>16</b><br></p>', '', 'Isian', 0, 0, '', '16', '', '2021-09-13 12:27:18'),
(38, 'IST', 'ZR', '<p>9&nbsp;&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;?<br></p>', '<p>Pada deret ini polanya berganti-ganti harus dikurangi dengan <b>2</b> dan setelah itu ditambah dengan <b>3</b>. </p><p>Jawabannya adalah : <b>10</b><br></p>', '', 'Isian', 0, 0, '', '10', '', '2021-09-13 12:28:41'),
(20, 'PAPI KOSTICK', 'PAPI KOSTICK', '', '                                                                                                                                                                                                                                                Bila anda merasa pernyataan “saya lambat dalam membuat teman” lebih mencerminkan diri anda daripada pernyataan “saya lambat dalam mengambil keputusan”, maka pilih pernyataan tersebut.                                                                                                                                                                                                        ', '', 'Pilihan Ganda', 0, 0, 'Saya lambat dalam membuat teman#                                                                                                                                                                Saya lambat dalam mengambil keputusan', '', '', '2021-06-06 14:47:43'),
(36, 'IST', 'RA', '<p>Dengan sepeda, Husin dapat menempuh 15 km dalam waktu 1 jam. Berapa km-kah yang dapat ia tempuh dalam waktu 4 jam?<br></p>', '<p>Jawabannya adalah : <b>60</b><br></p>', '', 'Aritmatika', 0, 0, '', '60', '', '2021-09-13 12:11:02'),
(32, 'IST', 'AN', '<p>GELAP : TERANG = BASAH : ...</p>', '<p>Gelap adalah lawan kata dari terang, maka untuk basah lawan katanya adalah kering. Jawaban yang&nbsp;<span style=\"font-size: 1rem;\">benar adalah : kering. Oleh karena itu pada kertas jawaban, pilih jawaban <b>E. kering</b></span></p>', '', 'Pilihan Ganda', 0, 0, 'hujan#hari#lembab#angin#kering', 'E', '', '2021-09-12 19:53:49'),
(33, 'IST', 'GE', '<p>Ayam - Itik</p>', '<p>Kata “unggas” dapat meliputi pengertian kedua kata tersebut. Oleh karena itu pada isian yang telah disediakan tulis kata “<b>unggas</b>”.<br></p>', '', 'Isian', 0, 0, '', 'unggas|hewan|-', '', '2021-09-13 12:05:21'),
(34, 'IST', 'GE', '<p>Gaul - Celana</p>', '<p>Kata “pakaian” dapat meliputi pengertian kedua kata tersebut. Oleh karena itu pada isian yang telah disediakan tulis kata “<b>pakaian</b>”.<br></p>', '', 'Isian', 0, 0, '', 'pakaian|outfit|-', '', '2021-09-13 12:06:21'),
(35, 'IST', 'RA', '<p>Sebatang pensil harganya 25 rupiah. Berapakah harga 3 batang ?<br></p>', '<p>Cara menjawabnya adalah dengan memilih angka jawaban.</p><p>0 1 2 3 4 <b style=\"\"><span style=\"background-color: rgb(255, 0, 0);\">5</span>&nbsp;</b>6 7 8 <span style=\"background-color: rgb(255, 0, 0);\"><b>9</b></span></p>', '', 'Aritmatika', 0, 0, '', '75', '', '2021-09-13 12:10:19'),
(31, 'IST', 'AN', '<p>HUTAN : POHON = TEMBOK : ...</p>', '<p>Hubungan antara hutan dan pohon adalah bahwa hutan terdiri atas pohon-pohon, maka hubungan&nbsp;<span style=\"font-size: 1rem;\">antara tembok dan salah satu kata pilihan adalah bahwa tembok terdiri atas batu bata. Jawaban yang&nbsp;</span><span style=\"font-size: 1rem;\">benar adalah : batu bata. Oleh karena itu pada kertas jawaban, pilih jawaban <b>a. batu bata</b></span></p>', '', 'Pilihan Ganda', 0, 0, 'batu bata#rumah#semen#putih#dinding', 'A', '', '2021-09-12 19:52:50'),
(28, 'IST', 'SE', '<p>Seekor kuda mempunyai kesamaan terbanyak dengan seekor…………………<br></p>', 'Jawaban yang benar adalah <b>C. keledai</b>', '', 'Pilihan Ganda', 0, 0, 'kucing#bajing#keledai#lembu#anjing', 'C', '', '2021-09-12 19:27:19'),
(29, 'IST', 'WA', '', '<p>Meja, kursi, lemari, dan tempat tidur adalah perabot rumah, sedangkan “burung” bukanlah perabot&nbsp;<span style=\"font-size: 1rem;\">rumah yang tidak memiliki kesamaan dengan keempat kata yang lain. Jawaban yang benar adalah :&nbsp;</span><span style=\"font-size: 1rem;\">burung. Oleh karena itu pada kertas jawaban, pilih jawaban <b>c. burung</b></span></p>', '', 'Pilihan Ganda', 0, 0, 'meja#kursi#burung#lemari#tempat tidur', 'C', '', '2021-09-12 19:38:40'),
(30, 'IST', 'WA', '', '<p>Pada duduk, berbaring, berdiri dan berjongkok adalah yang orang berada dalam keadaan tidak bergerak,&nbsp;<span style=\"font-size: 1rem;\">sedangkan “berjalan” orang berada dalam keadaan bergerak. Jawaban yang benar adalah : berjalan.&nbsp;</span><span style=\"font-size: 1rem;\">Oleh karena itu pada kertas jawaban, pilih jawaban <b>d. berjalan</b></span></p>', '', 'Pilihan Ganda', 0, 0, 'duduk#berbaring#berdiri#berjalan#berjongkok', 'D', '', '2021-09-12 19:39:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_event`
--

CREATE TABLE `tbl_event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(20) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time NOT NULL,
  `grup` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_event`
--

INSERT INTO `tbl_event` (`id_event`, `nama_event`, `tgl_mulai`, `tgl_akhir`, `waktu_mulai`, `waktu_akhir`, `grup`, `added_at`) VALUES
(3, 'Demo Psikotes', '2021-09-11', '2021-09-30', '07:00:00', '23:59:00', 'Demo', '2021-09-11 17:14:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_grup`
--

CREATE TABLE `tbl_grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` text NOT NULL,
  `jenis_tes` varchar(41) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_grup`
--

INSERT INTO `tbl_grup` (`id_grup`, `nama_grup`, `jenis_tes`) VALUES
(1, 'Demo', 'CFIT, IST, MBTI, MSDT, PAPI KOSTICK, DISC'),
(2, 'Manajer', 'CFIT, IST, MBTI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasiltes`
--

CREATE TABLE `tbl_hasiltes` (
  `id_hasiltes` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenistes`
--

CREATE TABLE `tbl_jenistes` (
  `id_jenistes` int(11) NOT NULL,
  `nama_tes` varchar(12) NOT NULL,
  `intruksi_tes` text NOT NULL,
  `add_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jenistes`
--

INSERT INTO `tbl_jenistes` (`id_jenistes`, `nama_tes`, `intruksi_tes`, `add_at`) VALUES
(1, 'CFIT', '<p>Pada test ini terdapat 4 subtest dengan cara kerja dan waktu pengerjaan yang berbeda-beda pada setiap subtest nya. Anda dapat memulai mengerjakan apabila sudah ada instruksi mulai, dan anda diminta berhenti mengerjakan apabila ada instruksi berhenti.<br></p>', '2021-03-19 20:45:05'),
(2, 'IST', '', '2021-03-19 20:51:43'),
(3, 'MBTI', '', '2021-04-01 12:19:57'),
(4, 'MSDT', '', '2021-04-01 12:20:08'),
(5, 'PAPI KOSTICK', '<p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"IN\">Dalam soal ini terdapat <b>90 pasang pernyataan</b>. Anda harus memilih salah satu\r\ndari setiap pernyataan, yang menurut anda paling mencerminkan diri anda atau\r\npaling menunjukkan bagaimana perasaan anda. Kadang-kadang anda akan dapatkan\r\nsepasang penyataan yang keduanya tidak menggambarkan diri anda, dalam hal\r\nseperti ini anda tetap harus memilih salah satu yang lebih mendekati.<o:p></o:p></span></p>', '2021-04-01 12:20:41'),
(6, 'EPPS', '', '2021-04-01 12:20:42'),
(7, 'DISC', '<p>Dari 4 pernyataan yang tersedia,</p><p>Pilih SATU pernyataan yang <b>PALING SESUAI (S)</b> dengan diri Anda lalu klik dikolom <b>S</b></p><p>Pilih SATU pernyataan yang <b>PALING TIDAK SESUAI (TS)</b> dengan diri Anda lalu klik dikolom <b>TS</b></p><p>Apabila ada pernyataan yang Anda anggap kurang mewakili diri Anda, silahkan pilih yang <b>PALING MENDEKATI</b> dengan diri Anda</p>', '2021-04-01 12:21:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jwbuser`
--

CREATE TABLE `tbl_jwbuser` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `jawaban` varchar(20) NOT NULL,
  `keterangan` enum('Benar','Salah') NOT NULL,
  `point` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jwbuser`
--

INSERT INTO `tbl_jwbuser` (`id_jawaban`, `id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`, `added_at`) VALUES
(1, 1, 174, 1, 'B', 'Benar', 1, '2021-09-11 17:19:04'),
(2, 1, 175, 1, 'C', 'Benar', 1, '2021-09-11 17:19:07'),
(3, 1, 176, 1, 'B', 'Benar', 1, '2021-09-11 17:19:09'),
(4, 1, 177, 1, 'D', 'Benar', 1, '2021-09-11 17:19:11'),
(5, 1, 178, 1, 'E', 'Benar', 1, '2021-09-11 17:19:13'),
(6, 1, 179, 1, 'B', 'Benar', 1, '2021-09-11 17:19:16'),
(7, 1, 180, 1, 'D', 'Benar', 1, '2021-09-11 17:19:18'),
(8, 1, 181, 1, 'B', 'Benar', 1, '2021-09-11 17:19:29'),
(9, 1, 182, 1, 'F', 'Benar', 1, '2021-09-11 17:19:30'),
(10, 1, 183, 1, 'C', 'Benar', 1, '2021-09-11 17:19:32'),
(11, 1, 184, 1, 'B', 'Benar', 1, '2021-09-11 17:19:34'),
(12, 1, 185, 1, 'B', 'Benar', 1, '2021-09-11 17:19:36'),
(13, 1, 186, 1, 'F', 'Benar', 1, '2021-09-11 17:19:39'),
(14, 1, 187, 2, 'B|E', 'Benar', 1, '2021-09-11 17:19:57'),
(15, 1, 188, 2, 'A|E', 'Benar', 1, '2021-09-11 17:20:00'),
(16, 1, 189, 2, 'A|D', 'Benar', 1, '2021-09-11 17:20:04'),
(17, 1, 190, 2, 'A|D', 'Salah', 0, '2021-09-11 17:20:09'),
(18, 1, 191, 2, 'C|E', 'Salah', 0, '2021-09-11 17:20:12'),
(19, 1, 192, 2, 'B|E', 'Salah', 0, '2021-09-11 17:20:15'),
(20, 1, 193, 2, 'A|D', 'Salah', 0, '2021-09-11 17:20:17'),
(21, 1, 194, 2, 'B|E', 'Benar', 1, '2021-09-11 17:20:20'),
(22, 1, 195, 2, 'B|E', 'Salah', 0, '2021-09-11 17:20:22'),
(23, 1, 196, 2, 'B|D', 'Benar', 1, '2021-09-11 17:20:24'),
(24, 1, 197, 2, 'A|E', 'Benar', 1, '2021-09-11 17:20:26'),
(25, 1, 198, 2, 'C|D', 'Benar', 1, '2021-09-11 17:20:29'),
(26, 1, 199, 2, 'B|C', 'Benar', 1, '2021-09-11 17:20:32'),
(27, 1, 200, 2, 'A|B', 'Benar', 1, '2021-09-11 17:20:34'),
(28, 1, 201, 3, 'E', 'Benar', 1, '2021-09-11 17:20:48'),
(29, 1, 202, 3, 'E', 'Benar', 1, '2021-09-11 17:20:50'),
(30, 1, 203, 3, 'E', 'Benar', 1, '2021-09-11 17:20:53'),
(31, 1, 204, 3, 'B', 'Benar', 1, '2021-09-11 17:20:55'),
(32, 1, 205, 3, 'C', 'Benar', 1, '2021-09-11 17:20:57'),
(33, 1, 206, 3, 'D', 'Benar', 1, '2021-09-11 17:20:59'),
(34, 1, 207, 3, 'E', 'Benar', 1, '2021-09-11 17:21:01'),
(35, 1, 208, 3, 'E', 'Benar', 1, '2021-09-11 17:21:02'),
(36, 1, 209, 3, 'A', 'Salah', 0, '2021-09-11 17:21:04'),
(37, 1, 210, 3, 'A', 'Salah', 0, '2021-09-11 17:21:06'),
(38, 1, 211, 3, 'F', 'Salah', 0, '2021-09-11 17:21:07'),
(39, 1, 212, 3, 'C', 'Salah', 0, '2021-09-11 17:21:09'),
(40, 1, 213, 3, 'C', 'Salah', 0, '2021-09-11 17:21:15'),
(41, 1, 214, 4, 'B', 'Benar', 1, '2021-09-11 17:21:28'),
(42, 1, 215, 4, 'A', 'Benar', 1, '2021-09-11 17:21:29'),
(43, 1, 216, 4, 'D', 'Benar', 1, '2021-09-11 17:21:33'),
(44, 1, 217, 4, 'D', 'Benar', 1, '2021-09-11 17:21:35'),
(45, 1, 218, 4, 'A', 'Benar', 1, '2021-09-11 17:21:36'),
(46, 1, 219, 4, 'B', 'Salah', 0, '2021-09-11 17:21:38'),
(47, 1, 220, 4, 'C', 'Benar', 1, '2021-09-11 17:21:39'),
(48, 1, 0, 0, '', 'Benar', 1, '2021-09-11 17:21:40'),
(49, 1, 221, 4, 'D', 'Salah', 0, '2021-09-11 17:21:43'),
(50, 1, 222, 4, 'A', 'Salah', 0, '2021-09-11 17:21:49'),
(51, 1, 223, 4, 'D', 'Salah', 0, '2021-09-11 17:21:52'),
(52, 1, 4, 5, 'B', 'Benar', 1, '2021-09-11 17:23:21'),
(53, 1, 5, 5, 'A', 'Salah', 0, '2021-09-11 17:23:24'),
(54, 1, 6, 5, 'D', 'Benar', 1, '2021-09-11 17:23:26'),
(55, 1, 7, 5, 'E', 'Salah', 0, '2021-09-11 17:23:27'),
(56, 1, 8, 5, 'C', 'Salah', 0, '2021-09-11 17:23:28'),
(57, 1, 9, 5, 'B', 'Benar', 1, '2021-09-11 17:23:30'),
(58, 1, 10, 5, 'C', 'Salah', 0, '2021-09-11 17:23:31'),
(59, 1, 11, 5, 'D', 'Salah', 0, '2021-09-11 17:23:33'),
(60, 1, 12, 5, 'A', 'Salah', 0, '2021-09-11 17:23:35'),
(61, 1, 13, 5, 'C', 'Salah', 0, '2021-09-11 17:23:36'),
(62, 1, 15, 5, 'D', 'Salah', 0, '2021-09-11 17:23:38'),
(63, 1, 16, 5, 'E', 'Salah', 0, '2021-09-11 17:23:40'),
(64, 1, 17, 5, 'D', 'Salah', 0, '2021-09-11 17:23:41'),
(65, 1, 18, 5, 'B', 'Salah', 0, '2021-09-11 17:23:43'),
(66, 1, 19, 5, 'D', 'Salah', 0, '2021-09-11 17:23:44'),
(67, 1, 20, 5, 'B', 'Salah', 0, '2021-09-11 17:23:46'),
(68, 1, 21, 5, 'C', 'Salah', 0, '2021-09-11 17:23:47'),
(69, 1, 22, 5, 'D', 'Salah', 0, '2021-09-11 17:23:49'),
(70, 1, 23, 5, 'E', 'Salah', 0, '2021-09-11 17:23:52'),
(71, 1, 24, 6, 'B', 'Benar', 1, '2021-09-11 17:24:14'),
(72, 1, 25, 6, 'D', 'Salah', 0, '2021-09-11 17:24:16'),
(73, 1, 161, 7, 'B', 'Salah', 0, '2021-09-11 17:24:24'),
(74, 1, 170, 8, 'arah', 'Benar', 1, '2021-09-11 17:24:41'),
(75, 1, 171, 8, 'aksesoris', 'Salah', 0, '2021-09-11 17:24:48'),
(76, 1, 164, 10, '27', 'Benar', 1, '2021-09-11 17:25:29'),
(77, 1, 165, 11, 'B', 'Salah', 0, '2021-09-11 17:29:48'),
(78, 1, 166, 12, 'A', 'Benar', 1, '2021-09-11 17:30:31'),
(79, 1, 172, 12, 'B', 'Salah', 0, '2021-09-11 17:30:34'),
(80, 1, 167, 13, 'B', 'Salah', 0, '2021-09-11 17:33:46'),
(81, 1, 168, 13, 'A', 'Benar', 1, '2021-09-11 17:33:47'),
(82, 1, 26, 14, 'A', 'Salah', 0, '2021-09-14 13:52:02'),
(83, 1, 27, 14, 'B', 'Salah', 0, '2021-09-14 13:52:03'),
(84, 1, 28, 14, 'A', 'Salah', 0, '2021-09-14 13:52:04'),
(85, 1, 29, 14, 'B', 'Salah', 0, '2021-09-14 13:52:06'),
(86, 1, 30, 14, 'A', 'Salah', 0, '2021-09-14 13:52:08'),
(87, 1, 31, 14, 'B', 'Salah', 0, '2021-09-14 13:52:10'),
(88, 1, 32, 14, 'A', 'Salah', 0, '2021-09-14 13:52:11'),
(89, 1, 33, 14, 'B', 'Salah', 0, '2021-09-14 13:52:13'),
(90, 1, 34, 14, 'A', 'Salah', 0, '2021-09-14 13:52:14'),
(91, 1, 95, 14, 'A', 'Salah', 0, '2021-09-14 13:52:18'),
(92, 1, 96, 15, 'A', 'Salah', 0, '2021-09-14 13:59:01'),
(93, 1, 97, 15, 'B', 'Salah', 0, '2021-09-14 13:59:02'),
(94, 1, 98, 15, 'A', 'Salah', 0, '2021-09-14 13:59:03'),
(95, 1, 99, 15, 'B', 'Salah', 0, '2021-09-14 13:59:04'),
(96, 1, 100, 15, 'A', 'Salah', 0, '2021-09-14 13:59:06'),
(97, 1, 101, 15, 'B', 'Salah', 0, '2021-09-14 13:59:08'),
(98, 1, 102, 15, 'A', 'Salah', 0, '2021-09-14 13:59:09'),
(99, 1, 158, 15, 'B', 'Salah', 0, '2021-09-14 13:59:13'),
(100, 1, 159, 15, 'A', 'Salah', 0, '2021-09-14 13:59:15'),
(101, 1, 224, 5, 'C', 'Benar', 1, '2021-09-14 14:28:15'),
(102, 1, 225, 5, 'A', 'Benar', 1, '2021-09-14 14:28:19'),
(103, 1, 226, 5, 'D', 'Benar', 1, '2021-09-14 14:28:22'),
(104, 1, 227, 5, 'E', 'Benar', 1, '2021-09-14 14:28:25'),
(105, 1, 228, 5, 'C', 'Benar', 1, '2021-09-14 14:28:28'),
(106, 1, 229, 5, 'E', 'Benar', 1, '2021-09-14 14:28:31'),
(107, 1, 230, 5, 'B', 'Benar', 1, '2021-09-14 14:28:34'),
(108, 1, 231, 5, 'B', 'Benar', 1, '2021-09-14 14:28:37'),
(109, 1, 232, 5, 'C', 'Benar', 1, '2021-09-14 14:28:41'),
(110, 1, 233, 5, 'B', 'Benar', 1, '2021-09-14 14:28:44'),
(111, 1, 234, 5, 'B', 'Benar', 1, '2021-09-14 14:28:47'),
(112, 1, 235, 5, 'C', 'Benar', 1, '2021-09-14 14:28:52'),
(113, 1, 236, 5, 'D', 'Benar', 1, '2021-09-14 14:28:55'),
(114, 1, 237, 5, 'D', 'Benar', 1, '2021-09-14 14:28:58'),
(115, 1, 238, 5, 'D', 'Benar', 1, '2021-09-14 14:29:02'),
(116, 1, 239, 5, 'B', 'Benar', 1, '2021-09-14 14:29:03'),
(117, 1, 240, 5, 'C', 'Benar', 1, '2021-09-14 14:29:07'),
(118, 1, 241, 5, 'A', 'Benar', 1, '2021-09-14 14:29:11'),
(119, 1, 242, 5, 'E', 'Benar', 1, '2021-09-14 14:29:14'),
(120, 1, 243, 5, 'B', 'Benar', 1, '2021-09-14 14:29:17'),
(121, 1, 244, 6, 'C', 'Benar', 1, '2021-09-14 14:29:44'),
(122, 1, 245, 6, 'C', 'Benar', 1, '2021-09-14 14:29:47'),
(123, 1, 246, 6, 'D', 'Benar', 1, '2021-09-14 14:29:49'),
(124, 1, 247, 6, 'D', 'Benar', 1, '2021-09-14 14:29:51'),
(125, 1, 248, 6, 'A', 'Benar', 1, '2021-09-14 14:29:53'),
(126, 1, 249, 6, 'B', 'Benar', 1, '2021-09-14 14:29:57'),
(127, 1, 250, 6, 'B', 'Benar', 1, '2021-09-14 14:30:00'),
(128, 1, 251, 6, 'D', 'Benar', 1, '2021-09-14 14:30:02'),
(129, 1, 252, 6, 'C', 'Benar', 1, '2021-09-14 14:30:05'),
(130, 1, 253, 6, 'C', 'Benar', 1, '2021-09-14 14:30:08'),
(131, 1, 254, 6, 'E', 'Benar', 1, '2021-09-14 14:30:12'),
(132, 1, 255, 6, 'A', 'Benar', 1, '2021-09-14 14:30:13'),
(133, 1, 256, 6, 'D', 'Benar', 1, '2021-09-14 14:30:17'),
(134, 1, 257, 6, 'A', 'Benar', 1, '2021-09-14 14:30:19'),
(135, 1, 258, 6, 'C', 'Benar', 1, '2021-09-14 14:30:23'),
(136, 1, 259, 6, 'A', 'Benar', 1, '2021-09-14 14:30:25'),
(137, 1, 260, 6, 'B', 'Benar', 1, '2021-09-14 14:30:31'),
(138, 1, 261, 6, 'A', 'Benar', 1, '2021-09-14 14:30:35'),
(139, 1, 262, 6, 'D', 'Benar', 1, '2021-09-14 14:30:38'),
(140, 1, 263, 6, 'C', 'Benar', 1, '2021-09-14 14:30:41'),
(141, 1, 264, 7, 'B', 'Benar', 1, '2021-09-14 14:30:58'),
(142, 1, 265, 7, 'D', 'Benar', 1, '2021-09-14 14:31:00'),
(143, 1, 266, 7, 'A', 'Benar', 1, '2021-09-14 14:31:03'),
(144, 1, 267, 7, 'D', 'Benar', 1, '2021-09-14 14:31:06'),
(145, 1, 268, 7, 'A', 'Benar', 1, '2021-09-14 14:31:09'),
(146, 1, 269, 7, 'E', 'Benar', 1, '2021-09-14 14:31:12'),
(147, 1, 270, 7, 'E', 'Benar', 1, '2021-09-14 14:31:16'),
(148, 1, 271, 7, 'E', 'Benar', 1, '2021-09-14 14:31:20'),
(149, 1, 272, 7, 'D', 'Benar', 1, '2021-09-14 14:31:24'),
(150, 1, 273, 7, 'B', 'Benar', 1, '2021-09-14 14:31:27'),
(151, 1, 274, 7, 'D', 'Benar', 1, '2021-09-14 14:31:31'),
(152, 1, 275, 7, 'B', 'Benar', 1, '2021-09-14 14:31:35'),
(153, 1, 276, 7, 'C', 'Benar', 1, '2021-09-14 14:31:38'),
(154, 1, 277, 7, 'A', 'Benar', 1, '2021-09-14 14:31:41'),
(155, 1, 278, 7, 'E', 'Benar', 1, '2021-09-14 14:31:45'),
(156, 1, 279, 7, 'B', 'Benar', 1, '2021-09-14 14:31:54'),
(157, 1, 280, 7, 'A', 'Benar', 1, '2021-09-14 14:31:58'),
(158, 1, 281, 7, 'A', 'Benar', 1, '2021-09-14 14:32:03'),
(159, 1, 282, 7, 'D', 'Benar', 1, '2021-09-14 14:32:05'),
(160, 1, 283, 7, 'A', 'Benar', 1, '2021-09-14 14:32:08'),
(161, 1, 284, 8, 'rantai makanan', 'Benar', 2, '2021-09-14 14:33:49'),
(162, 1, 285, 8, 'wadah', 'Benar', 2, '2021-09-14 14:33:55'),
(163, 1, 286, 8, 'batas', 'Benar', 2, '2021-09-14 14:33:59'),
(164, 1, 287, 8, 'sifat', 'Benar', 2, '2021-09-14 14:34:03'),
(165, 1, 288, 8, 'pasar', 'Benar', 2, '2021-09-14 14:34:07'),
(166, 1, 289, 8, 'arah', 'Benar', 2, '2021-09-14 14:34:10'),
(167, 1, 290, 8, 'jarak', 'Benar', 2, '2021-09-14 14:34:14'),
(168, 1, 291, 8, 'kejahatan', 'Benar', 2, '2021-09-14 14:34:18'),
(169, 1, 292, 8, 'pelanggan', 'Benar', 2, '2021-09-14 14:34:26'),
(170, 1, 293, 8, 'alat pernapasan', 'Benar', 2, '2021-09-14 14:34:32'),
(171, 1, 294, 8, 'bunga', 'Benar', 2, '2021-09-14 14:34:35'),
(172, 1, 295, 8, 'indra', 'Benar', 2, '2021-09-14 14:34:39'),
(173, 1, 296, 8, 'kristal', 'Benar', 2, '2021-09-14 14:34:43'),
(174, 1, 297, 8, 'cuaca', 'Benar', 2, '2021-09-14 14:34:50'),
(175, 1, 298, 8, 'informasi', 'Benar', 2, '2021-09-14 14:34:54'),
(176, 1, 299, 8, 'lensa', 'Benar', 2, '2021-09-14 14:35:00'),
(177, 1, 300, 8, 'pencernaan', 'Benar', 2, '2021-09-14 14:35:04'),
(178, 1, 301, 8, 'ukuran', 'Benar', 2, '2021-09-14 14:35:07'),
(179, 1, 302, 8, 'bibit', 'Benar', 2, '2021-09-14 14:35:11'),
(180, 1, 303, 8, 'lambang', 'Benar', 2, '2021-09-14 14:35:16'),
(213, 1, 317, 9, '26', 'Benar', 1, '2021-09-14 14:49:54'),
(212, 1, 316, 9, '025', 'Benar', 1, '2021-09-14 14:49:49'),
(211, 1, 315, 9, '028', 'Benar', 1, '2021-09-14 14:49:44'),
(210, 1, 314, 9, '35', 'Benar', 1, '2021-09-14 14:49:39'),
(209, 1, 313, 9, '3', 'Benar', 1, '2021-09-14 14:49:32'),
(208, 1, 312, 9, '5', 'Benar', 1, '2021-09-14 14:49:15'),
(207, 1, 311, 9, '04', 'Benar', 1, '2021-09-14 14:49:03'),
(206, 1, 310, 9, '17', 'Benar', 1, '2021-09-14 14:48:59'),
(205, 1, 309, 9, '012', 'Benar', 1, '2021-09-14 14:48:54'),
(204, 1, 308, 9, '09', 'Benar', 1, '2021-09-14 14:48:43'),
(203, 1, 307, 9, '57', 'Benar', 1, '2021-09-14 14:48:32'),
(202, 1, 306, 9, '6', 'Benar', 1, '2021-09-14 14:48:12'),
(201, 1, 305, 9, '19', 'Benar', 1, '2021-09-14 14:48:08'),
(200, 1, 304, 9, '67', 'Benar', 1, '2021-09-14 14:47:52'),
(214, 1, 318, 9, '03', 'Benar', 1, '2021-09-14 14:49:59'),
(215, 1, 319, 9, '07', 'Benar', 1, '2021-09-14 14:50:03'),
(216, 1, 320, 9, '45', 'Benar', 1, '2021-09-14 14:50:09'),
(217, 1, 321, 9, '45', 'Benar', 1, '2021-09-14 14:50:13'),
(218, 1, 322, 9, '48', 'Benar', 1, '2021-09-14 14:50:17'),
(219, 1, 323, 10, '8', 'Benar', 1, '2021-09-14 14:50:56'),
(220, 1, 324, 10, '14', 'Benar', 1, '2021-09-14 14:50:59'),
(221, 1, 325, 10, '45', 'Benar', 1, '2021-09-14 14:51:05'),
(222, 1, 326, 10, '63', 'Benar', 1, '2021-09-14 14:51:10'),
(223, 1, 327, 10, '12', 'Benar', 1, '2021-09-14 14:51:13'),
(224, 1, 328, 10, '80', 'Benar', 1, '2021-09-14 14:51:17'),
(225, 1, 330, 10, '14', 'Benar', 1, '2021-09-14 14:51:22'),
(226, 1, 331, 10, '11', 'Benar', 1, '2021-09-14 14:51:24'),
(227, 1, 332, 10, '63', 'Benar', 1, '2021-09-14 14:51:27'),
(228, 1, 333, 10, '10', 'Benar', 1, '2021-09-14 14:51:32'),
(229, 1, 334, 10, '27', 'Benar', 1, '2021-09-14 14:51:36'),
(230, 1, 335, 10, '25', 'Benar', 1, '2021-09-14 14:51:37'),
(231, 1, 336, 10, '27', 'Benar', 1, '2021-09-14 14:51:41'),
(232, 1, 337, 10, '15', 'Benar', 1, '2021-09-14 14:51:46'),
(233, 1, 338, 10, '42', 'Benar', 1, '2021-09-14 14:51:47'),
(234, 1, 339, 10, '10', 'Benar', 1, '2021-09-14 14:51:52'),
(235, 1, 340, 10, '42', 'Benar', 1, '2021-09-14 14:51:55'),
(236, 1, 341, 10, '7', 'Benar', 1, '2021-09-14 14:52:00'),
(237, 1, 342, 10, '5', 'Benar', 1, '2021-09-14 14:52:02'),
(238, 1, 343, 10, '14', 'Benar', 1, '2021-09-14 14:52:04'),
(239, 1, 344, 11, 'A', 'Benar', 1, '2021-09-14 14:53:28'),
(240, 1, 345, 11, 'C', 'Benar', 1, '2021-09-14 14:53:32'),
(241, 1, 346, 11, 'B', 'Benar', 1, '2021-09-14 14:53:37'),
(242, 1, 347, 11, 'A', 'Benar', 1, '2021-09-14 14:53:48'),
(243, 1, 348, 11, 'D', 'Benar', 1, '2021-09-14 14:53:52'),
(244, 1, 349, 11, 'D', 'Salah', 0, '2021-09-14 14:54:08'),
(245, 1, 350, 11, 'C', 'Benar', 1, '2021-09-14 14:54:33'),
(246, 1, 351, 11, 'E', 'Benar', 1, '2021-09-14 14:54:41'),
(247, 1, 352, 11, 'E', 'Benar', 1, '2021-09-14 14:54:48'),
(248, 1, 353, 11, 'D', 'Benar', 1, '2021-09-14 14:55:30'),
(249, 1, 354, 11, 'D', 'Salah', 0, '2021-09-14 14:55:40'),
(250, 1, 355, 11, 'A', 'Benar', 1, '2021-09-14 14:55:48'),
(251, 1, 356, 11, 'D', 'Benar', 1, '2021-09-14 14:56:00'),
(252, 1, 357, 11, 'A', 'Benar', 1, '2021-09-14 14:56:02'),
(253, 1, 358, 11, 'B', 'Benar', 1, '2021-09-14 14:56:14'),
(254, 1, 359, 11, 'E', 'Benar', 1, '2021-09-14 14:56:17'),
(255, 1, 360, 11, 'B', 'Benar', 1, '2021-09-14 14:56:21'),
(256, 1, 361, 11, 'D', 'Benar', 1, '2021-09-14 14:56:23'),
(257, 1, 362, 11, 'E', 'Benar', 1, '2021-09-14 14:56:27'),
(258, 1, 363, 11, 'A', 'Benar', 1, '2021-09-14 14:56:38'),
(259, 1, 364, 12, 'A', 'Benar', 1, '2021-09-14 14:57:04'),
(260, 1, 365, 12, 'C', 'Benar', 1, '2021-09-14 14:57:05'),
(261, 1, 366, 12, 'D', 'Benar', 1, '2021-09-14 14:57:08'),
(262, 1, 367, 12, 'E', 'Benar', 1, '2021-09-14 14:57:09'),
(263, 1, 368, 12, 'A', 'Benar', 1, '2021-09-14 14:57:13'),
(264, 1, 369, 12, 'C', 'Benar', 1, '2021-09-14 14:57:16'),
(265, 1, 370, 12, 'D', 'Benar', 1, '2021-09-14 14:57:18'),
(266, 1, 371, 12, 'C', 'Benar', 1, '2021-09-14 14:57:19'),
(267, 1, 372, 12, 'E', 'Benar', 1, '2021-09-14 14:57:22'),
(268, 1, 373, 12, 'A', 'Benar', 1, '2021-09-14 14:57:23'),
(269, 1, 374, 12, 'B', 'Benar', 1, '2021-09-14 14:57:26'),
(270, 1, 375, 12, 'A', 'Benar', 1, '2021-09-14 14:57:27'),
(271, 1, 376, 12, 'E', 'Benar', 1, '2021-09-14 14:57:30'),
(272, 1, 377, 12, 'B', 'Benar', 1, '2021-09-14 14:57:31'),
(273, 1, 378, 12, 'B', 'Benar', 1, '2021-09-14 14:57:33'),
(274, 1, 379, 12, 'D', 'Benar', 1, '2021-09-14 14:57:37'),
(275, 1, 380, 12, 'A', 'Benar', 1, '2021-09-14 14:57:38'),
(276, 1, 381, 12, 'E', 'Benar', 1, '2021-09-14 14:57:41'),
(277, 1, 382, 12, 'B', 'Benar', 1, '2021-09-14 14:57:42'),
(278, 1, 383, 12, 'C', 'Benar', 1, '2021-09-14 14:57:46'),
(279, 1, 384, 13, 'E', 'Benar', 1, '2021-09-14 15:01:19'),
(280, 1, 385, 13, 'D', 'Benar', 1, '2021-09-14 15:01:25'),
(281, 1, 386, 13, 'B', 'Benar', 1, '2021-09-14 15:01:31'),
(282, 1, 387, 13, 'E', 'Benar', 1, '2021-09-14 15:01:38'),
(283, 1, 388, 13, 'B', 'Benar', 1, '2021-09-14 15:01:44'),
(284, 1, 389, 13, 'E', 'Benar', 1, '2021-09-14 15:01:51'),
(285, 1, 390, 13, 'D', 'Benar', 1, '2021-09-14 15:01:56'),
(286, 1, 391, 13, 'C', 'Benar', 1, '2021-09-14 15:02:10'),
(287, 1, 392, 13, 'A', 'Benar', 1, '2021-09-14 15:02:14'),
(288, 1, 393, 13, 'A', 'Benar', 1, '2021-09-14 15:02:18'),
(289, 1, 394, 13, 'B', 'Benar', 1, '2021-09-14 15:02:22'),
(290, 1, 395, 13, 'E', 'Benar', 1, '2021-09-14 15:02:28'),
(291, 1, 396, 13, 'A', 'Benar', 1, '2021-09-14 15:02:37'),
(292, 1, 397, 13, 'D', 'Benar', 1, '2021-09-14 15:02:41'),
(293, 1, 398, 13, 'C', 'Benar', 1, '2021-09-14 15:02:46'),
(294, 1, 399, 13, 'B', 'Benar', 1, '2021-09-14 15:02:53'),
(295, 1, 400, 13, 'A', 'Benar', 1, '2021-09-14 15:02:59'),
(296, 1, 401, 13, 'A', 'Benar', 1, '2021-09-14 15:03:07'),
(297, 1, 402, 13, 'C', 'Benar', 1, '2021-09-14 15:03:10'),
(298, 1, 403, 13, 'B', 'Benar', 1, '2021-09-14 15:03:16'),
(299, 2, 174, 1, 'B', 'Benar', 1, '2021-09-15 08:48:22'),
(300, 2, 175, 1, 'B', 'Salah', 0, '2021-09-15 08:48:26'),
(301, 2, 186, 1, 'D', 'Salah', 0, '2021-09-15 08:48:37'),
(302, 2, 187, 2, 'A|B', 'Salah', 0, '2021-09-15 08:49:13'),
(303, 2, 200, 2, 'B|C', 'Salah', 0, '2021-09-15 08:49:24'),
(304, 2, 201, 3, 'A', 'Salah', 0, '2021-09-15 08:50:02'),
(305, 2, 213, 3, 'C', 'Salah', 0, '2021-09-15 08:50:08'),
(306, 2, 214, 4, 'A', 'Salah', 0, '2021-09-15 08:50:21'),
(307, 2, 223, 4, 'C', 'Salah', 0, '2021-09-15 08:50:27'),
(308, 3, 174, 1, 'D', 'Salah', 0, '2021-09-23 13:20:07'),
(309, 3, 175, 1, 'D', 'Salah', 0, '2021-09-23 13:20:12'),
(310, 3, 0, 0, '', 'Benar', 1, '2021-09-23 13:20:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_subtes` int(11) NOT NULL,
  `status` enum('Selesai','Belum Selesai') NOT NULL DEFAULT 'Belum Selesai',
  `tipe` enum('Soal','Contoh') NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_log`
--

INSERT INTO `tbl_log` (`id_log`, `id_user`, `id_subtes`, `status`, `tipe`, `tanggal`) VALUES
(1, 2, 1, 'Selesai', 'Contoh', '2021-09-15 08:47:59'),
(2, 2, 1, 'Selesai', 'Soal', '2021-09-15 08:48:07'),
(3, 2, 2, 'Selesai', 'Contoh', '2021-09-15 08:49:02'),
(4, 2, 2, 'Selesai', 'Soal', '2021-09-15 08:49:09'),
(5, 2, 3, 'Selesai', 'Contoh', '2021-09-15 08:49:35'),
(6, 2, 3, 'Selesai', 'Soal', '2021-09-15 08:49:58'),
(7, 2, 4, 'Selesai', 'Contoh', '2021-09-15 08:50:12'),
(8, 2, 4, 'Selesai', 'Soal', '2021-09-15 08:50:18'),
(9, 2, 5, 'Selesai', 'Contoh', '2021-09-15 09:01:44'),
(10, 2, 5, 'Selesai', 'Soal', '2021-09-15 09:01:48'),
(11, 3, 1, 'Selesai', 'Contoh', '2021-09-23 13:17:43'),
(12, 3, 1, 'Selesai', 'Soal', '2021-09-23 13:17:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paketgambar`
--

CREATE TABLE `tbl_paketgambar` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `gambar` varchar(54) NOT NULL,
  `jumlah_gambar` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_paketgambar`
--

INSERT INTO `tbl_paketgambar` (`id_paket`, `nama_paket`, `gambar`, `jumlah_gambar`, `added_at`) VALUES
(1, 'Contoh FA', 'Contoh FA-5.PNG', 5, '2021-04-29 17:31:54'),
(2, 'Soal FA 1', 'Soal FA 1-5.png', 5, '2021-04-29 17:40:36'),
(3, 'Soal FA 11', 'Soal FA 11-5.png', 5, '2021-09-13 16:47:22'),
(4, 'Soal WU', 'Soal WU-5.png', 5, '2021-09-13 17:23:32'),
(5, 'Contoh WU', 'Contoh WU-5.png', 5, '2021-09-13 17:44:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id_soal` int(11) NOT NULL,
  `jenis_tes` varchar(12) NOT NULL,
  `subtes` varchar(12) NOT NULL,
  `soal` text NOT NULL,
  `gambar` varchar(23) NOT NULL,
  `jenis_jawaban` enum('Isian','Pilihan Ganda','Gambar','Aritmatika','Hafalan') NOT NULL,
  `jumlah_jawaban` int(11) NOT NULL,
  `jumlah_benar` int(11) NOT NULL,
  `pilihan` varchar(150) NOT NULL,
  `jawaban_benar` varchar(255) NOT NULL,
  `paket_gambar` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `jenis_tes`, `subtes`, `soal`, `gambar`, `jenis_jawaban`, `jumlah_jawaban`, `jumlah_benar`, `pilihan`, `jawaban_benar`, `paket_gambar`, `added_at`) VALUES
(174, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-173.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 14:39:57'),
(175, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-175.png', 'Pilihan Ganda', 6, 1, '', 'C', '', '2021-09-11 14:45:44'),
(270, 'IST', 'AN', '<p>STATESKOP : DOKTER = OSILOSKOP : ...</p>', '', 'Pilihan Ganda', 0, 0, 'APOTEKER#ARKEOLOG#BAKTERIOLOG#MONTIR#NEUROLOG', 'E', '', '2021-09-12 19:59:21'),
(269, 'IST', 'AN', '<p>BUNGA : TAMAN</p>', '', 'Pilihan Ganda', 0, 0, 'POHON : RANTING#MURID : PR#DOKTER : PASIEN#SEKRETARIS : KOMPUTER#DOSEN : UNIVERSITAS', 'E', '', '2021-09-12 19:58:29'),
(268, 'IST', 'AN', '<p>TELUK : LAUT</p>', '', 'Pilihan Ganda', 0, 0, 'SEMENANJUNG : DARATAN#KARANG : TANJUNG#SEPEDA : PEDAL#KAPAL : PELABUHAN#SELAT : PULAU', 'A', '', '2021-09-12 19:57:43'),
(267, 'IST', 'AN', '<p>GAMBAR : PELUKIS</p>', '', 'Pilihan Ganda', 0, 0, 'LAGU : PENYANYI#RESTORAN : KOKI#PENA : KARTUNIS#LAGU : KOMPONIS#PUISI : PENYAIR', 'D', '', '2021-09-12 19:57:09'),
(266, 'IST', 'AN', '<p>AIR : MENGUAP = ...</p>', '', 'Pilihan Ganda', 0, 0, 'Es : Mencair#Panas : Memuai#Jatuh : Pecah#Uap : Hujan#Laut : Mendung', 'A', '', '2021-09-12 19:56:35'),
(265, 'IST', 'AN', '<p>BUSUR : GARIS = ... : ...</p>', '', 'Pilihan Ganda', 0, 0, 'Terbenam : Terbit#Tangkap : Lempar#Tombak : Busur#Relatif : Absolut#Busur : Panah', 'D', '', '2021-09-12 19:55:36'),
(263, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'batu#baja#bulu#karet#kayu', 'C', '', '2021-09-12 19:51:23'),
(264, 'IST', 'AN', '<p>MATAHARI : BUMI = Bumi : ...</p>', '', 'Pilihan Ganda', 0, 0, 'Gravitasi#Bulan#Planet#Matahari#Bintang', 'B', '', '2021-09-12 19:54:45'),
(262, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'kunci#palang pintu#gerendel#gunting#obeng', 'D', '', '2021-09-12 19:50:57'),
(261, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'panjang#lonjong#runcing#bulat#bersudut', 'A', '', '2021-09-12 19:50:37'),
(259, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'jembatan#batas#perkawinan#pagar#masyarakat', 'A', '', '2021-09-12 19:49:55'),
(260, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'mengetam#mamahat#mengasah#melicinkan#menggosok', 'B', '', '2021-09-12 19:50:17'),
(258, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'gambar#lukisan#potret#patung#ukiran', 'C', '', '2021-09-12 19:49:37'),
(257, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'bermotor#berjalan#berlayar#bersepeda#berkuda', 'A', '', '2021-09-12 19:44:51'),
(255, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'jam#kompas#penunjuk jalan#bintang pari#arah', 'A', '', '2021-09-12 19:44:10'),
(256, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'kebijaksanaan#pendidikan#perencanaan#penempatan#pengarahan', 'D', '', '2021-09-12 19:44:33'),
(254, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'bergelombang#kasar#berduri#licin#lurus', 'E', '', '2021-09-12 19:43:49'),
(252, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'mengingat#menyatukan#melepaskan#mengaitkan#melekatkan', 'C', '', '2021-09-12 19:43:10'),
(253, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'arah#timur#perjalanan#tujuan#selatan', 'C', '', '2021-09-12 19:43:30'),
(249, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'lingkaran#panah#elips#busur#lengkungan', 'B', '', '2021-09-12 19:41:22'),
(250, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'mengetuk#memaki#menjahit#menggergaji#memukul', 'B', '', '2021-09-12 19:42:28'),
(251, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'lebar#keliling#luas#isi#panjang', 'D', '', '2021-09-12 19:42:48'),
(248, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'biola#seruling#clarinet#terompet#saxophone', 'A', '', '2021-09-12 19:41:07'),
(247, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'otobis#pesawat terbang#sepeda motor#sepeda#kapal api', 'D', '', '2021-09-12 19:40:47'),
(246, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'putih#pucat#buram#kasar#berkilauan', 'D', '', '2021-09-12 19:40:23'),
(26, 'MBTI', 'MBTI', 'soal1', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(27, 'MBTI', 'MBTI', 'soal2', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(28, 'MBTI', 'MBTI', 'soal3', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(29, 'MBTI', 'MBTI', 'soal4', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(30, 'MBTI', 'MBTI', 'soal5', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(31, 'MBTI', 'MBTI', 'soal6', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(32, 'MBTI', 'MBTI', 'soal7', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(33, 'MBTI', 'MBTI', 'soal8', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(34, 'MBTI', 'MBTI', 'soal9', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(35, 'MBTI', 'MBTI', 'soal10', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(36, 'MBTI', 'MBTI', 'soal11', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(37, 'MBTI', 'MBTI', 'soal12', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(38, 'MBTI', 'MBTI', 'soal13', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(39, 'MBTI', 'MBTI', 'soal14', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(40, 'MBTI', 'MBTI', 'soal15', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(41, 'MBTI', 'MBTI', 'soal16', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(42, 'MBTI', 'MBTI', 'soal17', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(43, 'MBTI', 'MBTI', 'soal18', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(44, 'MBTI', 'MBTI', 'soal19', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(45, 'MBTI', 'MBTI', 'soal20', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(46, 'MBTI', 'MBTI', 'soal21', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(47, 'MBTI', 'MBTI', 'soal22', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(48, 'MBTI', 'MBTI', 'soal23', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(49, 'MBTI', 'MBTI', 'soal24', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(50, 'MBTI', 'MBTI', 'soal25', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(51, 'MBTI', 'MBTI', 'soal26', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(52, 'MBTI', 'MBTI', 'soal27', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(53, 'MBTI', 'MBTI', 'soal28', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(54, 'MBTI', 'MBTI', 'soal29', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(55, 'MBTI', 'MBTI', 'soal30', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(56, 'MBTI', 'MBTI', 'soal31', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(57, 'MBTI', 'MBTI', 'soal32', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(58, 'MBTI', 'MBTI', 'soal33', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(59, 'MBTI', 'MBTI', 'soal34', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(60, 'MBTI', 'MBTI', 'soal35', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(61, 'MBTI', 'MBTI', 'soal36', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(62, 'MBTI', 'MBTI', 'soal37', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(63, 'MBTI', 'MBTI', 'soal38', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(64, 'MBTI', 'MBTI', 'soal39', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(65, 'MBTI', 'MBTI', 'soal40', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(66, 'MBTI', 'MBTI', 'soal41', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(67, 'MBTI', 'MBTI', 'soal42', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(68, 'MBTI', 'MBTI', 'soal43', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(69, 'MBTI', 'MBTI', 'soal44', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(70, 'MBTI', 'MBTI', 'soal45', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(71, 'MBTI', 'MBTI', 'soal46', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(72, 'MBTI', 'MBTI', 'soal47', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(73, 'MBTI', 'MBTI', 'soal48', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(74, 'MBTI', 'MBTI', 'soal49', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(75, 'MBTI', 'MBTI', 'soal50', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(76, 'MBTI', 'MBTI', 'soal51', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(77, 'MBTI', 'MBTI', 'soal52', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(78, 'MBTI', 'MBTI', 'soal53', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(79, 'MBTI', 'MBTI', 'soal54', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(80, 'MBTI', 'MBTI', 'soal55', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(81, 'MBTI', 'MBTI', 'soal56', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(82, 'MBTI', 'MBTI', 'soal57', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(83, 'MBTI', 'MBTI', 'soal58', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(84, 'MBTI', 'MBTI', 'soal59', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(85, 'MBTI', 'MBTI', 'soal60', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(86, 'MBTI', 'MBTI', 'soal61', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(87, 'MBTI', 'MBTI', 'soal62', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(88, 'MBTI', 'MBTI', 'soal63', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(89, 'MBTI', 'MBTI', 'soal64', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(90, 'MBTI', 'MBTI', 'soal65', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(91, 'MBTI', 'MBTI', 'soal66', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(92, 'MBTI', 'MBTI', 'soal67', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(93, 'MBTI', 'MBTI', 'soal68', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(94, 'MBTI', 'MBTI', 'soal69', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(95, 'MBTI', 'MBTI', 'soal70', '', 'Pilihan Ganda', 0, 0, 'A#B', '', '', '2021-04-22 14:53:56'),
(96, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A1#B1', '', '', '2021-04-23 14:27:06'),
(97, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A2#B2', '', '', '2021-04-23 14:27:06'),
(98, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A3#B3', '', '', '2021-04-23 14:27:06'),
(99, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A4#B4', '', '', '2021-04-23 14:27:06'),
(100, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A5#B5', '', '', '2021-04-23 14:27:06'),
(101, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A6#B6', '', '', '2021-04-23 14:27:06'),
(102, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A7#B7', '', '', '2021-04-23 14:27:06'),
(103, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A8#B8', '', '', '2021-04-23 14:27:06'),
(104, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A9#B9', '', '', '2021-04-23 14:27:06'),
(105, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A10#B10', '', '', '2021-04-23 14:27:06'),
(106, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A11#B11', '', '', '2021-04-23 14:27:06'),
(107, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A12#B12', '', '', '2021-04-23 14:27:06'),
(108, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A13#B13', '', '', '2021-04-23 14:27:06'),
(109, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A14#B14', '', '', '2021-04-23 14:27:06'),
(110, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A15#B15', '', '', '2021-04-23 14:27:06'),
(111, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A16#B16', '', '', '2021-04-23 14:27:06'),
(112, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A17#B17', '', '', '2021-04-23 14:27:06'),
(113, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A18#B18', '', '', '2021-04-23 14:27:06'),
(114, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A19#B19', '', '', '2021-04-23 14:27:06'),
(115, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A20#B20', '', '', '2021-04-23 14:27:06'),
(116, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A21#B21', '', '', '2021-04-23 14:27:06'),
(117, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A22#B22', '', '', '2021-04-23 14:27:06'),
(118, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A23#B23', '', '', '2021-04-23 14:27:06'),
(119, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A24#B24', '', '', '2021-04-23 14:27:06'),
(120, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A25#B25', '', '', '2021-04-23 14:27:06'),
(121, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A26#B26', '', '', '2021-04-23 14:27:06'),
(122, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A27#B27', '', '', '2021-04-23 14:27:06'),
(123, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A28#B28', '', '', '2021-04-23 14:27:06'),
(124, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A29#B29', '', '', '2021-04-23 14:27:06'),
(125, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A30#B30', '', '', '2021-04-23 14:27:06'),
(126, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A31#B31', '', '', '2021-04-23 14:27:06'),
(127, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A32#B32', '', '', '2021-04-23 14:27:06'),
(128, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A33#B33', '', '', '2021-04-23 14:27:06'),
(129, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A34#B34', '', '', '2021-04-23 14:27:06'),
(130, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A35#B35', '', '', '2021-04-23 14:27:06'),
(131, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A36#B36', '', '', '2021-04-23 14:27:06'),
(132, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A37#B37', '', '', '2021-04-23 14:27:06'),
(133, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A38#B38', '', '', '2021-04-23 14:27:06'),
(134, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A39#B39', '', '', '2021-04-23 14:27:06'),
(135, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A40#B40', '', '', '2021-04-23 14:27:06'),
(136, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A41#B41', '', '', '2021-04-23 14:27:06'),
(137, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A42#B42', '', '', '2021-04-23 14:27:06'),
(138, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A43#B43', '', '', '2021-04-23 14:27:06'),
(139, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A44#B44', '', '', '2021-04-23 14:27:06'),
(140, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A45#B45', '', '', '2021-04-23 14:27:06'),
(141, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A46#B46', '', '', '2021-04-23 14:27:06'),
(142, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A47#B47', '', '', '2021-04-23 14:27:06'),
(143, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A48#B48', '', '', '2021-04-23 14:27:06'),
(144, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A49#B49', '', '', '2021-04-23 14:27:06'),
(145, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A50#B50', '', '', '2021-04-23 14:27:06'),
(146, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A51#B51', '', '', '2021-04-23 14:27:06'),
(147, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A52#B52', '', '', '2021-04-23 14:27:06'),
(148, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A53#B53', '', '', '2021-04-23 14:27:06'),
(149, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A54#B54', '', '', '2021-04-23 14:27:06'),
(150, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A55#B55', '', '', '2021-04-23 14:27:06'),
(151, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A56#B56', '', '', '2021-04-23 14:27:06'),
(152, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A57#B57', '', '', '2021-04-23 14:27:06'),
(153, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A58#B58', '', '', '2021-04-23 14:27:06'),
(154, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A59#B59', '', '', '2021-04-23 14:27:06'),
(155, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A60#B60', '', '', '2021-04-23 14:27:06'),
(156, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A61#B61', '', '', '2021-04-23 14:27:06'),
(157, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A62#B62', '', '', '2021-04-23 14:27:06'),
(158, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A63#B63', '', '', '2021-04-23 14:27:06'),
(159, 'MSDT', 'MSDT', '', '', 'Pilihan Ganda', 0, 0, 'A64#B64', '', '', '2021-04-23 14:27:06'),
(176, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-176.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 14:50:58'),
(244, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'jarak#perpisahan#tugas#batas#perceraian', 'C', '', '2021-09-12 19:39:43'),
(245, 'IST', 'WA', '', '', 'Pilihan Ganda', 0, 0, 'saringan#kelambu#payung#tapisan#jala', 'C', '', '2021-09-12 19:40:07'),
(227, 'IST', 'SE', '<p>Lawannya “tidak pernah” adalah …………………<br></p>', '', 'Pilihan Ganda', 0, 0, 'sering#kadang#jarang#kerap kali#selalu', 'E', '', '2021-09-12 19:30:14'),
(228, 'IST', 'SE', '<p>Jarak antara Jakarta – Surabaya ialah kira-kira ……………<br></p>', '', 'Pilihan Ganda', 0, 0, '650#1000#800#6000#950', 'C', '', '2021-09-12 19:30:38'),
(229, 'IST', 'SE', '<p>Untuk dapat membuat nada yang rendah dan mendalam, kita memerlukan banyak……………<br></p>', '', 'Pilihan Ganda', 0, 0, 'kekuatan#peranan#ayunan#berat#suara', 'E', '', '2021-09-12 19:31:01'),
(230, 'IST', 'SE', '<p>Ayah …………………….. lebih pengalaman daripada anaknya<br></p>', '', 'Pilihan Ganda', 0, 0, 'selalu#biasanya#jauh#jarang#pada dasarnya', 'B', '', '2021-09-12 19:31:28'),
(231, 'IST', 'SE', '<p>Diantara kota-kota berikut, maka kota ……………….. letaknya paling selatan<br></p>', '', 'Pilihan Ganda', 0, 0, 'Jakarta#Bandung#Cirebon#Semarang#Surabaya', 'B', '', '2021-09-12 19:31:52'),
(232, 'IST', 'SE', '<p>Jika kita mengetahui jumlah persentase nomor-nomor lotere yang tidak menang, maka kita dapat&nbsp;<span style=\"font-size: 1rem;\">menghitung……………………</span></p>', '', 'Pilihan Ganda', 0, 0, 'jumlah nomor yang menang#pajak lotere#kemungkinan menang#jumlah pengikut#tinggi keuntungan', 'C', '', '2021-09-12 19:32:42'),
(233, 'IST', 'SE', '<p>Seorang anak yang baru berumur 10 tahun tingginya rata-rata …………<br></p>', '', 'Pilihan Ganda', 0, 0, '150#130#110#105#115', 'B', '', '2021-09-12 19:33:08'),
(234, 'IST', 'SE', '<p>Pengaruh seseorang terhadap orang lain seharusnya tergantung pada………………<br></p>', '', 'Pilihan Ganda', 0, 0, 'kekuasaan#bujukan#kekayaan#keberanian#kewibawaan', 'B', '', '2021-09-12 19:33:36'),
(235, 'IST', 'SE', '<p>Lawannya “hemat” adalah …………<br></p>', '', 'Pilihan Ganda', 0, 0, 'murah#kikir#boros#berani#kaya', 'C', '', '2021-09-12 19:33:57'),
(236, 'IST', 'SE', '<p>………………..tidak termasuk cuaca<br></p>', '', 'Pilihan Ganda', 0, 0, 'angin puyuh#halilintar#salju#gempa bumi#kabut', 'D', '', '2021-09-12 19:34:23'),
(237, 'IST', 'SE', '<p>Lawannya “setia” adalah ……………<br></p>', '', 'Pilihan Ganda', 0, 0, 'cinta#benci#persahabatan#khianat#permusuhan', 'D', '', '2021-09-12 19:34:47'),
(238, 'IST', 'SE', '<p>Seekor kuda selalu mempunyai ………<br></p>', '', 'Pilihan Ganda', 0, 0, 'kandang#ladam#pelana#kuku#surai', 'D', '', '2021-09-12 19:35:09'),
(239, 'IST', 'SE', '<p>Seorang paman …………………. lebih tua dari kemenakannya<br></p>', '', 'Pilihan Ganda', 0, 0, 'jarang#biasanya#selalu#tak pernah#kadang-kadang', 'B', '', '2021-09-12 19:35:33'),
(240, 'IST', 'SE', '<p>Pada jumlah yang sama, nilai kalori tertinggi terdapat pada ………<br></p>', '', 'Pilihan Ganda', 0, 0, 'ikan#daging#lemak#tahu#sayuran', 'C', '', '2021-09-12 19:35:55'),
(241, 'IST', 'SE', '<p>Pada suatu pertandingan selalu terdapat …………<br></p>', '', 'Pilihan Ganda', 0, 0, 'lawan#wasit#penonton#sorak#kemenangan', 'A', '', '2021-09-12 19:36:21'),
(242, 'IST', 'SE', '<p>Suatu pernyataan yang belum dipastikan dikatakan sebagai pernyataan yang ………<br></p>', '', 'Pilihan Ganda', 0, 0, 'paradoks#tergesa-gesa#mempunyai arti lengkap#menyesatkan#hipotesis', 'E', '', '2021-09-12 19:36:55'),
(243, 'IST', 'SE', '<p>Pada sepatu selalu terdapat …………<br></p>', '', 'Pilihan Ganda', 0, 0, 'kulit#sol#tali sepatu#gesper#lidah', 'B', '', '2021-09-12 19:37:17'),
(226, 'IST', 'SE', '<p>Seseorang yang bersikap menyangsikan setiap kemajuan adalah seorang yang …………………<br></p>', '', 'Pilihan Ganda', 0, 0, 'demokratis#radikal#liberal#konservativ#anarkis', 'D', '', '2021-09-12 19:29:48'),
(224, 'IST', 'SE', '<p>Suatu …………….. tidak termasuk persoalan pencegahan kecelakaan<br></p>', '', 'Pilihan Ganda', 0, 0, 'lampu lalulintas#kacamata pelindung#kotak PPPK#tanda peringatan#palang kereta api', 'C', '', '2021-09-12 19:28:52'),
(225, 'IST', 'SE', '<p>Mata uang dari Rp.50,- garis tengahnya adalah ……………………….. mm</p><div><br></div>', '', 'Pilihan Ganda', 0, 0, '17#29#25#24#15', 'A', '', '2021-09-12 19:29:19'),
(177, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-177.png', 'Pilihan Ganda', 6, 1, '', 'D', '', '2021-09-11 14:56:52'),
(178, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-178.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 15:01:50'),
(179, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-179.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 15:06:13'),
(180, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-180.png', 'Pilihan Ganda', 6, 1, '', 'D', '', '2021-09-11 15:10:56'),
(181, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-181.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 15:15:55'),
(182, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-182.png', 'Pilihan Ganda', 6, 1, '', 'F', '', '2021-09-11 15:20:07'),
(183, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-183.png', 'Pilihan Ganda', 6, 1, '', 'C', '', '2021-09-11 15:25:58'),
(184, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-184.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 15:30:15'),
(185, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-185.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 15:34:34'),
(186, 'CFIT', 'Subtest 1', '', 'CFIT-Subtest 1-186.png', 'Pilihan Ganda', 6, 1, '', 'F', '', '2021-09-11 15:43:13'),
(187, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-187.png', 'Pilihan Ganda', 5, 2, '', 'B|E', '', '2021-09-11 15:53:48'),
(188, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-188.png', 'Pilihan Ganda', 5, 2, '', 'A|E', '', '2021-09-11 16:05:38'),
(189, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-189.png', 'Pilihan Ganda', 5, 2, '', 'A|D', '', '2021-09-11 16:06:07'),
(190, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-190.png', 'Pilihan Ganda', 5, 2, '', 'C|E', '', '2021-09-11 16:09:50'),
(191, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-191.png', 'Pilihan Ganda', 5, 2, '', 'B|E', '', '2021-09-11 16:13:26'),
(192, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-192.png', 'Pilihan Ganda', 5, 2, '', 'A|D', '', '2021-09-11 16:16:47'),
(193, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-193.png', 'Pilihan Ganda', 5, 2, '', 'B|E', '', '2021-09-11 16:20:51'),
(194, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-194.png', 'Pilihan Ganda', 5, 2, '', 'B|E', '', '2021-09-11 16:24:45'),
(195, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-195.png', 'Pilihan Ganda', 5, 2, '', 'A|D', '', '2021-09-11 16:28:40'),
(196, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-196.png', 'Pilihan Ganda', 5, 2, '', 'B|D', '', '2021-09-11 16:32:02'),
(197, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-197.png', 'Pilihan Ganda', 5, 2, '', 'A|E', '', '2021-09-11 16:35:00'),
(198, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-198.png', 'Pilihan Ganda', 5, 2, '', 'C|D', '', '2021-09-11 16:38:27'),
(199, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-199.png', 'Pilihan Ganda', 5, 2, '', 'B|C', '', '2021-09-11 16:42:28'),
(200, 'CFIT', 'Subtest 2', '', 'CFIT-Subtest 2-200.png', 'Pilihan Ganda', 5, 2, '', 'A|B', '', '2021-09-11 16:45:11'),
(201, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-201.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:46:54'),
(202, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-202.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:47:44'),
(203, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-203.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:48:29'),
(204, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-204.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 16:49:08'),
(205, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-205.png', 'Pilihan Ganda', 6, 1, '', 'C', '', '2021-09-11 16:49:54'),
(206, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-206.png', 'Pilihan Ganda', 6, 1, '', 'D', '', '2021-09-11 16:50:40'),
(207, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-207.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:51:25'),
(208, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-208.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:52:04'),
(209, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-209.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:52:51'),
(210, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-210.png', 'Pilihan Ganda', 6, 1, '', 'B', '', '2021-09-11 16:53:28'),
(211, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-211.png', 'Pilihan Ganda', 6, 1, '', 'C', '', '2021-09-11 16:54:06'),
(212, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-212.png', 'Pilihan Ganda', 6, 1, '', 'E', '', '2021-09-11 16:54:46'),
(213, 'CFIT', 'Subtest 3', '', 'CFIT-Subtest 3-213.png', 'Pilihan Ganda', 6, 1, '', 'A', '', '2021-09-11 16:55:21'),
(214, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-214.png', 'Pilihan Ganda', 5, 1, '', 'B', '', '2021-09-11 16:58:48'),
(215, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-215.png', 'Pilihan Ganda', 5, 1, '', 'A', '', '2021-09-11 17:00:03'),
(216, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-216.png', 'Pilihan Ganda', 5, 1, '', 'D', '', '2021-09-11 17:00:50'),
(217, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-217.png', 'Pilihan Ganda', 5, 1, '', 'D', '', '2021-09-11 17:01:59'),
(218, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-218.png', 'Pilihan Ganda', 5, 1, '', 'A', '', '2021-09-11 17:02:37'),
(219, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-219.png', 'Pilihan Ganda', 5, 1, '', 'A', '', '2021-09-11 17:03:14'),
(220, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-220.png', 'Pilihan Ganda', 5, 1, '', 'C', '', '2021-09-11 17:04:04'),
(221, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-221.png', 'Pilihan Ganda', 5, 1, '', 'A', '', '2021-09-11 17:04:48'),
(222, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-222.png', 'Pilihan Ganda', 5, 1, '', 'C', '', '2021-09-11 17:06:08'),
(223, 'CFIT', 'Subtest 4', '', 'CFIT-Subtest 4-223.png', 'Pilihan Ganda', 5, 1, '', 'A', '', '2021-09-11 17:06:42'),
(271, 'IST', 'AN', '<p>PILOT : PESAWAT</p>', '', 'Pilihan Ganda', 0, 0, 'MASINIS : KAPAL#KUSIR : KERETA#NELAYAN : KAPAL#MOTOR : TRUK#SUPIR : MOBIL', 'E', '', '2021-09-12 19:59:55'),
(272, 'IST', 'AN', '<p>DESIBEL : SUARA</p>', '', 'Pilihan Ganda', 0, 0, 'ARE : JARAK#WARNA : MERAH#SUHU : TEMPERATUR#VOLT : LISTRIK#KALORI : BERAT', 'D', '', '2021-09-12 20:00:31'),
(273, 'IST', 'AN', '<p>AIR : HAUS</p>', '', 'Pilihan Ganda', 0, 0, 'ANGIN : PANAS#MAKANAN : LAPAR#RUMPUT : KAMBING#GELAP : LAMPU#MINYAK : API', 'B', '', '2021-09-12 20:01:07'),
(274, 'IST', 'AN', '<p>SEMINAR : SARJANA</p>', '', 'Pilihan Ganda', 0, 0, 'AKADEMI : TARUNA#KONSERVATOR : SENIMAN#PERPUSTAKAAN : PENELITI#RUANG PENGADILAN : SAKSI#RUMAH SAKIT : PASIEN', 'D', '', '2021-09-12 20:02:00'),
(275, 'IST', 'AN', '<p>BEBATUAN : GEOLOGI = BENIH : ...</p>', '', 'Pilihan Ganda', 0, 0, 'ILMU PENGETAHUAN#HORTIKULTURA#REPRODUKSI#ATOM#BIOLOGI', 'B', '', '2021-09-12 20:02:38'),
(276, 'IST', 'AN', '<p>KAKI : SEPATU</p>', '', 'Pilihan Ganda', 0, 0, 'TOPI : KEPALA#CINCIN : JARI#TELINGA : ANTING#MEJA : RUANGAN#CAT : KUAS', 'C', '', '2021-09-12 20:03:14'),
(277, 'IST', 'AN', '<p>ULAT : KEPOMPONG : KUPU-KUPU</p>', '', 'Pilihan Ganda', 0, 0, 'BAYI : ANAK-ANAK : REMAJA#NGANTUK : TIDUR : MIMPI#KECIL : SEDANG : BESAR#ANAK : AYAH : KAKEK#SORE : SIANG : PAGI', 'A', '', '2021-09-12 20:08:12'),
(278, 'IST', 'AN', '<p>MURID : BUKU : PERPUSTAKAAN</p>', '', 'Pilihan Ganda', 0, 0, 'ORANG TUA : ANAK : IBU#PEMBELI : MAKANAN : GUDANG#ANAK : KELERENG : RUMAH#MAKANAN : NASI : MEJA#NASABAH : UANG : BANK', 'E', '', '2021-09-12 20:09:00'),
(279, 'IST', 'AN', '<p>KUDA : DAKU : DUKA</p>', '', 'Pilihan Ganda', 0, 0, 'KAKI : KAKA : KUKU#NADI : DINA : DANI#PAPI : PAPA : PIPA#BUKA : BAKI : KAKA#DADA : DIDI : DADU', 'B', '', '2021-09-12 20:10:57'),
(280, 'IST', 'AN', '<p>API : BAKAR : PANAS</p>', '', 'Pilihan Ganda', 0, 0, 'AIR : LEMBAB : DINGIN#UDARA : SEGAR : HANGAT#BESI : PANAS : MEMUAI#KAYU : KERAS : PANJANG#ES : BEKU : DINGIN', 'A', '', '2021-09-12 20:11:38'),
(281, 'IST', 'AN', '<p>INSENTIF : PRESTASI</p>', '', 'Pilihan Ganda', 0, 0, 'HADIAH : PENGABDIAN#PENGHORMATAN : KEPRIBADIAN#HAK : KEWAJIBAN#KEBUTUHAN : PEMENUHAN KEBUTUHAN#MOTIVASI : KERJA', 'A', '', '2021-09-12 20:12:27'),
(282, 'IST', 'AN', '<p>RAMALAN : ASTROLOGI = BANGSA : ...</p>', '', 'Pilihan Ganda', 0, 0, 'SOSIOLOGI#DEMOGRAFI#PSIKOLOGI#ETNOLOGI#ANTROPOLOGI', 'D', '', '2021-09-12 20:13:44'),
(283, 'IST', 'AN', '<p>DONGENG : PERISTIWA</p>', '', 'Pilihan Ganda', 0, 0, 'FIKTIF : FAKTA#DATA : RAMALAN#TESIS : ANTI TESIS#RENCANA : PROYEKSI#DUGAAN : HIPOTESIS', 'A', '', '2021-09-12 20:14:22'),
(284, 'IST', 'GE', '<p>Rumput - Gajah</p>', '', 'Isian', 0, 0, '', 'rantai makanan|rantai|makanan', '', '2021-09-13 11:14:04'),
(285, 'IST', 'GE', '<p>Ember - kantong</p>', '', 'Isian', 0, 0, '', 'wadah|tempat|-', '', '2021-09-13 11:23:53'),
(286, 'IST', 'GE', '<p>Awal - Akhir</p>', '', 'Isian', 0, 0, '', 'batas|-|-', '', '2021-09-13 11:26:28'),
(287, 'IST', 'GE', '<p>Kikir - boros</p>', '', 'Isian', 0, 0, '', 'sifat|-|-', '', '2021-09-13 11:27:03'),
(288, 'IST', 'GE', '<p>Penawaran - Permintaan</p>', '', 'Isian', 0, 0, '', 'pasar|-|-', '', '2021-09-13 11:27:40'),
(289, 'IST', 'GE', '<p>Atas - Bawah</p>', '', 'Isian', 0, 0, '', 'Arah|-|-', '', '2021-09-13 11:27:59'),
(290, 'IST', 'GE', '<p>Jauh - Dekat</p>', '', 'Isian', 0, 0, '', 'jarak|-|-', '', '2021-09-13 11:28:24'),
(291, 'IST', 'GE', '<p>Mencuri - Membunuh</p>', '', 'Isian', 0, 0, '', 'kejahatan|kegiatan|-', '', '2021-09-13 11:29:41'),
(292, 'IST', 'GE', '<p>Klien - Pasien</p>', '', 'Isian', 0, 0, '', 'pelanggan|konsumen|klien', '', '2021-09-13 11:30:23'),
(293, 'IST', 'GE', '<p>Insang - Paru-paru</p>', '', 'Isian', 0, 0, '', 'alat pernapasan|bernafas|-', '', '2021-09-13 11:38:39'),
(294, 'IST', 'GE', '<p>mawar - melati</p>', '', 'Isian', 0, 0, '', 'bunga|kembang|-', '', '2021-09-13 11:45:39'),
(295, 'IST', 'GE', '<p>Mata - Telinga</p>', '', 'Isian', 0, 0, '', 'Indra|bagian tubuh|organ', '', '2021-09-13 11:50:26'),
(296, 'IST', 'GE', '<p>Gula - Intan</p>', '', 'Isian', 0, 0, '', 'kristal|berlian|-', '', '2021-09-13 11:54:10'),
(297, 'IST', 'GE', '<p>Hujan - salju</p>', '', 'Isian', 0, 0, '', 'cuaca|suhu|-', '', '2021-09-13 11:57:13'),
(298, 'IST', 'GE', '<p>Pengantar Surat - Telepon</p>', '', 'Isian', 0, 0, '', 'informasi|data|komunikasi', '', '2021-09-13 11:58:06'),
(299, 'IST', 'GE', '<p>Kamera - Kacamata</p>', '', 'Isian', 0, 0, '', 'lensa|dokumentasi|-', '', '2021-09-13 12:01:39'),
(300, 'IST', 'GE', '<p>Lambung - usus</p>', '', 'Isian', 0, 0, '', 'pencernaan|organ tubuh|-', '', '2021-09-13 12:02:26'),
(301, 'IST', 'GE', '<p>Banyak - Sedikit</p>', '', 'Isian', 0, 0, '', 'ukuran|jumlah|-', '', '2021-09-13 12:03:03'),
(302, 'IST', 'GE', '<p>Telur - benih</p>', '', 'Isian', 0, 0, '', 'bibit|biji|-', '', '2021-09-13 12:03:37'),
(303, 'IST', 'GE', '<p>Bendera - Lencana</p>', '', 'Isian', 0, 0, '', 'lambang|simbol|-', '', '2021-09-13 12:04:25'),
(304, 'IST', 'RA', '<p>Karena dipanaskan, kawat yang panjangnya 48 cm akan mengembang menjadi 52 cm. Setelah pemanasan, berapakah panjangnya kawat yang berukuran 72 cm ?<br></p>', '', 'Aritmatika', 0, 0, '', '76', '', '2021-09-13 12:11:19'),
(305, 'IST', 'RA', '<p>Suatu pabrik dapat menghasilkan 304 batang pensil dalam waktu 8 jam. Berapa batangkah yang dihasilkan dalam waktu setengah jam ?<br></p>', '', 'Aritmatika', 0, 0, '', '19', '', '2021-09-13 12:11:43'),
(306, 'IST', 'RA', '<p>Untuk suatu campuran diperlukan 2 bagian perak dan 3 bagian timah. Berapa gram-kah perak yang diperlukan untuk mendapatkan campuran itu beratnya 15 gram?<br></p>', '', 'Aritmatika', 0, 0, '', '6', '', '2021-09-13 12:11:59'),
(307, 'IST', 'RA', '<p>Untuk setiap Rp. 3,- yang dimiliki Sidin, Hamid memiliki Rp. 5,- . Jika mereka bersama mempunyai&nbsp;<span style=\"font-size: 1rem;\">Rp. 120,- berapa rupiahkah yang dimiliki Hamid ?</span></p>', '', 'Aritmatika', 0, 0, '', '75', '', '2021-09-13 12:12:26'),
(308, 'IST', 'RA', '<p>Mesin A menenun 60 m kain, sedangkan mesin B menenun 40 m kain. Berapa meterkah yang ditenun mesin A, Jika mesin B menenun 60 m?<br></p>', '', 'Aritmatika', 0, 0, '', '90', '', '2021-09-13 12:12:46'),
(309, 'IST', 'RA', '<p>Seseorang memberikan 1/10 dari uangnya untuk perangko dan 4 kali jumlah itu untuk alat tulis.&nbsp;<span style=\"font-size: 1rem;\">Sisa uangnya masih Rp. 60,-. Berapa rupiahkah uangnya semula?</span></p>', '', 'Aritmatika', 0, 0, '', '120', '', '2021-09-13 12:13:06'),
(310, 'IST', 'RA', '<p>Dalam 2 peti terdapat 43 piring. Didalam peti yang satu terdapat 9 buah piring lebih banyak daripada didalam peti yang lain. Berapa buah piring terdapat didalam peti yang lebih kecil?<br></p>', '', 'Aritmatika', 0, 0, '', '17', '', '2021-09-13 12:13:25'),
(311, 'IST', 'RA', '<p>Suatu lembaran kain yang panjangnya 60 cm harus dibagi sedemikian rupa sehingga panjangnya satu bagian adalah 2/3 dari bagian yang lain. Berapakah bagian yang terpendek?<br></p>', '', 'Aritmatika', 0, 0, '', '40', '', '2021-09-13 12:20:15'),
(312, 'IST', 'RA', '<p>Suatu perusahaan mengekspor ¾ dari hasil produksinya dan menjual 4/5 dari sisa itu di dalam negeri. Berapa % kah hasil produksi yang masih tinggal?<br></p>', '', 'Aritmatika', 0, 0, '', '5', '', '2021-09-13 12:20:33'),
(313, 'IST', 'RA', '<p>Didalam suatu keluarga setiap anak perempuan mempunyai jumlah saudara laki-laki yang sama dengan jumlah saudara perempuan dan setiap anak laki-laki mempunyai dua kali lebih banyak saudara perempuan daripada saudara laki-laki. Berapa anak laki-laki kah yang terdapat dalam keluarga itu?<br></p>', '', 'Aritmatika', 0, 0, '', '3', '', '2021-09-13 12:21:13'),
(314, 'IST', 'RA', '<p>Jika seorang anak memiliki Rp. 50,- dan memberikan Rp. 15,-. Berapa rupiahkah yang masih tinggal padanya?<br></p>', '', 'Aritmatika', 0, 0, '', '35', '', '2021-09-13 12:21:33'),
(315, 'IST', 'RA', '<p>Berapa km-kah yang dapat ditempuh oleh kereta api dalam waktu 7 jam. Jika kecepatannya 40 km/jam ?<br></p>', '', 'Aritmatika', 0, 0, '', '280', '', '2021-09-13 12:21:48'),
(316, 'IST', 'RA', '<p>15 peti buah-buahan beratnya 250 kg dan setiap peti kosong beratnya 3 kg, berapakah berat buah-buahan itu ?<br></p>', '', 'Aritmatika', 0, 0, '', '205', '', '2021-09-13 12:22:05'),
(317, 'IST', 'RA', '<p>Seseorang mempunyai persediaan rumput yang cukup untuk 7 ekor kuda selama 78 hari. Berapa harikah persediaan itu cukup untuk 21 ekor kuda?<br></p>', '', 'Aritmatika', 0, 0, '', '26', '', '2021-09-13 12:22:21'),
(318, 'IST', 'RA', '<p>3 batang coklat harganya Rp. 5,-. Berapa batangkah yang dapat kita beli dengan Rp. 50,-?<br></p>', '', 'Aritmatika', 0, 0, '', '30', '', '2021-09-13 12:22:36'),
(319, 'IST', 'RA', '<p>Seseorang dapat berjalan 1,75 m dalam waktu ¼ detik. Berapa meterkah yang dapat ditempuh dalam waktu 10 detik ?<br></p>', '', 'Aritmatika', 0, 0, '', '70', '', '2021-09-13 12:24:20'),
(320, 'IST', 'RA', '<p>Jika sebuah batu terletak 15 m di sebelah selatan dari sebatang pohon dan pohon itu berada 30 m di sebelah selatan dari sebuah rumah. Berapa meterkah jarak antara batu dan rumah itu?<br></p>', '', 'Aritmatika', 0, 0, '', '45', '', '2021-09-13 12:24:35'),
(321, 'IST', 'RA', '<p>Jika 4 1/5 bahan sandang harganya Rp. 90,-. Berapa rupiahkah harga 2 ½ m?<br></p>', '', 'Aritmatika', 0, 0, '', '54', '', '2021-09-13 12:25:57'),
(322, 'IST', 'RA', '<p>7 orang dapat menyelesaikan suatu pekerjaan dalam 6 hari. Berapa orangkah yang diperlukan untuk menyelesaikan pekerjaan itu dalam setengah hari ?<br></p>', '', 'Aritmatika', 0, 0, '', '84', '', '2021-09-13 12:26:14'),
(323, 'IST', 'ZR', '<p>94&nbsp; &nbsp; 92&nbsp; &nbsp; 46&nbsp; &nbsp; 44&nbsp; &nbsp; 22&nbsp; &nbsp; 20&nbsp; &nbsp; 10&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '8', '', '2021-09-13 12:29:36'),
(324, 'IST', 'ZR', '<p>5&nbsp; &nbsp; 8&nbsp; &nbsp; 9&nbsp; &nbsp; 8&nbsp; &nbsp; 11&nbsp; &nbsp; 12&nbsp; &nbsp; 11&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '14', '', '2021-09-13 12:31:01'),
(325, 'IST', 'ZR', '<p>12&nbsp; &nbsp; 15&nbsp; &nbsp; 19&nbsp; &nbsp; 23&nbsp; &nbsp; 28&nbsp; &nbsp; 33&nbsp; &nbsp; 39&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '45', '', '2021-09-13 12:31:20'),
(326, 'IST', 'ZR', '<p>7&nbsp; &nbsp; 5&nbsp; &nbsp; 10&nbsp; &nbsp; 7&nbsp; &nbsp; 21&nbsp; &nbsp; 17&nbsp; &nbsp; 68&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '63', '', '2021-09-13 12:31:45'),
(327, 'IST', 'ZR', '<p>11&nbsp; &nbsp; 15&nbsp; &nbsp; 18&nbsp; &nbsp; 9&nbsp; &nbsp; 13&nbsp; &nbsp; 16&nbsp; &nbsp; 8&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '12', '', '2021-09-13 12:32:20'),
(328, 'IST', 'ZR', '<p>3&nbsp; &nbsp; 8&nbsp; &nbsp; 15&nbsp; &nbsp; 24&nbsp; &nbsp; 35&nbsp; &nbsp; 48&nbsp; &nbsp; 63&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '80', '', '2021-09-13 12:32:40'),
(329, 'IST', 'RA', '<p>Jika suatu botol berisi anggur hanya 7/8 bagian dan harganya ialah Rp. 84,-. Berapakah harga anggur itu jika botol itu hanya terisi ½ penuh?<br></p>', '', 'Aritmatika', 0, 0, '', '48', '', '2021-09-13 12:34:41'),
(330, 'IST', 'ZR', '<p>4&nbsp; &nbsp; 5&nbsp; &nbsp; 7&nbsp; &nbsp; 4&nbsp; &nbsp; 8&nbsp; &nbsp; 13&nbsp; &nbsp; 7&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '14', '', '2021-09-13 12:35:13'),
(331, 'IST', 'ZR', '<p>8&nbsp; &nbsp; 5&nbsp; &nbsp; 15&nbsp; &nbsp; 18&nbsp; &nbsp; 6&nbsp; &nbsp; 3&nbsp; &nbsp; 9&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '11', '', '2021-09-13 12:35:31'),
(332, 'IST', 'ZR', '<p>15&nbsp; &nbsp; 6&nbsp; &nbsp; 18&nbsp; &nbsp; 10&nbsp; &nbsp; 30&nbsp; &nbsp; 23&nbsp; &nbsp; 69&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '63', '', '2021-09-13 12:35:58'),
(333, 'IST', 'ZR', '<p>5&nbsp; &nbsp; 35&nbsp; &nbsp; 28&nbsp; &nbsp; 4&nbsp; &nbsp; 11&nbsp; &nbsp; 77&nbsp; &nbsp; 70&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '10', '', '2021-09-13 12:36:24'),
(334, 'IST', 'ZR', '<p>6&nbsp; &nbsp; 9&nbsp; &nbsp; 12&nbsp; &nbsp; 15&nbsp; &nbsp; 18&nbsp; &nbsp; 21&nbsp; &nbsp; 24&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '27', '', '2021-09-13 12:36:53'),
(335, 'IST', 'ZR', '<p>15&nbsp; &nbsp; 16&nbsp; &nbsp; 18&nbsp; &nbsp; 19&nbsp; &nbsp; 21&nbsp; &nbsp; 22&nbsp; &nbsp; 24&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '25', '', '2021-09-13 12:37:36'),
(336, 'IST', 'ZR', '<p>19&nbsp; &nbsp; 18&nbsp; &nbsp; 22&nbsp; &nbsp; 21&nbsp; &nbsp; 25&nbsp; &nbsp; 24&nbsp; &nbsp; 28&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '27', '', '2021-09-13 12:38:00'),
(337, 'IST', 'ZR', '<p>15&nbsp; &nbsp; 12&nbsp; &nbsp; 17&nbsp; &nbsp; 13&nbsp; &nbsp; 18&nbsp; &nbsp; 14&nbsp; &nbsp; 19&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '15', '', '2021-09-13 12:38:21'),
(338, 'IST', 'ZR', '<p>2&nbsp; &nbsp; 4&nbsp; &nbsp; 8&nbsp; &nbsp; 10&nbsp; &nbsp; 20&nbsp; &nbsp; 22&nbsp; &nbsp; 44&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '42', '', '2021-09-13 12:38:43'),
(339, 'IST', 'ZR', '<p>15&nbsp; &nbsp; 13&nbsp; &nbsp; 16&nbsp; &nbsp; 12&nbsp; &nbsp; 17&nbsp; &nbsp; 11&nbsp; &nbsp; 18&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '10', '', '2021-09-13 12:39:03'),
(340, 'IST', 'ZR', '<p>25&nbsp; &nbsp; 22&nbsp; &nbsp; 11&nbsp; &nbsp; 33&nbsp; &nbsp; 30&nbsp; &nbsp; 15&nbsp; &nbsp; 45&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '42', '', '2021-09-13 12:39:29'),
(341, 'IST', 'ZR', '<p>49&nbsp; &nbsp; 51&nbsp; &nbsp; 54&nbsp; &nbsp; 27&nbsp; &nbsp; 9&nbsp; &nbsp; 11&nbsp; &nbsp; 14&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '7', '', '2021-09-13 12:39:53'),
(342, 'IST', 'ZR', '<p>2&nbsp; &nbsp; 3&nbsp; &nbsp; 1&nbsp; &nbsp; 3&nbsp; &nbsp; 4&nbsp; &nbsp; 2&nbsp; &nbsp; 4&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '5', '', '2021-09-13 12:40:08'),
(343, 'IST', 'ZR', '<p>19&nbsp; &nbsp; 17&nbsp; &nbsp; 20&nbsp; &nbsp; 16&nbsp; &nbsp; 21&nbsp; &nbsp; 15&nbsp; &nbsp; 22&nbsp; &nbsp; ?</p>', '', 'Isian', 0, 0, '', '14', '', '2021-09-13 12:40:22'),
(344, 'IST', 'FA', '', 'IST-FA-1.png', 'Gambar', 0, 0, '', 'A', 'Soal FA 1', '2021-09-13 16:07:01'),
(345, 'IST', 'FA', '', 'IST-FA-2.png', 'Gambar', 0, 0, '', 'C', 'Soal FA 1', '2021-09-13 16:07:23'),
(346, 'IST', 'FA', '', 'IST-FA-3.png', 'Gambar', 0, 0, '', 'B', 'Soal FA 1', '2021-09-13 16:12:35'),
(347, 'IST', 'FA', '', 'IST-FA-4.png', 'Gambar', 0, 0, '', 'A', 'Soal FA 1', '2021-09-13 16:13:27'),
(348, 'IST', 'FA', '', 'IST-FA-5.png', 'Gambar', 0, 0, '', 'D', 'Soal FA 1', '2021-09-13 16:15:24'),
(349, 'IST', 'FA', '', 'IST-FA-6.png', 'Gambar', 0, 0, '', 'B', 'Soal FA 1', '2021-09-13 16:25:38'),
(350, 'IST', 'FA', '', 'IST-FA-7.png', 'Gambar', 0, 0, '', 'C', 'Soal FA 1', '2021-09-13 16:25:57'),
(351, 'IST', 'FA', '', 'IST-FA-8.png', 'Gambar', 0, 0, '', 'E', 'Soal FA 1', '2021-09-13 16:29:39'),
(352, 'IST', 'FA', '', 'IST-FA-9.png', 'Gambar', 0, 0, '', 'E', 'Soal FA 1', '2021-09-13 16:33:08'),
(353, 'IST', 'FA', '', 'IST-FA-10.png', 'Gambar', 0, 0, '', 'D', 'Soal FA 1', '2021-09-13 16:38:02'),
(354, 'IST', 'FA', '', 'IST-FA-11.png', 'Gambar', 0, 0, '', 'E', 'Soal FA 1', '2021-09-13 16:40:12'),
(355, 'IST', 'FA', '', 'IST-FA-12.png', 'Gambar', 0, 0, '', 'A', 'Soal FA 1', '2021-09-13 16:40:30'),
(356, 'IST', 'FA', '', 'IST-FA-13.png', 'Gambar', 0, 0, '', 'D', 'Soal FA 11', '2021-09-13 16:53:25'),
(357, 'IST', 'FA', '', 'IST-FA-14.png', 'Gambar', 0, 0, '', 'A', 'Soal FA 11', '2021-09-13 16:53:40'),
(358, 'IST', 'FA', '', 'IST-FA-15.png', 'Gambar', 0, 0, '', 'B', 'Soal FA 11', '2021-09-13 16:55:04'),
(359, 'IST', 'FA', '', 'IST-FA-16.png', 'Gambar', 0, 0, '', 'e', 'Soal FA 11', '2021-09-13 16:56:09'),
(360, 'IST', 'FA', '', 'IST-FA-17.png', 'Gambar', 0, 0, '', 'B', 'Soal FA 11', '2021-09-13 17:01:40'),
(361, 'IST', 'FA', '', 'IST-FA-18.png', 'Gambar', 0, 0, '', 'D', 'Soal FA 11', '2021-09-13 17:05:57'),
(362, 'IST', 'FA', '', 'IST-FA-19.png', 'Gambar', 0, 0, '', 'E', 'Soal FA 11', '2021-09-13 17:13:00'),
(363, 'IST', 'FA', '', 'IST-FA-20.png', 'Gambar', 0, 0, '', 'A', 'Soal FA 11', '2021-09-13 17:13:41'),
(364, 'IST', 'WU', '', 'IST-WU-1.png', 'Gambar', 0, 0, '', 'A', 'Soal WU', '2021-09-13 17:26:50'),
(365, 'IST', 'WU', '', 'IST-WU-2.png', 'Gambar', 0, 0, '', 'C', 'Soal WU', '2021-09-13 17:27:05'),
(366, 'IST', 'WU', '', 'IST-WU-3.png', 'Gambar', 0, 0, '', 'D', 'Soal WU', '2021-09-13 17:27:16'),
(367, 'IST', 'WU', '', 'IST-WU-4.png', 'Gambar', 0, 0, '', 'E', 'Soal WU', '2021-09-13 17:27:29'),
(368, 'IST', 'WU', '', 'IST-WU-5.png', 'Gambar', 0, 0, '', 'A', 'Soal WU', '2021-09-13 17:27:39'),
(369, 'IST', 'WU', '', 'IST-WU-6.png', 'Gambar', 0, 0, '', 'C', 'Soal WU', '2021-09-13 17:30:33'),
(370, 'IST', 'WU', '', 'IST-WU-7.png', 'Gambar', 0, 0, '', 'D', 'Soal WU', '2021-09-13 17:30:46'),
(371, 'IST', 'WU', '', 'IST-WU-8.png', 'Gambar', 0, 0, '', 'C', 'Soal WU', '2021-09-13 17:31:46'),
(372, 'IST', 'WU', '', 'IST-WU-9.png', 'Gambar', 0, 0, '', 'E', 'Soal WU', '2021-09-13 17:31:58'),
(373, 'IST', 'WU', '', 'IST-WU-10.png', 'Gambar', 0, 0, '', 'A', 'Soal WU', '2021-09-13 17:32:09'),
(374, 'IST', 'WU', '', 'IST-WU-11.png', 'Gambar', 0, 0, '', 'B', 'Soal WU', '2021-09-13 17:35:00'),
(375, 'IST', 'WU', '', 'IST-WU-12.png', 'Gambar', 0, 0, '', 'A', 'Soal WU', '2021-09-13 17:35:12'),
(376, 'IST', 'WU', '', 'IST-WU-13.png', 'Gambar', 0, 0, '', 'E', 'Soal WU', '2021-09-13 17:35:24'),
(377, 'IST', 'WU', '', 'IST-WU-14.png', 'Gambar', 0, 0, '', 'B', 'Soal WU', '2021-09-13 17:35:39'),
(378, 'IST', 'WU', '', 'IST-WU-15.png', 'Gambar', 0, 0, '', 'B', 'Soal WU', '2021-09-13 17:35:54'),
(379, 'IST', 'WU', '', 'IST-WU-16.png', 'Gambar', 0, 0, '', 'D', 'Soal WU', '2021-09-13 17:39:18'),
(380, 'IST', 'WU', '', 'IST-WU-17.png', 'Gambar', 0, 0, '', 'A', 'Soal WU', '2021-09-13 17:39:34'),
(381, 'IST', 'WU', '', 'IST-WU-18.png', 'Gambar', 0, 0, '', 'E', 'Soal WU', '2021-09-13 17:39:44'),
(382, 'IST', 'WU', '', 'IST-WU-19.png', 'Gambar', 0, 0, '', 'B', 'Soal WU', '2021-09-13 17:40:00'),
(383, 'IST', 'WU', '', 'IST-WU-20.png', 'Gambar', 0, 0, '', 'C', 'Soal WU', '2021-09-13 17:40:09'),
(384, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>Z</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'E', '', '2021-09-13 17:52:12'),
(385, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>A</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'D', '', '2021-09-13 17:52:56'),
(386, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>C</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'B', '', '2021-09-13 17:53:23'),
(387, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>M</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'E', '', '2021-09-13 17:53:48'),
(388, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>P</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'B', '', '2021-09-13 17:54:25'),
(389, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>H </b>adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'E', '', '2021-09-13 17:54:51'),
(390, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>U</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'D', '', '2021-09-13 17:55:21'),
(391, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>E</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'C', '', '2021-09-13 17:55:52'),
(392, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>L</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'A', '', '2021-09-13 17:56:30'),
(393, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>S</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'A', '', '2021-09-13 17:57:00'),
(394, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>K</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'B', '', '2021-09-13 17:57:27'),
(395, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>B</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'E', '', '2021-09-13 17:58:05'),
(396, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan<b> F </b>adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'A', '', '2021-09-13 17:58:28'),
(397, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>O</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'D', '', '2021-09-13 17:58:58'),
(398, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>T</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'C', '', '2021-09-13 17:59:28'),
(399, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>J</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'B', '', '2021-09-13 17:59:56'),
(400, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>Y</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'A', '', '2021-09-13 18:00:37'),
(401, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>D</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'A', '', '2021-09-13 18:01:20'),
(402, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>I</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'C', '', '2021-09-13 18:01:44'),
(403, 'IST', 'ME', '<p>Kata yang mempunyai huruf permulaan <b>W</b> adalah suatu……………<br></p>', '', 'Hafalan', 0, 0, 'bunga#perkakas#negara#kesenian#hewan', 'B', '', '2021-09-13 18:02:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_subtes`
--

CREATE TABLE `tbl_subtes` (
  `id_subtes` int(11) NOT NULL,
  `id_jenistes` int(11) NOT NULL,
  `nama_subtes` varchar(12) NOT NULL,
  `intruksi` text NOT NULL,
  `tipe_soal` enum('Gambar','Pilihan Ganda','Isian','Aritmatika','Hafalan') NOT NULL,
  `timer` decimal(11,1) NOT NULL,
  `soal_hafalan` text NOT NULL,
  `timer_hafalan` decimal(11,1) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_subtes`
--

INSERT INTO `tbl_subtes` (`id_subtes`, `id_jenistes`, `nama_subtes`, `intruksi`, `tipe_soal`, `timer`, `soal_hafalan`, `timer_hafalan`, `added_at`) VALUES
(1, 1, 'Subtest 1', '<ul><li>Subtes ini terdiri dari 13 soal</li><li>Di bagian atas, anda akan menemukan sederet kotak yang berisi urutan gambar. Namun, kotak terakhir masih kosong. </li><li>Tugas anda adalah mengisi kotak kosong tersebut dengan pilihan gambar yang paling sesuai dengan cara memilih dari 6 pilihan gambar jawaban yang tersedia yaitu A,B,C,D,E dan F. Perlu diingat bahwa gambar-gambar pada soal memiliki pola tertentu sehingga untuk mengisinya, anda perlu mengetahui pola dari urutan gambar tersebut. </li><li>Anda tidak diperkenankan membuka atau memulai subtest selanjutnya sebelum ada instruksi lebih lanjut. </li></ul>', 'Pilihan Ganda', '3.0', '', '0.0', '2021-04-20 16:34:25'),
(2, 1, 'Subtest 2', '<ul><li>Subtest ini terdiri dari 14 soal</li><li>Pada setiap soal anda akan menemukan 5 buah gambar yang disusun secara berdampingan. Lihatlah gambar-gambar tersebut dengan teliti.&nbsp;</li><li>Tugas anda adalah memilih <b>DUA</b> gambar yang memiliki karakteristik atau pola yang serupa/hampir sama.&nbsp;</li><li>Anda tidak diperkenankan membuka atau memulai subtest selanjutnya sebelum ada instruksi lebih lanjut.&nbsp;</li></ul>', 'Pilihan Ganda', '4.0', '', '0.0', '2021-04-20 16:35:20'),
(3, 1, 'Subtest 3', '<ul><li>Subtest ini terdiri dari 13 soal</li><li>Di bagian sebelah kiri, anda akan menemukan sebuah kotak besar yang didalamnya terdapat kotak-kotak kecil bergambar. Anggaplah ini sebagai gambar sebuah sapu tangan, dimana kotak-kotak tersebut memiliki pola tertentu. Perhatikan bahwa bagian sebelah kanan bawah masih kosong.&nbsp;</li><li>Tugas anda adalah <b>melengkapi bagian kosong tersebut dengan salah satu dari 5 pilihan jawaban yang tersedia</b>&nbsp;yaitu A,B,C,D,E dan F.&nbsp;</li><li>Anda tidak diperkenankan membuka atau memulai subtest selanjutnya sebelum ada instruksi lebih lanjut.</li></ul>', 'Pilihan Ganda', '3.0', '', '0.0', '2021-04-20 16:36:39'),
(4, 1, 'Subtest 4', '<ul><li>Subtest ini terdiri dari 10 soal</li><li>Di dalam setiap kotak soal terdapat sebuah titik.&nbsp;</li><li>Tugas anda adalah memilih 1 jawaban yang paling tepat dari 5 pilihan jawaban dengan mencari titik dan mencari prinsip dari titik tersebut.&nbsp;</li><li>Silahkan tunggu instruksi selanjutnya.</li></ul>', 'Pilihan Ganda', '2.5', '', '0.0', '2021-04-20 16:40:31'),
(5, 2, 'SE', '<p>Soal-soal 01 – 20 terdiri atas kalimat-kalimat.</p><p>Pada setiap kalimat satu kata hilang dan disediakan 5 (lima) kata pilihan sebagai jawabannya.</p><p>Pilihlah kata yang tepat yang dapat menyempurnakan kalimat itu !</p>', 'Pilihan Ganda', '6.0', '', '0.0', '2021-04-20 16:47:56'),
(6, 2, 'WA', '<p>Ditentukan lima kata.</p><p>Pada 4 dari 5 kata itu terdapat suatu kesamaan.</p><p>Carilah satu kata yang tidak memiliki kesamaan dengan keempat kata yang lain.</p>', 'Pilihan Ganda', '6.0', '', '0.0', '2021-04-20 16:48:38'),
(7, 2, 'AN', '<p>Ditentukan tiga kata.</p><p>Antara kata pertama dan kata kedua terdapat suatu hubungan tertentu.</p><p>Antara kata ketiga dan salah satu kata di antara kelima kata pilihan, harus pula terdapat hubungan yang sama.</p><p>Carilah kata itu.</p><div><br></div>', 'Pilihan Ganda', '7.0', '', '0.0', '2021-04-20 16:49:17'),
(8, 2, 'GE', '<p>Ditentukan dua kata.</p><p>Carilah satu perkataan yang meliputi pengertian kedua kata tadi.</p><p>Tulislah perkataan itu pada kotak yang telah disediakan.</p>', 'Isian', '8.0', '', '0.0', '2021-04-20 16:49:50'),
(9, 2, 'RA', '<p>Test berikutnya adalah soal-soal hitungan.<br></p>', 'Aritmatika', '10.0', '', '0.0', '2021-04-20 16:50:25'),
(10, 2, 'ZR', '<p>Pada test berikut akan diberikan deret angka.</p><p>Setiap deret tersusun menurut suatu pola tertentu dan dapat dilanjutkan menurut pola tersebut.</p><p>Carilah angka berikutnya untuk setiap deret, dan tulis jawaban saudara pada kotak yang telah disediakan.</p>', 'Isian', '10.0', '', '0.0', '2021-04-20 16:51:00'),
(11, 2, 'FA', '<p>Pada test berikutnya, setiap soal memperlihatkan sesuatu bentuk tertentu yang terpotong menjadi beberapa bagian.</p><p>Carilah diantara bentuk-bentuk yang terdapat dalam pilihan (a, b, c, d, e), suatu bentuk yang dapat dibangun dengan cara menyusun potongan-potongan yang terdapat dalam soal.</p>', 'Gambar', '7.0', '', '0.0', '2021-04-20 16:51:39'),
(12, 2, 'WU', '<p>Terdapat sebuah kubus dengan tanda yang terlihat pada ketiga sisi nya. Kubus tersebut dapat diputar, dapat digulingkan atau dapat diputar dan digulingkan dalam pikiran saudara.</p><p>Carilah 1 (satu) dari 5 (lima) pilihan kubus yang memiliki tanda yang sama dengan kubus yang terdapat pada soal.</p>', 'Gambar', '9.0', '', '0.0', '2021-04-20 16:52:14'),
(13, 2, 'ME', '<p>Anda akan diberikan secarik kertas mengenai kata-kata yang perlu saudara hafalkan dalam waktu <b>3 menit</b>.</p><p>Setelah 3 menit, kertas tersebut akan diambil kembali oleh pengawas.</p>', 'Hafalan', '6.0', '<p>Hafalkan teks berikut selama 3 menit untuk menjawab soal-soal yang akan diberikan.<br></p><p><b>BUNGA </b>: Flamboyan, Lily, Soka, Yasmin, Dahlia</p><p><b>PERKAKAS</b> : Wajan, Jarum, Palu, Cangkul, Kikir</p><p><b>NEGARA</b> : India, Ethiopia, Timorleste, Nigeria, Venezuela<b> </b></p><p><b>KESENIAN</b> : Gamelan, Opera, Arca, Quintet, Ukiran </p><p><b>HEWAN</b> : Musang, Rusa, Beruang, Zebra, Harimau</p>', '3.0', '2021-04-20 16:53:24'),
(14, 3, 'MBTI', '<p>Dalam soal ini terdapat 70 pertanyaan yang masing-masing tersedia alternatif jawaban.&nbsp;</p><p>Tugas anda memilih salah satu alternatif jawaban “A” atau “B” yang menurut anda paling mencerminkan diri anda atau paling menunjukkan bagaimana perasaan anda. Bila anda mendapatkan sepasang jawaban yang tidak menggambarkan diri anda, maka anda tetap harus memilih salah satu yang lebih mendekati diri anda.&nbsp;</p><p>Bekerjalah secepat mungkin, tetapi periksa dengan cermat bahwa anda sudah memilih satu jawaban pada setiap nomer. Jangan sampai ada satu nomer pun yang terlewatkan.&nbsp;</p>', 'Pilihan Ganda', '0.0', '', '0.0', '2021-04-21 17:51:32'),
(15, 4, 'MSDT', '<ol><li>Pilihlah jawaban “A” atau “B” pada pasangan penyataan-pernyataan berikut dan tulislah pada lembar jawaban yang telah disediakan.</li><li>Dilarang membuat coretan apapun didalam buku persoalan.</li></ol>', 'Pilihan Ganda', '0.0', '', '0.0', '2021-04-23 12:56:13'),
(16, 5, 'PAPI KOSTICK', '', 'Pilihan Ganda', '0.0', '', '0.0', '2021-04-29 12:50:46'),
(17, 7, 'DISC', '', 'Pilihan Ganda', '0.0', '', '0.0', '2021-04-29 12:58:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `noHp` varchar(14) NOT NULL,
  `password` varchar(35) NOT NULL,
  `acara` int(11) NOT NULL,
  `keperluan` enum('Individu','Perusahaan') NOT NULL,
  `perusahaan` varchar(75) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `profesi` enum('Entrepreneur','Karyawan','Guru','Belum Bekerja') NOT NULL,
  `jabatan` varchar(15) NOT NULL DEFAULT '-',
  `pendidikan_terakhir` enum('SD','SMP','SMA','S1','S2','S3') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Belum Aktif','Aktif') NOT NULL DEFAULT 'Belum Aktif'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `noHp`, `password`, `acara`, `keperluan`, `perusahaan`, `gender`, `profesi`, `jabatan`, `pendidikan_terakhir`, `tgl_lahir`, `tgl_daftar`, `status`) VALUES
(1, 'Joses Adriel', '42170233@student.kwikkiangie.ac.id', '089625769346', '97e9698d0aeb127e2c042b63ad084743', 3, 'Individu', '', 'Laki-Laki', 'Belum Bekerja', '-', 'S1', '1999-09-09', '2021-09-29 13:07:10', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jawaban_disc`
--
ALTER TABLE `jawaban_disc`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jawaban_papi`
--
ALTER TABLE `jawaban_papi`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `soal_disc`
--
ALTER TABLE `soal_disc`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `soal_papi`
--
ALTER TABLE `soal_papi`
  ADD PRIMARY KEY (`id_papi`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_contohsoal`
--
ALTER TABLE `tbl_contohsoal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indeks untuk tabel `tbl_grup`
--
ALTER TABLE `tbl_grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indeks untuk tabel `tbl_hasiltes`
--
ALTER TABLE `tbl_hasiltes`
  ADD PRIMARY KEY (`id_hasiltes`);

--
-- Indeks untuk tabel `tbl_jenistes`
--
ALTER TABLE `tbl_jenistes`
  ADD PRIMARY KEY (`id_jenistes`);

--
-- Indeks untuk tabel `tbl_jwbuser`
--
ALTER TABLE `tbl_jwbuser`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tbl_paketgambar`
--
ALTER TABLE `tbl_paketgambar`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `tbl_subtes`
--
ALTER TABLE `tbl_subtes`
  ADD PRIMARY KEY (`id_subtes`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jawaban_disc`
--
ALTER TABLE `jawaban_disc`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jawaban_papi`
--
ALTER TABLE `jawaban_papi`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `soal_disc`
--
ALTER TABLE `soal_disc`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `soal_papi`
--
ALTER TABLE `soal_papi`
  MODIFY `id_papi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_contohsoal`
--
ALTER TABLE `tbl_contohsoal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_grup`
--
ALTER TABLE `tbl_grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasiltes`
--
ALTER TABLE `tbl_hasiltes`
  MODIFY `id_hasiltes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenistes`
--
ALTER TABLE `tbl_jenistes`
  MODIFY `id_jenistes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_jwbuser`
--
ALTER TABLE `tbl_jwbuser`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_paketgambar`
--
ALTER TABLE `tbl_paketgambar`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT untuk tabel `tbl_subtes`
--
ALTER TABLE `tbl_subtes`
  MODIFY `id_subtes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
