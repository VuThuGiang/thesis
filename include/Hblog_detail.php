<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/blog_detail.css">
    <style>
        .shadow-box {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .tags {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .tags h5 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .tags .tag-item {
            display: inline-block;
            background-color: #e9ecef;
            color: #333;
            padding: 5px 10px;
            margin: 5px 5px 0 0;
            border-radius: 20px;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .tags .tag-item:hover {
            background-color: #d6d8db;
        }

        .liked {
            color: red;
        }

        .unliked {
            color: gray;
        }

        .like-button {
            margin-left: 0px;
            margin-block-start: -2px;
            border: none;
            background-color: #fff;
        }

        .replies {
            margin-left: 20px;
            display: none;
        }

        .toggle-button {
            background: none;
            border: none;
            color: blue;
            cursor: pointer;
            text-decoration: none;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 60px;
        }

        .related-posts {
            margin-top: 30px;
           
        }

        .related-posts .card {
            margin-bottom: 15px;
            border: none;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .related-posts .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .related-posts .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .related-posts .card-text {
            font-size: 1rem;
            text-align: left;
            margin: 0;
            padding: 0;
        }

        .related-posts .card-footer {
            background-color: #fff;
            border-top: none;
        }

        .related-posts .card a {
            text-decoration: none;
            color: inherit;
        }

        .new-posts ul {
            list-style-type: none;
            padding: 0;
        }

        .new-posts ul li {
            margin-bottom: 10px;
        }

        .new-posts ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .new-posts ul li a:hover {
            text-decoration: underline;
        }

        .popular-posts .post-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .popular-posts .post-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 15px;
        }

        .popular-posts .post-item .post-details {
            flex: 1;
        }

        .popular-posts .post-item .post-details h6 {
            margin: 0;
            font-size: 1.1rem;
        }

        .popular-posts .post-item .post-details .post-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .btn5 {
            margin-top: 10px;
            align-self: center;
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn5:hover {
            background-color: #e55a4f;
        }

    </style>
</head>