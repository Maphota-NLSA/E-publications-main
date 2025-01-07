<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliography Information Form</title>
    <link href="../assets/img/favicon.webp" rel="icon">
    <link rel="stylesheet" href="../assets/css/styles.css">
   <!-- JavaScript Validation -->
   <script defer src="../assets/js/validation.js"></script>

       <!-- Inline Styles for Background -->
       <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, red, green, yellow, blue, black);
            background-size: 300% 300%; /* Creates a smooth gradient */
            animation: backgroundAnimation 10s ease infinite; /* Smooth transition */
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }

        @keyframes backgroundAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        form {
            max-width: 600px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, select, button {
            width: 100%;
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #0066cc;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #004c99;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        .alert {
            max-width: 600px;
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ff4d4d;
            background-color: #ffcccc;
            color: #900;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Bibliography Information Form</h2>
       
        <!-- Display server-side error messages if any -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error_message']); ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        
            <form id ="" action="../assets/php/db_connect.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required placeholder="example@example.com">

                <label for="author_name">Author's Name:</label>
                <input type="text" id="author_name" name="author_name" required placeholder="Enter Author's Name">

                <label for="author_pseudonym">Author's Pseudonym:</label>
                <input type="text" id="author_pseudonym" name="author_pseudonym" required placeholder="Enter Pseudonym (optional)">

                <label for="editor_name">Editor's Name:</label>
                <input type="text" id="editor_name" name="editor_name" required placeholder="Enter Editor's Name">

                <label for="title_of_publication">Title of Publication:</label>
                <input type="text" id="title_of_publication" name="title_of_publication" required placeholder="Enter Title">

                <label for="edition">Edition:</label>
                <input type="text" id="edition" name="book_edition" required placeholder="Enter Edition">

                <label for="impression">Impression:</label>
                <input type="text" id="impression" name="impression" required placeholder="Enter Impression">

                <label for="isbn_electronic">ISBN of Electronic Book:</label>
                <input type="text" id="isbn_electronic" name="isbn_electronic" required pattern="\d{13}" placeholder="Enter 13-digit ISBN">

                <label for="set_isbn">Set ISBN:</label>
                <input type="text" id="set_isbn" name="set_isbn" required placeholder="Enter Set ISBN">

                <label for="publisher_name">Publisher's Name:</label>
                <input type="text" id="publisher_name" name="publisher_name" required placeholder="Enter Publisher Name">

                <label for="publisher_address">Publisher's Address:</label>
                <input type="text" id="publisher_address" name="publisher_address" required placeholder="Enter Publisher Address">

                <label for="publication_year">Publication Year:</label>
                <input type="number" id="publication_year" name="publication_year" required placeholder="Enter Year">

                <label for="price">Price (Rand):</label>
                <input type="number" step="0.01" id="price" name="price" required placeholder="R 0.00">

                <label for="fiction_or_nonfiction">Fiction or Nonfiction:</label>
                <select id="fiction_or_nonfiction" name="fiction_or_nonfiction" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Nonfiction">Nonfiction</option>
                </select>
                
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required placeholder="Enter Genre">

                <label for="language_of_publication">Language of Publication:</label>
                <input type="text" id="language_of_publication" name="language_of_publication" required placeholder="Enter Language">

                <label for="english_translation_title">English Translation of Title:</label>
                <input type="text" id="english_translation_title" name="english_translation_title" required placeholder="Enter Translation (if any)">

                <label for="file">Upload File:</label>
                <input type="file" id="file" name="file" required>       
            <button type="submit">Submit</button>
            </form>

</body>
</html>