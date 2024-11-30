<?php
// Step 1: Fetch data from the API
// The URL of the Bahrain Open Data Portal API, filtered to include IT college and bachelor programs
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Use file_get_contents to fetch the API response as a JSON string
$response = file_get_contents($url);

// Decode the JSON string into a PHP associative array
$data = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Nationality Data</title>
    <!-- Link to Pico CSS stylesheet for default responsive styling -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <style>
        /* Optional: Add some custom spacing or tweaks to improve table appearance */
        table {
            margin-top: 20px; /* Adds some spacing above the table */
        }
        .table-container {
            overflow-x: auto; /* Enables horizontal scrolling for smaller screens */
        }
    </style>
</head>
<body>
    <!-- Main container to hold the content -->
    <main class="container">
        <h1>University of Bahrain Student Data</h1>
        
        <!-- Wrapper div to enable horizontal scrolling for the table -->
        <div class="table-container">
            <!-- Dynamic table to display API data -->
            <table role="grid">
                <!-- Table header defining column names -->
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Programs</th>
                        <th>Nationality</th>
                        <th>Colleges</th>
                        <th>Number of Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Step 2: Dynamically generate table rows from API data
                    // Check if the API returned any records
                    if (!empty($data['records'])) {
                        // Loop through each record in the API response
                        foreach ($data['records'] as $record) {
                            echo "<tr>"; // Start a new table row
                            // Safely output each field, with a fallback to "N/A" if the field is missing
                            echo "<td>" . htmlspecialchars($record['fields']['year'] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($record['fields']['semester'] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($record['fields']['the_programs'] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($record['fields']['nationality'] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($record['fields']['colleges'] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($record['fields']['number_of_students'] ?? "N/A") . "</td>";
                            echo "</tr>"; // End the table row
                        }
                    } else {
                        // If no data is available, display a single row with a message
                        echo "<tr><td colspan='6'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
