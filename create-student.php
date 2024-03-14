<!DOCTYPE html>
<html>

<head>
    <title>Create Student Record</title>
</head>

<body>
    <h2>Create Student Record</h2>
    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><label for="id">Student ID :</label></td>
                <td>
                    <input type="text" name="id" id="id" value="" maxlength="10">
                </td>
            </tr>
            <tr>
                <td><label for="name">Student Name :</label></td>
                <td>
                    <input type="text" name="name" id="name" value="" maxlength="30">
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <input type="radio" name="gender" id="F" value="F">
                    <label for="F">Female</label>

                    <input type="radio" name="gender" id="M" value="M">
                    <label for="M">Male</label>
                </td>
            </tr>
            <tr>
                <td><label for="program">Program :</label></td>
                <td>
                    <select name="program" id="program">
                        <option value="">-- Select One --</option>
                        <option value="IA">Information Systems Engineering</option>
                        <option value="IB">Business Information Systems</option>
                        <option value="IT">Internet Technology</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" name="insert1" value="Insert (Method 1)" />
        <input type="submit" name="insert2" value="Insert (Method 2)" />
    </form>
    <?php
        // Define the database connection details
        DEFINE ('DB_HOST', 'localhost');
        DEFINE ('DB_USER', 'root');
        DEFINE ('DB_PASSWORD', '');
        DEFINE ('DB_NAME', 'p4_demo');

        // Create a connection to the database
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Check the connection, if it fails, print the error message
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        // Method 1: using prepare to prevent SQL injection by escaping special characters
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['insert1'])){
                $studentID =  $_POST["id"];
                $studentName = $_POST["name"];
                $gender = $_POST["gender"];
                $program = $_POST["program"];

                // Prepare the INSERT query
                $sql = "INSERT INTO Student (StudentID, StudentName, Gender, Program) VALUES (?, ?, ?, ?)";
                
                // Prepare the statement
                // mysqli_prepare() returns a statement object or FALSE if an error occurred. 
                // it automatically handle the escaping of special characters 
                if ($stmt = mysqli_prepare($con, $sql)) {
                    // Bind parameters to the prepared statement
                    // i - integer , d - double , s - string , b - BLOB
                    mysqli_stmt_bind_param($stmt, "ssss", $studentID, $studentName, $gender, $program);

                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        echo "New student ".$studentID ." created successfully";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }

        // Method 2: using mysqli_escape_string to prevent SQL injection by escaping special characters
        // escape eg: '\', '\n', '\r', '\'', '"', and "\x1a".
        $string = "This is a string with 'quotes' and special characters like \n and \r\n";

        $escaped_string = mysqli_real_escape_string($con, $string);

        echo "Original String: " . $string . "<br>";
        echo "Escaped String: " . $escaped_string . "<br>";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['insert2'])){
                $studentID = mysqli_real_escape_string($con, $_POST["id"]);
                $studentName = mysqli_real_escape_string($con, $_POST["name"]);
                $gender = mysqli_real_escape_string($con,$_POST["gender"]);
                $program = mysqli_real_escape_string($con,$_POST["program"]);

                // Prepare the INSERT query
                $sql = "INSERT INTO Student (StudentID, StudentName,Gender, Program) VALUES ('$studentID', '$studentName', '$gender', '$program')";

                // Execute the query
                if ($result=mysqli_query($con, $sql)) {
                    echo "New student ". $studentID . " created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
        }
        mysqli_close($con);
    ?>
</body>

</html>