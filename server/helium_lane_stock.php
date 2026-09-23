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
$sql = "SELECT * FROM core_export WHERE input_date != '' AND output_date = '' AND lane = 'Lane1' ORDER BY id DESC LIMIT 1";
$sql2 = "SELECT * FROM core_export WHERE input_date != '' AND output_date = '' AND lane = 'Lane2' ORDER BY id DESC LIMIT 1";

// Execute the query
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

// Check if the query returned any results
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if(htmlspecialchars($row['judge']) == 'OK') {
            echo '<tr style="color:limegreen">';
            echo '<td>Lane 1</td>';
            echo '<td>' . htmlspecialchars($row['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row['type']) . '</td>';
            if (htmlspecialchars($row['type']) != '27D' && htmlspecialchars($row['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">NG</button>
                    </td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        else if(htmlspecialchars($row['judge']) == 'NG') {
            echo '<tr style="color:firebrick">';
            echo '<td>Lane 1</td>';
            echo '<td>' . htmlspecialchars($row['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row['type']) . '</td>';
            if (htmlspecialchars($row['type']) != '27D' && htmlspecialchars($row['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">NG</button>
                    </td>';
                echo '<td><input type="date"></td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        else {
            echo '<tr>';
            echo '<td>Lane 1</td>';
            echo '<td>' . htmlspecialchars($row['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row['type']) . '</td>';
            if (htmlspecialchars($row['type']) != '27D' && htmlspecialchars($row['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row['kanban_code']) . '\',\'Lane1\')">NG</button>
                    </td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        
    }
}
if ($result->num_rows <= 0) {
        echo '<tr>';
        echo '<td>Lane 1</td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
    
}

if ($result2->num_rows > 0) {

    // Fetch and display the results
    while($row2 = $result2->fetch_assoc()) {
        if (htmlspecialchars($row2['judge']) == 'OK') {
            echo '<tr style="color:limegreen">';
            echo '<td>Lane 2</td>';
            echo '<td>' . htmlspecialchars($row2['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['type']) . '</td>';
            if (htmlspecialchars($row2['type']) != '27D' && htmlspecialchars($row2['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">NG</button>
                    </td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        else if (htmlspecialchars($row2['judge']) == 'NG') {
            echo '<tr style="color:firebrick">';
            echo '<td>Lane 2</td>';
            echo '<td>' . htmlspecialchars($row2['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['type']) . '</td>';
            if (htmlspecialchars($row2['type']) != '27D' && htmlspecialchars($row2['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">NG</button>
                    </td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        else {
            echo '<tr>';
            echo '<td>Lane 2</td>';
            echo '<td>' . htmlspecialchars($row2['kanban_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['core_code']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['judge']) . '</td>';
            echo '<td>' . htmlspecialchars($row2['type']) . '</td>';
            if (htmlspecialchars($row2['type']) != '27D' && htmlspecialchars($row2['judge']) == '') {
                echo '<td>
                        <button type="button" onclick="submitcode(\'OK\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">OK</button>
                        <button type="button" onclick="submitcode(\'NG\', \'' . htmlspecialchars($row2['kanban_code']) . '\',\'Lane2\')">NG</button>
                    </td>';
            } else {
                echo '<td></td>';
            }
            echo '</tr>';
        }
        
    }
}
if ($result2->num_rows <= 0) {
        echo '<tr>';
        echo '<td>Lane 2</td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
    
}

// Close the connection
$conn->close();
?>
