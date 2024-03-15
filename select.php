<div>
    <h1>List Student</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Gender</th>
            <th>Program</th>
        </tr>
        <?php
        function print_array($array){

            $json_pretty = json_encode($array, JSON_PRETTY_PRINT); 
            echo "<pre>" . $json_pretty . "<pre/>"; 
            // echo "<pre>";
            // print_r($array);
            // echo "</pre>";
        }

        // Select table data
        // Step 1 : Connect to database
        // Define the database connection details
        DEFINE('DB_HOST', 'localhost');
        DEFINE('DB_USER', 'root');
        DEFINE('DB_PASS', '');
        DEFINE('DB_NAME', 'p4_demo');

        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  // mysqli_connect() function opens a new connection to the MySQL server.
        
        // Step 2 : Check Database connection connect successfully
        if (!$con) { // mysqli_connect_errno() - Returns the error code from the last connect call , Zero if no error occurred.
            die('Connection failed: ' . mysqli_connect_error());
            }

        // Step 3 : Prepare SQL Stament
        $sql = "SELECT * FROM Student";

        // Step 4 : Execute the Query and store in $result
        $result = mysqli_query($con, $sql);

        echo "Result:";
        print_array($result);

        // Step 5 : Display the result. Check if the number of row inside $result is more than 0, display the result.
        $num_rows = mysqli_num_rows($result);

        echo "Number of rows: " . $num_rows . "<br>";

        if ($num_rows > 0) {
            echo "mysqli_fetch_array (Without Specifying resulttype):";
            // mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
            print_array(mysqli_fetch_array($result));
            
            echo "mysqli_fetch_array (With MYSQLI_ASSOC as resulttype):";
            print_array(mysqli_fetch_array($result, MYSQLI_ASSOC));

            echo "mysqli_fetch_array (With MYSQLI_NUM as resulttype):";
            print_array(mysqli_fetch_array($result, MYSQLI_NUM));

            echo "mysqli_fetch_array (With MYSQLI_BOTH as resulttype):";
            print_array(mysqli_fetch_array($result, MYSQLI_BOTH));

            while ($row = mysqli_fetch_array($result)) {
                printf('
            <tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            </tr>',
                    $row['StudentID'],
                    $row['StudentName'],
                    $row['Gender'],
                    $row['Program']
                );
                }
            } else {
            // If no records found, display a message
            printf('
        <tr>
        <td colspan="4">No records found</td>
        </tr>');
            }

        ?>
    </table>
</div>
<!-- End of content -->