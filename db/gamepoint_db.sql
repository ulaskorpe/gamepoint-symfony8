-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2026 at 11:17 AM
-- Server version: 11.8.6-MariaDB-6 from Debian
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamepoint_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(31, 'minus ducimus rerum', 'Et dolores doloremque nihil aliquam ut aut vel. Repudiandae ex odit odit neque. Quam ut quis qui vel.'),
(32, 'rem sint esse', 'Soluta ab eveniet aut quaerat repellat reiciendis. Ab nihil a velit reiciendis dolores dolor. Magnam est ut ea consequatur ipsum blanditiis possimus.'),
(33, 'distinctio nisi est', 'Quo sed nemo voluptates vel. Distinctio ut cum reprehenderit enim est. Sequi dolores alias quis qui ipsum.'),
(34, 'non beatae in', 'Molestiae libero reprehenderit porro. Ad rerum suscipit placeat aut et. Debitis inventore debitis reprehenderit totam nesciunt perspiciatis.'),
(35, 'repellendus expedita animi', 'Officia nesciunt aliquid dolorum ad illo magnam ea. Id occaecati facere laboriosam explicabo consequatur porro. Minima quam ab eos voluptatum.'),
(36, 'aut molestiae molestiae', 'Quidem nihil est quod quibusdam sint. Quaerat sapiente officia eveniet. Sed provident culpa porro quia doloremque iusto.'),
(37, 'perspiciatis et dolorem', 'Quaerat animi quibusdam vero blanditiis. Assumenda et qui ut fugit totam aspernatur nemo. Ullam quod distinctio eaque quia perferendis.'),
(38, 'neque et occaecati', 'Porro expedita consequuntur quas repellendus esse aut esse facere. Qui neque qui qui reprehenderit. Voluptatem sed maxime aliquid facilis est impedit autem.'),
(39, 'consectetur maiores vitae', 'Qui eligendi libero voluptatum expedita est non veritatis. Autem vero in non dolore excepturi delectus nihil. Ut veritatis rerum qui iste.'),
(40, 'ut ipsa rem', 'Quia facilis libero molestiae ratione sed officia. Quae nemo possimus officia non delectus. Cum delectus reiciendis sed est ducimus non.');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260508143746', '2026-05-08 14:38:15', 643),
('DoctrineMigrations\\Version20260508143953', '2026-05-08 14:40:04', 93),
('DoctrineMigrations\\Version20260509130606', '2026-05-09 13:06:14', 523),
('DoctrineMigrations\\Version20260509141521', '2026-05-09 14:16:06', 175),
('DoctrineMigrations\\Version20260515101514', '2026-05-15 10:15:33', 176),
('DoctrineMigrations\\Version20260515102402', '2026-05-15 10:24:11', 200),
('DoctrineMigrations\\Version20260515144949', '2026-05-15 14:50:01', 92);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `title`, `description`, `image`, `category_id`) VALUES
(41, 'et a voluptatem', 'Ratione fuga animi id.', 'https://picsum.photos/640/480?random=8319', 36),
(42, 'odio magnam deserunt', 'Excepturi dolor quod autem reiciendis id.', 'https://picsum.photos/640/480?random=43', 38),
(43, 'omnis ipsam quo', 'Molestiae in et itaque qui id est.', 'https://picsum.photos/640/480?random=3364', 31),
(44, 'quos aut delectus', 'Odio sint a voluptates veniam facere et.', 'https://picsum.photos/640/480?random=8185', 33),
(45, 'mollitia molestiae tempore', 'Aliquid ut debitis distinctio et.', 'https://picsum.photos/640/480?random=6858', 38),
(46, 'molestiae distinctio facilis', 'Dolore impedit in qui.', 'https://picsum.photos/640/480?random=243', 37),
(47, 'omnis et ab', 'Et dolore deserunt est.', 'https://picsum.photos/640/480?random=3176', 38),
(48, 'aut sunt molestias', 'Quas sint et velit repellendus error voluptate saepe.', 'https://picsum.photos/640/480?random=8140', 35),
(49, 'commodi libero id', 'Consequatur vel fugiat voluptas rerum error est minima sit.', 'https://picsum.photos/640/480?random=313', 36),
(50, 'officiis nostrum corrupti', 'Iure inventore at fugit doloremque voluptates et.', 'https://picsum.photos/640/480?random=7952', 36),
(51, 'praesentium quo ullam', 'Nam consequatur et voluptatem ipsam dolorem vel.', 'https://picsum.photos/640/480?random=5897', 32),
(52, 'fugiat sed beatae', 'Placeat rem laborum eaque in.', 'https://picsum.photos/640/480?random=9188', 31),
(53, 'ratione aut asperiores', 'Beatae nihil ut harum repudiandae.', 'https://picsum.photos/640/480?random=3626', 32),
(54, 'tenetur excepturi eos', 'Inventore dolores ducimus enim ut quia doloremque non.', 'https://picsum.photos/640/480?random=5544', 31),
(55, 'quo quis voluptate', 'Repudiandae repellat et et nam.', 'https://picsum.photos/640/480?random=4152', 39),
(56, 'minima ipsa molestiae', 'Dignissimos temporibus accusantium cum et et non.', 'https://picsum.photos/640/480?random=9648', 36),
(57, 'quo quisquam soluta', 'Labore accusantium fugit iusto aperiam sed nemo.', 'https://picsum.photos/640/480?random=9991', 34),
(58, 'placeat non sit', 'Sequi explicabo debitis consequatur ipsa nam magni iste.', 'https://picsum.photos/640/480?random=1470', 33),
(59, 'non mollitia minus', 'Iste qui sint dolore nam.', 'https://picsum.photos/640/480?random=3526', 35),
(60, 'rem veritatis in', 'Facilis adipisci sint temporibus.', 'https://picsum.photos/640/480?random=6437', 36);

