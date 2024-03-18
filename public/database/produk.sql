-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2023 pada 06.29
-- Versi server: 8.0.30
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `up_skaneda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `kategori_produk_id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_produk` int NOT NULL,
  `berat_produk` int NOT NULL COMMENT 'dalam satuan gram',
  `harga_produk` int NOT NULL,
  `deskripsi_produk` longtext COLLATE utf8mb4_unicode_ci,
  `foto_produk` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kategori_produk_id`, `nama_produk`, `slug_produk`, `stok_produk`, `berat_produk`, `harga_produk`, `deskripsi_produk`, `foto_produk`, `created_at`, `updated_at`) VALUES
(1, 7, 'Tin C2', 'tin-c2', 652, 666, 666, 'Single dd', 'tin-20231011064903.jpg', '2023-10-11 11:49:03', '2023-10-13 00:38:54'),
(3, 7, 'Moondrop KATO', 'moondrop-kato', 500, 110, 4000000, 'Moondrop KATO, Detachable', 'Moondrop-KATO-20231014053105.jpg', '2023-10-12 23:29:41', '2023-10-13 22:31:05'),
(4, 7, 'Moondrop LAN', 'moondrop-lan', 300, 120, 650000, 'Moondrop LAN', 'Moondrop-LAN-20231014120102.jpg', '2023-10-13 17:01:02', '2023-10-13 17:01:02'),
(5, 5, 'Moondrop JOKER', 'moondrop-joker', 220, 320, 1200000, 'Headphone', 'Moondrop-JOKER-20231014120259.jpg', '2023-10-13 17:02:59', '2023-10-13 17:02:59'),
(7, 5, 'Moondrop PLANAR', 'moondrop-planar', 100, 340, 2300000, 'Using Planar System', 'Moondrop-PLANAR-20231014053357.png', '2023-10-13 22:33:57', '2023-10-13 22:33:57'),
(8, 7, 'Moondrop CHU II', 'moondrop-chu-ii', 400, 120, 290000, 'Single dd', 'Moondrop-CHU-II-20231014053603.jpg', '2023-10-13 22:35:22', '2023-10-13 22:36:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_kategori_produk_id_foreign` (`kategori_produk_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_produk_id_foreign` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id_kategori_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
