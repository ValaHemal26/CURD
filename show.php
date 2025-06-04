<?php 
session_start();
include "conn.php";

$limit = 5; 
$offset=4; 
$getQuery = "select * from users"; 
$result = mysqli_query($conn, $getQuery);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil ($total_rows / $limit);
    if (!isset ($_GET['page']) ) 
    {        
        $page_number = 1; 
    } 
    else
    {
        $page_number = $_GET['page'];      
    }    
    $initial_page = ($page_number-1) * $limit;
    $getQuery = "SELECT * FROM users LIMIT " . $initial_page . ',' . $limit;  
    $result = mysqli_query($conn, $getQuery);    
    if (!isset ($_GET['page']) )
    {   
       $page_number = 1;     
     } 
     else
     {        
          $page_number = $_GET['page'];      
    } 

?>
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5 p-4 border border-success border-2 w-75 rounded">
    <h2 class="border-bottom border-3 p-2">User List
        <a href="create.php" class="btn btn-success float-end">+ Add User</a>
    </h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Created</th><th>Updated</th><th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['created_at'] . "</td>
                        <td>" . $row['updated_at'] . "</td>
                        <td>
                            <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Delete this user?')\" class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr class='text-center'><td colspan='6'>No Data Found</td></tr>";
        }
        ?>
    </table>
    <ul class="pagination justify-content-center">
        <?php        
            $getQuery = "SELECT COUNT(*) FROM users"; 
            $result = mysqli_query($conn, $getQuery);   
            $row = mysqli_fetch_row($result);   
            $total_rows = $row[0];   
            echo "</br>";           
            $total_pages = ceil($total_rows / $limit); 
            $pageURL = "";  
            if($page_number>=2)
            {
                        echo " <li class='page-item'><a href='show.php?page=".($page_number-1)."' class='page-link'>  Prev </a></li>";
            }  
            for ($i=1; $i<=$total_pages; $i++) 
            {
                    if ($i == $page_number)
                    { 
                        $pageURL .= "<li class='page-item'><a  href='show.php?page=".$i."' class='page-link'>".$i." </a></li>"; 
                    }
                    else
                    {
                        $pageURL .= "<li class='page-item'><a  href='show.php?page=".$i."' class='page-link'>".$i." </a></li>";
                    } 
            }
            echo $pageURL;
            if($page_number<$total_pages)
            { 
                    echo "<li class='page-item'><a  href='show.php?page=".($page_number+1)."' class='page-link'>  Next </a></li>"; 
            } 
        ?>
     </ul>
</body>
</html><!--
SELECT *
FROM users
ORDER BY id
LIMIT 2 OFFSET 2;
-->
