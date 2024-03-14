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
        $id      = strtoupper(trim($_POST['id']));
        $name    = trim($_POST['name']);
        $gender  = isset($_POST['gender']) ? trim($_POST['gender']) : null;
        $program = trim($_POST['program']);

        // Validations.
        $error['id']      = validateStudentID($id);
        $error['name']    = validateStudentName($name);
        $error['gender']  = validateGender($gender);
        $error['program'] = validateProgram($program);
        // https://www.w3schools.com/php/func_array_filter.asp
        // https://www.php.net/manual/en/function.array-filter.php
        // array_filter — Filters elements of an array using a callback function, if no callback is supplied, all entries of array equal to FALSE will be removed.
        // eg. array_filter([0 => 'foo', 1 => false, 2 => -1, 3 => null, 4 => '', 5 => '0', 6 => 0]);  returns [0 => 'foo', 2 => -1]
        // why '0' is removed? because it is a string '0' which is equal to FALSE.
        $error = array_filter($error); // Remove null values.

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
            
            // NOTE:
            // -----
            // I am using mysqli_prepare() method and Statement object.
            // I am using procedural style in this example.
            // The query() + real_escape_string() methods will work too.

            $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = '
                INSERT INTO Student (StudentID, StudentName, Gender, Program)
                VALUES (?, ?, ?, ?)
            ';
            // https://www.php.net/manual/en/mysqli.prepare.php
            $stm = mysqli_prepare($con, $sql);
            // https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            $stm = mysqli_stmt_bind_param($stm, 'ssss', $id, $name, $gender, $program);
            // https://www.php.net/manual/en/mysqli-stmt.execute.php
            $stm = mysqli_stmt_execute($stm);
            
            // https://www.php.net/manual/en/mysqli-stmt.affected-rows.php
            if (mysqli_stmt_affected_rows($stm) > 0)
            {
                printf('
                    <div class="info">
                    Student <strong>%s</strong> has been inserted.
                    [ <a href="list-student.php">Back to list</a> ]
                    </div>',
                    $name);

                // Reset fields.
                $id = $name = $gender = $program = null;
            }
            else
            {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not inserted.
                    </div>
                    ';
            }
            
            // https://www.php.net/manual/en/mysqli-stmt.close.php
            mysqli_stmt_close($stm);
            // https://www.w3schools.com/php/func_mysqli_close.asp
            mysqli_close($con);
            ///////////////////////////////////////////////////////////////////
        }
        else // Input error detected. Display error message.
        {
            echo '<ul class="error">';
            foreach ($error as $value)
            {
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
                    <?php
                    htmlInputText('id', isset($id) ? $id : "" , 10);
                    // NOTE:
                    // -----
                    // HTML helpers are defined at "helper.php".
                    // Personal preference. Time savers, but not a must.
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">Student Name :</label></td>
                <td>
                    <?php htmlInputText('name', isset($name) ? $name : "" , 30) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php htmlRadioList('gender', $GENDERS, isset($gender) ? $gender : "") ?>
                </td>
            </tr>
            <tr>
                <td><label for="program">Program :</label></td>
                <td>
                    <?php htmlSelect('program', $PROGRAMS, isset($program) ? $program : "", '-- Select One --') ?>
                </td>
            </tr>
        </table>

        <input type="submit" name="insert" value="Insert" />
        <input type="button" value="Cancel" onclick="location='list-student.php'" />
    </form>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
