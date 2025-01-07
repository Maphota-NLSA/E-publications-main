<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      display: block;
      font-weight: bold;
    }
    .sidebar a:hover {
      background: #495057;
      border-radius: 5px;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        width: 100%;
        height: auto;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block sidebar">
        <h3 class="text-center py-3">Cataloguer Dashboard</h3>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
          <li class="nav-item"><a href="notifications.php" class="nav-link">Notifications</a></li>
          <li class="nav-item"><a href="view.php" class="nav-link">Document Management</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="mt-4">Assigned list of catalogues</h1>
        <div class="table-responsive mt-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Downloads</th>
                <th>Action</th>
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
      const tableBody = document.getElementById('documents-table');

      // Fetch document data from PHP backend
      fetch('fetch_documents.php')
        .then(response => response.json())
        .then(data => {
          if (data.documents && data.documents.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No documents found.</td></tr>';
            return;
          }

          // Populate table
          tableBody.innerHTML = data.documents.map(doc => `
<tr>
  <td>${doc.id}</td>
  <td>
    <a href="view.php?doc_id=${doc.id}" class="text-decoration-none text-dark">
      ${doc.title}
    </a>
  </td>
  <td>${doc.description}</td>
  <td>
    <a href="view.php?doc_id=${doc.id}" class="btn btn-primary">
      View Details
    </a>
  </td>
  <td>
    <a href="${doc.file_path}" target="_blank" class="btn btn-link">
      View File
    </a>
  </td>
  <td>${doc.download_count}</td>
  <td>
    <button class="btn btn-success" onclick="downloadDocument(${doc.id})">
      Download <i class="bi bi-download"></i>
    </button>
  </td>
</tr>

          `).join('');
        })
        .catch(err => {
          console.error('Error fetching documents:', err);
          tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading documents.</td></tr>';
        });
    });

    function downloadDocument(bookId) {
      fetch(`download_document.php?Book_ID=${bookId}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.href = data.file_path; 
          } else {
            alert(data.message || 'Error downloading file.');
          }
        })
        .catch(err => {
          console.error('Error downloading document:', err);
          alert('An error occurred while downloading. Please try again.');
        });
    }
  </script>
</body>
</html>
