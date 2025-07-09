-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2025 at 06:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_galyna`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id_article` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `title`, `slug`, `content`, `cover_image`, `author`, `location`, `published_at`, `created_at`, `updated_at`) VALUES
(2, 'Keunikan Sasirangan: Warisan Budaya Kalimantan Selatan', 'keunikan_sasirangan_warisan_budaya_kalimantan_selatan', '<p style=\"text-align:justify;\">Sasirangan adalah pakaian tradisional yang menjadi simbol budaya khas Kalimantan Selatan, khususnya masyarakat Banjar. Sasirangan memiliki ciri khas yang sangat berbeda dengan jenis kain tradisional lainnya di Indonesia, karena menggunakan teknik pembuatan yang unik dan memerlukan keterampilan tinggi. Kata “sasirang” berasal dari bahasa Banjar yang berarti “jahit dan celup,” yang menggambarkan proses pembuatan kain tersebut. Pada teknik ini, kain dijahit atau diikat sesuai pola yang diinginkan, kemudian dicelupkan ke dalam larutan pewarna alami. Teknik pewarnaan ini dikenal dengan nama “celup rintang,” yang memungkinkan kain memiliki motif-motif yang sangat beragam dan penuh makna.</p><p style=\"text-align:justify;\">Motif yang dihasilkan dari teknik celup rintang ini tidak hanya memperindah kain, tetapi juga sarat akan makna filosofis dan simbolik. Setiap pola pada kain Sasirangan memiliki nilai-nilai mendalam, seperti kemuliaan, keteguhan, keberanian, kemakmuran, dan perlindungan. Misalnya, motif yang berbentuk seperti gelombang diyakini sebagai simbol kelancaran dan kehidupan yang harmonis. Ada pula motif yang dianggap sebagai simbol perlindungan, yang diyakini mampu memberikan kekuatan spiritual bagi pemakainya. Karena alasan ini, Sasirangan pada awalnya bukan hanya berfungsi sebagai pakaian, tetapi juga sebagai benda ritual yang digunakan dalam berbagai upacara adat dan keagamaan oleh masyarakat Banjar.</p><p style=\"text-align:justify;\">Selain nilai budaya dan spiritualnya, Sasirangan juga dikenal dengan keindahan warna yang dihasilkan dari teknik pewarnaan alami. Pewarna yang digunakan dalam proses pembuatan Sasirangan umumnya berasal dari tumbuh-tumbuhan lokal yang memiliki khasiat untuk memberikan warna yang tahan lama dan indah. Kain Sasirangan tradisional biasanya memiliki warna-warna alami yang tidak mudah pudar, menjadikannya sebagai produk tekstil yang awet dan berkualitas tinggi.</p><p style=\"text-align:justify;\">Pada masa lalu, Sasirangan dipercaya memiliki kekuatan spiritual untuk melindungi pemakainya dari berbagai bahaya, baik fisik maupun non-fisik. Oleh karena itu, kain ini sering dipakai dalam upacara adat, pernikahan, dan berbagai perayaan penting lainnya. Bahkan, masyarakat Banjar percaya bahwa Sasirangan dapat membawa keberuntungan, menjadikan pemakainya lebih sukses dalam kehidupan dan melindungi mereka dari gangguan-gangguan negatif.</p><p style=\"text-align:justify;\">Seiring berjalannya waktu, Sasirangan tidak hanya dipandang sebagai simbol budaya lokal yang kaya akan makna, tetapi juga sebagai produk yang semakin dikenal dan dihargai di kancah nasional maupun internasional. Dalam era modern ini, Sasirangan telah bertransformasi menjadi salah satu warisan budaya yang terus dilestarikan dan dikembangkan. Dengan sentuhan kreativitas para pengrajin dan inovasi dalam desain, Sasirangan kini tidak hanya dikenakan dalam konteks adat, tetapi juga sebagai pakaian sehari-hari atau aksesori fashion yang modern.</p><p style=\"text-align:justify;\">Keberadaan Sasirangan kini tidak hanya dirayakan oleh masyarakat Banjar, tetapi juga oleh banyak kalangan di Indonesia bahkan di luar negeri. Berbagai motif dan teknik pewarnaan yang kaya akan makna, dipadu dengan keindahan desain, membuat Sasirangan semakin diterima dan dihargai oleh berbagai lapisan masyarakat. Seiring dengan peningkatan kesadaran akan pentingnya pelestarian budaya dan produk lokal, Sasirangan kini juga dilihat sebagai pilihan yang mengangkat nilai-nilai budaya Indonesia, memperkenalkan keunikan tradisi lokal ke dunia internasional, sekaligus mendukung industri tekstil berkelanjutan yang semakin berkembang.</p><p style=\"text-align:justify;\">Baca lebih lanjut tentang Sasirangan di <a href=\"https://id.wikipedia.org/wiki/Sasirangan\"><i>Wikipedia</i></a></p>', '1750131425_keunikan_sasirangan_warisan_budaya_kalimantan_selatan.png', 'Adi Aulia Rahman as IT Lead', 'Tanah Laut', '2024-12-01', '2025-06-17 03:37:05', '2025-06-17 03:37:05'),
(3, 'Sasirangan dan Pewarna Alami Indigo', 'sasirangan_dan_pewarna_alami_indigo', '<p style=\"text-align:justify;\">Sasirangan adalah pakaian tradisional yang menjadi simbol kebudayaan Kalimantan Selatan. Kain ini dikenal dengan motif yang penuh makna yang dimana setiap motif memiliki nilai filosofi yang dalam seperti, menggambarkan kemuliaan, keberanian, serta perlindungan. Selain sebagai simbol budaya, Sasirangan juga menjadi daya tarik di pasar internasional, terutama yang dibuat dengan pewarna alami indigo (<a href=\"http://[https://www.indonesiakaya.com/]\"><i>Indonesia Kaya, 2024</i></a>).</p><p style=\"text-align:justify;\">Pewarna alami indigo, yang berasal dari tanaman Indigofera tinctoria, memberikan warna biru yang khas dan tahan lama. Proses pewarnaan ini tidak hanya ramah lingkungan, tetapi juga mengurangi penggunaan bahan kimia berbahaya yang bisa mencemari lingkungan. Selain itu, penggunaan pewarna alami juga mendukung keberlanjutan, yang sangat penting dalam era modern ini yang semakin peduli pada isu lingkungan (<a href=\"https://www.fibre2fashion.com/\"><i>Fibre2Fashion, 2024</i></a>).</p><p style=\"text-align:justify;\">Pewarna indigo memiliki kelebihan lain, yakni memberikan warna yang lebih dalam dan eksklusif pada kain Sasirangan. Proses pewarnaan alami ini melibatkan beberapa tahap, mulai dari ekstraksi daun indigo hingga pencelupan kain secara berulang hingga mendapatkan intensitas warna yang diinginkan. Warna biru alami ini memberikan sentuhan estetika yang unik pada Sasirangan, sekaligus melestarikan warisan budaya lokal Kalimantan Selatan (<a href=\"https://www.ecotextile.com/\"><i>Eco Textile, 2024</i></a>).</p><p style=\"text-align:justify;\"><span style=\"background-color:rgb(255,255,255);color:rgb(32,32,32);\">Melalui pemakaian pewarna alami, Sasirangan tidak hanya mempertahankan tradisi, tetapi juga mendukung praktik yang lebih ramah lingkungan. Sasirangan dengan pewarna alami indigo telah menjadi simbol keberlanjutan yang menggabungkan kekayaan budaya dengan kepedulian terhadap alam, menjadikannya pilihan yang tepat bagi mereka yang mencari produk yang tidak hanya indah tetapi juga beretika (</span><a href=\"https://www.goodnewsfromindonesia.id/\"><i>Good News From Indonesia, 2024</i></a><span style=\"background-color:rgb(255,255,255);color:rgb(32,32,32);\">).</span></p>', '1750133498_sasirangan_dan_pewarna_alami_indigo.png', 'Galyna Heiwa', 'Tanah Laut', '2024-12-01', '2025-06-17 04:11:38', '2025-06-17 04:25:49'),
(4, 'Sasirangan Indigo: Warisan Budaya yang Berkelanjutan', 'sasirangan_indigo_warisan_budaya_yang_berkelanjutan', '<p style=\"text-align:justify;\">Sasirangan dengan pewarna alami indigo adalah contoh sempurna dari warisan budaya Kalimantan Selatan yang berkelanjutan. Penggunaan pewarna alami pada kain Sasirangan bukan hanya tentang melestarikan tradisi, tetapi juga mengenai keberlanjutan lingkungan. Pewarna alami indigo memberikan sentuhan estetika yang khas dan mendalam, sementara proses pewarnaan yang ramah lingkungan mendukung upaya global dalam menjaga keseimbangan alam <i>(</i><a href=\"https://www.goodnewsfromindonesia.id/\"><i>Good News From Indonesia, 2024</i></a><i>)</i>.</p><p style=\"text-align:justify;\">Pewarna alami memiliki kelebihan yang tidak dimiliki oleh pewarna sintetis, seperti ramah lingkungan dan bebas dari bahan kimia berbahaya. Penggunaan indigo sebagai pewarna alami memberikan warna biru yang khas pada Sasirangan, sekaligus mengurangi dampak negatif terhadap ekosistem. Selain itu, produk yang dihasilkan memiliki nilai tambah, karena mengusung konsep keberlanjutan dan kepedulian terhadap lingkungan <i>(</i><a href=\"https://www.fibre2fashion.com/\"><i>Fibre2Fashion, 2024</i></a><i>)</i>.</p><p style=\"text-align:justify;\">Sasirangan indigo juga memiliki potensi untuk berkembang di pasar global, terutama dengan meningkatnya kesadaran akan pentingnya mode berkelanjutan. Dengan strategi pemasaran yang tepat, seperti menceritakan proses pewarnaan alami dan nilai budaya yang terkandung dalam setiap motif, Sasirangan bisa dikenal sebagai produk tekstil yang tidak hanya indah tetapi juga etis <i>(</i><a href=\"https://thedharmadoor.com/blogs/the-dharma-door-blog/\"><i>The Dharma Door, 2024</i></a><i>)</i>.</p><p style=\"text-align:justify;\">Melalui penggunaan pewarna alami indigo, Sasirangan tetap menjadi simbol budaya yang kuat sekaligus berkontribusi pada pelestarian lingkungan. Sasirangan dengan pewarna alami bukan hanya pilihan fashion, tetapi juga pilihan yang penuh makna bagi konsumen yang peduli terhadap keberlanjutan dan keberagaman budaya <a href=\"https://www.ecotextile.com/\"><i>(Eco Textile, 2024)</i></a>.</p>', '1750133907_sasirangan_indigo_warisan_budaya_yang_berkelanjutan.png', 'Galyna Heiwa', 'Tanah Laut', '2025-02-14', '2025-06-17 04:18:27', '2025-06-17 04:18:27'),
(5, 'Yankumham Begawi: Sosialisasi Kekayaan Intelektual dan PT Perseorangan di Kalimantan Selatan', 'yankumham_begawi_sosialisasi_kekayaan_intelektual_dan_pt_perseorangan_di_kalimantan_selatan', '<p style=\"text-align:justify;\">Banjarmasin, 2024 - Acara <i>Yankumham Begawi</i> sukses diselenggarakan di Hotel Internasional Banjarmasin, Kalimantan Selatan. Kegiatan ini bertujuan untuk meningkatkan pemahaman masyarakat tentang kekayaan intelektual dan tata kelola Perseroan Terbatas (PT) Perseorangan, khususnya di kalangan pelaku UMKM.</p><p style=\"text-align:justify;\">Dengan tema <i>Kesetaraan dan Inklusi: Bersama Membangun Industri Kreatif yang Inklusif Mendukung Kemajuan UMKM di Kalimantan Selatan</i>, acara ini menghadirkan sejumlah narasumber ahli. Salah satu narasumber utama adalah Ibu Hanik Timur Permata, yang memberikan materi penting mengenai kewajiban pajak bagi PT Perseorangan.</p><p style=\"text-align:justify;\">Dalam pemaparannya, Ibu Hanik menjelaskan pentingnya pemenuhan kewajiban pajak sebagai salah satu aspek legalitas dan keberlanjutan usaha bagi PT Perseorangan. Ia juga memberikan panduan praktis tentang prosedur pelaporan pajak serta manfaat yang dapat dirasakan pelaku usaha ketika taat terhadap regulasi perpajakan.</p><p style=\"text-align:justify;\">Peserta yang hadir, terdiri dari pelaku usaha, akademisi, hingga pemerintah daerah, menyambut antusias diskusi interaktif yang disampaikan. Acara ini diharapkan mampu mendorong pelaku UMKM di Kalimantan Selatan untuk lebih melek hukum dan memahami pentingnya pengelolaan usaha yang inklusif, kreatif, dan berbasis hukum.</p><p style=\"text-align:justify;\">Dengan berakhirnya kegiatan ini, diharapkan Kalimantan Selatan dapat semakin maju dalam pengembangan sektor UMKM dan industri kreatif, sejalan dengan visi Yankumham untuk mendukung penguatan legalitas usaha di daerah</p>', '1750134265_yankumham_begawi_sosialisasi_kekayaan_intelektual_dan_pt_perseorangan_di_kalimantan_selatan.png', 'Galyna Heiwa', 'Banjarmasin, Gedung HBI', '2025-01-03', '2025-06-17 04:24:25', '2025-06-17 04:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `article_image`
--

CREATE TABLE `article_image` (
  `id_article_image` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_article` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'kain', 'kain premium berbagai motif', '2025-05-28 01:03:22', '2025-05-28 01:03:22'),
(3, 'Full set', 'Set Blue Indigo Sasirangan', '2025-06-12 18:34:09', '2025-06-12 18:34:09'),
(5, 'T-Shirt', 'Outer Sasirangan', '2025-06-17 01:11:18', '2025-06-17 01:11:18'),
(6, 'Muslim Fashion', 'Prayer Gown', '2025-06-17 01:14:28', '2025-06-17 01:14:28'),
(7, 'Blazer', 'Blazer Sasirangan', '2025-06-17 03:08:17', '2025-06-17 03:08:17'),
(8, 'Scraf', 'Scarf Sasirangan', '2025-06-17 03:13:53', '2025-06-17 03:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id_link` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id_link`, `name`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Galyna Heiwa', 'https://www.karyakreatifindonesia.co.id/umkm/galyna-heiwa', '2025-06-13 03:39:23', '2025-06-13 03:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_11_08_203912_create_category_table', 1),
(3, '2024_11_09_101618_create_product_table', 1),
(4, '2024_11_27_130153_create_article_table', 1),
(5, '2024_11_27_130229_create_product_image_table', 1),
(6, '2024_11_27_130300_create_article_image_table', 1),
(7, '2024_11_28_095023_create_link_table', 1),
(8, '2025_02_05_080247_create_table_order', 1),
(9, '2025_05_25_145353_create_posts_table', 1),
(10, '2025_05_26_203927_add_foreign_keys_to_cart_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `id_user` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `courier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_cost` int DEFAULT '0',
  `estimated_day` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `name`, `email`, `phone`, `address`, `message`, `status`, `id_user`, `id_product`, `quantity`, `total`, `courier`, `delivery_cost`, `estimated_day`, `code`, `transaction_token`, `created_at`, `updated_at`) VALUES
(26, 'Imelda Aryani', 'imelda.aryani@mhs.politala.ac.id', '081349445267', 'BASIRIH, BANJARMASIN BARAT, BANJARMASIN, KALIMANTAN SELATAN, 70245', 'saya mau ini pakai daun pisang ya bungkusnya', 'paid', 7, 4, 1, 300000, 'jne', 12000, '1 day', 'ORD-TY9FB4HU', '', '2025-07-04 15:22:09', '2025-07-05 06:04:37'),
(27, 'Dian Lucky', 'dianlucky13@gmail.com', '081349445267', 'BASIRIH, BANJARMASIN BARAT, BANJARMASIN, KALIMANTAN SELATAN, 70245', 'testinggg', 'paid', 7, 9, 1, 100000, 'jne', 12000, '1 day', 'ORD-ZXPNL5HT', '', '2025-07-04 16:58:58', '2025-07-04 17:12:38'),
(28, 'Dian Lucky', 'dianlucky13@gmail.com', '081349445267', 'BASIRIH, BANJARMASIN BARAT, BANJARMASIN, KALIMANTAN SELATAN, 70245', 'testtt', 'paid', 7, 5, 2, 400000, 'jne', 12000, '1 day', 'ORD-DITB952S', '', '2025-07-04 16:59:28', '2025-07-04 17:12:38'),
(29, 'imelda aryani', 'imelda.aryani@mhs.politala.ac.id', '081349445267', 'BASIRIH SELATAN, BANJARMASIN SELATAN, BANJARMASIN, KALIMANTAN SELATAN, 70245', 'testingggg', 'paid', 14, 6, 1, 350000, 'jne', 12000, '1 day', 'ORD-F8CD7JVA', '', '2025-07-06 18:43:09', '2025-07-06 18:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `rating` int NOT NULL DEFAULT '0',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_new` int NOT NULL DEFAULT '0',
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `description`, `rating`, `code`, `is_new`, `cover_image`, `price`, `id_category`, `created_at`, `updated_at`) VALUES
(4, 'Set Blue Indigo Sasirangan', '<p style=\"text-align:justify;\">Hadirkan keindahan budaya lokal dalam gaya modern dengan <strong>Set Blue Indigo Sasirangan</strong>, koleksi eksklusif yang memadukan warna biru indigo yang elegan dengan motif khas sasirangan dari Kalimantan Selatan. Set ini terdiri dari atasan dan bawahan yang dirancang untuk memberikan kenyamanan dan fleksibilitas dalam berbagai kesempatan.</p><p style=\"text-align:justify;\">Dibuat dari bahan berkualitas premium, set ini nyaman digunakan sepanjang hari dan memberikan kesan anggun dan memikat. Warna biru indigo yang menenangkan dipadukan dengan pola sasirangan yang unik menciptakan kesan istimewa, baik untuk acara formal maupun kasual.</p><p style=\"text-align:justify;\">Tampil menawan dan bangga dengan warisan budaya lokal bersama <strong>Set Blue Indigo Sasirangan</strong> – sempurna untuk Anda yang ingin tampil berbeda dan berkelas.</p>', 0, 'set_blue_indigo_sasirangan', 1, '1749778198_set_blue_indigo_sasirangan.png', 300000, 3, '2025-06-13 01:29:58', '2025-06-13 01:29:58'),
(5, 'Outer Sasirangan Modern', '<p style=\"text-align:justify;\">Lengkapi gaya Anda dengan <strong>Outer Sasirangan Modern</strong>, pilihan sempurna untuk tampilan yang kasual sekaligus elegan. Dengan motif khas sasirangan asli Kalimantan Selatan, outer ini memberikan sentuhan budaya lokal yang memikat dalam desain yang modern dan stylish.</p><p style=\"text-align:justify;\">Terbuat dari bahan ringan dan nyaman, outer ini cocok digunakan sebagai pelengkap berbagai jenis pakaian, mulai dari kaos hingga dress. Pilihan sempurna untuk menghadiri acara santai, berkumpul bersama teman, atau bahkan untuk acara semi-formal.</p><p style=\"text-align:justify;\"><strong>Outer Sasirangan Modern</strong> hadir sebagai simbol kebanggaan terhadap budaya Indonesia sekaligus memberikan fleksibilitas bagi Anda yang ingin tampil memikat tanpa mengorbankan kenyamanan. Jadikan outer ini bagian dari koleksi fashion Anda!</p>', 0, 'outer_sasirangan_modern', 1, '1750122800_outer_sasirangan_modern.png', 200000, 5, '2025-06-17 01:13:20', '2025-06-17 01:13:20'),
(6, 'Indigo Sasirangan Prayer Gown', '<p style=\"text-align:justify;\">Hadirkan kesyahduan dalam ibadah dengan <span style=\"background-color:rgb(230,230,77);\"><i>prayer gown</i></span> atau mukena cantik berwarna biru indigo, terinspirasi dari keindahan budaya Kalimantan Selatan. Bermotif khas sasirangan yang elegan, mukena ini menggabungkan unsur tradisional dan modern untuk menciptakan kenyamanan sekaligus keindahan saat digunakan.</p><p style=\"text-align:justify;\">Dibuat dari bahan berkualitas tinggi, mukena ini ringan, sejuk, dan mudah dilipat, cocok untuk penggunaan sehari-hari maupun bepergian. Warna biru indigo memberikan nuansa tenang dan menenangkan hati, sementara motif sasirangan yang unik menjadikannya istimewa dan penuh makna budaya.</p><p style=\"text-align:justify;\">Pilih Indigo Sasirangan Prayer Gown untuk melengkapi ibadah Anda dengan gaya yang anggun dan sentuhan kearifan lokal.</p>', 0, 'indigo_sasirangan_prayer_gown', 1, '1750122937_indigo_sasirangan_prayer_gown.png', 350000, 6, '2025-06-17 01:15:37', '2025-06-17 01:15:37'),
(7, 'Blazer Sasirangan Elegan', '<p style=\"text-align:justify;\">Tampilkan gaya profesional yang memancarkan kearifan lokal dengan <strong>Blazer Sasirangan</strong>. Blazer ini dirancang dengan motif khas sasirangan dari Kalimantan Selatan, memadukan unsur budaya dengan desain modern yang elegan.</p><p style=\"text-align:justify;\">Terbuat dari bahan berkualitas tinggi yang nyaman dipakai, blazer ini cocok digunakan untuk acara formal, pertemuan bisnis, atau sekadar melengkapi gaya santai namun tetap berkelas. Motif sasirangan yang autentik memberikan sentuhan unik, menjadikan blazer ini pilihan sempurna bagi Anda yang ingin tampil beda sekaligus melestarikan budaya.</p><p style=\"text-align:justify;\">Kenakan <strong>Blazer Sasirangan Elegan</strong> untuk menonjolkan karakter Anda yang percaya diri, anggun, dan bangga dengan warisan budaya Nusantara.</p>', 0, 'blazer_sasirangan_elegan', 1, '1750129777_blazer_sasirangan_elegan.png', 250000, 7, '2025-06-17 03:09:37', '2025-06-17 03:09:37'),
(8, 'Blazer Sasirangan Embrodier', '<p style=\"text-align:justify;\">Blazer Sasirangan Embordier ini merupakan perpaduan elegan antara motif tradisional khas Kalimantan Selatan dan sentuhan modern dengan teknik bordir yang mewah. Terbuat dari kain sasirangan eksklusif berwarna <strong>blue indigo</strong> yang diolah dengan teknik <strong>ecoprint</strong>, blazer ini menampilkan motif alami yang ramah lingkungan dan unik di setiap desainnya.</p><p style=\"text-align:justify;\">Didesain untuk memberikan kesan profesional sekaligus stylish, blazer ini cocok digunakan untuk acara formal maupun semi-formal. Potongan modernnya nyaman dipakai, dilengkapi dengan detail bordir yang memperkaya estetika busana. Dengan bahan berkualitas tinggi dan pewarnaan alami, blazer ini tidak hanya melestarikan budaya lokal tetapi juga mendukung mode yang berkelanjutan.</p><p style=\"text-align:justify;\"><strong>Keunggulan Produk:</strong></p><ul><li>-Motif <strong>ecoprint</strong> dengan pewarna alami.</li><li>-Kombinasi bordir detail yang menonjolkan kemewahan.</li><li>-Warna <strong>blue indigo</strong> yang elegan dan universal.</li><li>-Ramah lingkungan dan bernilai budaya tinggi.</li></ul><p style=\"text-align:justify;\">Pilih <strong>Blazer Sasirangan Embordier Blue Indigo Ecoprint</strong> untuk tampil percaya diri dengan gaya yang memadukan tradisi dan modernitas.</p>', 0, 'blazer_sasirangan_embrodier', 1, '1750129899_blazer_sasirangan_embrodier.png', 250000, 7, '2025-06-17 03:11:39', '2025-06-17 03:11:39'),
(9, 'GH01-1 SET', '<p style=\"text-align:justify;\"><strong>GH 01-1 Set (Scarf, Vest, Blouse, Obi, Skirt)</strong> adalah pilihan busana yang memadukan keanggunan dan kenyamanan dalam satu set lengkap. Didesain dengan sentuhan modern, set ini mengusung motif sasirangan yang kaya akan budaya, memberikan kesan unik dan elegan dalam setiap kesempatan.</p><p style=\"text-align:justify;\">Terbuat dari bahan <strong>Cotton dan Knitting</strong> berkualitas tinggi, set ini memastikan kenyamanan maksimal sepanjang hari. Dengan ukuran <strong>M fit to L</strong>, set ini cocok untuk berbagai bentuk tubuh, memberikan kesan anggun namun tetap santai. Set ini terdiri dari scarf, vest, blouse, obi, dan skirt, yang dapat dipadukan sesuai selera untuk menciptakan tampilan yang sempurna.</p>', 0, 'gh01_1_set', 0, '1750129982_gh01_1_set.png', 100000, 1, '2025-06-17 03:13:02', '2025-06-17 03:13:02'),
(10, 'Scarf Sasirangan', '<p style=\"text-align:justify;\"><strong>Scarf Sasirangan Motif Natural Colour</strong> adalah aksesori yang memadukan keindahan motif tradisional dengan kesan elegan dan modern. Dengan ukuran <strong>150 cm x 50 cm</strong>, scarf ini memberikan keleluasaan dalam penggunaannya, baik sebagai pelengkap busana maupun penambah kesan anggun pada penampilan Anda.</p><p style=\"text-align:justify;\">Mengusung motif sasirangan dengan warna alami, scarf ini menonjolkan kekayaan budaya lokal Kalimantan Selatan yang dipadukan dengan warna-warna natural yang menenangkan. Terbuat dari bahan berkualitas tinggi, scarf ini tidak hanya nyaman digunakan, tetapi juga menambah kesan elegan dan penuh karakter dalam setiap gaya Anda.</p><p style=\"text-align:justify;\">Tampil lebih istimewa dengan <strong>Scarf Sasirangan Motif Natural Colour</strong>, pilihan sempurna untuk Anda yang ingin menghadirkan sentuhan budaya dalam tampilan sehari-hari.</p>', 0, 'scarf_sasirangan', 1, '1750130107_scarf_sasirangan.png', 100000, 1, '2025-06-17 03:15:07', '2025-06-17 03:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id_product_image` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$7rKvbJVfOir1SQ/ujPEZv.aQwSOQSarJ3gKXPtexwy2HdaYw6645W', 'admin', '2025-05-28 00:47:57', '2025-06-29 12:56:35'),
(2, 'rena', 'reina.kirei@gmail.com', '$2y$12$sid6ABU85vkRqpvOpBXQKO4o/kLuuv9Np7kOfe0izvQ2LL2r3Q4Em', 'user', '2025-05-28 01:04:01', '2025-05-28 01:04:22'),
(3, 'imel', 'meliblossom17@gmail.com', '$2y$12$C/gnCGexJrVwWNfDzWCf4.bh4UuBdOk2jaDXjPCyhRM7FyESMz/oO', 'admin', '2025-05-28 05:38:23', '2025-05-28 05:44:10'),
(5, 'Imelda Aryani', 'imelda17aryani17@gmail.com', '$2y$12$edLzRvdj2wdZopaErCy0Net9lTbE0wUv9i.XX678fLF/P634qNpTm', 'user', '2025-06-03 03:16:01', '2025-06-03 03:18:04'),
(7, 'customer123', 'customer@gmail.com', '$2y$12$8lovMRucnowyh7mjXSXzRueOGIxB7IxDqlKgHx0djk21qwoupC3Fq', 'user', '2025-06-27 16:10:18', '2025-06-27 16:11:39'),
(8, 'testing', 'testing@gmail.com', '$2y$10$i5gsaLI.nBGFQA3TMIwmouv4tc2QmhK/6Qbue5wYEe7op6XhK4w0q', 'user', '2025-07-04 05:46:36', '2025-07-04 05:46:36'),
(9, 'testingcode', 'testingcode@gmail.com', '$2y$10$T.Am67bRG6RJ0w9yAaJ.Bu8SG3VuqDvNbOdn27//z0RDuB/JUrOtG', 'user', '2025-07-04 05:50:02', '2025-07-04 05:50:02'),
(10, 'test', 'test@gmail.com', '$2y$10$KdxYtq/l861kqn4cJvhwV.4wUoh0KPLax0gQUy6l3vLa17udY.fy2', 'user', '2025-07-04 05:52:52', '2025-07-04 05:52:52'),
(11, 'testing', 'tessss@gmail.com', '$2y$10$ZSUYHiIf13KobyPAdHKEUO6tC6nZrnptAzawANULHt5wr0EOf84uu', 'user', '2025-07-06 12:18:46', '2025-07-06 12:18:46'),
(12, 'dian', 'dian@gmail.com', '$2y$10$RPA.tX/oFUSCiuLMJfef3OMF1Her5KoOhp9BEk2ykzugcs9KALVhG', 'user', '2025-07-06 12:26:23', '2025-07-06 12:26:23'),
(14, 'Imelda Aryani', 'imelda.aryani@mhs.politala.ac.id', '$2y$12$NpARsMBJN5jnyS17fQ8qxOUeUyxGE3iPxgyY.f64YXM0mdvZGXFGW', 'user', '2025-07-06 18:41:00', '2025-07-06 18:42:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `article_title_unique` (`title`),
  ADD UNIQUE KEY `article_slug_unique` (`slug`);

--
-- Indexes for table `article_image`
--
ALTER TABLE `article_image`
  ADD PRIMARY KEY (`id_article_image`),
  ADD KEY `article_image_id_article_foreign` (`id_article`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id_link`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `order_id_user_foreign` (`id_user`),
  ADD KEY `order_id_product_foreign` (`id_product`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `product_name_unique` (`name`),
  ADD UNIQUE KEY `product_code_unique` (`code`),
  ADD KEY `product_id_category_foreign` (`id_category`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id_product_image`),
  ADD KEY `product_image_id_product_foreign` (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `article_image`
--
ALTER TABLE `article_image`
  MODIFY `id_article_image` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id_link` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id_product_image` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_image`
--
ALTER TABLE `article_image`
  ADD CONSTRAINT `article_image_id_article_foreign` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
