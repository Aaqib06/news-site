<?php include "header.php"; 

if($_SESSION["user_role"]=='0'){
 
    header("location:{$hostname}/admin/post.php");

}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">








                <html>

                <head>
                    <title>Pagination</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                    <style>
                        table {
                            border-collapse: collapse;
                        }

                        .inline {
                            display: inline-block;
                            float: right;
                            margin: 20px 0px;
                        }

                        input,
                        button {
                            height: 34px;
                        }

                        .pagination {
                            display: inline-block;
                        }

                        .pagination a {
                            font-weight: bold;
                            font-size: 18px;
                            color: black;
                            float: left;
                            padding: 8px 16px;
                            text-decoration: none;
                            border: 1px solid black;
                        }

                        .pagination a.active {
                            background-color: pink;
                        }

                        .pagination a:hover:not(.active) {
                            background-color: skyblue;
                        }
                    </style>
                </head>

                <body>
                    <center>
                        <?php

                        // Import the file where we defined the connection to Database.     
                        require_once "config.php";

                        $per_page_record = 3;  // Number of entries to show in a page.   
                        // Look for a GET variable page if not found default is 1.        
                        if (isset($_GET["page"])) {
                            $page  = $_GET["page"];
                        } else {
                            $page = 1;
                        }

                        $start_from = ($page - 1) * $per_page_record;

                        $query = "SELECT * FROM user LIMIT $start_from, $per_page_record";
                        $rs_result = mysqli_query($conn, $query);
                        ?>

                        <div class="container">
                            <br>
                            <div>

                                <table class="table table-striped table-condensed    
                                          table-bordered">
                                    <thead>
                                        <th>S.No.</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_array($rs_result)) {
                                            // Display each field of the records.    
                                        ?>
                                            <tr>
                                                <td class='id'><?php echo $row['user_id']  ?></td>
                                                <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                                <td><?php echo $row['username']  ?></td>
                                                <td><?php
                                                    if ($row['role'] == 1) {
                                                        echo "ADMIN";
                                                    } else {
                                                        echo "NORMAL ";
                                                    }


                                                    ?></td>
                                                <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"] ?>'><i class='fa fa-edit'></i></a></td>
                                                <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"] ?>'><i class='fa fa-trash-o'></i></a></td>
                                            </tr>
                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                </table>

                                <ul class='pagination admin-pagination'>
                                    <?php
                                    $query = "SELECT COUNT(*) FROM user";
                                    $rs_result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_row($rs_result);
                                    $total_records = $row[0];

                                    echo "</br>";
                                    // Number of pages required.   
                                    $total_pages = ceil($total_records / $per_page_record);
                                    $pagLink = "";

                                    if ($page >= 2) {
                                        echo "<a href='users.php?page=" . ($page - 1) . "'>  Prev </a>";
                                    }

                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $page) {
                                            $pagLink .= "<a class = 'active' href='users.php?page="
                                                . $i . "'>" . $i . " </a>";
                                        } else {
                                            $pagLink .= "<a href='users.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                                        }
                                    };
                                    echo $pagLink;

                                    if ($page < $total_pages) {
                                        echo "<a href='users.php?page=" . ($page + 1) . "'>  Next </a>";
                                    }

                                    ?>
                                </div>


                                <div class="inline">
                                    <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page . "/" . $total_pages; ?>" required>
                                    <button onClick="go2Page();">Go</button>
                                </div>
                            </div>
                        </div>
                    </center>
                    <script>
                        function go2Page() {
                            var page = document.getElementById("page").value;
                            page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
                            window.location.href = 'users.php?page=' + page;
                        }
                    </script>
                </body>

                </html>
             