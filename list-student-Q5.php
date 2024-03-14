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
    $sort  = empty($_GET) ? 'StudentID' : (array_key_exists($_GET['sort'], $headers) ? $_GET['sort'] : 'StudentID');
    $order = empty($_GET) ? 'ASC' : ($_GET['order'] == 'DESC' ? 'DESC' : 'ASC');

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
        }
        else // Non-sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=ASC">%s</a>
                </th>',
                $key,
                $value);
        }
    }
    echo '</tr>';


    ///////////////////////////////////////////////////////////////////////
    // Database select ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////
    // Notes:
    // I am using Procedural style in this script.
    
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // SQL with ORDER BY clause.
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

        // OR (if you prefer OOP style)
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
        //         $row->Program . ' - ' .$PROGRAMS[$row->Program]);
        // }
    }

    printf('
        <tr>
        <td colspan="4">
            %d record(s) returned.
            [ <a href="insert-student.php">Insert Student</a> ]
        </td>
        </tr>',
        $result->num_rows);
    echo '</table>'; // Table ends.

    $result->free();
    $con->close();
    ///////////////////////////////////////////////////////////////////////
    ?>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
