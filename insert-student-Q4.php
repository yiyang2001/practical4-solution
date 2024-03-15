<?php
$PAGE_TITLE = 'Insert Student';
// https://www.w3schools.com/php/php_includes.asp
// include - The include (or require) statement takes all the text/code/markup that exists in the specified file and copies it into the file that uses the include statement.
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q4 -->
<div>
    <h1>Insert Student</h1>

    <?php
    // https://www.w3schools.com/php/keyword_require_once.asp
    // require_once - include and evaluate the specified file only once
    require_once('includes/helper.php');

    // https://www.w3schools.com/php/func_var_empty.asp
    if (!empty($_POST)) // Something posted back.
        {
        // https://www.w3schools.com/php/func_string_strtoupper.asp
        $id = strtoupper(trim($_POST['id'])); // strtoupper() - Make a string uppercase
        $name = trim($_POST['name']); // trim() - Strip whitespace (or other characters) from the beginning and end of a string
        $gender = isset($_POST['gender']) ? trim($_POST['gender']) : null; // isset() - Determine if a variable is set and is not NULL
        $program = trim($_POST['program']);

        // Validations.
        $error['id'] = validateStudentID($id);
        $error['name'] = validateStudentName($name);
        $error['gender'] = validateGender($gender);
        $error['program'] = validateProgram($program);
        // https://www.w3schools.com/php/func_array_filter.asp
        // https://www.php.net/manual/en/function.array-filter.php
        // array_filter — Filters elements of an array using a callback function, if no callback is supplied, all entries of array equal to FALSE will be removed.
        // eg. array_filter([0 => 'foo', 1 => false, 2 => -1, 3 => null, 4 => '', 5 => '0', 6 => 0]);  returns [0 => 'foo', 2 => -1]
        // why '0' is removed? because it is a string '0' which is equal to FALSE.
        $error = array_filter($error); // Remove null values. Keep only error messages.
        // NOTE:
        // -----
        // The validation functions are defined at "helper.php".
        // Any validation approach will do. No need to follow this.
    
        // https://www.w3schools.com/php/func_var_empty.asp
        if (empty($error)) // If no error.
        {
            ///////////////////////////////////////////////////////////////////
            // Database insert ////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
    

            //////////////////////////////////////////////////////////////////////////
            // Method 1 : Using mysqli_real_escape_string() to prevent SQL injection//
            //////////////////////////////////////////////////////////////////////////
    
            // Step 1 : Connect to Database
            $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // Step 2 : Check Database connection connect successfully
            if (mysqli_connect_errno()) {
                die('Connect Failed' . mysqli_connect_error());
                }

            // Method 1: using mysqli_escape_string to prevent SQL injection by escaping special characters
            // escape eg: '\', '\n', '\r', '\'', '"', and "\x1a".
            // $string = "This is a string with 'quotes' and special characters like \n and \r\n";
            // $escaped_string = mysqli_real_escape_string($con, $string);
            // echo "Original String: " . $string . "<br>";
            // echo "Escaped String: " . $escaped_string . "<br>";
    
            // Step 3 : Sanitize the input
            $id = mysqli_real_escape_string($con, $id);
            $name = mysqli_real_escape_string($con, $name);
            $gender = mysqli_real_escape_string($con, $gender);
            $program = mysqli_real_escape_string($con, $program);

            // Step 4 : Prepare SQL Statement
            $sql = "INSERT INTO Student (StudentID, StudentName,Gender,Program) VALUES ('$id', '$name', '$gender', '$program')";

            // Step 5 : Execute the Query and store in $result
            // Step 6 :  Check if the statement executed successfully 
            if (mysqli_query($con, $sql)) {
                printf('
                <div class="info">
                Student <strong>%s</strong> has been inserted.
                [ <a href="list-student-Q3.php">Back to list</a> ]
                </div>',
                    $name
                );

                // Reset fields.
                $id = $name = $gender = $program = null;
                } else {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not inserted.
                    </div>
                    ';
                }

            // Step 7 : Close the connection
            mysqli_close($con);

            ///////////////////////////////////////////////////////////////////
            // Method 2 : Using mysqli_prepare() and Statement Object  ////////
            ///////////////////////////////////////////////////////////////////
    

            // Method 2 mysqli_prepare() and Statement object to prevent SQL injection by escaping special characters
            // Step 1 : Connect to Database
            $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // Step 2 : Check Database connection connect successfully
            if (mysqli_connect_errno()) {
                die('Connect Failed' . mysqli_connect_error());
                }

            // Step 3 : Prepare SQL with ? as placeholder for parameters
            $sql = 'INSERT INTO Student (StudentID, StudentName, Gender, Program) VALUES (?, ?, ?, ?)';

            // Step 4 : Prepare the statement
            // https://www.php.net/manual/en/mysqli.prepare.php
            $stm = mysqli_prepare($con, $sql);

            // Step 5 : Bind parameters to the prepared statement
            // https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            $stm_bind_result = mysqli_stmt_bind_param($stm, 'ssss', $id, $name, $gender, $program);

            // Step 6 : Execute the statement
            // https://www.php.net/manual/en/mysqli-stmt.execute.php
            $stm_execute_result = mysqli_stmt_execute($stm);

            // Step 7 : Check if the statement executed successfully using affected_rows and display message
            // https://www.php.net/manual/en/mysqli-stmt.affected-rows.php
            if (mysqli_stmt_affected_rows($stm) > 0) {
                printf('
                        <div class="info">
                        Student <strong>%s</strong> has been inserted.
                        [ <a href="list-student-Q3.php">Back to list</a> ]
                        </div>',
                    $name
                );

                // Reset fields.
                $id = $name = $gender = $program = null;
                } else {
                // Something goes wrong.
                echo '
                        <div class="error">
                        Opps. Database issue. Record not inserted.
                        </div>
                        ';
                }

            // Step 8 : Close the statement and connection
            // https://www.php.net/manual/en/mysqli-stmt.close.php
            mysqli_stmt_close($stm);
            // https://www.w3schools.com/php/func_mysqli_close.asp
            mysqli_close($con);
            // ///////////////////////////////////////////////////////////////////
        } 
        
        else // Input error detected. Display error message.
        {
            echo '<ul class="error">';
            foreach ($error as $value) {
                echo "<li>$value</li>";
                }
            echo '</ul>';
        }
    }
    ?>
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

        <input type="submit" name="insert" value="Insert" />
        <input type="button" value="Cancel" onclick="location='list-student-Q3.php'" />
    </form>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>