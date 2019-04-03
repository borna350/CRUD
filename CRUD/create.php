<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$author_name = $other_author = $paper_title = $journal_name = $reference_format = $paper_link = $category = $paper_index = $key_words = "";
$author_name_err = $other_author_err = $paper_title_err = $journal_name_err = $reference_format_err = $paper_link_err = $category_err = $paper_index_err = $key_words_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate author name
    $input_author_name = trim($_POST["author_name"]);
    if(empty($input_author_name)){
        $author_name_err = "Please enter a name.";
    } elseif(!filter_var($input_author_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $author_name_err = "Please enter a valid name.";
    } else{
        $author_name = $input_author_name;
    }

    // Validate other authors name
    $input_other_author = trim($_POST["other_author"]);
    if(empty($input_other_author)){
        $other_author_err = "Please enter a name.";
    } elseif(!filter_var($input_other_author, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $other_author_err = "Please enter a valid name.";
    } else{
        $other_author = $input_other_author;
    }

    
    // Validate paper title
    $input_paper_title = trim($_POST["paper_title"]);
    if(empty($input_paper_title)){
        $paper_title_err = "Please enter an address.";     
    } else{
        $paper_title = $input_paper_title;
    }
    
    // Validate journal name
    $input_journal_name = trim($_POST["journal_name"]);
    if(empty($input_journal_name)){
        $journal_name_err = "Please enter the salary amount.";     
    
      } else{
        $journal_name= $input_journal_name;
    }

    // Validate reference format
    $input_reference_format = trim($_POST["reference_format"]);
    if(empty($input_reference_format)){
        $reference_format_err = "Please enter the salary amount.";     
    
     }else{
        $reference_format= $input_reference_format;
    }
    // Validate paper link
    $input_paper_link = trim($_POST["paper_link"]);
    if(empty($input_paper_link)){
        $paper_link_err = "Please enter the salary amount.";     
    
     }else{
        $paper_link= $input_paper_link;
    }
    // Validate category
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter the salary amount.";     
    
     }else{
        $category= $input_category;
    }
    // Validate paper index
    $input_paper_index = trim($_POST["paper_index"]);
    if(empty($input_paper_index)){
        $paper_index_err = "Please enter the salary amount.";     
    
     }else{
        $paper_index= $input_paper_index;
    }
    // Validate key words
    $input_key_words = trim($_POST["key_words"]);
    if(empty($input_key_words)){
        $key_words_err = "Please enter the salary amount.";     
    
     }else{
        $key_words= $input_key_words;
    }
    
    // Check input errors before inserting in database
    if(empty($author_name_err) && empty($other_author_err) && empty($paper_title_err) && empty($journal_name_err) && empty($reference_format_err) && empty($paper_link_err) && empty($category_err) && empty( $paper_index_err) && empty($key_words_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tb_publication (author_name, other_author, paper_title, journal_name, reference_format, paper_link,  category, paper_index, key_words) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_author_name, $param_other_author, $param_paper_title, $param_journal_name,$param_reference_format, $param_paper_link, $param_category, $param_paper_index, $param_key_words);
            
            // Set parameters
            $param_author_name = $author_name;
            $param_other_author = $other_author;
            $param_paper_title = $paper_title;
            $param_journal_name = $journal_name ;
            $param_reference_format = $reference_format;
            $param_paper_link = $paper_link;
            $param_category = $category;
             $param_paper_index = $paper_index;
             $param_key_words = $key_words;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add publication record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($author_name_err)) ? 'has-error' : ''; ?>">
                            <label>Author Name</label>
                            <input type="text" name="author_name" class="form-control" value="<?php echo $author_name; ?>">
                            <span class="help-block"><?php echo $author_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($other_author_err)) ? 'has-error' : ''; ?>">
                            <label>Other Authors</label>
                            <textarea name="other_author" class="form-control"><?php echo $other_author; ?></textarea>
                            <span class="help-block"><?php echo $other_author_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($paper_title_err)) ? 'has-error' : ''; ?>">
                            <label>Paper Title</label>
                            <input type="text" name="paper_title" class="form-control" value="<?php echo $paper_title; ?>">
                            <span class="help-block"><?php echo $paper_title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($journal_name_err)) ? 'has-error' : ''; ?>">
                            <label>Journal Name</label>
                            <input type="text" name="journal_name" class="form-control" value="<?php echo $journal_name; ?>">
                            <span class="help-block"><?php echo $journal_name_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($reference_format_err)) ? 'has-error' : ''; ?>">
                            <label>Reference</label>
                            <textarea name="reference_format" class="form-control"><?php echo $reference_format; ?></textarea>
                            <span class="help-block"><?php echo $reference_format_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($journal_name_err)) ? 'has-error' : ''; ?>">
                            <label>Paper Link</label>
                            <input type="text" name="paper_link" class="form-control" value="<?php echo $paper_link; ?>">
                            <span class="help-block"><?php echo $paper_link;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                            <label>Category</label>
                            <select name="category" class="form-control"><?php echo $category; ?>
                            <option>Select Any </option>
                             <option>CSR </option>
                              <option>Information System </option>
                              </select>
                            <span class="help-block"><?php echo $category_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($paper_index_err)) ? 'has-error' : ''; ?>">
                            <label>Paper Index</label>
                            <select name="paper_index" class="form-control"><?php echo $paper_index; ?>
                            <option>Select </option>
                             <option>Scopus </option>
                              <option>ISI </option>
                              </select>
                            <span class="help-block"><?php echo $paper_index_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($key_words_err)) ? 'has-error' : ''; ?>">
                            <label>KeyWords</label>
                            <textarea name="key_words" class="form-control"><?php echo $key_words; ?></textarea>
                            <span class="help-block"><?php echo $key_words_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>