<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<head>
    <!-- Nội dung thẻ head của bạn -->
    <style>
    .tour-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
        position: relative;
        height: 420px; /* Điều chỉnh chiều cao của card để đảm bảo tất cả nội dung hiển thị đầy đủ */
        display: flex;
        flex-direction: column;
    }

    .tour-card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .card-header1 {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;       
        z-index: 2;
    }
    .heart-icon {
        font-size: 2.5rem;
        cursor: pointer;
        color: #ddd;
        position: absolute;
        top: 10px;
        right: -280px;
        transition: color 0.3s ease;
    }

    .heart-icon.heart-red {
        color: red;
    }

    .card-img-top {
        height: 150px; 
        width: 100%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .card-body {
        padding: 15px;
        flex-grow: 1; 
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 15px;
    }

    .time-touring {
        background-color: #FFD580;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
        font-size: 0.8rem;
    }

    .tour-card p:last-child {
        margin-bottom: 0;
    }
    .card-body i {
        font-size: 0.8rem;
        color: #FFD700;
    }
    .filter-section-container {
            background-color: #f0f8ff; 
            border-radius: 8px; 
            padding: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; 
        }

        .filter-section h5 {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff9800; 
            border-color: #ff9800;
            color: white; 
        }

        .btn-primary:hover {
            background-color: #e68900; 
            border-color: #e68900;
        }

        .btn-link {
            text-decoration: none;
        }

        .hidden {
            display: none;
        }

        .show {
            display: block;
        }
                /* CSS cho thanh trượt và giá trị hiển thị */
                .price-range-container {
            margin-bottom: 20px;
        }

        .price-range {
            width: 100%;
        }

        .price-range-values {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .price-range-values span {
            font-weight: bold;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #ff9800;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #ff9800;
            cursor: pointer;
        }
</style>

</head>