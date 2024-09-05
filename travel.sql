-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2024 at 02:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `summary` text COLLATE utf8mb4_general_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `date`, `title`, `summary`, `content`, `image_url`, `views`) VALUES
(37, '2024/06/26', 'Tham Quan Hoa Lư - Tràng An/Tam Cốc - Hang Múa Khởi Hành Từ Hà Nội | Việt Nam', 'Khám phá vẻ đẹp quyến rũ của Hoa Lư, chiêm ngưỡng cảnh quan tuyệt đẹp của Tràng An và Tam Cốc, và leo lên Hang Múa trong chuyến tham quan trong ngày thú vị từ Hà Nội.', '<p>Từ H&agrave; Nội để di chuyển đến tỉnh Ninh B&igrave;nh, nơi nổi tiếng với vẻ đẹp thi&ecirc;n nhi&ecirc;n tuyệt đẹp, c&aacute;c di t&iacute;ch lịch sử v&agrave; v&ugrave;ng n&ocirc;ng th&ocirc;n y&ecirc;n tĩnh.</p>\r\n\r\n<p>Đi s&acirc;u v&agrave;o lịch sử quyến rũ của Hoa Lư, nơi những c&acirc;u chuyện cổ xưa trở n&ecirc;n sống động giữa những t&agrave;n t&iacute;ch đầy ấn tượng. Sau đ&oacute;, du kh&aacute;ch tuỳ chọn: hoặc đắm m&igrave;nh trong những kỳ quan ngọc lục bảo của Tr&agrave;ng An, nơi những tuyến đường thủy len lỏi qua những n&uacute;i đ&aacute; v&ocirc;i hoặc lựa chọn phong cảnh m&ecirc; hoặc của Tam Cốc. Giữa những kỳ quan thi&ecirc;n nhi&ecirc;n n&agrave;y, du kh&aacute;ch c&oacute; thể leo l&ecirc;n đỉnh của Hang M&uacute;a, nơi c&oacute; tầm nh&igrave;n to&agrave;n cảnh vẻ đẹp hoang sơ đang chờ du kh&aacute;ch kh&aacute;m ph&aacute;</p>\r\n', 'Du-lich-Trang-An-Ninh-Binh-7.jpg', 2),
(43, '2024/08/27', 'Chuyến đi trong ngày đến Ninh Bình- Hoa Lư-Trang An-Hang Mua｜Việt Nam', 'Đi thuyền tham quan Tràng An để ngắm vẻ đẹp tuyệt vời của cảnh quan ', '<p>&nbsp;Tham quan Tr&agrave;ng An được UNESCO c&ocirc;ng nhận l&agrave; Di sản thế giới năm 2014. Tr&agrave;ng An c&oacute; hệ thống hang động đường hầm tuyệt vời n&ecirc;n đo&agrave;n l&agrave;m phim Kong&#39;s đ&atilde; chọn nơi n&agrave;y cho Phi&ecirc;n bản mới của Kong năm 2016 &ndash; &ldquo;Đảo đầu l&acirc;u&rdquo;. Đi thuyền tham quan Tr&agrave;ng An để ngắm nh&igrave;n vẻ đẹp tuyệt vời của cảnh quan n&agrave;y với nhiều hang động như: Hang S&aacute;ng (Hang &Aacute;nh S&aacute;ng), Hang Tối (hang Dack), Hang Nấu Rượu (Nấu Rượu), d&ograve;ng s&ocirc;ng xanh v&agrave; cảnh quan thi&ecirc;n nhi&ecirc;n.</p>\r\n', '1716266594_anh2.jpg', 3),
(44, '2024/06/26', 'Dê Núi - Đặc Sản Ninh Bình Được Lòng \"Dân Nhậu\"', 'thịt dê ở Ninh Bình vô cùng săn chắc và dai ', '<p>Được chăn thả b&ecirc;n tr&ecirc;n những ngọn n&uacute;i đ&aacute; n&ecirc;n thịt d&ecirc; ở Ninh B&igrave;nh v&ocirc; c&ugrave;ng săn chắc v&agrave; dai n&ecirc;n du kh&aacute;ch đến Ninh B&igrave;nh nhất định phải thử m&oacute;n ăn n&agrave;y một lần. Trong khi thịt d&ecirc; ở đ&acirc;y c&ograve;n được chế biến ra nhiều m&oacute;n ăn ngon với những c&aacute;ch chế biến kh&ocirc;ng giống nhau như l&agrave;m th&agrave;nh nem d&ecirc;, d&ecirc; hấp, d&ecirc; nướng hay nổi tiếng nhất l&agrave; d&ecirc; tương gừng - một m&oacute;n ăn cực kỳ gi&agrave;u dinh dưỡng. Nhiều người cũng bảo rằng thịt d&ecirc; c&ograve;n c&oacute; thể chữa được rất nhiều loại bệnh, n&ecirc;n đến Ninh B&igrave;nh nếu c&oacute; cơ hội bạn chớ bỏ lỡ thịt d&ecirc; n&uacute;i nức tiếng nơi đ&acirc;y</p>\r\n', 'NBf.webp', 7),
(45, '2024/08/27', ' Nem Dê - Đặc Sản Ninh Bình \"Hao Cơm\"', 'Là một nét tinh túy của ẩm thực cố đô', '<p>nem d&ecirc; Ninh B&igrave;nh kh&ocirc;ng chỉ g&acirc;y ấn tượng với vị ngon chua của thịt, vị ngậy của th&iacute;nh m&agrave; c&ograve;n mang đậm vị ngon đặc trưng kh&ocirc;ng thể t&igrave;m thấy ở bất kỳ nơi n&agrave;o kh&aacute;c.</p>\r\n\r\n<p>Một phần của vị ngon đặc trưng đ&oacute; đến từ việc d&ecirc; được thả r&ocirc;ng tr&ecirc;n n&uacute;i v&agrave; ăn cỏ tự nhi&ecirc;n, trong đ&oacute; c&oacute; nhiều loại l&aacute; thuốc v&agrave; thảo mộc. Nhờ v&agrave;o chế độ ăn tự nhi&ecirc;n n&agrave;y, thịt d&ecirc; trở n&ecirc;n săn chắc, &iacute;t mỡ, mềm mềm v&agrave; dai dai, đồng thời mang đến hương vị đặc trưng của thảo mộc m&agrave; kh&ocirc;ng thể t&igrave;m thấy ở nơi kh&aacute;c.</p>\r\n', 'nbf1.webp', 1),
(46, '2024/06/26', 'MOMALI Hotel Ninh Binh', 'Nằm ở Ninh Bình và cách Chùa Bái Đính 22 km', '<p>MOMALI Hotel Ninh Binh cung cấp dịch vụ tiền sảnh, c&aacute;c ph&ograve;ng kh&ocirc;ng g&acirc;y dị ứng, khu vườn, Wi-Fi miễn ph&iacute; ở to&agrave;n bộ chỗ nghỉ v&agrave; ph&ograve;ng chờ chung. Ngo&agrave;i ph&ograve;ng gia đ&igrave;nh, chỗ nghỉ n&agrave;y cũng cung cấp cho kh&aacute;ch s&acirc;n hi&ecirc;n phơi nắng. Đ&acirc;y l&agrave; chỗ nghỉ kh&ocirc;ng h&uacute;t thuốc v&agrave; tọa lạc c&aacute;ch Nh&agrave; thờ đ&aacute; Ph&aacute;t Diệm 26 km. C&aacute;c căn đi k&egrave;m điều h&ograve;a, TV m&agrave;n h&igrave;nh phẳng c&oacute; truyền h&igrave;nh c&aacute;p, minibar, ấm đun nước, v&ograve;i xịt/chậu rửa vệ sinh, đồ vệ sinh c&aacute; nh&acirc;n miễn ph&iacute; v&agrave; b&agrave;n l&agrave;m việc. Với ph&ograve;ng tắm ri&ecirc;ng được trang bị v&ograve;i sen v&agrave; m&aacute;y sấy t&oacute;c, một số ph&ograve;ng tại kh&aacute;ch sạn cũng c&oacute; view th&agrave;nh phố. Ph&ograve;ng kh&aacute;ch c&oacute; tủ quần &aacute;o. Hằng ng&agrave;y, chỗ nghỉ c&oacute; c&aacute;c lựa chọn thực đơn buffet, thực đơn &agrave; la carte hoặc kiểu lục địa cho bữa s&aacute;ng. Tại MOMALI Hotel Ninh Binh, kh&aacute;ch sẽ t&igrave;m thấy nh&agrave; h&agrave;ng phục vụ ẩm thực Mỹ, Việt v&agrave; &Aacute;. B&ecirc;n cạnh đ&oacute;, họ c&oacute; thể y&ecirc;u cầu m&oacute;n chay v&agrave; m&oacute;n thuần chay. Chỗ nghỉ c&oacute; s&acirc;n chơi trẻ em. Kh&aacute;ch c&oacute; thể chơi bi-a v&agrave; b&oacute;ng b&agrave;n tại MOMALI Hotel Ninh Binh. Ngo&agrave;i ra, leo n&uacute;i l&agrave; hoạt động được ưa chuộng trong khu vực. Th&agrave;nh thạo tiếng Anh v&agrave; tiếng Việt, đội ngũ nh&acirc;n vi&ecirc;n tại lễ t&acirc;n 24/24 lu&ocirc;n sẵn l&ograve;ng đưa ra th&ocirc;ng tin hữu &iacute;ch về khu vực xung quanh. Kh&aacute;ch sạn c&aacute;ch Ninh Binh Stadium 18 ph&uacute;t đi bộ v&agrave; Khu du lịch sinh th&aacute;i Vườn Chim Thung Nham 14 km. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Thọ Xu&acirc;n, c&aacute;ch MOMALI Hotel Ninh Binh 95 km, đồng thời chỗ nghỉ n&agrave;y cũng cung cấp dịch vụ đưa đ&oacute;n s&acirc;n bay mất ph&iacute;.</p>\r\n', 'nbhotel.jpg', 4),
(47, '2024/06/26', 'Tam Coc Serenity Hotel & Bungalow', 'Nằm ở Ninh Bình, cách Chùa Bái Đính 25 km\nTam Coc Road, Ninh Bình, Việt Nam', '<p>Tam Coc Serenity Hotel &amp; Bungalow cung cấp chỗ nghỉ c&oacute; hồ bơi ngo&agrave;i trời, chỗ đậu xe ri&ecirc;ng miễn ph&iacute;, khu vườn v&agrave; ph&ograve;ng chờ chung. Mỗi ph&ograve;ng tại resort 4 sao n&agrave;y đều nh&igrave;n ra khu vườn, đồng thời kh&aacute;ch c&oacute; thể sử dụng nh&agrave; h&agrave;ng v&agrave; quầy bar. Chỗ nghỉ cung cấp lễ t&acirc;n 24/24, dịch vụ đưa đ&oacute;n s&acirc;n bay, dịch vụ ph&ograve;ng v&agrave; Wi-Fi miễn ph&iacute; ở to&agrave;n bộ chỗ nghỉ. Tại resort, c&aacute;c ph&ograve;ng đều đi k&egrave;m với điều h&ograve;a, b&agrave;n l&agrave;m việc, s&acirc;n trong với view hồ bơi, ph&ograve;ng tắm ri&ecirc;ng, TV m&agrave;n h&igrave;nh phẳng, ga trải giường v&agrave; khăn tắm. Tất cả c&aacute;c ph&ograve;ng đều c&oacute; ấm đun nước, trong đ&oacute; một số ph&ograve;ng c&oacute; s&acirc;n hi&ecirc;n. Tất cả c&aacute;c ph&ograve;ng đều c&oacute; tủ lạnh. Chỗ nghỉ c&oacute; phục vụ bữa s&aacute;ng thực đơn buffet, kiểu lục địa hoặc kiểu Mỹ mỗi buổi s&aacute;ng. Tam Coc Serenity Hotel &amp; Bungalow c&ograve;n c&oacute; dịch vụ cho thu&ecirc; xe đạp v&agrave; dịch vụ văn ph&ograve;ng. Chỗ nghỉ c&aacute;ch Nh&agrave; thờ đ&aacute; Ph&aacute;t Diệm 33 km v&agrave; Khu du lịch sinh th&aacute;i Vườn Chim Thung Nham 6 km. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Thọ Xu&acirc;n, c&aacute;ch Tam Coc Serenity Hotel &amp; Bungalow 94 km.</p>\r\n', 'nbhotel1.jpg', 0),
(48, '2024/09/04', 'Kinh nghiệm du lịch Ninh Bình tự túc: Đi đâu đẹp, ăn gì ngon?', 'chi tiết, bổ ích', '<p>Ninh B&igrave;nh l&agrave; th&agrave;nh phố nằm ở cực Nam của đồng bằng s&ocirc;ng Hồng với nhiều danh lam thắng cảnh nổi tiếng như cố đ&ocirc; Hoa Lư c&ugrave;ng bề d&agrave;y lịch sử h&agrave;o h&ugrave;ng, quần thể Tam Cốc - B&iacute;ch Động đẹp say l&ograve;ng, Tr&agrave;ng An với khung cảnh thi&ecirc;n nhi&ecirc;n h&ugrave;ng vĩ v&agrave; nhiều địa điểm du lịch t&acirc;m linh như ch&ugrave;a B&aacute;i Đ&iacute;nh, nh&agrave; thờ Ph&aacute;t Diệm...&nbsp;</p>\r\n\r\n<h2>N&ecirc;n đi du lịch Ninh B&igrave;nh v&agrave;o m&ugrave;a n&agrave;o?</h2>\r\n\r\n<p>Ninh B&igrave;nh nằm trong khu vực cận nhiệt đới ẩm với kh&iacute; hậu nhiệt đới gi&oacute; m&ugrave;a, c&oacute; nhiệt độ trung b&igrave;nh 23,5 độ C. Nơi đ&acirc;y c&oacute; 4 m&ugrave;a r&otilde; rệt xu&acirc;n, hạ, thu, đ&ocirc;ng; với đặc trưng m&ugrave;a đ&ocirc;ng kh&ocirc; lạnh v&agrave; m&ugrave;a h&egrave; n&oacute;ng ẩm, mưa nhiều. Theo kinh nghiệm du lịch Ninh B&igrave;nh của MoMo, 2 thời điểm đẹp nhất trong năm để tham quan l&agrave; lập xu&acirc;n v&agrave; đầu h&egrave;.</p>\r\n\r\n<p><img alt=\"du lịch ninh bình có gì\" src=\"https://homepage.momocdn.net/blogscontents/momo-upload-api-210611133706-637590154260936269.jpg\" /></p>\r\n\r\n<p><em>Theo kinh nghiệm du lịch Ninh B&igrave;nh của MoMo, 2 thời điểm đẹp nhất trong năm để tham quan l&agrave; lập xu&acirc;n v&agrave; đầu h&egrave;&nbsp;(Nguồn: @justin_the_mind)</em></p>\r\n\r\n<p>Thời điểm lập xu&acirc;n: Từ th&aacute;ng 1 đến th&aacute;ng 3, Ninh B&igrave;nh sẽ chiều chuộng du kh&aacute;ch với kh&iacute; hậu m&aacute;t mẻ, kh&ocirc;ng qu&aacute; lạnh, mưa &iacute;t, thuận tiện cho c&aacute;c hoạt động tham quan, ngắm cảnh. Thời điểm n&agrave;y cũng rất l&yacute; tưởng cho việc du xu&acirc;n với c&aacute;c hoạt động du lịch t&acirc;m linh như thăm ch&ugrave;a B&aacute;i Đ&iacute;nh, Tr&agrave;ng An, nh&agrave; thờ Đ&aacute;.</p>\r\n\r\n<p>Thời điểm v&agrave;o h&egrave;: Trong th&aacute;ng 4 đến th&aacute;ng 6, thời tiết Ninh B&igrave;nh thường kh&aacute; m&aacute;t mẻ, dễ chịu, kh&ocirc;ng lạnh m&agrave; cũng chẳng qu&aacute; nắng n&oacute;ng. V&agrave;o h&egrave; l&agrave; thời điểm cho quang cảnh tho&aacute;ng đ&atilde;ng, thực vật sinh trưởng tốt n&ecirc;n bạn sẽ c&oacute; cơ hội ngắm nh&igrave;n vẻ đẹp đồng l&uacute;a ch&iacute;n v&agrave;ng ở Tam Cốc hoặc hệ sinh th&aacute;i đa dạng của rừng C&uacute;c Phương, Với &aacute;nh nắng chan h&ograve;a sẽ l&agrave; cơ hội cho bạn những bức ảnh đẹp v&agrave; nghệ thuật đ&oacute; nha.</p>\r\n\r\n<p><img alt=\"giới thiệu về du lịch ninh bình\" src=\"https://homepage.momocdn.net/blogscontents/momo-upload-api-210611133832-637590155126537967.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nếu bạn c&oacute; kế hoạch đi v&agrave;o m&ugrave;a đ&ocirc;ng, kinh nghiệm du lịch Ninh B&igrave;nh của V&iacute; MoMo khuy&ecirc;n bạn n&ecirc;n tham khảo dự b&aacute;o thời tiết trước khi đi nh&eacute;. M&ugrave;a đ&ocirc;ng ở Ninh B&igrave;nh c&oacute; kh&iacute; hậu lạnh, r&eacute;t đậm, r&eacute;t hại sẽ dễ l&agrave;m bạn bị cảm. H&atilde;y chuẩn bị quần &aacute;o ấm nếu bạn đi v&agrave;o thời điểm n&agrave;y.&nbsp;</p>\r\n', 'Du-lich-Trang-An-Ninh-Binh-7.jpg', 1),
(49, '2024/08/19', 'Thịt lợn đồi Tam Đảo', 'siuuuu ngonnnn', '<h2 style=\"font-style:italic\">Lợn đồi Tam Đảo l&agrave; loại lợn rừng được nu&ocirc;i trong chuồng rừng c&oacute; diện t&iacute;ch lớn. Những ch&uacute; lợn được thoải m&aacute;i &ldquo;chạy bộ&rdquo; chẳng kh&aacute;c g&igrave; nu&ocirc;i thả ngo&agrave;i tự nhi&ecirc;n. Người Tam Đảo nu&ocirc;i lợn bằng rau củ quả v&agrave; thức ăn thường n&ecirc;n lợn chậm lớn, k&iacute;ch thước nhỏ nhưng thịt chắc, thơm, &iacute;t mỡ v&agrave; 100% l&agrave; thực phẩm sạch. Thịt lợn đồi Tam Đảo được mang chế biến th&agrave;nh c&aacute;c m&oacute;n hấp, nướng, x&agrave;o lăn, giả cầy&hellip; m&oacute;n n&agrave;o cũng &ldquo;đỉnh&rdquo;.</h2>\r\n\r\n<p>&nbsp;</p>\r\n', 'TBfood.webp', 0),
(50, '2024/06/28', 'Anh Minh Hotel', ' Block 1, Tam Ðảo, Việt Nam', '<p>Anh Minh Hotel c&oacute; hồ bơi ngo&agrave;i trời, khu vườn, ph&ograve;ng chờ chung v&agrave; s&acirc;n hi&ecirc;n ở Tam &ETH;ảo. Ngo&agrave;i dịch vụ ph&ograve;ng, chỗ nghỉ n&agrave;y c&ograve;n c&oacute; nh&agrave; h&agrave;ng v&agrave; s&acirc;n chơi trẻ em. Chỗ nghỉ cung cấp lễ t&acirc;n 24/24, dịch vụ đưa đ&oacute;n s&acirc;n bay, bếp chung v&agrave; Wi-Fi miễn ph&iacute; ở to&agrave;n bộ chỗ nghỉ. Tại kh&aacute;ch sạn, c&aacute;c ph&ograve;ng đều đi k&egrave;m với điều h&ograve;a, b&agrave;n l&agrave;m việc, ban c&ocirc;ng với view th&agrave;nh phố, ph&ograve;ng tắm ri&ecirc;ng, TV m&agrave;n h&igrave;nh phẳng, ga trải giường v&agrave; khăn tắm. C&aacute;c căn đều c&oacute; tủ lạnh. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Quốc tế Nội B&agrave;i, c&aacute;ch Anh Minh Hotel 46 km.</p>\r\n', 'TDhotel.jpg', 0),
(51, '2024/08/19', 'Studio Cầu Mây', 'nơi đáng thử đi nhất trên đời', '<p>C&oacute; thể n&oacute;i studio Cầu M&acirc;y l&agrave; một thi&ecirc;n đường check-in d&agrave;nh cho những ai đến Tam Đảo. C&aacute;c bối cảnh tựa như ti&ecirc;n cảnh hay những c&aacute;nh đồng hoa cải như đang ở Đ&agrave; Lạt, hoặc chỉ l&agrave; những chiếc cầu treo tr&ecirc;n cao lững lờ m&acirc;y tr&ocirc;i chắc chắn sẽ l&agrave;m đầy bộ ảnh trong m&aacute;y bạn ngay th&ocirc;i.</p>\r\n\r\n<p>Được xem l&agrave; <strong>địa điểm check-in Tam Đảo</strong> c&oacute; thể thu h&uacute;t mọi du kh&aacute;ch đến check-in th&igrave; bạn h&atilde;y y&ecirc;n t&acirc;m về chất lượng b&ecirc;n trong. V&agrave; quan trọng l&agrave; bạn nhớ chuẩn bị những bộ đồ thật đẹp ph&ugrave; hợp với kh&ocirc;ng gian l&atilde;ng mạng n&agrave;y nh&eacute;. C&aacute;c tiểu cảnh nổi bật nhất tại địa điểm n&agrave;y l&agrave; nh&agrave; thờ đ&aacute;, quảng trường, th&aacute;c bạc, cổng trời, ng&ocirc;i nh&agrave; bảy sắc cầu vồng&hellip;</p>\r\n', 'tddes.webp', 1),
(52, '2024/06/28', 'Kinh nghiệm du lịch Tam  tự túc: Đi đâu đẹp, ăn gì ngon?', '', '<p>Thị trấn Tam Đảo l&agrave; địa danh du lịch nổi tiếng của tỉnh Vĩnh Ph&uacute;c, c&aacute;ch H&agrave; Nội khoảng 80 km. Tam Đảo nằm ở độ cao hơn 900 m so với mặt nước biển, c&oacute; kh&iacute; hậu m&aacute;t mẻ quanh năm. Sở dĩ c&oacute; t&ecirc;n gọi Tam Đảo bởi nơi đ&acirc;y c&oacute; ba ngọn n&uacute;i cao nh&ocirc; l&ecirc;n tr&ecirc;n biển m&acirc;y, đ&oacute; l&agrave; Thạch B&agrave;n, Thi&ecirc;n Thị v&agrave; Ph&ugrave; Nghĩa c&oacute; thể nh&igrave;n thấy từ H&agrave; Nội v&agrave;o ng&agrave;y nắng. Ng&agrave;y 25/1 vừa qua, Tam Đảo được c&ocirc;ng nhận l&agrave; Khu du lịch quốc gia.</p>\r\n\r\n<p>Đến đ&acirc;y d&ugrave; v&agrave;o m&ugrave;a n&agrave;o du kh&aacute;ch cũng được tận hưởng kh&ocirc;ng kh&iacute; biến chuyển 4 m&ugrave;a trong ng&agrave;y. Tam Đảo l&agrave; một trong những khu nghỉ m&aacute;t được người Ph&aacute;p trước kia y&ecirc;u th&iacute;ch. Hiện tại, Tam Đảo sở hữu cảnh quan n&uacute;i non v&agrave; nhiều c&ocirc;ng tr&igrave;nh mới kiểu ch&acirc;u &Acirc;u, l&agrave; điểm phượt ph&ugrave; hợp với những du kh&aacute;ch muốn tr&aacute;nh xa th&agrave;nh thị v&agrave;o cuối tuần.</p>\r\n', 'tdadvice.png', 0),
(53, '2024/07/03', 'ANIVIA TAM ĐẢO ', 'Tam Đảo được nhiều người biết đến với cái tên là “Đà Lạt của miền Bắc”', '<p>Nếu bạn l&agrave; người y&ecirc;u th&iacute;ch du lịch th&igrave; chắc chắn kh&ocirc;ng được bỏ qua địa danh với vẻ đẹp thi&ecirc;n nhi&ecirc;n trong l&agrave;nh lu&ocirc;n mờ mờ ảo ảo trong m&agrave;n sương, thời tiết hơi se lạnh v&agrave; kh&iacute; hậu rất trong l&agrave;nh. C&oacute; dịp đặt ch&acirc;n đến đ&acirc;y th&igrave; bạn đừng bỏ qua cơ hội được nghỉ dưỡng tại&nbsp;<a href=\"https://ticotravel.com.vn/hotel/anivia-tam-dao-hotel/\"><strong>Anivia Tam Đảo Hotel</strong></a>.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>1. Đ&Ocirc;I N&Eacute;T VỀ ANIVIA TAM ĐẢO HOTEL&nbsp;</strong></h2>\r\n\r\n<p><strong>Anivia Tam Đảo Hotel</strong>&nbsp;l&agrave; kh&aacute;ch sạn 4 sao, tọa lạc tại tỉnh Vĩnh Ph&uacute;c. Nơi đ&acirc;y thu h&uacute;t kh&aacute;ch du lịch dừng ch&acirc;n nghỉ dưỡng bởi sự sang trọng, cao cấp trong từng đường n&eacute;t thiết kế.&nbsp;</p>\r\n\r\n<p>Anivia l&agrave; khu nghỉ dưỡng được thiết kế với kh&ocirc;ng gian mở, tạo cảm gi&aacute;c rộng r&atilde;i v&agrave; gần gũi với thi&ecirc;n nhi&ecirc;n. Khu&ocirc;n vi&ecirc;n của resort được bao phủ bởi những h&agrave;ng c&acirc;y xanh m&aacute;t, mang đến kh&ocirc;ng kh&iacute; trong l&agrave;nh cho du kh&aacute;ch khi đến tham quan v&agrave; nghỉ dưỡng tại đ&acirc;y.</p>\r\n\r\n<p><img alt=\"Đôi nét về Anivia Tam Đảo Hotel \" src=\"https://ticotravel.com.vn/wp-content/uploads/2023/03/anivia-hotel-1-1.jpg\" style=\"height:768px; width:512px\" /></p>\r\n\r\n<p><strong>Kh&aacute;ch sạn Anivia Tam Đảo</strong>&nbsp;c&ograve;n ch&uacute; trọng đến hệ thống c&aacute;c ph&ograve;ng nghỉ với thiết kế sang trọng với vật liệu l&agrave;m chủ yếu bằng gỗ với gam m&agrave;u trầm ấm, vừa gợi n&eacute;t truyền thống xưa nhưng cũng rất hiện đại.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, nơi đ&acirc;y&nbsp;lu&ocirc;n thu h&uacute;t rất nhiều kh&aacute;ch du lịch đến đ&acirc;y bởi sự hoang sơ, giản dị v&agrave; cảnh sắc thi&ecirc;n nhi&ecirc;n trời m&acirc;y, non nước v&ocirc; c&ugrave;ng hữu t&igrave;nh.&nbsp;</p>\r\n\r\n<p><img alt=\"Đôi nét về Anivia Tam Đảo Hotel \" src=\"https://ticotravel.com.vn/wp-content/uploads/2023/03/anivia-hotel-3-1.jpg\" style=\"height:768px; width:1024px\" /></p>\r\n\r\n<p>Bạn sẽ cảm thấy h&agrave;i l&ograve;ng với chất lượng dịch vụ ở đ&acirc;y. Mỗi ph&ograve;ng đều đầy đủ tiện nghi, nh&acirc;n vi&ecirc;n chu đ&aacute;o, nhiệt t&igrave;nh. Đ&oacute; cũng ch&iacute;nh l&agrave; những yếu tố quan trọng khiến kỳ nghỉ của bạn trở n&ecirc;n &yacute; nghĩa hơn bao giờ hết.</p>\r\n', 'anivia-tam-dao-hotel-5.jpg', 0),
(54, '2024/07/03', 'Quán Gió Tam Đảo', ' để tạm thời “bỏ trốn” khỏi những bộn bề của cuộc sống thì quán Gió Tam Đảo chắc chắn là địa điểm lý tưởng nhất', '<p>Qu&aacute;n Gi&oacute; l&agrave; qu&aacute;n cafe độc đ&aacute;o bậc nhất ở Tam Đảo, v&igrave; được x&acirc;y dựng nh&ocirc; ra tr&ecirc;n những v&aacute;ch n&uacute;i cheo leo, mang đến cho du kh&aacute;ch cảm gi&aacute;c như đang lơ lửng giữa m&acirc;y trời. Tuy kh&ocirc;ng c&oacute; m&aacute;i che, nhưng bạn y&ecirc;n t&acirc;m l&agrave; chỗ ngồi ở Qu&aacute;n Gi&oacute; kh&ocirc;ng bị nắng gắt kh&oacute; chịu v&igrave; đ&atilde; c&oacute; những l&agrave;n gi&oacute; dịu m&aacute;t v&agrave; kh&ocirc;ng kh&iacute; rất tho&aacute;ng đ&atilde;ng.</p>\r\n\r\n<p>View check-in đắc địa nhất Qu&aacute;n Gi&oacute; ch&iacute;nh L&acirc;u đ&agrave;i Tam Đảo - Ch&acirc;teau De Tamdao với kiến tr&uacute;c đậm chất ch&acirc;u &Acirc;u sang chảnh n&ecirc;n bạn nhất định phải c&oacute; được v&agrave;i pose ở đ&acirc;y nh&eacute;.</p>\r\n\r\n<ul>\r\n	<li>Địa chỉ: Th&ocirc;n 1, thị trấn Tam Đảo, Tam Đảo, Vĩnh Ph&uacute;c</li>\r\n	<li>Gi&aacute;: Đồ uống c&oacute; gi&aacute; từ 20.000 - 50.000 VND</li>\r\n</ul>\r\n\r\n<p><img alt=\"Ảnh:@bu_bam_insta\" src=\"https://cdn3.ivivu.com/2016/10/quan-gio-tam-dao-ivivu-10.png\" /></p>\r\n', 'quan-gio-tam-dao-ivivu-1.jpg', 8),
(55, '2024/07/03', 'Gà nướng bọ đất sét', '', '<p>G&agrave; nướng bọc đất l&agrave; m&oacute;n ăn bạn nhất định phải thử khi tới Tam Đảo. G&agrave; Tam Đảo thường được nu&ocirc;i thả tự nhi&ecirc;n n&ecirc;n thịt rất săn chắc, ngọt thơm nhưng vẫn mềm. Bạn c&oacute; thể t&igrave;m thấy m&oacute;n g&agrave; n&agrave;y ở hầu hết c&aacute;c nh&agrave; h&agrave;ng hoặc qu&aacute;n ăn ở Tam Đảo.</p>\r\n\r\n<p>Địa chỉ:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Nh&agrave; H&agrave;ng Long H&agrave; Cơm Lam - G&agrave; Đồi: dốc Tam Đảo, Thị trấn Tam Đảo, Tam Đảo, Vĩnh Ph&uacute;c</li>\r\n	<li>Nh&agrave; h&agrave;ng T&acirc;y Thi&ecirc;n: Đại Đ&igrave;nh, Tam Đảo, Vĩnh Ph&uacute;c</li>\r\n	<li>Gi&aacute;: 250.000 VND/ con.</li>\r\n</ul>\r\n\r\n<p><img alt=\"Gà nướng bọc đất\" src=\"https://homepage.momocdn.net/blogscontents/momo-upload-api-210609103124-637588314843519441.jpg\" /></p>\r\n', 'ga-nuong-TD.jpg', 0),
(56, '2024/07/03', 'Phở bò', '', '<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Phở bò\" src=\"https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_75,s_1920x1920/https://cdn.tgdd.vn/Files/2021/06/24/1363040/cac-mon-ngon-ha-noi-phai-thu-cac-quan-an-ha-noi-phai-ghe-202209271022113647.jpg\" style=\"height:429px; width:762px\" title=\"Phở bò\" />Phở b&ograve;</p>\r\n\r\n<p><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-nau-pho-bo-ha-noi-962092\">Phở b&ograve;</a>&nbsp;lu&ocirc;n l&agrave; m&oacute;n ăn giữ vị tr&iacute; số một trong những m&oacute;n ăn ngon nhất H&agrave; Nội.&nbsp;<strong>M&oacute;n ăn n&agrave;y được tạo n&ecirc;n bởi hương vị từ quế hồi c&ugrave;ng với nước d&ugrave;ng được hầm từ xương b&ograve; trong thời gian d&agrave;i, tạo n&ecirc;n trải nghiệm ăn uống đầy th&uacute; vị v&agrave; g&acirc;y được ấn tượng mạnh đến với thực kh&aacute;ch.</strong></p>\r\n', 'pho-bo-HN.jpg', 1),
(57, '2024/07/03', 'Bún đậu mắm tôm', '', '<p><img alt=\"Bún đậu mắm tôm\" src=\"https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_75,s_1920x1920/https://cdn.tgdd.vn/Files/2021/06/24/1363040/cac-mon-ngon-ha-noi-phai-thu-cac-quan-an-ha-noi-phai-ghe-202209271035598983.jpg\" style=\"height:429px; width:762px\" title=\"Bún đậu mắm tôm\" />B&uacute;n đậu mắm t&ocirc;m</p>\r\n\r\n<p>Một đặc sản kh&aacute;c ở H&agrave; Nội đ&oacute; ch&iacute;nh l&agrave; m&oacute;n b&uacute;n đậu mắm t&ocirc;m.<strong>&nbsp;M&oacute;n ăn n&agrave;y đặc biệt bởi c&ocirc;ng thức chưng mắm t&ocirc;m độc đ&aacute;o kh&ocirc;ng nơi n&agrave;o c&oacute;, điều n&agrave;y tạo ra một hương vị độc nhất v&agrave; g&acirc;y k&iacute;ch th&iacute;ch vị gi&aacute;c mạnh cho c&aacute;c thực kh&aacute;ch.</strong></p>\r\n', 'bun-dau-mam-tom-HN.jpg', 0),
(58, '2024/07/03', ' Phố cổ Hà Nội - địa điểm vui chơi Hà Nội về đêm ', ' Hoàn Kiếm, Hà Nội', '<p>Khu phố cổ l&agrave; địa điểm vui chơi ở H&agrave; Nội cuối tuần quen thuộc của mọi cư d&acirc;n v&agrave; du kh&aacute;ch. Đ&acirc;y l&agrave; nơi lưu giữ kh&ocirc;ng gian văn h&oacute;a xưa của người d&acirc;n thủ đ&ocirc; với những ng&ocirc;i nh&agrave; san s&aacute;t, ng&otilde; ng&aacute;ch đan xen.</p>\r\n\r\n<p><img alt=\"Địa điểm vui chơi Hà Nội\" src=\"https://statics.vinpearl.com/dia-diem-vui-choi-ha-noi-3_1635393995.jpg\" /><em>Phố cổ H&agrave; Nội - nơi thời gian ngừng chảy&nbsp;</em></p>\r\n\r\n<p>Chợ đ&ecirc;m phố cổ thường họp v&agrave;o tối thứ 6, thứ 7 v&agrave; chủ nhật h&agrave;ng tuần tr&ecirc;n c&aacute;c phố H&agrave;ng Ngang, H&agrave;ng Đ&agrave;o, H&agrave;ng Đường, H&agrave;ng Khoai tới H&agrave;ng Giầy. Chợ đ&ecirc;m l&uacute;c n&agrave;o cũng nhộn nhịp với nhiều mặt h&agrave;ng d&acirc;n d&atilde; đậm văn h&oacute;a truyền thống.</p>\r\n', 'pho-co-HN.jpg', 78),
(59, '2024/07/03', 'Lăng Bác - nơi mọi người con đất Việt hướng về', '8 Hùng Vương, Điện Biên, Ba Đình, Hà Nội', '<p><img alt=\"Địa điểm vui chơi Hà Nội\" src=\"https://statics.vinpearl.com/l%C4%83ng%20b%C3%A1c%201_1661339206.jpg\" /><em>Gh&eacute; thăm Lăng B&aacute;c để tri &acirc;n vị cha gi&agrave; của d&acirc;n tộc (Ảnh: sưu tầm)</em></p>\r\n\r\n<p>Hầu như người con đất Việt n&agrave;o đ&atilde; đặt ch&acirc;n tới H&agrave; Nội đều sẽ đi thăm Lăng B&aacute;c Hồ. V&agrave;o mỗi m&ugrave;a, Lăng B&aacute;c sẽ c&oacute; c&aacute;c khung giờ mở cửa nhất định. Du kh&aacute;ch n&ecirc;n t&igrave;m hiểu kỹ trước khi viếng thăm nơi đ&acirc;y. Buổi tối, du kh&aacute;ch c&oacute; thể ngồi chơi tới 21:00 ở khoảng s&acirc;n m&aacute;t mẻ trước lăng v&agrave; xem lễ hạ cờ. Buổi s&aacute;ng, bạn n&ecirc;n dậy sớm để gh&eacute; nơi đ&acirc;y v&agrave;o 5:00 để xem lễ thượng cờ.&nbsp;</p>\r\n', 'lang-bac-HN.jpg', 5),
(60, '2024/07/03', 'Hanoi Paradise Center Hotel & Spa', ' 22/5 Hang Voi Street, Ly Thai To Ward, Hoan Kiem District, Vietnam, Quận Hoàn Kiếm, Hà Nội, Việt Nam ', '<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/346327028.jpg?k=083b8d316e4e1eb267cb86967b2fc678fa834f0e27b36fc18360e8a7b83422ea&amp;o=\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tọa lạc ở Hà N&ocirc;̣i, c&aacute;ch Nh&agrave; h&aacute;t m&uacute;a rối Thăng Long 5 ph&uacute;t đi bộ, Hanoi Paradise Center Hotel &amp; Spa cung cấp chỗ nghỉ c&oacute; ph&ograve;ng chờ chung, chỗ đậu xe ri&ecirc;ng, s&acirc;n hi&ecirc;n v&agrave; quầy bar.</p>\r\n\r\n<p>Chỗ nghỉ c&aacute;ch Nh&agrave; thờ Th&aacute;nh Joseph khoảng 13 ph&uacute;t đi bộ, Tr&agrave;ng Tiền Plaza chưa đến 1 km v&agrave; Ga H&agrave; Nội 2.8 km. Chỗ nghỉ cung cấp lễ t&acirc;n 24/24, dịch vụ đưa đ&oacute;n s&acirc;n bay, dịch vụ ph&ograve;ng v&agrave; Wi-Fi miễn ph&iacute;. Kh&aacute;ch sạn sẽ cung cấp cho kh&aacute;ch c&aacute;c ph&ograve;ng được trang bị điều h&ograve;a c&oacute; b&agrave;n l&agrave;m việc, ấm đun nước, tủ lạnh, minibar, k&eacute;t an to&agrave;n, TV m&agrave;n h&igrave;nh phẳng v&agrave; ph&ograve;ng tắm ri&ecirc;ng với v&ograve;i xịt/chậu rửa vệ sinh.</p>\r\n\r\n<p>Tại Hanoi Paradise Center Hotel &amp; Spa, tất cả c&aacute;c ph&ograve;ng đều được thiết kế c&oacute; ga trải giường v&agrave; khăn tắm. Chỗ nghỉ c&oacute; phục vụ bữa s&aacute;ng thực đơn buffet, thực đơn &agrave; la carte hoặc kiểu Anh/ Ai-len mỗi s&aacute;ng. Tại chỗ nghỉ, kh&aacute;ch sẽ t&igrave;m thấy nh&agrave; h&agrave;ng phục vụ ẩm thực ch&acirc;u Phi, Mỹ v&agrave; Argentina.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, họ c&oacute; thể y&ecirc;u cầu kh&ocirc;ng chứa sữa, đồ ăn Halal v&agrave; kosher (cho người đạo Do Th&aacute;i). Đi xe đạp l&agrave; hoạt động được ưa chuộng trong khu vực. Ngo&agrave;i ra, kh&aacute;ch sạn 4 sao n&agrave;y c&oacute; dịch vụ thu&ecirc; xe đạp.</p>\r\n\r\n<p>C&aacute;c điểm tham quan nổi tiếng gần Hanoi Paradise Center Hotel &amp; Spa bao gồm Hồ Ho&agrave;n Kiếm, &Ocirc; Quan Chưởng v&agrave; Nh&agrave; h&aacute;t Lớn H&agrave; Nội. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Quốc tế Nội B&agrave;i, c&aacute;ch kh&aacute;ch sạn 24 km.</p>\r\n\r\n<p><img src=\"/ckeditor/ckfinder/userfiles/images/image.png\" style=\"height:100px; width:408px\" /><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/219028904.jpg?k=7b712d36525a5605ff17671bfdca578b4eba8c97a2c91736ba35b92784e64f95&amp;o=\" /></p>\r\n', 'hotle-HN.jpg', 14),
(61, '2024/07/03', 'Shining Central Hotel & Spa  ', '20 Lo Su Street , Quận Hoàn Kiếm, Hà Nội, Việt Nam ', '<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/238668662.jpg?k=b6558629a3712f66d6dcd063feaccad80d31826796c28ef60f30d973dcd93738&amp;o=\" /></p>\r\n\r\n<p>Với trung t&acirc;m thể dục, s&acirc;n hi&ecirc;n v&agrave; quầy bar, Shining Central Hotel &amp; Spa nằm ở trung t&acirc;m Hà N&ocirc;̣i, c&aacute;ch Nh&agrave; h&aacute;t m&uacute;a rối Thăng Long 3 ph&uacute;t đi bộ. Chỗ nghỉ c&aacute;ch Tr&agrave;ng Tiền Plaza khoảng chưa đến 1 km, Nh&agrave; h&aacute;t Lớn H&agrave; Nội 11 ph&uacute;t đi bộ v&agrave; Ga H&agrave; Nội 2.7 km. Chỗ nghỉ cung cấp lễ t&acirc;n 24/24, dịch vụ đưa đ&oacute;n s&acirc;n bay, dịch vụ ph&ograve;ng v&agrave; Wi-Fi miễn ph&iacute; ở to&agrave;n bộ chỗ nghỉ. Kh&aacute;ch sạn sẽ cung cấp cho kh&aacute;ch c&aacute;c ph&ograve;ng được trang bị điều h&ograve;a c&oacute; b&agrave;n l&agrave;m việc, ấm đun nước, tủ lạnh, minibar, k&eacute;t an to&agrave;n, TV m&agrave;n h&igrave;nh phẳng v&agrave; ph&ograve;ng tắm ri&ecirc;ng với v&ograve;i xịt/chậu rửa vệ sinh. Tại Shining Central Hotel &amp; Spa, tất cả c&aacute;c ph&ograve;ng đều c&oacute; ga trải giường v&agrave; khăn tắm.</p>\r\n\r\n<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/510848162.jpg?k=475607a78a7087bc8ddef64246be7679363b139a9b9674325520d46596f2c97e&amp;o=\" /></p>\r\n\r\n<p>Chỗ nghỉ c&oacute; phục vụ bữa s&aacute;ng thực đơn buffet, kiểu lục địa hoặc kiểu &Aacute; mỗi s&aacute;ng. Đi xe đạp l&agrave; hoạt động được ưa chuộng trong khu vực. Ngo&agrave;i ra, kh&aacute;ch sạn 4 sao n&agrave;y c&oacute; dịch vụ thu&ecirc; xe đạp. C&aacute;c điểm tham quan nổi tiếng gần chỗ nghỉ bao gồm Hồ Ho&agrave;n Kiếm, &Ocirc; Quan Chưởng v&agrave; Nh&agrave; thờ Th&aacute;nh Joseph. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Quốc tế Nội B&agrave;i, c&aacute;ch Shining Central Hotel &amp; Spa 24 km.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/226161041.jpg?k=7d4c86e64f1c5d2755c81509e01fbc20ab6edecde46f58f282a43091dfcf3faf&amp;o=\" /></p>\r\n\r\n<p><img src=\"/ckeditor/ckfinder/userfiles/images/image(1).png\" style=\"height:134px; width:500px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'hotel-HN.jpg', 25),
(62, '2024/07/03', 'Kinh nghiệm du lịch Hà  tự túc: Đi đâu đẹp, ăn gì ngon?', '', '<h3 style=\"text-align:center\"><em><strong>H&agrave; Nội m&ugrave;a n&agrave;o đẹp</strong></em></h3>\r\n\r\n<p>Thời gian l&yacute; tưởng nhất để du lịch H&agrave; Nội l&agrave; v&agrave;o m&ugrave;a thu từ th&aacute;ng 8 đến th&aacute;ng 11 v&agrave; m&ugrave;a xu&acirc;n từ th&aacute;ng 3 đến th&aacute;ng 4. Kh&ocirc;ng &iacute;t người cho rằng&nbsp;<a href=\"https://vnexpress.net/thang-9-dac-san-mua-thu-cham-ngo-ha-noi-3464955.html\">m&ugrave;a thu</a>&nbsp;l&agrave; l&uacute;c tiết trời đẹp nhất trong năm ở H&agrave; Nội, với bầu trời xanh trong, gi&oacute; heo may se se lạnh, l&aacute; v&agrave;ng rơi, m&ugrave;i hoa sữa thoảng... M&ugrave;a xu&acirc;n về tiết trời ấm &aacute;p, đường phố như thay &aacute;o mới khi c&acirc;y cối đ&acirc;m chồi nảy lộc,&nbsp;<a href=\"https://vnexpress.net/projects/ha-noi-12-thang-hon-ca-12-mua-hoa-3720087/index.html\">mu&ocirc;n hoa đua nở</a>...</p>\r\n\r\n<p><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2022/05/11/ho-hoan-kiem-3319-1652253984.jpg?w=0&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=kicaGv990ST9pJ70bI1VJw\" /></p>\r\n\r\n<p>Lộc vừng thay l&aacute; b&ecirc;n hồ Gươm những ng&agrave;y xu&acirc;n.</p>\r\n', 'advice-HN.jpg', 1),
(63, '2024/07/03', ' Thịt gác bếp', '', '<h2 dir=\"ltr\">Thịt g&aacute;c bếp, đặc sản quanh năm của H&agrave; Giang, kh&ocirc;ng chỉ l&agrave; một m&oacute;n ăn truyền thống m&agrave; c&ograve;n l&agrave; qu&agrave; biểu tượng của v&ugrave;ng cao n&agrave;y.&nbsp; Những miếng thịt tr&acirc;u v&agrave; thịt lợn bản lớn được tẩm ướp kỹ c&agrave;ng với gia vị, sau đ&oacute; được g&aacute;c l&ecirc;n bếp. Điều đặc biệt nằm ở qu&aacute; tr&igrave;nh tẩm ướp với gừng, ớt v&agrave; mắc kh&eacute;n - loại hạt đặc trưng của v&ugrave;ng cao.&nbsp;</h2>\r\n\r\n<table align=\"center\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Thịt gác bếp - Thức đặc sản Hà Giang cực hảo hạng và thơm ngon\" src=\"https://baohagiang.vn/file/4028eaa4679b32c401679c0c74382a7e/122023/image5_20231218104757.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thịt g&aacute;c bếp - Thức đặc sản H&agrave; Giang cực hảo hạng v&agrave; thơm ngon</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p dir=\"ltr\">Thịt tr&acirc;u, với vị dai v&agrave; đậm đ&agrave; hơn so với thịt lợn, được thớ d&agrave;i rồi xi&ecirc;n v&agrave;o que treo l&ecirc;n g&aacute;c bếp để kh&ocirc;. Điều n&agrave;y tạo n&ecirc;n đặc điểm ri&ecirc;ng biệt của thịt g&aacute;c bếp H&agrave; Giang. Mặc d&ugrave; gi&aacute; th&agrave;nh cao hơn so với thịt lợn, nhưng đ&acirc;y l&agrave; một trải nghiệm ẩm thực kh&ocirc;ng thể phải l&ograve;ng.</p>\r\n\r\n<p dir=\"ltr\">Một mẹo nhỏ cho thực kh&aacute;ch l&agrave; n&ecirc;n hấp thịt g&aacute;c bếp để l&agrave;m mềm v&agrave; dễ ăn hơn. Đồng thời, bạn n&ecirc;n chấm m&oacute;n đặc sản n&agrave;y với muối mắc kh&eacute;n hoặc chẩm ch&eacute;o để tận hưởng hương vị tuyệt vời nhất nh&eacute;!</p>\r\n', 'trau-gac-bep-HG.jpg', 1),
(64, '2024/07/03', 'Cơm Lam Bắc Mê', '', '<p dir=\"ltr\">Cơm lam Bắc M&ecirc;, m&oacute;n đặc sản H&agrave; Giang, l&agrave; lựa chọn ưa th&iacute;ch của du kh&aacute;ch. Để chế biến cơm lam Bắc M&ecirc; kh&ocirc;ng kh&oacute;, chỉ cần ng&acirc;m gạo nếp, vo sạch v&agrave; rắc muối. Gạo nếp sau đ&oacute; được đặt v&agrave;o ống tre, tr&uacute;c v&agrave; nướng tr&ecirc;n bếp than hồng.&nbsp;</p>\r\n\r\n<table align=\"center\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Cơm Lam Bắc Mê - chiều lòng mọi thực khách đam mê ẩm thực\" src=\"https://baohagiang.vn/file/4028eaa4679b32c401679c0c74382a7e/122023/image6_20231218104916.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cơm Lam Bắc M&ecirc; - chiều l&ograve;ng mọi thực kh&aacute;ch đam m&ecirc; ẩm thực</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p dir=\"ltr\">Qu&aacute; tr&igrave;nh nướng cần xoay đều để nhiệt lan tỏa quanh vỏ tre, tr&uacute;c. Hương thơm của cơm lam Bắc M&ecirc; c&ugrave;ng với hương l&aacute; dong v&agrave; l&aacute; chuối nướng tạo n&ecirc;n bữa ăn hấp dẫn. V&agrave; bạn c&oacute; thể thưởng thức đặc sản n&agrave;y ăn k&egrave;m muối vừng, lạc hay c&aacute; nướng nha.</p>\r\n', 'com-lam-bac-me-HG.png', 1),
(65, '2024/07/03', 'Cột Cờ Lũng Cú', ' Đỉnh núi Long Sơn, Lũng Cú, Đồng Văn, Hà Giang', '<p><a href=\"https://www.klook.com/vi/city/34-hanoi-things-to-do/\" target=\"_blank\"><img alt=\"dia-diem-du-lich-ha-giang\" src=\"https://res.klook.com/image/upload/fl_lossy.progressive,q_85/c_fill,w_1000/v1696079920/esbpbnzlhzxoxlkmdsnn.webp\" /></a></p>\r\n\r\n<p><a href=\"https://www.klook.com/vi/city/34-hanoi-things-to-do/\" target=\"_blank\">Nguồn ảnh: B&aacute;o D&acirc;n tộc v&agrave; Ph&aacute;t triển</a></p>\r\n\r\n<p>Cột cờ Lũng C&uacute; tọa lạc tr&ecirc;n đỉnh ngọn n&uacute;i Rồng ở độ cao 1.470 m&eacute;t so với mực nước biển. L&agrave; một trong bốn điểm cực của Tổ quốc, cột cờ Lũng C&uacute; tại H&agrave; Giang đ&aacute;nh dấu điểm cực Bắc của đất nước.&nbsp;</p>\r\n\r\n<p>Cột cờ đ&atilde; được tr&ugrave;ng tu x&acirc;y dựng lại v&agrave;o năm 2010, mang theo l&aacute; cờ đỏ sao v&agrave;ng rộng 54 m&eacute;t vu&ocirc;ng tượng trưng cho 54 d&acirc;n tộc anh em bay phấp phới tr&ecirc;n độ cao hơn 33 m&eacute;t. Cột cờ Lũng C&uacute; c&oacute; thiết kế th&acirc;n h&igrave;nh b&aacute;t gi&aacute;c c&ugrave;ng t&aacute;m tấm ph&ugrave; đi&ecirc;u bằng đ&aacute; xanh dưới ch&acirc;n cột cờ m&ocirc; phỏng họa tiết Trống đồng Đ&ocirc;ng Sơn v&agrave; những trang lịch sử h&agrave;o h&ugrave;ng của d&acirc;n tộc.</p>\r\n\r\n<p>Để l&ecirc;n đến cột cờ, du kh&aacute;ch sẽ đi qua 839 bậc thang v&agrave; chi&ecirc;m ngưỡng cảnh non nước hữu t&igrave;nh dần hiện ra. Đứng tr&ecirc;n đỉnh n&uacute;i v&agrave; ph&oacute;ng tầm mắt ra xa, bạn sẽ cảm nhận được kh&iacute; trời m&aacute;t lạnh của v&ugrave;ng n&uacute;i Đ&ocirc;ng Bắc v&agrave; kh&ocirc;ng kh&iacute; trang nghi&ecirc;m tự h&agrave;o nơi đ&acirc;y. Ngo&agrave;i ra khi đến đ&acirc;y, bạn cũng c&oacute; thể dạo qua bản người L&ocirc; L&ocirc; v&agrave; người M&ocirc;ng c&ugrave;ng ao nước Mắt Rồng trong xanh nằm ngay dưới ch&acirc;n n&uacute;i.</p>\r\n', 'Cột_cờ_Lũng_Cú_HG.JPG', 4),
(66, '2024/07/03', 'Thung Lũng Sủng Là', 'Sủng Là, Đồng Văn, Hà Giang', '<p><a href=\"https://www.klook.com/vi/city/34-hanoi-things-to-do/\" target=\"_blank\"><img alt=\"dia-diem-du-lich-ha-giang\" src=\"https://res.klook.com/image/upload/fl_lossy.progressive,q_85/c_fill,w_1000/v1696080453/jsmwtvmvuykc8mir4i4k.webp\" /></a></p>\r\n\r\n<p>Giữa v&ugrave;ng cao nguy&ecirc;n đ&aacute; Đồng Văn h&ugrave;ng vĩ, bạn sẽ t&igrave;m được một &ldquo;thi&ecirc;n đường&rdquo; đầy hoa xinh đẹp nhất H&agrave; Giang mang t&ecirc;n thung lũng Sủng L&agrave;. Những t&acirc;m hồn kh&aacute;m ph&aacute; nhất định phải đến đ&acirc;y để cảm nhận vẻ đẹp mộc mạc, b&igrave;nh y&ecirc;n của n&uacute;i rừng.</p>\r\n\r\n<p>Sủng L&agrave; l&agrave; một ng&ocirc;i l&agrave;ng nằm y&ecirc;n b&igrave;nh giữa những d&atilde;y n&uacute;i đ&aacute; tai m&egrave;o hiểm trở. Nơi đ&acirc;y nổi tiếng với những m&aacute;i hi&ecirc;n nh&agrave; đơn sơ v&agrave; những bức tường r&agrave;o bằng đ&aacute; nhuốm m&agrave;u thời gian. Du kh&aacute;ch sẽ như lạc v&agrave;o chốn thần ti&ecirc;n với những thung lũng ngập tr&agrave;n sắc trắng thanh tao của hoa mận, hoa l&ecirc;, hoa cải, hay sắc hồng t&iacute;m của hoa đ&agrave;o rừng, v&agrave; hoa tam gi&aacute;c mạch v&agrave;o dịp cuối năm. Hai địa điểm bạn nhất định phải gh&eacute; thăm khi tới thung lũng Sủng L&agrave; đ&oacute; ch&iacute;nh l&agrave; l&agrave;ng văn h&oacute;a Lũng Cẩm, v&agrave; nh&agrave; của Pao trong bộ phim nổi tiếng. Tại đ&acirc;y, bạn sẽ được trải nghiệm bản sắc v&ugrave;ng cao qua những bữa ăn d&acirc;n d&atilde;, tr&ograve; chơi d&acirc;n gian, v&agrave; tiếng h&aacute;t mộc mạc của d&acirc;n tộc H&rsquo;M&ocirc;ng.&nbsp;</p>\r\n\r\n<p>Thung lũng nằm tr&ecirc;n quốc lộ 4C, c&aacute;ch huyện Đồng Văn chỉ khoảng 20 km. Dọc theo cung đường đ&egrave;o tới ng&atilde; ba Ph&oacute; Bảng sẽ l&agrave; điểm đẹp nhất để bạn c&oacute; thể ngắm nh&igrave;n to&agrave;n bộ thung lũng Sủng L&agrave;&nbsp;</p>\r\n', 'thung-lung-sung-la-HG-.jpg', 1),
(67, '2024/08/19', 'Hoang Su Phi Lodge', 'Nam Hong village Thong Nguyen, Hoang Su Phi, Hà Giang, Việt Nam ', '<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/219487105.jpg?k=12892f07040691c99a8df46ed5a7966ac4ba162e4ceb165520ae52ac7ebdaff0&amp;o=\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<p>Hoang Su Phi Lodge c&oacute; khu vườn, ph&ograve;ng chờ chung, s&acirc;n hi&ecirc;n v&agrave; nh&agrave; h&agrave;ng ở H&agrave; Giang. Ngo&agrave;i dịch vụ tiền sảnh, chỗ nghỉ n&agrave;y c&ograve;n c&oacute; s&acirc;n chơi trẻ em.</p>\r\n\r\n<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/296446648.jpg?k=622602b94e3567563bacb970b2a787beb0eb7b5311b484f40aaafabd88a0e091&amp;o=\" style=\"height:225px; width:300px\" /></p>\r\n\r\n<p>Chỗ nghỉ cung cấp lễ t&acirc;n 24/24, dịch vụ đưa đ&oacute;n s&acirc;n bay, dịch vụ ph&ograve;ng v&agrave; Wi-Fi miễn ph&iacute;. Tất cả c&aacute;c căn đi k&egrave;m tủ lạnh, l&ograve; nướng, ấm đun nước, v&ograve;i xịt/chậu rửa vệ sinh, đồ vệ sinh c&aacute; nh&acirc;n miễn ph&iacute; v&agrave; b&agrave;n l&agrave;m việc. Ngo&agrave;i ph&ograve;ng tắm ri&ecirc;ng được trang bị v&ograve;i sen v&agrave; m&aacute;y sấy t&oacute;c, c&aacute;c ph&ograve;ng tại kh&aacute;ch sạn đều c&oacute; view th&agrave;nh phố.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/273961929.jpg?k=ea7273968d7873c1ab7615eac2e870dbd0a5047102df68e9287cd24bbc658add&amp;o=\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<p>Tại Hoang Su Phi Lodge, tất cả c&aacute;c ph&ograve;ng đều c&oacute; ga trải giường v&agrave; khăn tắm. Chỗ nghỉ c&oacute; phục vụ bữa s&aacute;ng kiểu &Aacute; mỗi s&aacute;ng. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Wenshan Puzhehei, c&aacute;ch Hoang Su Phi Lodge 222 km.</p>\r\n', 'hotel-HG.jpg', 0),
(68, '2024/07/03', 'Ha Giang Wings Bungalow ', ' Tien Thang Hamlet, Phuong Thien Commune, Ha Giang, Hà Giang, Việt Nam', '<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/522041361.jpg?k=e87fa31db7478309343aef9bb995e636e83247fade6f679db7bfd4a597d329af&amp;o=\" style=\"height:225px; width:300px\" /></p>\r\n\r\n<p>Ha Giang Wings Bungalow c&oacute; Wi-Fi miễn ph&iacute; ở to&agrave;n bộ chỗ nghỉ v&agrave; nh&igrave;n ra hồ ở H&agrave; Giang. Mỗi ph&ograve;ng tại kh&aacute;ch sạn 3 sao n&agrave;y đều nh&igrave;n ra hồ bơi, đồng thời kh&aacute;ch c&oacute; thể sử dụng hồ bơi ngo&agrave;i trời v&agrave; khu vườn. Ở đ&acirc;y c&oacute; nh&agrave; h&agrave;ng phục vụ m&oacute;n ăn Mỹ v&agrave; chỗ đậu xe ri&ecirc;ng miễn ph&iacute;.</p>\r\n\r\n<p><img alt=\"\" src=\"https://cf.bstatic.com/xdata/images/hotel/max1024x768/522027530.jpg?k=04479afc903b6c07e1bfe512122789976dc57886219ede11b8f161eada477455&amp;o=\" style=\"height:225px; width:300px\" /></p>\r\n\r\n<p>Tại kh&aacute;ch sạn, c&aacute;c ph&ograve;ng đều đi k&egrave;m với điều h&ograve;a, b&agrave;n l&agrave;m việc, s&acirc;n hi&ecirc;n với view n&uacute;i, ph&ograve;ng tắm ri&ecirc;ng, TV m&agrave;n h&igrave;nh phẳng, ga trải giường v&agrave; khăn tắm. Tất cả c&aacute;c ph&ograve;ng đều c&oacute; minibar. Chỗ nghỉ c&oacute; phục vụ bữa s&aacute;ng thực đơn buffet, thực đơn &agrave; la carte hoặc kiểu &Aacute; mỗi buổi s&aacute;ng. Dịch vụ đề xuất 24/7 lu&ocirc;n c&oacute; sẵn tại lễ t&acirc;n với đội ngũ nh&acirc;n vi&ecirc;n th&agrave;nh thạo tiếng Anh v&agrave; tiếng Việt. S&acirc;n bay gần nhất l&agrave; S&acirc;n bay Wenshan Puzhehei, c&aacute;ch Ha Giang Wings Bungalow 150 km, đồng thời chỗ nghỉ n&agrave;y cũng cung cấp dịch vụ đưa đ&oacute;n s&acirc;n bay mất ph&iacute;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src=\"/ckeditor/ckfinder/userfiles/images/image(2).png\" style=\"height:88px; width:500px\" /></p>\r\n', 'ga-nuong-TD.jpg', 0),
(69, '2024/07/03', '	Kinh nghiệm du lịch Hà  tự túc: Đi đâu đẹp, ăn gì ngon?', '', '<h1 style=\"text-align:center\"><em><strong>H&agrave; Giang m&ugrave;a n&agrave;o đẹp?</strong></em></h1>\r\n\r\n<p>L&agrave; tỉnh miền n&uacute;i cao n&ecirc;n kh&iacute; hậu ở H&agrave; Giang lạnh r&otilde; rệt so với v&ugrave;ng thấp v&agrave; trung du kế cận. Nhiệt độ trung b&igrave;nh năm khoảng 21-23 độ C. N&eacute;t nổi bật của kh&iacute; hậu l&agrave; độ ẩm cao trong năm, mưa nhiều v&agrave; k&eacute;o d&agrave;i.</p>\r\n\r\n<p>Bạn c&oacute; thể du lịch H&agrave; Giang v&agrave;o bất kỳ m&ugrave;a n&agrave;o trong năm. Người ta thường đến H&agrave; Giang v&agrave;o m&ugrave;a thu l&uacute;a ch&iacute;n v&agrave;ng. Thời gian đẹp nhất l&agrave; th&aacute;ng 10, 11 v&agrave; 12, khi hoa tam gi&aacute;c mạch hay những c&aacute;nh đồng cải khoe sắc. C&ograve;n m&ugrave;a xu&acirc;n, hoa mơ, hoa mận nở trắng rừng khiến bạn như đang bồng bềnh tr&ecirc;n m&acirc;y.</p>\r\n\r\n<p>Th&aacute;ng 5, những thửa ruộng lấp lo&aacute;ng m&ugrave;a nước đổ. Th&aacute;ng 6 v&agrave; th&aacute;ng 7, nhiều người bỏ lỡ H&agrave; Giang v&igrave; những cơn mưa h&egrave; r&eacute;o rắt bất chợt. Nhưng cũng nhờ sự ẩm ướt n&agrave;y, n&uacute;i rừng nơi đ&acirc;y lại kho&aacute;c l&ecirc;n m&igrave;nh một m&agrave;u xanh mướt say đắm l&ograve;ng người.</p>\r\n\r\n<p><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2022/07/05/Meo-Vac-Ha-Giang-6830-16488070-5496-1277-1657019227.jpg?w=0&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=ARNpFMVrOMiRAU6WLShnkw\" style=\"height:202px; width:300px\" /></p>\r\n\r\n<p>Đ&aacute;m trẻ chạy giữa luống hoa cải v&agrave;ng ở M&egrave;o Vạc</p>\r\n\r\n<p><a href=\"https://i-dulich.vnecdn.net/2022/07/05/mua-xuan-ha-giang-vnexpress-8-6887-3357-1657019228.jpg\"><img alt=\"mua-xuan-ha-giang-vnexpress-8-5717-8783-\" src=\"https://i-dulich.vnecdn.net/2022/07/05/mua-xuan-ha-giang-vnexpress-8-6887-3357-1657019228.jpg\" style=\"height:200px; width:300px\" title=\"Chiều xuân trên Phố Cáo. Ảnh: Nguyễn Hữu Thông\" /></a></p>\r\n\r\n<p><a href=\"https://i-dulich.vnecdn.net/2022/07/05/mua-xuan-ha-giang-vnexpress-3-6189-6723-1657019228.jpg\"><img alt=\"mua-xuan-ha-giang-vnexpress-3-2794-8490-\" src=\"https://i-dulich.vnecdn.net/2022/07/05/mua-xuan-ha-giang-vnexpress-3-6189-6723-1657019228.jpg\" style=\"height:200px; width:300px\" title=\"Ảnh: Nguyễn Hữu Thông\" /></a></p>\r\n\r\n<p><a href=\"https://i-dulich.vnecdn.net/2022/07/05/Ha-Giang-tam-giac-mach-2777-16-1591-9108-1657019229.jpg\"><img alt=\"Ha-Giang-tam-giac-mach-2777-1648718522.j\" src=\"https://i-dulich.vnecdn.net/2022/07/05/Ha-Giang-tam-giac-mach-2777-16-1591-9108-1657019229.jpg\" style=\"height:202px; width:300px\" title=\"Mùa hoa tam giác mạch tại Lũng Táo, Đồng Văn. Ảnh: Nguyễn Đức Phước\" /></a></p>\r\n\r\n<h3>Di chuyển</h3>\r\n\r\n<p>Đến H&agrave; Giang từ c&aacute;c tỉnh miền Bắc rất dễ d&agrave;ng v&igrave; c&oacute; nhiều nh&agrave; xe chạy thẳng. Ngược lại với những du kh&aacute;ch ở xa trong miền Nam hoặc miền Trung th&igrave; n&ecirc;n bắt đầu h&agrave;nh tr&igrave;nh từ H&agrave; Nội. Từ H&agrave; Nội, hầu như giờ n&agrave;o cũng c&oacute; xe kh&aacute;ch xuất ph&aacute;t từ c&aacute;c bến xe Mỹ Đ&igrave;nh, Lương Y&ecirc;n, Y&ecirc;n Nghĩa, Gia L&acirc;m.</p>\r\n\r\n<p>Du kh&aacute;ch c&oacute; thể chọn xe giường nằm hoặc xe limousine chất lượng cao, t&ugrave;y theo t&agrave;i ch&iacute;nh. Tuy vậy, bạn n&ecirc;n di chuyển bằng xe kh&aacute;ch đ&ecirc;m để tiết kiệm được thời gian, giữ sức cho chuyến h&agrave;nh tr&igrave;nh kh&aacute;m ph&aacute; d&agrave;i. Gi&aacute; v&eacute; xe từ H&agrave; Nội đến H&agrave; Giang v&agrave; ngược lại dao động 200.000 - 300.000 đồng một lượt.</p>\r\n\r\n<p>Khi đến TP H&agrave; Giang, bạn c&oacute; thể thu&ecirc; xe m&aacute;y tự t&uacute;c du ngoạn với gi&aacute; 150.000 - 300.000 đồng một xe trong ng&agrave;y. Ngược lại nếu kh&ocirc;ng đủ thời gian v&agrave; sức khỏe, hoặc đo&agrave;n c&oacute; người gi&agrave; v&agrave; trẻ nhỏ th&igrave; bạn n&ecirc;n thu&ecirc; &ocirc; t&ocirc; dịch vụ 7 - 16 chỗ.</p>\r\n\r\n<h3>Kh&aacute;ch sạn, homestay đẹp</h3>\r\n\r\n<p>Những gia đ&igrave;nh, cặp đ&ocirc;i muốn lưu tr&uacute; tại khu nghỉ dưỡng cao cấp, ri&ecirc;ng biệt c&oacute; thể đến với P&#39;apiu ở x&atilde; Y&ecirc;n Định, huyện Bắc M&ecirc;. Tại đ&acirc;y, du kh&aacute;ch được đắm ch&igrave;m trong sắc m&agrave;u v&ugrave;ng cao bởi&nbsp;<a href=\"https://vnexpress.net/con-duong-tho-cam-dai-nhat-viet-nam-4222865.html\">con đường thổ cẩm</a>&nbsp;d&agrave;i nhất Việt Nam, lưu tr&uacute; trong những biệt thự, villa mang thiết kế nh&agrave; tr&igrave;nh tường của người H&#39;Mong. Gi&aacute; một đ&ecirc;m nghỉ khoảng 10.000.000 đồng.</p>\r\n\r\n<p>Với những du kh&aacute;ch y&ecirc;u th&iacute;ch sự mới lạ, H&#39;Mong Village với thiết kế h&igrave;nh quẩy tấu l&agrave; một gợi &yacute;. Khu nghỉ dưỡng nằm tr&ecirc;n những ngọn đồi ở Tr&aacute;ng K&igrave;m, Quản Bạ, mặt hướng về d&ograve;ng s&ocirc;ng Miện v&agrave; những d&atilde;y n&uacute;i h&ugrave;ng vĩ ph&iacute;a xa. Du kh&aacute;ch c&oacute; thể lựa chọn ở ph&ograve;ng cộng đồng, gi&aacute; 400.000 đồng một đ&ecirc;m hoặc ở bungalow quẩy tấu 2.400.000 đồng một đ&ecirc;m.</p>\r\n\r\n<p><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2022/07/05/Hoang-Su-Phi-Ha-Giang-1196-164-6724-9210-1657019230.jpg?w=0&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=YTmLZeGs7B2yAKNffb8QWA\" style=\"height:200px; width:300px\" /></p>\r\n', 'hotel-HG.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `blog_cate`
--

CREATE TABLE `blog_cate` (
  `blog_id` int NOT NULL,
  `cate_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_cate`
--

INSERT INTO `blog_cate` (`blog_id`, `cate_id`) VALUES
(37, 3),
(44, 1),
(46, 2),
(47, 2),
(50, 2),
(52, 4),
(53, 2),
(55, 1),
(54, 3),
(56, 1),
(57, 1),
(58, 3),
(59, 3),
(60, 2),
(61, 2),
(62, 4),
(63, 1),
(64, 1),
(65, 3),
(66, 3),
(68, 2),
(69, 4),
(67, 2),
(49, 1),
(51, 3),
(45, 1),
(43, 3),
(48, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `user_id` int NOT NULL,
  `voucher_id` int DEFAULT NULL,
  `no_adult` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_child` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `quantity` int NOT NULL,
  `payment methods` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `booking_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_day` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `variant_id`, `user_id`, `voucher_id`, `no_adult`, `no_child`, `total_price`, `quantity`, `payment methods`, `status`, `payment_status`, `booking_date`, `payment_day`, `created_at`, `transaction_code`) VALUES
(76, 1, 1, 43, NULL, '2', '0', 20000, 2, 'offline', 'complete', 'unpaid', '2024-09-12', NULL, '2024-09-05 14:31:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'food'),
(2, 'hotel'),
(3, 'destination'),
(4, 'advice');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `blog_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `likes` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `parent_id`, `comment`, `likes`, `created_at`) VALUES
(7, 65, 43, NULL, 'noi nay that dep', 0, '2024-08-01 09:12:39'),
(8, 65, 52, 7, 't ko thay dep', 4, '2024-08-01 09:18:12'),
(9, 65, 43, 8, 'k dep thi luon', 5, '2024-08-01 09:20:39'),
(10, 65, 43, NULL, 'fhfhgf', 1, '2024-08-01 09:56:48'),
(11, 66, 43, NULL, 'hehe\r\n', 0, '2024-08-05 02:25:27'),
(12, 58, 43, NULL, 'mê\r\n', 0, '2024-08-05 02:41:29'),
(13, 65, 43, 7, 'hay ', 0, '2024-08-05 07:22:24'),
(14, 56, 43, NULL, 'BỔ ÍCH LẮM\r\n', 0, '2024-08-05 09:57:22'),
(15, 57, 43, NULL, 'ngon nhức nách', 0, '2024-08-05 16:23:10'),
(16, 54, 43, NULL, 'good good', 0, '2024-08-27 03:09:42'),
(17, 58, 43, NULL, 'ẻwe', 0, '2024-08-27 09:59:04'),
(18, 58, 43, 17, 'đê', 0, '2024-08-27 09:59:56'),
(19, 60, 43, NULL, '123', 1, '2024-08-27 15:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `feedback_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_name`, `position`, `image_url`, `feedback_text`, `created_at`) VALUES
(6, 'phatrrrrrr', 'ôsin quèn', '/assets/img/profile/anh1.jpg', 'rất thú vị nha', '2024-08-13 03:18:44'),
(7, 'giangg', 'giám đốc', '/assets/img/profile/anh5.jpg', 'hay ho đẹp đẽ các kiểu đòn', '2024-08-13 03:30:54'),
(8, 'dtran ', 'nô tì', '/assets/img/profile/anh3.png', 'em ước ao được đi một lần nữa', '2024-08-13 03:31:42'),
(9, 'vutuan', 'o sen', '/assets/img/profile/anh4.jpg', 'một lần đi chơi thật tuyẹt', '2024-08-13 03:32:33'),
(10, 'hoàng', 'lái xe', '/assets/img/profile/anh2.png', 'tôi mới vui vui được 1 lần', '2024-08-13 03:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `image_url`) VALUES
(2, 'HA GIANG', 'anh-HG.jpg'),
(3, 'HA NOI', 'anh-ha-noi.jpg'),
(4, 'TAM DAO', 'quan-gio-tam-dao-ivivu-1.jpg'),
(5, 'NINH BINH', 'Du-lich-Trang-An-Ninh-Binh-7.jpg'),
(18, 'QUANG BINH', 'phongnhakebang.jpg'),
(19, 'DA NANG', 'Danang_banner_2600x1111_0.webp'),
(20, 'QUANG NINH', 'quang_ninh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location_blog`
--

CREATE TABLE `location_blog` (
  `location_id` int NOT NULL,
  `blog_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_blog`
--

INSERT INTO `location_blog` (`location_id`, `blog_id`) VALUES
(5, 37),
(5, 44),
(5, 46),
(5, 47),
(4, 50),
(4, 52),
(4, 53),
(4, 55),
(4, 54),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(3, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 68),
(2, 69),
(2, 67),
(4, 49),
(4, 51),
(5, 45),
(5, 43),
(5, 48);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `tour_id`, `rating`, `review`, `created_at`) VALUES
(3, 43, 1, 5, 'ui la troi mat lam nha <3', '2024-08-01 07:10:44'),
(4, 43, 1, 4, 'dep dien nguoi ra i nho', '2024-08-05 03:26:19'),
(5, 52, 1, 5, 'đi 10l rồi vẫn thíc', '2024-08-05 03:39:09'),
(15, 43, 17, 4, 'nice\r\n<3', '2024-08-28 08:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `setting_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES
(3, 'gallery_images', 'assets/img/tdadvice.png'),
(4, 'newsletter', 'TripBoss is the leading e-commerce travel platform that connects travelers with authentic local tours & activities.\r\n\r\nWe are a group of travel lovers who look for the most authentic local experiences.\r\n\r\nWe know how difficult it is to create an unforgettable journey so we created this platform to make it easier for you to find the activity that best fits your upcoming trip.'),
(5, 'facebook_link', '45464'),
(6, 'youtube_link', '7656'),
(7, 'linkedin_link', '656'),
(8, 'about_us_text', 'About us'),
(9, 'contact_us_text', 'Contact us'),
(10, 'privacy_policy_text', 'Privacy Policy'),
(11, 'help_text', 'Help'),
(12, 'address', 'Số 1, Yên Xá, Thanh Trì, Hà Nội'),
(13, 'phone', '+84 73647485'),
(14, 'email', '123@gmail.com'),
(182, 'website', 'http:/dulich.test/');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int NOT NULL,
  `tour_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `location_id` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `adult_price` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `child_price` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `time_tour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Itinerary` json NOT NULL,
  `quantity` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `tour_name`, `location_id`, `description`, `image`, `adult_price`, `child_price`, `time_tour`, `price`, `Itinerary`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TOUR DU LỊCH ĐÀ NẴNG – TOUR ĐÀ NẴNG 2 NGÀY 1 ĐÊM', 19, 'Tour du lịch Đà Nẵng 2 Ngày 1 Đêm tham quan những thắng cảnh thú vị, từ bán đảo Sơn Trà chiêm ngưỡng vẻ đẹp tuyệt mỹ và dừng chân tại Chùa Linh Ứng để thưởng ngoạn toàn cảnh phố biển Đà Nẵng trên cao như lạc vào chốn bồn lai tiên cảnh của Bà Nà, tham gia tour Đà Nẵng 2 ngày để cùng hòa mình vào làn nước biển xanh ngắt bên bờ cát trắng Mỹ Khê dài miên man cùng bạn bè và gia đình hay khám phá và tham quan các điểm đến nổi tiếng Đà Nẵng một trong 10 thành phố đáng sống nhất Đông Nam Á', 'tourtest.jpg', '10000', '1430000', '2 NGÀY 1 ĐÊM', '1430000', '[]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 04:46:06'),
(16, 'TOUR Hạ Long - Động Thiên Cung - Bảo tàng Quảng Ninh', 20, 'Điểm nhấn của chương trình\r\n\r\nĐặt chân đến Quảng Ninh – tỉnh đầu tiên có 4 thành phố: Hạ Long, Móng Cái, Uông Bí và Cẩm Phả tạo nên thành phố du lịch không chỉ nổi tiếng về biển như Vịnh Hạ Long với hàng nghìn đảo đá nhấp nhô trên sóng nước lung linh huyền ảo, những hang động tuyệt đẹp, những bãi tắm hoang sơ, làn nước mát lạnh trong veo đặt trưng của vùng đảo Cô Tô, Soi Sim, ... Không những thế, Quảng Ninh còn hấp dẫn du khách về không khí mát mẻ của vùng núi thiêng Yên Tử nơi hội tụ tâm linh, văn hóa và không gian nghỉ dưỡng đỉnh cao. Nếu bạn yêu sự hoang sơ của thiên nhiên, không gian thoáng mát thì hãy thử một lần ghé thăm cao nguyên Bình Liêu, được ví von như “Sapa vùng đất than”, với các cột mốc biên giới và dãy “cờ cỏ lau” hay con đường “Sống lưng khủng long” chạy dọc đường tuần biên luôn là điểm dừng yêu thích của du khách trong và ngoài tỉnh. ', 'dulichHL.jpg', '1990000', '1500000', '2 NGÀY 1 ', '1500000', '[{\"day\": \"1\", \"title\": \"Hà Nội - Hạ Long - Động Thiên \", \"activities\": {\"noon\": [\"Tham quan Động Thiên Cung là một trong những động đẹp nhất ở Hạ Long. Vẻ đẹp nguy nga và lộng lẫy bởi những lớp thạch nhũ và những luồng ánh sáng lung linh. Từ trên tàu ngắm nhìn các hòn đảo lớn nhỏ trong Vịnh Hạ Long: Hòn Gà Chọi, Hòn Lư Hương.\"], \"evening\": [\"Buổi tối, Quý khách tự do khám phá nhiều hoạt động dịch vụ giải trí sôi nổi tại “phố cổ” Bãi Cháy - nằm cạnh công viên Sun World Hạ Long từ những ẩm thực đường phố đến các quán cà phê siêu dễ thương như Hòn Gai Coffee & Lounge hay thoải mái bung xõa tại The Mini Bar, Brothers Pub,\"], \"morning\": [\"Xe đón Quý khách tại Vietravel Hà Nội (Số 03 Hai Bà Trưng, Phường Tràng Tiền, Quận Hoàn Kiếm) và khởi hành đưa Quý khách đi tham quan Hồ Hoàn Kiếm ngắm bên ngoài Tháp Rùa, Đền Ngọc Sơn, Cầu Thê Húc. Quý khách tiếp tục khởi hành đi Hạ Long theo đường cao tốc Hải Phòng – Hạ Long, trên đường ngắm cảnh Bạch Đằng Giang.\\r\\n\", \"Đến nơi, Quý khách Quý khách xuống thuyền đi du ngoạn Vịnh Hạ Long - Thắng cảnh thiên nhiên tuyệt đẹp và vô cùng sống động, được UNESCO công nhận là di sản thiên nhiên Thế giới năm 1994.\"], \"afternoon\": [\"Tham quan mua sắm đặc sản tại Hải Sản Hương Đà Hạ Long với nhiều mặt hàng nổi tiếng chả mực giã tay Hạ Long, thịt chưng mắm tép, ruốc tôm, sá sùng khô, cá cơm, cá chỉ vàng.\"]}}]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 07:15:57'),
(17, 'Tour Động Thiên Đường – Động Phong Nha', 18, 'Quảng Bình như một bức tranh hoành tráng; có rừng; có biển với nhiều cảnh quan thiên nhiên hùng vĩ; thắng cảnh nổi tiếng: Đèo Ngang; biển Nhật Lệ; Đá Nhảy đặc biệt là Vườn quốc gia Phong Nha Kẻ Bàng di sản thiên nhiên thế giới. Với hơn 400 hang động lớn nhỏ phong phú nên được mệnh danh là “Vương quốc hang động”; ẩn chứa những vẻ đẹp tuyệt mỹ của tạo hoá. Chương trình tour Quảng Bình 1 ngày khám phá hai hang động nổi tiếng nhất Động Phong Nha và Động Thiên Đường; giúp quý khách có những trải nghiệm đáng nhớ về vùng đất gió Lào; cát trắng.', 'tdadvice.png', '1050000', '700000', 'TRONG NGÀY', '700000', '[{\"day\": \"1\", \"title\": \"Tour Động Thiên Đường – Động Phong Nha\", \"activities\": {\"noon\": [\"nghỉ trưa\"], \"evening\": [\"đi ngủ\"], \"morning\": [\"Khởi hành đi Vườn quốc gia Phong Nha - Kẻ Bàng tham quan Động Thiên Đường \\\"Hoàng cung trong lòng đất\", \"Hành trình từ km 16 của đường Hồ Chí Minh nhánh Tây cách trung tâm thành phố Đồng Hới chừng 65km về hướng Tây Bắc, băng qua những tán rừng già ngợp lá, những dãy núi đá vôi trùng trùng điệp điệp, du khách sẽ đến Động Thiên Đường, hang động khô dài nhất châu Á đã được các nhà thám hiểm Hoàng gia Anh phát hiện vào năm 2005 là một  trong những kỳ quan tráng lệ và huyền ảo bậc nhất  thế giới với vẻ đẹp lộng lẫy của mình nên được mệnh danh \\\"Hoàng cung trong lòng đất\\\".\", \"Quý khách lên xe điện trung chuyển từ bãi đậu xe vào tận chân núi của hang động khoảng 2km. Hai bên đường là cánh rừng nguyên sinh cây cối xanh tươi, mát rượi, tiếng chim hót, tiếng ve kêu nghe thật vui tai.\"], \"afternoon\": [\"chơi vui\"]}}]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 04:47:14'),
(22, 'Tour Hà Giang 3N2Đ: Lũng Cú - Mã Pì Lèng - Sông Nho Quế', 2, 'Hà Giang - cao nguyên đá nơi địa đầu Tổ quốc không chỉ sở hữu nhiều danh lam thắng cảnh tuyệt đẹp, đây còn là nơi lưu giữ những nét văn hóa độc đáo của 22 dân tộc vùng cao. Khám phá Hà Giang với lịch trình 3 ngày 2 đêm, Quý khách sẽ được thả hồn mình vào khung cảnh thiên nhiên hùng vĩ, ngắm nhìn những ruộng hoa đầy sắc màu, tham gia làng văn hóa Lũng Cẩm và vui chơi tại những phiên chợ vùng cao đầy mới lạ,...\r\n\r\nLên đường khám phá Hà Giang cùng BestPrice ngay thôi để không bỏ lỡ nhiều chương trình hấp dẫn!', 'tour-ha-giang-3n2d-ha-giang-song-nho-que-lung-cu.jpg', '10000', '5000', '3N2Đ', '5000', '[{\"day\": \"1\", \"title\": \" Hà Nội - Hà Giang - Quản Bạ - Yên Minh\", \"activities\": {\"noon\": [\"Đến Hà Giang, đoàn ăn trưa tại nhà hàng \"], \"evening\": [\"Quý khách thưởng thức bữa tối tại nhà hàng và tự do khám phá Hà Giang, sau đó nghỉ đêm tại khách sạn.\"], \"morning\": [\"Trong hành trình di chuyển, du khách được ngắm cảnh rừng núi Đông Bắc hùng vĩ tuyệt đẹp. Tại đây, đoàn được chiêm ngưỡng những dãy núi cao chót vót với một bên là vực sâu chìm trong khu rừng nguyên sinh phong phú. Đi xa một đoạn, Quý khách có thể nhìn thấy những bản làng nhỏ nằm ngay dưới chân thung lũng. Dọc đường đi, xe sẽ dừng lại để Quý khách thư giãn và chụp hình lưu niệm.\"], \"afternoon\": [\"Quý khách lên xe di chuyển đến Quản Bạ. Du khách ngắm cảnh, chiêm ngưỡng Núi Đôi Cô Tiên và lắng nghe về truyền thuyết của ngọn núi này. Dừng chân tại cổng trời, đoàn ngắm nhìn trọn vẹn ngọn núi đôi tròn trịa, yên bình nằm ngay sát các thuở ruộng bậc thang màu mỡ. Cách đó không xa là rừng thông đẹp nhất Việt Nam có tuổi thọ lên đến gần một thập kỉ.\"]}}, {\"day\": \"2\", \"title\": \"Yên Minh - Lũng Cú - Mã Pì Lèng - Đồng Văn\", \"activities\": {\"noon\": [\"Khách du lịch Hà Giang thưởng thức bữa trưa tại nhà hàng với các món đặc sản tại đây.\\r\\n\\r\\n\"], \"evening\": [\"Thưởng thức bữa tối tại nhà hàng.\"], \"morning\": [\"Đầu tiên, đoàn du lịch Hà Giang dừng chân tại Dinh họ Vương. Đây là công trình nổi tiếng với kiến trúc độc đáo và câu chuyện lịch sử hấp dẫn. Quý khách được tham quan 3 dinh khác nhau gồm 64 buồng được chia thành 2 tầng. Đoàn chiêm ngưỡng các vật dụng và nội thất cổ gắn liền với Vua Mèo và check in tại sân chính - nơi có cổng trời và được bao quanh bởi 4 nhà ngang.\", \"iếp theo, đoàn di chuyển đến cột cờ Lũng Cú - cột mốc biên giới quan trọng khu vực phía Bắc. Quý khách sẽ được trải nghiệm hát Quốc ca tại nơi địa đầu Tổ Quốc và tận mắt chiêm ngưỡng quang cảnh vùng núi Tây Bắc hùng vĩ với 2 ao nước trong xanh còn gọi là ao mắt Rồng. Cả đoàn chụp ảnh lưu niệm tại chân cột cờ và nghỉ ngơi uống nước để di chuyển xuống thị trấn.\"], \"afternoon\": [\"Đoàn tiếp tục hành trình du lịch Hà Giang. Quý khách được thử sức khi chinh phục đèo Mã Pì Lèng - một trong tứ đại đỉnh đèo tại Tây Bắc. Cung đèo trắc trở nằm trên vách núi cao, nhìn xuống là dòng sông Nho Quế xanh mát như ngọc. Đoàn có thể tự do tham quan, check-in tại hẻm vực Mã Pì Lèng -  một trong những địa điểm sống ảo mà du khách không thể bỏ qua. \", \"Sau đó, Quý khách ngồi thuyền du ngoạn trên sông Nho Quế và nghe HDV thuyết minh trên dòng sông này. Đoàn thưởng ngoạn trên sông và ngắm nhìn hẻm Tu Sản - khu vực hẻm sâu nhất Việt Nam (chi phí xe ôm xuống bến tàu tự túc). Hẻm Tu Sản thơ mộng được hình thành bởi hai bên dãy núi cao liên tiếp với nền thực vật đa dạng, du khách có thể ngồi thuyền ăn uống nhẹ và chụp ảnh check in tại đây.\"]}}]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 07:22:20'),
(23, 'Tour du lịch Ninh Bình - 2 NGÀY 1 ĐÊM', 5, 'Chạy trốn Hà Nội vội vã và đến với bức tranh thiên nhiên tuyệt đẹp của Tràng An và chốn tâm linh yên bình của Tam Chúc\r\nChiêm ngưỡng quần thể chùa Tam Chúc nức tiếng Hà Nam được bao quanh bởi hệ thống sông và những thửa rừng xanh mướt\r\nTham quan Quần thể danh thắng Tràng An, di sản văn hóa và thiên nhiên thế giới do UNESCO công nhận\r\nDành cho bản thân mình một chút yên tĩnh khi thuyền đưa bạn qua sông để đến những cảnh quan tuyệt vời', 'Bai-Dinh-1.png', '9000', '4000', '2N1D', '4000', '[{\"day\": \"1\", \"title\": \"HÀ NỘI – NINH BÌNH – HOA LƯ – TAM CỐC (ĂN TRƯA / TỐI)\", \"activities\": {\"noon\": [\"Quý khách về nhà hàng nghỉ ngơi dùng cơm trưa\"], \"evening\": [\"Sau khi dùng bữa tối, quý khách tự do khám phá vẻ đẹp Ninh Bình về đêm. \"], \"morning\": [\" khởi hành đi Ninh Bình.\\r\\n\\r\\n\"], \"afternoon\": [\"ngồi thuyền đi xuôi theo dòng sông Ngô Đồng với ruộng lúa hai bên bờ để vào khám phá Tam Cốc. Tại đây, quý khách sẽ được khám phá\", \"Đền thờ vua Đinh Tiên Hoàng toạ lạc tại khu vực trung tâm Cố đô Hoa Lư, có lối kiến trúc “nội công ngoại quốc”  là một trong những lối kiến trúc nổi tiếng và đặc biệt của Việt Nam. Với đền thờ được toạ lạc ở ngay vị trí chính điện với toà nhà ba gian: Bái đường, Thiêu hương và Chính cung. Trên sân rồng ngay trước gian giữa của Bái đường và trước nghi môn ngoại có sập long sàng bằng đá xanh nguyên khối đã được công nhận là bảo vật Quốc gia.\", \"Đền thờ vua Lê Đại Hành, là toà cũng bao gồm Bái đường, Thiêu hương và Chính cung. Tuy nhiên đền vua Lê Đại Hành có quy mô nhỏ hơn và thấp hơn so với đền thờ vua Đinh Tiên Hoàng, không gian trong đền gần gũi và huyền ảo, với lối kiến trúc độc đảo nghệ thuật chạm khắc vô cùng tinh xảo cùng với đó là chất liều được sơn son thép vàng vô cùng nổi bật với hoạ tiết mang đậm chất cung đình và văn hoá nghệ thuật đặc sắc.\"]}}, {\"day\": \"2\", \"title\": \"QƯERTYUI\", \"activities\": {\"noon\": [\"Sau đó quý khách thăm quan chùa Ngọc. Chùa Ngọc tọa lạc trên đỉnh núi Thất Tinh, đây là một trong những hạng mục chính của chùa Tam Chúc. Để có thể chiêm ngưỡng được ngôi chùa này bạn sẽ phải vượt qua 200 bậc thang bằng đá. Đứng trên chùa Ngọc bạn sẽ được phóng tầm mắt chiêm ngưỡng một khung cảnh mênh mông vô cùng yên bình và tự tại.Quý khách tiếp tục chiêm ngưỡng vẻ đẹp của Điện Tam Bảo, Điện thờ Pháp Chủ Thích Ca Mâu Ni, Điện Quan Âm và Vườn Cột Kinh.\"], \"evening\": [\"\"], \"morning\": [\" thăm quan chùa Tam Chúc—Ngôi chùa linh thiêng được xây dựng với hàng nghìn bức tranh bằng đá được ghép tỉ mỉ, cẩn thận bởi đôi bàn tay tài hoa của những người thợ thủ công lành nghề.\"], \"afternoon\": [\"\"]}}]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 07:47:45'),
(24, 'TEST', 4, 'test', 'anhTD.jpg', '213212', '133333', 'test', '13333', '[{\"day\": \"1\", \"title\": \"3we\", \"activities\": {\"noon\": [\"qưe\"], \"evening\": [\"ưeqw\"], \"morning\": [\"ưqee\"], \"afternoon\": [\"qưeq\"]}}, {\"day\": \"2\", \"title\": \"ưeqwsada\", \"activities\": {\"noon\": [\"ưeq\"], \"evening\": [\"dfsdf\"], \"morning\": [\"qưe\"], \"afternoon\": [\"ưesada\"]}}, {\"day\": \"3\", \"title\": \"ƯED\", \"activities\": {\"noon\": [\"ỨD\"], \"evening\": [\"\"], \"morning\": [\"ỨAD\"], \"afternoon\": [\"ỨAD\"]}}]', 0, 1, '2024-08-28 17:00:00', '2024-08-29 09:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `tour_attributes`
--

CREATE TABLE `tour_attributes` (
  `attribute_id` int NOT NULL,
  `attribute_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_attributes`
--

INSERT INTO `tour_attributes` (`attribute_id`, `attribute_name`) VALUES
(1, 'restaurant'),
(2, 'car rental'),
(3, 'Wifi'),
(4, 'Bồn tắm'),
(5, 'Máy giặt'),
(6, 'Bếp điện');

-- --------------------------------------------------------

--
-- Table structure for table `tour_attribute_values`
--

CREATE TABLE `tour_attribute_values` (
  `tour_id` int NOT NULL,
  `attribute_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_attribute_values`
--

INSERT INTO `tour_attribute_values` (`tour_id`, `attribute_id`) VALUES
(1, 1),
(1, 3),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tour_variants`
--

CREATE TABLE `tour_variants` (
  `id` int NOT NULL,
  `tour_id` int NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sale_price` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_variants`
--

INSERT INTO `tour_variants` (`id`, `tour_id`, `variant_name`, `sale_price`, `price`, `quantity`) VALUES
(1, 1, '\r\nTrẻ em dưới 5 tuổi: miễn phí.', 0, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tour_voucher`
--

CREATE TABLE `tour_voucher` (
  `tour_id` int NOT NULL,
  `voucher_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_voucher`
--

INSERT INTO `tour_voucher` (`tour_id`, `voucher_id`) VALUES
(1, 2),
(1, 3),
(1, 14),
(1, 2),
(1, 15),
(1, 18),
(1, 14),
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phoneNo` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_verified` int DEFAULT '0',
  `resettoken` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resettokenexpired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `role`, `full_name`, `username`, `email`, `dob`, `address`, `phoneNo`, `password`, `img`, `verification_code`, `is_verified`, `resettoken`, `resettokenexpired`) VALUES
(41, 0, 'tunn', 'admin', 'admin@gmail.com', '2020-05-06', '', '099999', '$2y$10$pIBuHIRn51QQvfOyXOrH3.Cnrx85/y9M0IWslTJmS7ik5lKlIfQTi', 'im3.jpg', '48266d9a6c51c5c3f5705184942ef60f', 0, NULL, NULL),
(43, 1, 'vuthutun', 'thutun', 'anc@gmail.com', '2020-06-26', 'Yên Xá', '0123456789', '$2y$10$fFOiZl1HidgnZ5XiU0bHuuYe555H4JMehZX1mvLLgB9st.QW2QUIq', 'im1.jpg', 'a32268a67334164b57f3910b95879e09', 0, NULL, NULL),
(44, 1, 'kimoanhh', 'cucbeo123', 'tin123@gmail.com', '2024-05-28', '', '23123123', '$2y$10$TohqFojPmJExlKB.w7by8e3SfoLxKVftASyrbIm.RmmgBL.8jkwa.', 'im2.jpg', '3a8f8bbe65416ad689267ca2e115f678', 0, NULL, NULL),
(47, 1, 'tun', 'tun', 'vuthugiang1105@gmail.com', '2024-06-04', '', '1234567', '$2y$10$1WekGpawn9biEknEzCjV3elMGrp6bbZnEGMC3zdJWb1Wvne.PPvEy', '', '7e843d7d49afa8311401c5af67990285', 1, NULL, NULL),
(51, 1, 'la', 'la', 'datt18776@gmail.com', NULL, '', NULL, '$2y$10$1g5RdNDPtjh9RHaCwsck4uRiNHpGNavsmMTEVzogbOH.NgkSFV0PK', '', '0f2f74aec383bb165c469aea23b75fec', 0, NULL, NULL),
(52, 1, 'phat', 'phat', 'phatdhdhd@gmail.com', '2024-08-25', NULL, '2344566', '$2y$10$lwTdAKvFT/1KESpUpJ5FTu8CwbzDuPObpI2im6cvIl7eSywl.1q3u', 'anh7.jpg', '9f222d71bd2570e386d1c16d838942df', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int NOT NULL,
  `voucher_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `discount` int NOT NULL,
  `quantity` int NOT NULL,
  `validity_start` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `validity_end` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`voucher_id`, `voucher_code`, `discount`, `quantity`, `validity_start`, `validity_end`, `created_at`) VALUES
(2, 'ABS', 90, 2, '29/7/2024', '30/10/2024', '2024-07-29 04:18:08'),
(3, 'hè tưng bừng', 10, 9, '2024-08-31', '2024-09-04', '2024-08-30 20:49:34'),
(14, 'noel 2024', 10, 156, '2024-12-01', '2024-12-31', '2024-08-31 10:28:04'),
(15, 'test', 90, 990, '2024-09-03', '2024-10-12', '2024-09-02 21:53:53'),
(16, 'Trung thu vui vẻ', 15, 50, '2024-09-05', '2024-10-12', '2024-09-03 21:51:47'),
(18, 'rer', 14, 3, '2024-09-03', '2024-10-03', '2024-09-04 07:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `added_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `tour_id`, `added_date`) VALUES
(68, 43, 1, '2024-09-05 07:21:02'),
(69, 43, 17, '2024-09-05 07:21:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_cate`
--
ALTER TABLE `blog_cate`
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `foreignkeybooking_tour_id` (`tour_id`),
  ADD KEY `foreignkeybooking_user_id` (`user_id`),
  ADD KEY `foreignkeybooking_variant_id` (`variant_id`),
  ADD KEY `foreignkeybooking_voucher_id` (`voucher_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_blog`
--
ALTER TABLE `location_blog`
  ADD KEY `location_id` (`location_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tours_location` (`location_id`);

--
-- Indexes for table `tour_attributes`
--
ALTER TABLE `tour_attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `tour_attribute_values`
--
ALTER TABLE `tour_attribute_values`
  ADD KEY `foreignkey_tour_id` (`tour_id`),
  ADD KEY `foreignkey_attribute_id` (`attribute_id`);

--
-- Indexes for table `tour_variants`
--
ALTER TABLE `tour_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_voucher`
--
ALTER TABLE `tour_voucher`
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tour_attributes`
--
ALTER TABLE `tour_attributes`
  MODIFY `attribute_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_variants`
--
ALTER TABLE `tour_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_cate`
--
ALTER TABLE `blog_cate`
  ADD CONSTRAINT `blog_cate_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blog_cate_ibfk_2` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `foreignkeybooking_tour_id` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreignkeybooking_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreignkeybooking_variant_id` FOREIGN KEY (`variant_id`) REFERENCES `tour_variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreignkeybooking_voucher_id` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`voucher_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `location_blog`
--
ALTER TABLE `location_blog`
  ADD CONSTRAINT `location_blog_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `location_blog_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_tours_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour_attribute_values`
--
ALTER TABLE `tour_attribute_values`
  ADD CONSTRAINT `foreignkey_attribute_id` FOREIGN KEY (`attribute_id`) REFERENCES `tour_attributes` (`attribute_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreignkey_tour_id` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour_variants`
--
ALTER TABLE `tour_variants`
  ADD CONSTRAINT `tour_variants_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour_voucher`
--
ALTER TABLE `tour_voucher`
  ADD CONSTRAINT `tour_voucher_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tour_voucher_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`voucher_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
