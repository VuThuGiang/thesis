<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Search Results</title>
    <style>
        .tour-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            height: 400px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tour-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-header1 {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            z-index: 2;
        }

        .heart-icon {
            font-size: 2rem;
            cursor: pointer;
            color: #ddd;
            position: absolute;
            top: 10px;
            right: -300px;
            transition: color 0.3s ease;
        }

        .heart-icon.heart-red {
            color: red;
        }

        .card-img-top {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            /* Increase margin to separate title from time */
        }

        .price {
            font-size: 1rem;
            color: red;
            font-weight: bold;
            margin-bottom: 5px;
            /* Add margin below price */
        }

        .time-touring {
            background-color: #FFD580;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            font-size: 0.8rem;
            margin-bottom: 10px;
            color: #333;
            text-align: center;
            width: 105px;
            margin-left: 110px;
        }


        .time-touring i {
            margin-right: 5px;
        }

        .btn-primary {
            background-color: orange;
            border-color: orange;
            color: white;
            width: 100%;
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