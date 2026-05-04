<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registered Users - YOGAVEDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Inline CSS for simplicity -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .table-container {
            margin: 20px auto;
            max-width: 900px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table td {
            background-color: #f9f9f9;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .error {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
    </style>
</head>

<body>

    <div class="table-container">
        <h2>Registered Users</h2>

        <!-- Display Registered Users -->
        <table>
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Open the users.txt file
            $file = fopen("users.txt", "r") or die("Unable to open file!");

            // Loop through each line in users.txt
            while (!feof($file)) {
                $line = fgets($file);
                $data = explode("\t", trim($line)); // Split the line using tab character

                // Ensure the line contains valid data before outputting
                if (count($data) >= 3) {
                    echo "<tr>";
                    echo "<td>{$data[0]}</td>"; // Full Name
                    echo "<td>{$data[1]}</td>"; // Email
                    echo "<td>{$data[2]}</td>"; // Password
                    echo "</tr>";
                }
            }

            // Close the file
            fclose($file);
            ?>
            </tbody>
        </table>
    </div>

</body>

</html>
