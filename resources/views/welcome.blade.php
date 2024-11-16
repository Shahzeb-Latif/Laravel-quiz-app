<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Quiz</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            /* Light background */
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 100px;
            max-width: 500px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Quiz</h1>
        <form id="user-form">
            <div class="mb-3">
                <label for="name" class="form-label">Enter Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Shahzeb Latif" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="submitName()">Start Quiz</button>
        </form>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert for Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script for AJAX Request -->
    <script>
        function submitName() {
            const name = document.getElementById('name').value;

            if (!name) {
                Swal.fire('Error', 'Name is required!', 'error');
                return;
            }

            axios.post('/save-user', {
                    name
                })
                .then(response => {
                    if (response.data.success) {
                        // Redirect to questions page
                        window.location.href = '/questions';
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                });
        }

    </script>
</body>
</html>

