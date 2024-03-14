<?php
$PAGE_TITLE = 'Select Student';
// https://www.w3schools.com/php/php_includes.asp
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q2 -->
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
        // https://www.w3schools.com/php/func_mysqli_connect.asp
        // Using Procedural style.
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(!$con){ // mysqli_connect_errno() - Returns the error code from the last connect call , Zero if no error occurred.
            // mysqli_connect_error() - Returns a string description of the last connect error if any. NULL if no error occurred
            die("Connection failed: " . mysqli_connect_error());
        }


        // https://www.w3schools.com/php/php_mysql_select.asp
        // https://www.w3schools.com/php/func_mysqli_query.asp

        $sql = "SELECT * FROM Student";
        // @ is not a good practice, it is used to suppress the error message.
        $result = mysqli_query($con, $sql);
   
        $num = mysqli_num_rows($result);
        if ($num>0)
        {
            // https://stackoverflow.com/questions/6681075/while-loop-in-php-with-assignment-operator
            // https://www.w3schools.com/php/func_mysqli_fetch_array.asp
            while($row = mysqli_fetch_array($result))
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
                
                // OR

                // echo "<tr>
                //     <td>" . $row['StudentID'] . "</td>
                //     <td>" . $row['StudentName'] . "</td>
                //     <td>" . $row['Gender'] . "</td>
                //     <td>" . $row['Program'] . "</td>
                //     </tr>";
            }

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
            //         $row->Gender,
            //         $row->Program);
            // }
        }

        printf('
            <tr>
            <td colspan="4">
                %d record(s) returned.
                [ <a href="insert-student.php">Insert Student</a> ]
            </td>
            </tr>',
            $num);
    

        // https://www.w3schools.com/php/func_mysqli_free_result.asp
        mysqli_free_result($result);
        // https://www.w3schools.com/php/func_mysqli_close.asp
        mysqli_close($con);

        ?>
    </table>
</div>
<!-- End of content -->
<?php
include('includes/footer.php');
?>