-- --------------------------------------------------------

--
-- Table structure for table `sys_log`
--

CREATE TABLE `sys_log` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `data` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sys_log`
--

INSERT INTO `sys_log` (`id`, `title`, `type`, `data`, `created_at`, `updated_at`) VALUES
(1, 'Technical kayıt oluşturuldu', 'technical.create', '20,dfasdf', '2026-05-15 12:03:18', NULL),
(2, 'Technical kayıt oluşturuldu', 'technical.create', '21,transport', '2026-05-16 08:45:04', '2026-05-16 08:45:04'),
(3, 'Technical kayıt oluşturuldu', 'technical.create', '22,async queue', '2026-05-16 08:47:39', '2026-05-16 08:47:39'),
(4, 'Technical kayıt oluşturuldu', 'technical.create', '23,DTO - data transfer obj', '2026-05-16 12:59:43', '2026-05-16 12:59:43'),
(5, 'Technical kayıt oluşturuldu', 'technical.create', '24,DB transaction', '2026-05-17 09:42:19', '2026-05-17 09:42:19'),
(6, 'Technical kayıt oluşturuldu', 'technical.create', '25,tranpiler - js (babel)', '2026-05-17 12:05:36', '2026-05-17 12:05:36'),
(7, 'Technical kayıt oluşturuldu', 'technical.create', '26,hoist', '2026-05-19 10:00:09', '2026-05-19 10:00:09'),
(8, 'Technical kayıt oluşturuldu', 'technical.create', '27,stateles token', '2026-05-19 10:18:16', '2026-05-19 10:18:16'),
(9, 'Technical kayıt oluşturuldu', 'technical.create', '28,stateful auth', '2026-05-19 10:18:35', '2026-05-19 10:18:35'),
(10, 'Technical kayıt oluşturuldu', 'technical.create', '29,REST vs Graph', '2026-05-19 10:19:02', '2026-05-19 10:19:02'),
(11, 'Technical kayıt oluşturuldu', 'technical.create', '30,DOM (Document Object Model)', '2026-05-19 11:47:26', '2026-05-19 11:47:26'),
(12, 'Technical kayıt oluşturuldu', 'technical.create', '31,MYSQL', '2026-05-19 12:30:56', '2026-05-19 12:30:56'),
(13, 'Technical kayıt oluşturuldu', 'technical.create', '32,NoSQL', '2026-05-19 12:45:42', '2026-05-19 12:45:42'),
(14, 'Technical kayıt oluşturuldu', 'technical.create', '33,ACID', '2026-05-19 12:46:10', '2026-05-19 12:46:10'),
(15, 'Technical kayıt oluşturuldu', 'technical.create', '34,BASE Modeli (Esnek Tutarlılık)', '2026-05-19 12:47:03', '2026-05-19 12:47:03'),
(16, 'Technical kayıt oluşturuldu', 'technical.create', '35,Reaktif veri', '2026-05-19 12:59:34', '2026-05-19 12:59:34'),
(17, 'Technical kayıt oluşturuldu', 'technical.create', '36,Computed vs Watch', '2026-05-19 13:08:34', '2026-05-19 13:08:34'),
(18, 'Technical kayıt oluşturuldu', 'technical.create', '37,reactive', '2026-05-19 13:16:38', '2026-05-19 13:16:38'),
(19, 'Technical kayıt oluşturuldu', 'technical.create', '38,promise', '2026-05-19 13:29:08', '2026-05-19 13:29:08'),
(20, 'Technical kayıt oluşturuldu', 'technical.create', '39,callback', '2026-05-19 13:38:40', '2026-05-19 13:38:40'),
(21, 'Technical kayıt oluşturuldu', 'technical.create', '40,OOP principles', '2026-05-19 14:30:11', '2026-05-19 14:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `technical`
--

CREATE TABLE `technical` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `code` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technical`
--

