<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
    <style>
        body {
            margin: 20px;
        }
        th {
            background-color: #f2f2f2;
        }
        table {
            float: left;
            margin-right: 20px;
        }
        textarea {
            width: auto;
            min-width: 30%;
            height: 500px;
            overflow: auto;
            background-color: #f7f7f7;
            color: #333;
            font-family: monospace;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<h2>Student List using mysqli_fetch_array</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Gender</th>
        <th>Program</th>
    </tr>

<?php

// Step 1: Define the database connection details
// Define the database connection details
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_NAME', 'p4_demo');
//OR 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p4";

// Create a connection to the database
// mysqli_connect() function opens a new connection to the MySQL server.
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check the connection , if it fails, print the error message
// mysqli_connect_error() function returns the error description from the last connection error, if any.
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve Students
// prepare the select query
$sql = "SELECT * FROM Student";
// mysqli_query() function performs a query against the database.
$result = mysqli_query($con, $sql);

// print the number of  return rows
echo "Number of rows: " . mysqli_num_rows($result) . "<br>";
// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    /*
        Fetch and display records using mysqli_fetch_array with MYSQLI_ASSOC / MYSQLI_NUM/ MYSQLI_BOTH
        /**
         * mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
         * @param $result - The result set returned by mysqli_query() function
         * @param $resulttype - The type of array that is to be fetched. It is an optional parameter.
         * MYSQLI_ASSOC - It returns an associative array of strings that corresponds to the fetched row.
         * MYSQLI_NUM - It returns an array of strings that corresponds to the fetched row.
         * MYSQLI_BOTH - It returns an array of strings that corresponds to the fetched row. It is the same as MYSQLI_ASSOC and MYSQLI_NUM combined.
         * 
         * @return - An array of strings that corresponds to the fetched row. It also returns NULL if there are no more rows in the result set.
         * /
    */
    // echo mysqli_fetch_array($result, MYSQLI_ASSOC)[0];
        
    // Fetch the first row
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    echo '<pre>';
    print_r($row);
    echo '</pre>'; 

    while ($row = mysqli_fetch_array($result)) { 
        // Using associative index for MYSQLI_ASSOC
        echo "<tr><td>" . $row["StudentID"] . "</td><td>" . $row["StudentName"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Program"] . "</td></tr>";

        // Using numeric index for MYSQLI_NUM
        // echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";

        // Using both numeric and associative index for MYSQLI_BOTH / Without specifying the resulttype
        // echo "<tr><td>" . $row[0] . "</td><td>" . $row["StudentName"] . "</td><td>" . $row[2] . "</td><td>" . $row["Program"] . "</td></tr>";
    }

    // Free result set
    mysqli_free_result($result);
} else {
    echo "0 results";
}

mysqli_close($con);
?>
</table>
<!-- Textarea displaying the PHP source code -->
<textarea readonly>
    DEFINE ('DB_HOST', 'localhost');
    DEFINE ('DB_USER', 'root');
    DEFINE ('DB_PASSWORD', '');
    DEFINE ('DB_NAME', 'p4_demo');
    
    $con = mysqli_connect(DB_HOST, 'root', '', DB_NAME);
    
    $sql = "SELECT * FROM Student";
    
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) { 
            echo "<tr>
                <td>" . $row["StudentID"] . "</td>
                <td>" . $row["StudentName"] . "</td>
                <td>" . $row["Gender"] . "</td>
                <td>" . $row["Program"] . "</td>
            </tr>";
        }
        mysqli_free_result($result);
    } else {
        echo "0 results";
    }

    mysqli_close($con);
</textarea>

</body>
</html>
