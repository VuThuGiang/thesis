<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-card .image-container {
            flex: 0 0 150px;
            max-width: 150px;
            overflow: hidden;
            border-radius: 5px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f8f8;
        }

        .order-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-details {
            flex: 1;
        }

        .order-details h5 {
            margin-bottom: 10px;
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .order-details p {
            margin-bottom: 5px;
            color: #666;
            font-size: 0.9rem;
        }

        .order-details .description {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .order-details  {
            font-weight: bold;
            color: #28a745;
        }

        .order-details .price2 {
            font-weight: bold;
            color: #ff0000;
            font-size: 1.2rem;
        }

        .order-actions {
            text-align: right;
        }

        .order-actions button {
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .order-card .badge {
            font-size: 0.8rem;
            margin-right: 5px;
        }

        .order-rating {
            color: #ffc107;
            margin-bottom: 10px;
        }

        .tab-content>.tab-pane {
            padding-top: 20px;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #007bff !important;
            border-color: #007bff !important;
        }

        div#orderTabsContent {
            height: 100vh;
            overflow-y: auto;
        }
        .rating-stars i {
        color: gray; /* Màu mặc định của sao chưa chọn */
        cursor: pointer;
        font-size: 24px;
    }

    .rating-stars i.selected {
        color: orange; /* Màu cam cho sao đã chọn */
    }
    </style>
</head>