INSERT INTO `technical` (`id`, `title`, `description`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'asdfdsfsdfafasdfasdfasdf', 'asdfasdfasd', 'asdfasdf', '2026-05-15 11:13:12', '2026-05-15 11:13:44', '2026-05-15 11:13:16'),
(3, 'afsdf', 'asdfasdfsadf', 'sdfasdf', '2026-05-15 11:18:51', '2026-05-15 11:18:51', '2026-05-15 11:18:54'),
(4, 'Services  - containers', 'A service is a reusable class that contains application logic and is managed by Symfony’s service container.  Reuseable \nSymfony’s service container is responsible for creating and managing application services and their dependencies. Autowiring automatically injects dependencies based on constructor type hints, reducing manual object creation and coupling.', NULL, '2026-05-15 11:46:40', '2026-05-15 12:07:39', NULL),
(5, 'clean code', 'thin controllers , biznis logic in service , queue for heavy task ,  validation layers , seperation of entities .  Documentation  & annotations \nI prefer keeping controlers thin, biz logic in services , seperate validation to async jobs keep codebase maintable and easier to debug or test ; naming notation is important  to be readable ,\nreusable and modular structures to reduce dublicated code', NULL, '2026-05-15 12:08:33', '2026-05-15 12:08:33', NULL),
(6, 'maintability', 'is not simply dev-prod segration  ,  if in 2yrs smo else  can understand and develop easily \nGood documentation improves maintainability and onboarding.', NULL, '2026-05-15 12:08:57', '2026-05-15 12:08:57', NULL),
(7, 'scalablity', 'sys s ability to handle increasing traffic without a major change . User 100>> 10000 performance down , use queue  for heavy works', 'Ölçeklenebilir (Scalable) Yazılım & Yüksek Trafik Yönetimi\n\nÖlçeklenebilirlik (Scalability)\n- Tanım: Sistemin artan yükü karşılayabilmesi.\n- Yatay Ölçeklendirme (Horizontal Scaling): Yeni sunucular ekle (load balancing).\n- Dikey Ölçeklendirme (Vertical Scaling): Mevcut sunucuyu güçlendir (CPU, RAM).\n\nYüksek Trafik Yönetimi\n1. Load Balancing (Yük Dengeleme)\n    - Gelen trafiği birden fazla sunucuya dağıt.\n    - Tools: Nginx, HAProxy.\n\n2. Caching (Önbellekleme)\n    - Sık kullanılan verileri cache\'le (Redis, Memcached).\n    - Statik içerik için CDN kullan (Cloudflare, Akamai).\n\n3. Database Optimizasyonu\n    - Indexing: Sorguları hızlandır.\n    - Sharding: Veritabanını böl (horizontal partitioning).\n    - Read Replicas: Okuma işlemlerini dağıt.\n\n4. Asynchronous İşlemler (Queue Systems)\n    - Uzun işlemleri kuyruğa al (RabbitMQ, Kafka).\n    - Kullanıcıya hızlı yanıt ver, işlemi arka planda yap.\n\n5. Microservices Arşitektürü\n    - Sistemi küçük, bağımsız servisler olarak tasarla.\n    - Her servis ayrı ölçeklenebilir.\n\n6. Monitoring & Auto Scaling\n    - Sistemi izle (Prometheus, Grafana).\n    - Otomatik ölçeklendirme kullan (AWS Auto Scaling, Kubernetes HPA).\n\nÖnemli Not\n- Test Et: Ölçeklenebilirliği test et (load testing).\n- Bottleneck Analizi: Daralan noktaları bul ve çöz.', '2026-05-15 12:09:08', '2026-05-21 09:46:19', NULL),
(8, 'autowiring', 'symfony can auto resolve and inject dependencies based on type hints. instead of manually creatingdependencies container manages them', 'public function __construct(\n    LoggerInterface $logger\n)', '2026-05-15 12:09:31', '2026-05-15 12:09:31', NULL),
(9, 'convention', 'team\'s common writing and structuring rules', NULL, '2026-05-15 12:10:00', '2026-05-15 12:10:00', NULL),
(10, 'consitency', 'maintaining the same approach throughout the project', 'consistency and coding standarts helps team maintain readability and reduce confision', '2026-05-15 12:10:17', '2026-05-15 12:10:55', NULL),
(11, 'coupling', 'low coupling  use I’s  DI and abstraction   . \nless dependend testable scaleable', 'LOW coupling  means ,  components are less dependent on each other which makes the sys easier to maintain test and extend', '2026-05-15 12:11:10', '2026-05-19 13:17:52', NULL),
(12, 'Feature test', 'test one process from side-to-side , scope can contain more than a class or model', NULL, '2026-05-15 12:11:34', '2026-05-15 12:11:34', NULL),
(13, 'unit test', 'purpose :  test only one function or class', NULL, '2026-05-15 12:12:07', '2026-05-15 12:12:07', NULL),
(14, 'MVP', 'minimum viable product , reduce risk learn fast', NULL, '2026-05-15 12:12:28', '2026-05-15 12:12:28', NULL),
(15, 'Load balance', 'in high trafic envs reqs typically distributed to multiple application servers behind a LB', NULL, '2026-05-15 12:12:46', '2026-05-15 12:12:46', NULL),
(16, 'High Traffic', '“Queues , db/sql optimization, payload reduction , load balance , caching , async functions”  \nFor high traffic applications, I think scalability and performance optimization are very important.', 'First, I prefer moving heavy or non critical operations into queues and background jobs. Async processing helps keep API responses fast and reduces the load during requests.\nI also focus on database optimization by improving SQL queries, adding proper indexes, selecting only the required fields, and avoiding unnecessary relations or large payloads in API responses.\nIn some cases, caching solutions like Redis can significantly reduce database load for frequently accessed data.', '2026-05-15 12:13:04', '2026-05-15 12:13:26', NULL),
(17, 'Interface', 'says, a class should have those functions and properties but doesnt tell how to \na class can have N interfaces', 'interface PublishableInterface\n{\n    public function publish(): void;\n}\n\n\nclass Article implements PublishableInterface\n{\n    public function publish(): void\n    {\n        echo \"Published\";\n    }\n}', '2026-05-15 12:28:22', '2026-05-15 12:28:22', NULL),
(18, 'Abstract Class', 'can not be instanced alone , but a class can extend from abstract class,  only one a-c  ,  \ncontains base functions a class must have . includes code. a class can have N traits , both prevents code dublication,', 'class Product extends BaseEntity implements SluggableInterface', '2026-05-15 12:30:52', '2026-05-15 12:35:56', NULL),
(19, 'dfasdf', 'fasdfasdf', NULL, '2026-05-15 14:59:51', '2026-05-15 14:59:51', '2026-05-15 15:03:39'),
(20, 'dfasdf', 'fasdfasdf', NULL, '2026-05-15 15:03:18', '2026-05-15 15:03:18', '2026-05-15 15:03:36'),
(21, 'transport', 'is delivery channel for messages ,  where to put messages so it can proceed later\nApp → Transport → Worker reads from transport', 'you send a message\ntransport stores it\nworker picks it up later', '2026-05-16 11:45:04', '2026-05-16 11:45:49', NULL),
(22, 'async queue', 'instead execute code immediately , you delay it \nsync ( normal )  : req > execute logic > response \nasync : req > store message ( worker process later ) > response immediatly', 'Why it matters:\nfaster API responses\nbackground processing\nbetter scalability\n\nExample:\n\nsending email\nlogging\nnotifications\nanalytics\nheavy calculations', '2026-05-16 11:47:39', '2026-05-16 11:47:39', NULL),
(23, 'DTO - data transfer obj', 'A simple object used to carry data between layers of an application.\nA DTO is a simple object used to transfer structured data between application layers. It isolates input/output data from the domain and persistence models, improving security, maintainability, and separation of concerns.', 'A DTO in Symfony is a simple data container used to transfer structured data between layers. Unlike Laravel FormRequest, it does not handle validation or lifecycle logic by itself. Validation in Symfony is handled separately using the Validator component or Form system. DTOs are mainly used to decouple API input from entities and improve architecture clarity.\n\n\nclass UserDTO\n{\n    #[Assert\\NotBlank]\n    #[Assert\\Length(min: 2, max: 50)]\n    public string $firstName;\n\n    #[Assert\\NotBlank]\n    #[Assert\\Length(min: 2, max: 50)]\n    public string $lastName;\n\n    #[Assert\\NotBlank]\n    #[Assert\\Email]\n    public string $email;\n\n    #[Assert\\NotBlank]\n    #[Assert\\Length(min: 6)]\n    public string $password;\n\n    public ?string $phone = null;\n\n    public bool $isActive = true;\n}', '2026-05-16 15:59:43', '2026-05-19 14:28:29', NULL),
(24, 'DB transaction', 'ya hepimiz ya hiç birimiz', 'use Illuminate\\Support\\Facades\\DB;\nuse Illuminate\\Support\\Facades\\Log;\nuse Exception;\n\npublic function storeMultipleData()\n{\n    try {\n        DB::transaction(function () {\n            \n            // 1. İşlem\n            $user = User::create([\n                \'name\' => \'Ahmet Yılmaz\',\n                \'email\' => \'ahmet@example.com\',\n            ]);\n\n            // 2. İşlem\n            $profile = Profile::create([\n                \'user_id\' => $user->id,\n                \'bio\' => \'Örnek biyografi\',\n                \'avatar\' => \'default.jpg\'\n            ]);\n\n            // 3. İşlem\n            $order = Order::create([\n                \'user_id\' => $user->id,\n                \'total\' => 999.99,\n                \'status\' => \'pending\'\n            ]);\n\n            // Daha fazla işlem ekleyebilirsiniz...\n            \n        });\n\n        return response()->json([\'message\' => \'Tüm işlemler başarılı\'], 201);\n\n    } catch (Exception $e) {\n        \n        // Hata loglama (detaylı)\n        Log::error(\'Transaction failed\', [\n            \'message\'   => $e->getMessage(),\n            \'code\'      => $e->getCode(),\n            \'file\'      => $e->getFile(),\n            \'line\'      => $e->getLine(),\n            \'trace\'     => $e->getTraceAsString(),\n        ]);\n\n        return response()->json([\n            \'message\' => \'İşlem sırasında hata oluştu, tüm değişiklikler geri alındı.\'\n        ], 500);\n    }\n}', '2026-05-17 12:42:19', '2026-05-17 12:42:19', NULL),
(25, 'tranpiler - js (babel)', 'A tool that converts code from one version of a language into another version of the same language.', '\"use strict\";\n\nvar add = function(a, b) {\n  return a + b;\n};\n\nvar User = function User(name) {\n  this.name = name;\n};\n\n\nReact / Vue code (ES6+)\n        ↓\nBabel transpiles\n        ↓\nWebpack / Vite bundles\n        ↓\nBrowser executes ES5-compatible JS', '2026-05-17 15:05:36', '2026-05-17 15:05:36', NULL),
(26, 'hoist', 'Hoisting is JavaScript’s behavior of registering declarations during the creation phase before execution starts. Variables declared with var are initialized with undefined, while let and const stay in the temporal dead zone until initialization.', 'Type	Hoisted	Initialized\nvar	yes	undefined\nlet	yes	no\nconst	yes	no\nfunction declaration	yes	full function\nfunction expression	variable only	undefined', '2026-05-19 13:00:09', '2026-05-19 13:01:13', NULL),
(27, 'stateles token', 'carries its own story , not kept in db , decoded by server includes user_id expiredate etc\nscaleable , no db work ,no logout', 'JWT (JSON Web Token), taraflar arasında JSON formatında bilgilerin güvenli ve doğrulanabilir bir şekilde aktarılmasını sağlayan açık bir endüstri standardıdır. Genellikle web ve mobil uygulamalarda kullanıcıların kimliğini doğrulamak (Authentication) ve yetkilendirmek için kullanılı', '2026-05-19 13:18:16', '2026-05-19 15:27:48', NULL),
(28, 'stateful auth', 'relies on serverside sessions stored in session or db  , login gives token , secure+ & control friendly', 'many real syss rly on hybrid', '2026-05-19 13:18:35', '2026-05-19 13:18:35', NULL),
(29, 'REST vs Graph', 'rest has multiple endpoints graph has one , rest is resource oriented , graph is query oriented  means  client  decides shape/content of data . Custom build response \nrest over-fetching / under-fetching , graph has n+1 problem  ( post : with user )  1 + N + N² apocalypse', NULL, '2026-05-19 13:19:02', '2026-05-19 13:19:02', NULL),
(30, 'DOM (Document Object Model)', 'Nasıl Çalışır? Tarayıcı, siteyi yüklediğinde tüm etiketleri (yazılar, resimler, butonlar) bir nesneye dönüştürür. JavaScript gibi diller bu ağacı kullanarak sitedeki yazıyı değiştirebilir, stil ekleyebilir veya yeni öğeler oluşturabilir.\nHTML ile Farkı: HTML dosyanız statik bir kaynak koddur; DOM ise tarayıcının belleğinde tutulan ve sürekli değişebilen dinamik nesne ağacıdır.\nKullanım Amacı: Dinamik bir web arayüzü yaratmak, animasyonlar yapmak ve sayfayı yenilemeden içerik güncellemek için kullanılır.', NULL, '2026-05-19 14:47:26', '2026-05-19 14:47:26', NULL),
(31, 'MYSQL', 'relational db management , MySQL’in içinde birden fazla Storage Engine (Depolama Motoru) bulunur.\nBunlar veriyi diskte nasıl saklayacağını, index’leyeceğini, transaction’ı nasıl yöneteceğini belirler.', NULL, '2026-05-19 15:30:56', '2026-05-19 15:30:56', NULL),
(32, 'NoSQL', 'not only sql kısaltması.  veri modeli . document-key , değişimlere esnek , genellikle no join , basit sorgular + yüksek trafikte hızlı . big data sm , realtime , log için iyi \nmongodb cassandra  \n\navantajları : yüksek scalable , yüksek crud performans , cluster sistemlerde daha iyi  geliştirme hızı yüksek', 'NoSQL Veritabanı Türleri\n\nDocument Database (En Popüler)\nVeriyi JSON/BSON benzeri doküman olarak saklar.\nÖrnek: MongoDB, Firebase Firestore\n\nKey-Value Store\nEn basit ve en hızlı tür.\nÖrnek: Redis, DynamoDB, Riak\n\nColumn Family / Wide Column\nÇok büyük veri ve yazma yükü için.\nÖrnek: Cassandra, HBase, ScyllaDB\n\nGraph Database\nİlişkiler çok önemliyse (sosyal ağ, öneri motoru).\nÖrnek: Neo4j, Amazon Neptune', '2026-05-19 15:45:42', '2026-05-19 15:45:42', NULL),
(33, 'ACID', 'Geleneksel ilişkisel veritabanlarının (SQL) kullandığı, katı kurallara dayalı bir modeldir. \n\n \nAtomiklik (Atomicity): \"Ya hep ya hiç\" ilkesidir. Bir işlemin adımlarından biri başarısız olursa, işlemin tamamı iptal edilir ve veritabanı önceki haline döner. \n\nAmazon Web Services (AWS)\n +1\nTutarlılık (Consistency): Yapılan her işlem veritabanının kurallarına (veri tipleri, kısıtlamalar vb.) uymak zorundadır.\nİzolasyon (Isolation): Eşzamanlı yapılan işlemler birbirinden bağımsızdır, birbirlerinin verilerini etkilemezler.\nKalıcılık (Durability): Bir işlem onaylandıktan (commit) sonra veri sistemde kalıcıdır; elektrik kesintisi gibi durumlarda veri kaybolmaz.', NULL, '2026-05-19 15:46:10', '2026-05-19 15:46:10', NULL),
(34, 'BASE Modeli (Esnek Tutarlılık)', 'Dağıtık ve büyük ölçekli sistemlerin (NoSQL, Big Data) tercih ettiği, performansı ön planda tutan modeldir. \n\n \nTemel Erişilebilirlik (Basically Available): Sistem, donanım veya ağ arızalarında bile kısmi olarak her zaman erişilebilir ve çalışır durumdadır.\nGeçici Durum (Soft State): Veriler anlık olarak farklı sunucularda eşleşmeyebilir; verinin durumu zamanla değişebilir. \n\n \nNihai Tutarlılık (Eventual Consistency): Sisteme bir süre veri girişi yapılmadığında, tüm sunuculardaki veriler sonunda birbirini kopyalayarak eşitlenir ve tutarlı hale gelir.', NULL, '2026-05-19 15:47:02', '2026-05-19 15:57:58', NULL),
(35, 'Reaktif veri', 'veri tabanınızdaki veya uygulamanızın durumundaki değişikliklerin (güncelleme, silme vb.) arayüzde (UI) ekstra bir DOM manipülasyonuna gerek kalmadan otomatik ve eşzamanlı olarak yansımasıdır', 'import { ref } from \'vue\'\n\nconst count = ref(0)\ncount.value++', '2026-05-19 15:59:34', '2026-05-19 15:59:34', NULL),
(36, 'Computed vs Watch', 'computed :  hesaplanmş üretilmiş veri , mevcut değerlerden yeni bir değer üretir. cache mümkün , template içinde usual veri gibi kullan.  return ile değer döner \n\nwatch:  veri izleyici. bir şey değiştiğinde yanetki oluşur . cache yok , api ve dom işlemlerinde kullanılır. return beklemez\n\ncomputed özellikleri . \nbağımlı oldğu veriler değşmedikçe tekrar hesaplanmaz / cachlenir.  genellikle senkron ve pure fx \nwatch özellikleri : \nbir veri değiştiğinde istediğin birşeyler olur .  side effect kullanır . no cache', 'computed örnek : \n<script setup>\nimport { ref, computed } from \'vue\'\n\nconst firstName = ref(\'Ahmet\')\nconst lastName = ref(\'Yılmaz\')\n\n// Computed\nconst fullName = computed(() => {\n    console.log(\'Computed çalıştı\')   // Bu sadece firstName veya lastName değişirse çalışır\n    return `${firstName.value} ${lastName.value}`\n})\n</script>\n\n<template>\n  <div>\n    <p>Ad Soyad: {{ fullName }}</p>   <!-- normal veri gibi kullanılır -->\n  </div>\n</template>\n\nwatch örnek :\n<script setup>\nimport { ref, watch } from \'vue\'\n\nconst searchText = ref(\'\')\nconst results = ref([])\n\n// Watch\nwatch(searchText, async (newValue, oldValue) => {\n    console.log(`Eski: ${oldValue} → Yeni: ${newValue}`)\n    \n    if (newValue.length > 2) {\n        // API çağrısı\n        results.value = await fetchResults(newValue)\n    }\n})\n</script>', '2026-05-19 16:08:34', '2026-05-19 16:08:34', NULL),
(37, 'reactive', 'Daha karmaşık veri yapıları (Array veya Object gibi veri kümeleri) için kullanılır. .value kullanmanıza gerek kalmaz, doğrudan nesne özelliklerine erişebilirsiniz', 'import { reactive } from \'vue\'\n\nconst user = reactive({\n  name: \'Ahmet\',\n  age: 25\n})\nuser.age = 26', '2026-05-19 16:16:38', '2026-05-19 16:16:38', NULL),
(38, 'promise', 'js için promise eş zamanlı - async - olarak çalışan işlemlerin gelecekteki sonucu - success / error , temsil eden ve bu süreçleri yönetmemizi sağlayan nesnedir . callback cehenneminden kurtulmak için okunabilir kod. \npromise oluştuğunda , 3 durumda bulunur pending, fulfilled, rejected\n\nuser methods :  then işlem başarılı ise , catch  rejected durumda exception  ve finally  işlemin her durumunda çalış.', 'const veriGetir = new Promise((resolve, reject) => {\n  let islemBasarili = true; // Durumu simüle ediyoruz\n\n  setTimeout(() => {\n    if (islemBasarili) {\n      resolve(\"Veri başarıyla alındı!\"); // İşlem olumlu\n    } else {\n      reject(\"Veri çekilirken hata oluştu.\"); // İşlem olumsuz\n    }\n  }, 2000); // 2 saniye bekletiyoruz\n});\n\n\nveriGetir\n  .then((sonuc) => {\n    console.log(\"Başarılı:\", sonuc);\n  })\n  .catch((hata) => {\n    console.error(\"Hata:\", hata);\n  })\n  .finally(() => {\n    console.log(\"İşlem tamamlandı.\");\n  });', '2026-05-19 16:29:08', '2026-05-19 16:30:32', NULL),
(39, 'callback', 'başka bir fx parametre olarak gönderir dıştaki fx tamamladığında belli olayı tetikler \n\njs de callback : async çalışan tek iş  ne zaman biteceğini kestiremediğmiz için işlem ardından ne yapılacaını belirtmek için callback\n\nphp de callback : daha çok filtreleme order map sort vs kullanılır , içiçe fx gibi', '// Dıştaki fonksiyon ve callback parametresi\nfunction selamVer(isim, callback) {\n    console.log(\"Merhaba, \" + isim);\n    callback(); // Parametre olarak gelen fonksiyonu çalıştır\n}\n\n// Callback olarak kullanılacak fonksiyon\nfunction vedaEt() {\n    console.log(\"Görüşmek üzere!\");\n}\n\n// Fonksiyonu çağırma\nselamVer(\"Ahmet\", vedaEt); \n\n\nphp\n// Callback fonksiyonu\nfunction buyukHarfeCevir($metin) {\n    return mb_strtoupper($metin, \'UTF-8\');\n}\n\n// Dıştaki fonksiyon (callable tip ipucu kullanılır)\nfunction veriIsle($veri, callable $callback) {\n    return $callback($veri);\n}\n\n// Kullanımı\necho veriIsle(\"merhaba dünya\", \"buyukHarfeCevir\");\n// Çıktı: MERHABA DÜNYA', '2026-05-19 16:38:39', '2026-05-19 16:38:39', NULL),
(40, 'OOP principles', 'inheritance,  a class can extend from other(s)  to reduce code dublication . Encapsulation ; props and methods can be restricted from other progress with private and protected  definations\npolymorphism . :  a child class can override a inherited prop or function to use for different purpose\nabstraction :  abstract classes can be used as template for classes to create', NULL, '2026-05-19 17:30:11', '2026-05-19 17:30:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `image`, `api_token`) VALUES
(12, 'Ece Adan', 'emel.alpugan', 'ebru.akbulut@example.org', '$2y$13$m1KljNWHy2FCJqN.eGg./uPKAfKkT/n7.B87NYOjlGAsjc47CZZyq', NULL, '4e0d5cb09c9bf35ac4331695dbf528b4497d51ee9aa34cec2ae9a6dd8c6cefcd'),
(13, 'Berk Akar', 'beserler.ada', 'oraloglu.berke@example.net', '$2y$13$hYwxE.D5WOB9nDcqNyKcAO4Cv7PM7M7.m7ai0HpdedxCelor5ZOt2', NULL, '0bebc8a11912388f18b3ef66a694193a1ae2c9828734f45fa00fc027b6d58a02'),
(14, 'Kutay Dalkıran', 'oztuna.kagan', 'burcu.cetiner@example.net', '$2y$13$M2m/jxG0t8WpPA/pxHlX8e3v3qyJ2xUqXFrxGph9CuJKPr83ntSES', NULL, '3a4e4553a2f4216a1644e229d5f301c015228a4f09df38cc122f1594d48da1ef'),
(15, 'İrem Akal', 'baran03', 'tuna08@example.net', '$2y$13$LU2Bcug3p3fWoyLUQq1DOOpSRX7b6.AmLJuHskHeITQ7R2vY5MSiW', NULL, '613bc07d4d989bf174c9cad048796f429925fd15f53303a63d4c8182a6231c7b'),
(16, 'Ümran Yeşilkaya', 'sahnur34', 'burcu67@example.org', '$2y$13$EhA0qU82qcec9cSuTdqR4eqKSuu6Og/ZFqkVD4PfZXD7qcuurlv.q', NULL, 'd1af4806ea90b04ada0da22b5b03369dfb46e6058d563da6b1b36a0336c9f64b'),
(17, 'Sinem Özdoğan', 'emel.balaban', 'bartu.akal@example.com', '$2y$13$WOSklIWwGOGBcsiVj0slAOSMo2koPYb791pSZ1xRqG7obquZ5MZyW', NULL, '0ecd6cefaa5f725bd982746331d816bd92263765dc6031ae154a803a86b37592'),
(18, 'Rüya Keseroğlu', 'vbaturalp', 'utku63@example.org', '$2y$13$eYZ4JN9Hnmt6zt5rIP8mtuEkGJW2FKQ21oWuwa5.4rNNzGDbNeeZS', NULL, '62f9fdfb45601fcb90a9d08dad672250905fcdd3635320d68a3c9cd4dbab9c70'),
(19, 'Prof. Dr. Ece Demirbaş', 'baykam.cinar', 'agaoglu.ada@example.com', '$2y$13$YfHVBXlOPuZ1eZcrVV8f7.Bagl92kkoiHa2AGmOSsBCP8RhjzfqRW', NULL, 'e15808b40db4bd6b4bbd8705eb3fafaf00e30645b4e14fe49d057c52a80577fe'),
(20, 'Esma Ilıcalı', 'gtokgoz', 'oztonga.daghan@example.com', '$2y$13$aKjZyyqB40GpR08hm8ABNuuUv5P9yXIHRQUlDmRXhEF7Ot14VoRg.', NULL, '3cbebc426534ca969cde55b8f6d6b6a0e02c68bb8d23e13d6c25202f1e5b18a5'),
(21, 'Ümran Babacan', 'beksioglu', 'ozdogan.kagan@example.net', '$2y$13$nQRKrifOaISOzK80qRPAYegvyFuXeOuKf00crRbgMd8uQBDG7XhEi', NULL, 'd5150647c3f9179d913ad6cadadaea24591139580dbc15c895cbf214d4387b9d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_232B318C12469DE2` (`category_id`);

--
-- Indexes for table `sys_log`
--
ALTER TABLE `sys_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical`
--
ALTER TABLE `technical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_user_username` (`username`),
  ADD UNIQUE KEY `uniq_user_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sys_log`
--
ALTER TABLE `sys_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `technical`
--
ALTER TABLE `technical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `FK_232B318C12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
