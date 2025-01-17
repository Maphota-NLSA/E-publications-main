<?php

require_once('../assets/php/adminDashboard.php');
$query = "select * from book_informationsheet";
$result = mysqli_query($conn,$query);

$bookTotal = "SELECT SQL_CALC_FOUND_ROWS * FROM book_informationsheet";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <link href="../assets/img/favicon.webp" rel="icon" >
    <title>Admin Dashboard</title>
    <link
      rel="stylesheet"
      href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
    />
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/adminDashboard.css" />
  </head>
  <body>

    <input type="checkbox" name="" id="sidebar-toggle">

    <div class="sidebar">
      <div class="sidebar-brand">
        <div class="brand-flex">
        <img src="../assets/img/NLSA2-logo.png" alt="National Library Logo" class="img-fluid" style="width:50%; height:50%" >
  
            </a>
          <div class="brand-icons">
            <span class="las la-bell"></span>
            <span class="las la-user-circle"></span>
          </div>
        </div>
      </div>

      <div class="sidebar-main">
        <div class="sidebar-user">
        <img src="../assets/img/admin.png" alt="National Library Logo" class="img-fluid" >
          <div>
            <h3>Administrator</h3>
            <span>legaldeposit@nlsa.ac.za</span>
          </div>
        </div>

        <div class="sidebar-menu">
          <div class="menu-block">
            <div class="menu-head">
              <span>Dashboard</span>
            </div>
            <ul>
              <li>
                <a href="">
                  <span class="las la-user-edit"></span>
                  User Management +
                </a>
                <ul>
                <li>
                  <a href="task.php">
                    <span class="las la-tasks"></span>
                      Task
                  </a>
              </li>
              <li>
                  <a href="viewStatus.php">
                    <span class="las la-tasks"></span>
                      View Status
                  </a>
              </li>
              <li>
                <a href="addCataloguers.php">
                  <span class="las la-user-alt"></span>
                  Add a Cataloguer
                </a>
              </li>
                </ul>
              </li>
              <li>
                <a href="bookDetails.php">
                  <span class="las la-book"></span>
                  E-Books
                </a>
              </li>
              <li>
                <a href="">
                  <span class="las la-chart-pie"></span>
                  Analytics
                </a>
              </li>
              <li>
                <a href="">
                  <span class="las la-calendar"></span>
                  Calendar
                </a>
              </li>
              <li>
                <a href="">
                  <span class="las la-envelope"></span>
                  Mailbox
                </a>
              </li>
              <li>
                <a href="../application files/logout.php">
                  <span class="las la-sign-out-alt"></span>
                  Logout
                </a>
              </li>
            </ul>
          </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="sidebar-toggle">
                    <span class="las la-bars"></span>
                </label>
            </div>
          <!-- <span class="bars"> </span> -->
        </header>

        <main>
          <div class="page-header">
            <div>
              <h1>Analytics Dashboard</h1>
              <small>Monitor key metrics. Check reporting and review insights</small>
            </div>

          </div>

          <div class="cards">
            <div class="card-single">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span><strong>E-books captured</strong></span>
                        </div>
                        
                        <h2>
                            <?php if ($bookTotalResult = mysqli_query($conn,$bookTotal)) {
                              $rowcount = mysqli_num_rows($bookTotalResult);
                              print($rowcount);
                            
                            } ?>
                        </h2>
                        <small>10 less</small>
                    </div>
                    <div class="card-chart danger">
                        <span class="las la-chart-line"></span>
                    </div>
                </div>
            </div>

            <div class="card-single">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Books Verified</span>
                            <small>Number of E-books</small>
                        </div>
                        
                        <h2>2000</h2>
                        <small>10 less</small>
                    </div>
                    <div class="card-chart success">
                        <span class="las la-chart-line"></span>
                    </div>
                </div>
            </div>

            <div class="card-single">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Books uploaded on the server</span>
                            <small>Number of E-books</small>
                        </div>
                        <h2>4000</h2>
                        <small>10 less</small>
                    </div>
                    <div class="card-chart yellow">
                        <span class="las la-chart-line"></span>
                    </div>
                </div>
            </div>
          </div>
          
          <div class="job-grid">
            <div class="analytics-card">
                <div class="analytics-head">
                    <h3>Actions needed</h3>
                    <span class="las la-ellipsis-h"></span>
                </div>

                <div class="analytics-chart">
                    <div class="chart-circle">
                        <h1>74%</h1>
                    </div>

                    <div class="analytics-note">
                        <small>Note: Current sprint requires stakeholders meeting to reach a conclusion</small>
                    </div>
                </div>
                <div class="analytics-btn">
                    <button>Generate report</button>
                </div>
            </div>

            <div class="jobs"> <!----This is where you need to include the database list-->
              <h2>Books <small><a href="bookDetails.php">View books</a><span class="las la-arrow-right"></span></small></h2>
                <div class="table-responsive">
                   <table class="table table-bordered text-center">
                    <tr>
                      <td>Book ID</td>
                      <td>Publisher Email</td>
                      <td>Book Title</td>
                      <td>ISBN</td>
                      <td>Edit</td>
                    </tr>
                    <tr>
                     <?php
                     
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                          ?>
                          <td><?php echo $row['Book_ID']; ?></td>
                          <td><?php echo $row['PublisherEmail']; ?></td>
                          <td><?php echo $row['PublicationTitle']; ?></td>
                          <td><?php echo $row['Isbn']; ?></td>
                          <td><a href="bookDetails.php" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php }?>

                  </table>
                </div>
            </div>
          </div>
        </main>
      </div>

      <label for="sidebar-toggle" class="body-label"></label>
  </body>
</html>
