<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Nội Bộ -->
    <style>
        /* Đặt kiểu dáng chung cho toàn bộ phần tìm kiếm */
        .ftco-section {
            padding: 50px 0;
        }

        .search-wrap-1 {
            background: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 230px;
        }

        .search-wrap-1 .form-group label {
            font-weight: bold;
            color: #333;
        }

        .search-wrap-1 .form-field {
            position: relative;
        }

        .search-wrap-1 .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            height: 50px;
            padding: 10px 20px;
            font-size: 16px;
            color: #333;
        }

        .search-wrap-1 .form-control::placeholder {
            color: #888;
        }

        .search-wrap-1 .searchY {
            background-color: #ff5722; /* Màu cam đậm cho nút */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px 30px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .search-wrap-1 .searchY:hover {
            background-color: #e64a19; /* Màu cam đậm hơn khi hover */
        }

        /* Căn chỉnh cột và canh giữa nội dung */
        .search-wrap-1 .row {
            display: flex;
            align-items: flex-end;
        }

        .search-wrap-1 .col-lg {
            flex: 1;
            margin-right: 15px;
        }

        .search-wrap-1 .col-lg:last-child {
            margin-right: 0;
        }

        @media (max-width: 768px) {
            /* Đối với màn hình nhỏ, căn giữa nội dung */
            .search-wrap-1 .row {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrap-1 .col-lg {
                margin-bottom: 15px;
            }

            .search-wrap-1 .col-lg:last-child {
                margin-bottom: 0;
            }

            .search-wrap-1 .form-control {
                width: 100%;
            }

            .search-wrap-1 .searchY {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate p-4">
                        <form action="/pages/search_results.php" method="GET" class="search-property-1">
                            <!-- Chuyển hướng đến search_results.php -->
                            <div class="row">
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Destination</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" name="destination" placeholder="Search place">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg align-self-end">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input type="submit" value="Search" class="searchY">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Thêm Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
