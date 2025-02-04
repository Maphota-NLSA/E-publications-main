<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Tab icon -->     
      <link href="../assets/img/favicon.webp" rel="icon">
  <title>Cataloguer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      background-color: #343a40;
      color: white;
      min-height: 100vh;
      width: 200px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      display: block;
      font-weight: bold;
    }
    .sidebar a:hover {
      background: #495057;
      border-radius: 5px;
    }
    .main-content {
      margin-left: 200px;
      padding: 20px;
    }
    .notification-dropdown {
      position: absolute;
      top: 15px;
      right: 20px;
    }
    .dropdown-menu {
      width: 300px;
      max-height: 400px;
      overflow-y: auto;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .dropdown-item {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .dropdown-item strong {
      font-size: 14px;
    }
    .dropdown-item small {
      font-size: 12px;
      color: #6c757d;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        width: 100%;
        height: auto;
        z-index: 1050;
      }
      .main-content {
        margin-left: 0;
        padding-top: 60px; /* we add padding to avoid overlap with sidebar */
      }
    }
  </style>
</head>
<body>
  
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block sidebar">
        <h3 class="text-center py-3">Dashboard</h3>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>

          <li class="nav-item"><a href="view.php" class="nav-link">Document Management</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <!-- Notification Dropdown -->
        <div class="notification-dropdown">
          <div class="dropdown">
            <button class="btn btn-light border dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-bell"></i> Notifications
            </button>
            <ul class="dropdown-menu dropdown-menu-end" id="notifications-menu" aria-labelledby="notificationsDropdown">
              <!-- Dynamic notifications will load here -->
              <li class="dropdown-item text-center text-muted">Loading...</li>
            </ul>
          </div>
        </div>

        <!-- Profile Section -->
        <div class="mt-4">
          <h1>Welcome, <span id="FullName">[Loading...]</span></h1>
          <p>Email: <span id="EmailAddress">[Loading...]</span></p>
        </div>

        <!-- Table Section -->
        <div class="table-responsive mt-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Email</th>
                <th>ISBN</th>
                <th>Downloads</th>
              </tr>
            </thead>
            <tbody id="documents-table">
              <!-- Dynamic content will load here -->
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const fullnameElement = document.getElementById("FullName");
      const emailElement = document.getElementById("EmailAddress");
      const tableBody = document.getElementById("documents-table");
      const notificationsMenu = document.getElementById("notifications-menu");

      // Fetch user profile data
      fetch("fetch_profile.php")
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            fullnameElement.textContent = data.fullname || "[Unknown]";
            emailElement.textContent = data.email || "[Unknown]";
          } else {
            const errorMsg = data.message || "Error fetching profile";
            fullnameElement.textContent = `[${errorMsg}]`;
            emailElement.textContent = `[${errorMsg}]`;
          }
        })
        .catch(err => {
          console.error("Error fetching profile:", err);
          fullnameElement.textContent = "[Error fetching profile]";
          emailElement.textContent = "[Error fetching profile]";
        });

      // Fetch document data
      fetch("fetch_documents.php")
        .then(response => response.json())
        .then(data => {
          if (data.documents && data.documents.length > 0) {
            tableBody.innerHTML = data.documents.map(doc => `
              <tr>
                <td>${doc.id}</td>
                <td>${doc.title}</td>
                <td>${doc.description}</td>
                <td><a href="view.php?doc_id=${doc.id}" class="btn btn-primary">View Details</a></td>
                <td>${doc.email || "N/A"}</td>
                <td>${doc.isbn || "N/A"}</td>
                <td><button class="btn btn-success" onclick="downloadDocument(${doc.id})">Download <i class="bi bi-download"></i></button></td>
              </tr>`).join("");
          } else {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center">No documents found.</td></tr>';
          }
        })
        .catch(err => {
          console.error("Error fetching documents:", err);
          tableBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Error loading documents.</td></tr>';
        });

      // Fetch notifications
      fetch("notifications.php")
        .then(response => response.json())
        .then(data => {
          if (data.success && data.notifications && data.notifications.length > 0) {
            notificationsMenu.innerHTML = data.notifications.map(notification => `
              <li class="dropdown-item">
                <strong>${notification.title}</strong><br>
                <small>${notification.description}</small><br>
                <small class="text-muted">${new Date(notification.date).toLocaleDateString()}</small>
              </li>`).join("");
          } else {
            notificationsMenu.innerHTML = '<li class="dropdown-item text-center text-muted">No notifications.</li>';
          }
        })
        .catch(err => {
          console.error("Error fetching notifications:", err);
          notificationsMenu.innerHTML = '<li class="dropdown-item text-center text-danger">Error loading notifications.</li>';
        });

      // Download document function
      window.downloadDocument = function(docId) {
        fetch(`download_document.php?doc_id=${docId}`)
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              window.location.href = data.file_path;
            } else {
              alert(data.message || "Error downloading file.");
            }
          })
          .catch(err => {
            console.error("Error downloading document:", err);
            alert("An error occurred while downloading. Please try again.");
          });
      };
    });
  </script>
</body>
</html>