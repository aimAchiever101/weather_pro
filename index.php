<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather App</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('assets/thunder.jpg');
            background-size: cover;
        }

        .container {
            width: 450px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 80%; /* Adjust the input width as needed */
            max-width: 300px; /* Set a maximum width if desired */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Weather Data Emailer Application</h1>
        <form action="send_email.php" method="POST">
            <div class="form-group">
                <label for="location"><i class="fas fa-map-marker-alt"></i> Enter Location:</label>
                <input type="text" id="location" name="location" placeholder="E.g., City, Country" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Enter Email:</label>
                <input type="email" id="email" name="email" placeholder="YourEmail@example.com" required>
            </div>
            <button type="submit">Get Weather</button>
        </form>
    </div>
</body>
</html>