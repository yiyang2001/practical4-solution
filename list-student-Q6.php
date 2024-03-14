<?php
$PAGE_TITLE = 'Select Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q6 -->
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

    // Validate sort and order values to prevent SQL errors and hacks.
    $sort  = !isset($_GET['sort']) ? 'StudentID' :  (array_key_exists($_GET['sort'], $headers) ? $_GET['sort'] : 'StudentID');

    // OR 
    // if (!isset($_GET['sort'])) {
    //     $sort = 'StudentID';
    // } else {
    //     if (array_key_exists($_GET['sort'], $headers)) {
    //         $sort = $_GET['sort'];
    //     } else {
    //         $sort = 'StudentID';
    //     }
    // }

    $order = !isset($_GET['order']) ? 'ASC' :  ($_GET['order'] == 'DESC' ? 'DESC' : 'ASC');

    // OR
    // if (!isset($_GET['order'])) {
    //     $order = 'ASC';
    // } else {
    //     if ($_GET['order'] == 'DESC') {
    //         $order = 'DESC';
    //     } else {
    //         $order = 'ASC';
    //     }
    // }

    // Validate program filter --> either IA, IB or IT.
    $program = !isset($_GET['program']) ? '%' :  (array_key_exists($_GET['program'], $PROGRAMS) ? $_GET['program'] : '%');

    // OR
    // if (!isset($_GET['program'])) {
    //     $program = '%';
    // } else {
    //     if (array_key_exists($_GET['program'], $PROGRAMS)) {
    //         $program = $_GET['program'];
    //     } else {
    //         $program = '%';
    //     }
    // }    

    ///////////////////////////////////////////////////////////////////////////
    // Generate filter options ////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    echo '<p>Filter : ';
    printf('<a href="?sort=%s&order=%s">All Programs</a> ', $sort, $order);
    foreach ($PROGRAMS as $key => $value)
    {
        printf('| <a href="?sort=%s&order=%s&program=%s">%s</a> ',
               $sort, $order, $key, $key);
    }
    echo '</p>';


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
                <a href="?sort=%s&order=%s&program=%s">%s</a>
                <img src="images/%s" alt="%s" />
                </th>',
                $key,
                $order == 'ASC' ? 'DESC' : 'ASC',  // This line toggles sorting order
                $program, // To retain filter.
                $value,
                $order == 'ASC' ? 'asc.png' : 'desc.png',      // Image.
                $order == 'ASC' ? 'Ascending' : 'Descending'); // Alt text.
        }
        else // Non-sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=ASC&program=%s">%s</a>
                </th>',
                $key,
                $program, // To retain filter.
                $value);
        }
    }
    echo '</tr>';


    ///////////////////////////////////////////////////////////////////////
    // Database select ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // SQL with WHERE and ORDER BY clause.
    $sql = "SELECT * FROM Student WHERE Program LIKE '$program' ORDER BY $sort $order";

    if ($result = $con->query($sql))
    {
        while ($row = $result->fetch_object())
        {
            printf('
                <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                </tr>',
                $row->StudentID,
                $row->StudentName,
                $GENDERS[$row->Gender],
                $row->Program . ' - ' .$PROGRAMS[$row->Program]);
        }
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

    $result->free(); // Free the result set
    $con->close();
    ///////////////////////////////////////////////////////////////////////
    ?>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
