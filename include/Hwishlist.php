<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .container1 {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .tour-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            background-color: #fff;
            position: relative;
        }

        .tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header1 {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 5px;
        }

        .tour-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            color: #666;
        }

        .time-touring {
            background-color: #FFD580;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            font-size: 0.8rem;
        }

        .star-rating i {
            color: #f8d64e;
            font-size: 1rem;
        }

        .star-rating .far {
            color: #ddd;
        }

        .cf-title-02 {
            text-align: center;
            margin-bottom: 30px;
        }

        .cf-title-02 h3 {
            font-size: 2rem;
            color: #333;
        }

        .cf-title-02 span {
            font-size: 1.25rem;
            color: #666;
        }
     
        .heart-icon {
            margin-left: 330px;
            margin-top: 10px;
            color: red; 
            cursor: pointer; 
            font-size: 1.5em; 
            transition: color 0.3s ease; 
        }

        .heart-icon:hover {
            color: darkred;}
    </style>
</head>