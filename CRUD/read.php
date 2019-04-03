<?php
// Check existence of id parameter before processing further
if(isset($_GET["si"]) && !empty(trim($_GET["si"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tb_publication WHERE si = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_si);
        
        // Set parameters
        $param_si = trim($_GET["si"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $author_name = $row["author_name"];
                $other_author = $row["other_author"];
                $paper_title = $row["paper_title"];
                 $journal_name = $row["journal_name"];
                $reference_format = $row["reference_format"];
                $paper_link = $row["paper_link"];
                 $category = $row["category"];
                $paper_index = $row["paper_index"];
                $key_words = $row["key_words"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Author Name</label>
                        <p class="form-control-static"><?php echo $row["author_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Other Authors</label>
                        <p class="form-control-static"><?php echo $row["other_author"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Paper Title</label>
                        <p class="form-control-static"><?php echo $row["paper_title"]; ?></p>
                    </div> 
                     <div class="form-group">
                        <label>Journal Name</label>
                        <p class="form-control-static"><?php echo $row["journal_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <p class="form-control-static"><?php echo $row["reference_format"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Paper Link</label>
                        <p class="form-control-static"><?php echo $row["paper_link"]; ?></p>
                    </div>
                     <div class="form-group">
                        <label>Category</label>
                        <p class="form-control-static"><?php echo $row["category"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Paper Index</label>
                        <p class="form-control-static"><?php echo $row["paper_index"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>KeyWords</label>
                        <p class="form-control-static"><?php echo $row["key_words"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>