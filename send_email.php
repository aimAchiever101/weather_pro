<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'vendor/autoload.php';

require'vendor/phpmailer/phpmailer/src/Exception.php';
require'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require'vendor/phpmailer/phpmailer/src/SMTP.php';

// Function to fetch weather data using file_get_contents
function fetchWeatherData($location)
{
    $weatherApiKey = ''; //  Weather API key
    $url = "https://api.weatherapi.com/v1/current.json?key={$weatherApiKey}&q={$location}";

    // Make HTTP request to the weather API
    $response = file_get_contents($url);

    // Parse JSON response
    $weatherData = json_decode($response, true);

    return $weatherData;
}

// Main script logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve location and email from form submission
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Fetch weather data for the location
    $weatherData = fetchWeatherData($location);

    if ($weatherData !== null && isset($weatherData['current'])) {
        // Extract weather details
        $temperature = $weatherData['current']['temp_c'];
        $humidity = $weatherData['current']['humidity'];
        $condition = $weatherData['current']['condition']['text'];

        // Compose weather summary
       // Extract weather details
$temperature = isset($weatherData['current']['temp_c']) ? $weatherData['current']['temp_c'] : 'N/A';
$humidity = isset($weatherData['current']['humidity']) ? $weatherData['current']['humidity'] : 'N/A';
$condition = isset($weatherData['current']['condition']['text']) ? $weatherData['current']['condition']['text'] : 'N/A';

// Compose weather summary
$weatherSummary = "Currently in $location, it's $condition with a temperature of {$temperature}°C and humidity at {$humidity}%.";

        // Send weather report via email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            //Server settings
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = ''; //  Gmail email address
            $mail->Password   = ''; // Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('kanakmoulekhi@gmail.com');
            $mail->addAddress($email); // Email address to send the report

            //Content
            $mail->isHTML(false);
            $mail->Subject = 'Weather Report';
            $mail->Body    = "
            Weather Summary for $location 
            Hello Dear user,
            
            hope this email finds you well. As part of our commitment to keeping you 
            informed about the weather conditions in your area, I'm pleased to provide you 
            with a summary of the recent weather patterns in $location.
           
            \n\n$weatherSummary\n\n
            Please note that this summary is based on available data and forecasts, 
            and actual conditions may vary. For the most accurate and up-to-date information, 
            I recommend checking local weather updates regularly.
            Stay safe and enjoy your day!
            ";
            
            $mail->send();
            echo " <script>
            alert('Weather report sent successfully to $email');
            document.location.href = 'index.php';
             </script> ";
        } catch (Exception $e) {
            echo "Failed to send weather report. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to fetch weather data for $location";
    }
} else {
    // Redirect to index.php if accessed directly without POST request
    header('Location: index.php');
    exit;
}
?>
