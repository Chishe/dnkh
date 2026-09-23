<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the query
$sql = "SELECT * FROM helium_percentage WHERE nb_pd >= CURDATE() - INTERVAL 14 DAY AND nb_pd != ' ' ORDER BY nb_pd DESC";

// Execute the query
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {


    // Fetch and display the results
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['nb_pd']) . '</td>';
        echo '<td>' . htmlspecialchars($row['core_part_no']) . '</td>';
        echo '<td>' . htmlspecialchars($row['count_all']) . '</td>';
        echo '<td>' . htmlspecialchars($row['count_ng']) . '</td>';
        echo '<td>' . htmlspecialchars($row['percent']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No results found";
}

// Close the connection
$conn->close();
?>
