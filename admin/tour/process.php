<?php
require("/laragon/www/dulich/connection.php");

// Define the escapeArray function to sanitize array inputs
function escapeArray($con, $array) {
    if (!is_array($array)) {
        return mysqli_real_escape_string($con, $array); // Handle non-array values
    }

    return array_map(function ($value) use ($con) {
        if (is_array($value)) {
            return escapeArray($con, $value); // Recursive call for multidimensional arrays
        } else {
            return mysqli_real_escape_string($con, $value);
        }
    }, $array);
}

// Đặt thư mục lưu trữ ảnh
$targetDir = '/admin/anh/';

// Lấy dữ liệu từ form và xử lý để chống SQL Injection
$tour_name = mysqli_real_escape_string($con, $_POST['tour_name']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$time_tour = mysqli_real_escape_string($con, $_POST['time_tour']);
$adult_price = floatval($_POST['adult_price']);
$child_price = floatval($_POST['child_price']);
$price = floatval($_POST['price']);
$create_day = mysqli_real_escape_string($con, $_POST['create_day']);
$category = mysqli_real_escape_string($con, $_POST['category']);
$location_id = intval($_POST['location_id']); // Ensure location_id is an integer
$imageURL = '';

// Kiểm tra nếu có ID (nghĩa là đang chỉnh sửa)
$id = isset($_POST['id']) ? intval($_POST['id']) : null;

// Xử lý tệp hình ảnh nếu có
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $targetFile =  $imageName;

    // Kiểm tra định dạng tệp
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Di chuyển tệp đã tải lên thư mục đích
    if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
        $imageURL = $targetFile;
    } else {
        die("Error uploading file");
    }
}

// Xử lý hành trình và các thông tin khác
$itinerary_data = [];
if (isset($_POST['itinerary_days']) && is_array($_POST['itinerary_days'])) {
    $itinerary_days = $_POST['itinerary_days'];
    $itinerary_titles = $_POST['itinerary_titles'];
    $itinerary_morning = $_POST['itinerary_morning'];
    $itinerary_noon = $_POST['itinerary_noon'];
    $itinerary_afternoon = $_POST['itinerary_afternoon'];
    $itinerary_evening = $_POST['itinerary_evening'];

    for ($i = 0; $i < count($itinerary_days); $i++) {
        $morning_activities = isset($itinerary_morning[$i]) ? escapeArray($con, $itinerary_morning[$i]) : [];
        $noon_activities = isset($itinerary_noon[$i]) ? escapeArray($con, $itinerary_noon[$i]) : [];
        $afternoon_activities = isset($itinerary_afternoon[$i]) ? escapeArray($con, $itinerary_afternoon[$i]) : [];
        $evening_activities = isset($itinerary_evening[$i]) ? escapeArray($con, $itinerary_evening[$i]) : [];

        $itinerary_data[] = [
            'day' => mysqli_real_escape_string($con, $itinerary_days[$i]),
            'title' => mysqli_real_escape_string($con, $itinerary_titles[$i]),
            'activities' => [
                'morning' => $morning_activities,
                'noon' => $noon_activities,
                'afternoon' => $afternoon_activities,
                'evening' => $evening_activities
            ]
        ];
    }
}

// Chuyển đổi dữ liệu hành trình thành JSON để lưu vào cơ sở dữ liệu
$itinerary_json = json_encode($itinerary_data, JSON_UNESCAPED_UNICODE);

if ($itinerary_json === false) {
    die("Error encoding itinerary data to JSON: " . json_last_error_msg());
}

if ($id) {
    // Nếu có ID, thực hiện cập nhật tour
    $sql = "UPDATE tours SET 
                tour_name='$tour_name', 
                description='$description', 
                adult_price='$adult_price', 
                child_price='$child_price', 
                time_tour='$time_tour', 
                price='$price', 
                Itinerary='$itinerary_json', 
                location_id='$location_id',  
                quantity=0, 
                status=1, 
                created_at='$create_day', 
                updated_at=NOW()";

    // Thêm thông tin ảnh nếu có ảnh mới được tải lên
    if ($imageURL !== '') {
        $sql .= ", image='$imageURL'";
    }

    $sql .= " WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        header("Location: tour.php?msg=Cập nhật tour thành công!");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $con->error;
    }
} else {
    // Nếu không có ID, thực hiện tạo mới tour
    $sql = "INSERT INTO tours (tour_name, description, image, adult_price, child_price, time_tour, price, Itinerary, location_id, quantity, status, created_at, updated_at) 
            VALUES ('$tour_name', '$description', '$imageURL', '$adult_price', '$child_price', '$time_tour', '$price', '$itinerary_json', '$location_id', 0, 1, '$create_day', NOW())";

    if ($con->query($sql) === TRUE) {
        header("Location: tour.php?msg=Tạo tour thành công!");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $con->error;
    }
}

// Đóng kết nối
$con->close();
?>
