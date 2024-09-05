<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .posts-list {
            margin-left: 330px;
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 1em;
            color: #333;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
            background-color: #fff;
        }

        .btn {
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.5);
        }

        .itinerary-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .itinerary-item:hover {
            background-color: #f1f1f1;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .itinerary-item input,
        .itinerary-item textarea {
            margin-bottom: 10px;
        }

        .remove-item {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            border-radius: 4px;
            font-size: 0.9em;
            box-shadow: 0px 4px 6px rgba(255, 77, 77, 0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .remove-item:hover {
            background-color: #ff1a1a;
            box-shadow: 0px 4px 8px rgba(255, 77, 77, 0.5);
        }

        .add-activity {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            border-radius: 4px;
            font-size: 0.9em;
            box-shadow: 0px 4px 6px rgba(40, 167, 69, 0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .add-activity:hover {
            background-color: #218838;
            box-shadow: 0px 4px 8px rgba(40, 167, 69, 0.5);
        }
    </style>
</head>