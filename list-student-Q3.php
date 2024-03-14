<?php
$PAGE_TITLE = 'Select Student';
// https://www.w3schools.com/php/php_includes.asp
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q3 -->
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
        // https://www.w3schools.com/php/keyword_require_once.asp
        require_once('includes/helper.php');
        // NOTE:
        // -----
        // The "helper.php" file contains definition for
        // DB_HOST, DB_USER, DB_PASS and DB_NAME.

        ///////////////////////////////////////////////////////////////////////
        // Database select ////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////

        // NOTE:
        // -----
        // Using Procedure style.
        // https://www.w3schools.com/php/php_mysql_connect.asp
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(!$con){ // mysqli_connect_errno() - Returns the error code from the last connect call , Zero if no error occurred.
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // https://www.w3schools.com/php/php_mysql_select.asp
        // https://www.w3schools.com/php/func_mysqli_query.asp
        $sql = "SELECT * FROM Student";
        $result = mysqli_query($con, $sql);

        // mysqli_num_rows() - Returns the number of rows in a result set.
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0)
        {
            // https://www.w3schools.com/php/func_mysqli_fetch_object.asp
            // https://www.php.net/manual/en/mysqli-result.fetch-object.php
            // https://stackoverflow.com/questions/6681075/while-loop-in-php-with-assignment-operator

            // mysqli_fetch_array() - Fetch a result row as an associative, a numeric array, or both
            while ($row = mysqli_fetch_array($result))
            {
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
                    $row['Program']);
                // NOTE:
                // -----
                // Lookup tables (arrays) are defined in "helper.php".

                // OR
                // echo '
                //     <tr>
                //     <td>' . $row['StudentID'] . '</td>
                //     <td>' . $row['StudentName'] . '</td>
                //     <td>' . $row['Gender'] . '</td>
                //     <td>' . $row['Program'] . '</td>
                //     </tr>';
            }

            // OR
            // mysqli_fetch_object() - Fetch a result row as an object
            // while ($row = mysqli_fetch_object($result))
            // {
            //     printf('
            //         <tr>
            //         <td>%s</td>
            //         <td>%s</td>
            //         <td>%s</td>
            //         <td>%s</td>
            //         </tr>',
            //         $row->StudentID,
            //         $row->StudentName,
            //         $GENDERS[$row->Gender],
            //         $row->Program . " - " . $PROGRAMS[$row->Program]);
            //     // NOTE:
            //     // -----
            //     // Lookup tables (arrays) are defined in "helper.php".
            // }
        }

        printf('
            <tr>
            <td colspan="4">
                %d record(s) returned.
                [ <a href="insert-student.php">Insert Student</a> ]
            </td>
            </tr>',
            $num_rows);
        
        // https://www.w3schools.com/php/func_mysqli_free_result.asp
        // why we need to free the result at the end of the script?
        // because it will free the memory associated with the result.
        mysqli_free_result($result);

        // https://www.w3schools.com/php/func_mysqli_close.asp
        // why we need to close the connection at the end of the script? 
        // php will automatically close the connection when the script ends. But it is a good practice to close the connection.
        mysqli_close($con);
        ///////////////////////////////////////////////////////////////////////
        ?>
    </table>
</div>
<!-- End of content -->
<?php
include('includes/footer.php');
?>
