<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Students by Nationality</title>
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: Arial, sans-serif;
            line-height: 1.8;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        header h1 {
            font-size: 1.8rem;
            color: #940000;
        }

        header p {
            color: #5e4545;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 100%;
            max-width: 70%;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.4);
        
        }

        table th, table td {
            text-align: left;
            padding: 1rem;
            border: 1px solid #333;
        }

        table th {
            background-color: #b00000;
            color: white;
        }
      

        table tbody tr:hover {
            background-color: #decccc;
        }

        footer {
    text-align: center;
    margin-top: 2rem;
    padding: 0.5rem 1rem; 
    background-color: #b00000; 
    color: white;
    font-size: 0.85rem; 
        }

        footer a {
            color: #ffd700; 
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline; 
        }

        /* Responsive table */
        @media (max-width: 768px) {

            table {
                font-size: 0.8rem;
                width: 100%;
                overflow-x: auto;
            }
        }

        p.empty{
             text-align : center;
             color : red;
        }

    </style>
   
</head>
<body>
    <header>
        <h1>UOB Students by Nationality</h1>
        
        <p>Data retrieved from Bahrain Open Data Portal</p>
    </header>
    <div class="container">
        <?php
        // API URL
        $apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

        // Fetch and decode the API data
        $response = file_get_contents($apiUrl);
// Check if the API call was successful
if ($response === FALSE) {
    echo "<p>Unable to fetch data from the API. Please try again later.</p>";
} else {
    // Decode the JSON response
    $result = json_decode($response, true);

    // Check if data is available
    if (isset($result['results']) && count($result['results']) > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
              </thead>";
        echo "<tbody>";

        // Loop through the data and display it in the table
        for($i = 0; $i < count($result['results']) ; ++$i) {
            
                
            echo "<tr>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['year'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['semester'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['the_programs'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['nationality'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['colleges'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "<td>" , htmlspecialchars($result['results'][$i]['number_of_students'], ENT_QUOTES, 'UTF-8') , "</td>";
            echo "</tr>";
    }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p class = empty>No data found in the API response.</p>";
    }
}
?>
    </div>
    <footer>
        <p>Powered by the <a href="https://data.gov.bh">Bahrain Open Data Portal</a> | UOB Students Enrollment</p>
    </footer>
</body>
</html>
