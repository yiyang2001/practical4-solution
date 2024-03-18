<?php
$PAGE_TITLE = 'Select Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q5 -->
<div>
    <h1>List Student</h1>

    <?php
    require_once('includes/helper.php');
    
    // Array of actual table field names and their display names.
    $headers = array(
        'StudentID'   => 'Student ID',
        'StudentName' => 'Student Name',
        'Gender'      => 'Gender',
        'Program'     => 'Program'
    );

    // https://www.w3schools.com/php/php_superglobals_get.asp
    // https://www.w3schools.com/php/func_array_key_exists.asp
    // Validate sort and order values to prevent SQL errors and hacks.

    // Determine the sort field. Default to 'StudentID' if not set or invalid.
    if (!isset($_GET)) { // If $_GET is not set. (No query string)
        $sort = 'StudentID';
    } else {
        // Check if the sort field exists in the headers array, otherwise default to 'StudentID'.
        if (array_key_exists($_GET['sort'], $headers)) {
            $sort = $_GET['sort'];
        } else {
            $sort = 'StudentID';
        }
    }

    // Determine the sort order. Default to 'ASC' if not set or invalid.
    if (!isset($_GET)) { // If $_GET is not set. (No query string)
        $order = 'ASC';
    } else {
        // Set order to 'DESC' if $_GET['order'] is 'DESC', otherwise default to 'ASC'.
        if ($_GET['order'] == 'DESC') {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }
    }

    ///////////////////////////////////////////////////////////////////////
    // Generate clickable table headers ///////////////////////////////////
    ///////////////////////////////////////////////////////////////////////
    
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr>';
    foreach ($headers as $key => $value)
    {
        if ($key == $sort) // The sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=%s">%s</a>
                <img src="images/%s" alt="%s" />
                </th>',
                $key,
                $order == 'ASC' ? 'DESC' : 'ASC',
                $value,
                $order == 'ASC' ? 'asc.png' : 'desc.png',      // Image.
                $order == 'ASC' ? 'Ascending' : 'Descending'); // Alt text.

            // OR

            // echo '
            //     <th>
            //     <a href="?sort=' . $key . '&order=' . ($order == 'ASC' ? 'DESC' : 'ASC') . '">' . $value . '</a>
            //     <img src="images/' . ($order == 'ASC' ? 'asc.png' : 'desc.png') . '" alt="' . ($order == 'ASC' ? 'Ascending' : 'Descending') . '" />
            //     </th>';
        }
        else // Non-sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=ASC">%s</a>
                </th>',
                $key,
                $value);

            // OR

            // echo '
            //     <th>
            //     <a href="?sort=' . $key . '&order=ASC">' . $value . '</a>
            //     </th>';
        }
    }
    echo '</tr>';


    ///////////////////////////////////////////////////////////////////////
    // Database select (Generate Table Rows Details) //////////////////////
    ///////////////////////////////////////////////////////////////////////

    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // SQL with ORDER BY clause. (ORDER BY COLUMN_NAME ASC|DESC)
    $sql = "SELECT * FROM Student ORDER BY $sort $order";

    if ($result = mysqli_query($con, $sql))
    {
        // mysqli_fetch_array
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
            
            // OR
            // echo '
            //     <tr>
            //     <td>' . $row['StudentID'] . '</td>
            //     <td>' . $row['StudentName'] . '</td>
            //     <td>' . $row['Gender'] . '</td>
            //     <td>' . $row['Program'] . '</td>
            //     </tr>';
        }
    }

    printf('
        <tr>
        <td colspan="4">
            %d record(s) returned.
            [ <a href="insert-student-Q4">Insert Student</a> ]
        </td>
        </tr>',
        $result->num_rows);
    echo '</table>'; // Table ends.

    mysqli_free_result($result); // Free the result set
    mysqli_close($con);
    ///////////////////////////////////////////////////////////////////////
    ?>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>