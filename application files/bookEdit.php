<?php 
    include "../assets/php/conn.php";
    $book_id = $_GET['Book_ID'];
        
    if (isset($_POST['submit'])) {
        
        $publisher_email = $_POST["PublisherEmail"];
        $author_name = $_POST["AuthorName"];
        $author_pseudonym = $_POST["AuthorPseudonym"];
        $editor_name = $_POST["EditorName"];
        $book_edition = $_POST["BookEdition"];
        $impression = $_POST["Impression"];
        $set_isbn = $_POST["SetISBN"];
        $publisher_name = $_POST["PublisherName"];
        $publisher_address = $_POST["PublisherAddress"];
        $publication_year = $_POST["PublicationYear"];
        $price = $_POST["Price"];
        $fiction_or_non = $_POST["FictionOrNonFiction"];
        $englishVersionTitle = $_POST["EnglishVersionTitle"];
        
        $sql = "UPDATE `book_informationsheet` SET `BookEdition`='$book_edition',`Price` = '$price',`AuthorPseudonym`='$author_pseudonym',
        `FictionOrNonFiction`='$fiction_or_non',`Impression`='$impression',`SetISBN`='$set_isbn',`EditorName`='$editor_name',`PublicationYear`='$publication_year',`EnglishVersionTitle`='$englishVersionTitle' WHERE Book_ID=$book_id";
        $bookUpdate = mysqli_query($conn, $sql);
    
        if ($bookUpdate) {
            // header("Location: bookdetails.php");
            header("Location: bookDetails.php");
        }
        else{
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Tab icon -->
    <link href="../assets/img/favicon.webp" rel="icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/bookEdit.css">
    <title>Update books</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        NLSA Electronic Publications
    </nav>

    <div class="container">
        
        <div class="text-center mb-4">
            <h3>Update SANB Electronic Book Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php 
            $sql = "SELECT * FROM `book_informationsheet` WHERE Book_ID = $book_id LIMIT 1";
            $editResult = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($editResult);
        ?>
        <div class="container_d-flex_justify-content-center">
            <form action="" method="POST" style="width:50vw; min-width:300px;">
                <div class="row_mb-3">
                    
                    <div class="col">
                        <label class="form-label"><strong>Publisher Email Address</strong></label>
                        <input type="email" class="form-control" name="PublisherEmail" value="<?php echo $row['PublisherEmail'] ?>" readonly>
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Author Fullname:</strong></label>
                        <input type="text" class="form-control" name="AuthorName" value="<?php echo $row['AuthorName'] ?>" readonly>
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Author Pseudonym:</strong></label>
                        <input type="text" class="form-control" name="AuthorPseudonym" value="<?php echo $row['AuthorPseudonym'] ?>">
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Editor Fullname:</strong></label>
                        <input type="text" class="form-control" name="EditorName" value="<?php echo $row['EditorName'] ?>" readonly>
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Title of Publication:</strong></label>
                        <input type="text" class="form-control" name="PublicationTitle" value="<?php echo $row['PublicationTitle'] ?>" readonly>
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Book Edition:</strong></label>
                        <input type="text" class="form-control" name="BookEdition" value="<?php echo $row['BookEdition'] ?>" readonly>
                    </div>
                    
                    <div class="col">
                        <label class="form-label"><strong>Impression:</strong></label>
                        <input type="text" class="form-control" name="Impression" value="<?php echo $row['Impression'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>ISBN:</strong></label>
                        <input type="text" class="form-control" name="Isbn" value="<?php echo $row['Isbn'] ?>" readonly>
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Set ISBN:</strong></label>
                        <input type="text" class="form-control" name="SetISBN" value="<?php echo $row['SetISBN'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Publisher Fullname:</strong></label>
                        <input type="text" class="form-control" name="PublisherName" value="<?php echo $row['PublisherName'] ?>" readonly>
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Publisher Address:</strong></label>
                        <input type="text" class="form-control" name="PublisherAddress" value="<?php echo $row['PublisherAddress'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Year of publication:</strong></label>
                        <input type="text" class="form-control" name="PublicationYear" value="<?php echo $row['PublicationYear'] ?>" readonly>
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Price:</strong></label>
                        <input type="text" class="form-control" name="Price" value="<?php echo $row['Price'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Fiction Or Non-fiction:</strong></label>
                        <input type="text" class="form-control" name="FictionOrNonFiction" value="<?php echo $row['FictionOrNonFiction'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Genre:</strong></label>
                        <input type="text" class="form-control" name="genre" value="<?php echo $row['Genre'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>Language of Publication:</strong></label>
                        <input type="text" class="form-control" name="publication_language" value="<?php echo $row['PublicationLanguage'] ?>" readonly>
                    </div>

                    <div class="col">
                        <label class="form-label"><strong>English Translation of Title(if the book is written in another language):</strong></label>
                        <input type="text" class="form-control" name="EnglishVersionTitle" value="<?php echo $row['EnglishVersionTitle'] ?>">
                    </div>
                </div>
                
                <div class="col">
                        <label class="form-label"><strong>File Uploaded:</strong></label>
                        <input type="text" class="form-control" name="fileuploaded" value="<?php echo $row['FileUpload'] ?>" readonly>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" onclick="openPopUp()">Update</button>
                    <a href="bookDetails.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>

        <div class="popup" id="popUp">
            <img src="../assets/img/istockphoto-1416145560-612x612.jpg">
            <h2>Update successful</h2>
            <p>Changes are successfully made!</p>
            <button type="button" class="btn-ok" onclick="closePopup()">Ok</button>
        </div>
    </div>


      <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>