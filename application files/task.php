<?php 
    require_once('../assets/php/conn.php');
    $sql = "Select * from book_informationsheet";
    $sql1 = "Select * from users";
    $bookresults = mysqli_query($conn, $sql);
    $bookresults1 = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tab icon -->
  <link href="../assets/img/favicon.webp" rel="icon">
  <link rel="stylesheet" href="../assets/css/bookDetails.css">
  <title>Book details</title>
</head>
<body>
  <div class="scrollable-table">
  <table class="table">
    <thead>
      <tr>
        <th>Book ID</th>
        <th>Publisher Email</th>
        <th>Author Name</th>
        <th>Author Pseudonym</th>
        <th>Editor Name</th>
        <th>Book Title</th>
        <th>Book Edition</th>
        <th>Impression</th>
        <th>ISBN</th>
        <th>Set ISBN</th>
        <th>Publisher Name</th>
        <th>Publisher Address</th>
        <th>Year of Publication</th>
        <th>Assign to</th>
        <th>Assign</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php   
          while ($row = mysqli_fetch_assoc($bookresults, $bookresults1)) 
          {
        ?>
              <td><?php echo $row['Book_ID']; ?></td>
              <td><?php echo $row['PublisherEmail']; ?></td>
              <td><?php echo $row['AuthorName']; ?></td>
              <td><?php echo $row['AuthorPseudonym']; ?></td>
              <td><?php echo $row['EditorName']; ?></td>
              <td><?php echo $row['PublicationTitle']; ?></td>
              <td><?php echo $row['BookEdition']; ?></td>
              <td><?php echo $row['Impression']; ?></td>
              <td><?php echo $row['Isbn']; ?></td>
              <td><?php echo $row['SetISBN']; ?></td>
              <td><?php echo $row['PublisherName']; ?></td>
              <td><?php echo $row['PublisherAddress']; ?></td>
              <td><?php echo $row['PublisherAddress']; ?></td>
              <td><?php echo $row['FullName']; ?></td>
              
              <td>
                <a href="bookEdit.php?Book_ID=<?php echo $row['Book_ID']?>" class="link-dark"><i class="fa-solid fa-pen-to-sqaure fs-5 me-3">Edit</i></a>
              </td>
       </tr>
                 <?php }?>

    </tbody>
  </table>
  </div>
</body>
</html>