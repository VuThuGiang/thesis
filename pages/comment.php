<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .review-form {
            width: 880px;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .details {
            flex-grow: 1;
        }

        .name {
            font-weight: bold;
            font-size: 16px;
        }

        .date {
            font-size: 12px;
            color: #888;
        }

        .stars {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .star {
            color: #ddd;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star:hover,
        .star.selected {
            color: #FFD700;
        }

        .review-content {
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

      

        .review-text {
            width: 97%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 55px;
            resize: none;
        }
    </style>
</head>

<body>
    <div class="review-form">
        <div class="user-info">
            <img src="/assets/img/profile/anh1.jpg" alt="User Avatar" class="avatar">
            <div class="details">
                <div class="name">Hai ngan</div>
                <div class="date">2024/07/29 </div>
            </div>
        </div>
        <div class="stars">
            <span class="star" data-value="1">&#9733;</span>
            <span class="star" data-value="2">&#9733;</span>
            <span class="star" data-value="3">&#9733;</span>
            <span class="star" data-value="4">&#9733;</span>
            <span class="star" data-value="5">&#9733;</span>
        </div>
        <div class="review-content">
            <textarea placeholder="Nội dung đánh giá" class="review-text"></textarea>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star');
            let selectedRating = 0;

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    updateStarSelection(star.getAttribute('data-value'));
                });

                star.addEventListener('mouseout', () => {
                    updateStarSelection(selectedRating);
                });

                star.addEventListener('click', () => {
                    selectedRating = star.getAttribute('data-value');
                    updateStarSelection(selectedRating);
                });
            });

            function updateStarSelection(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= rating) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }
        });
    </script>

</body>

</html>
