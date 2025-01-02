<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-color {
            color: #c77943;
        }
        .custom-border {
            border-color: #c77943 !important;
        }
        .custom-bg {
            background-color: #c77943;
        }
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-code {
            font-size: 150px;
            font-weight: bold;
            line-height: 1;
        }
        .back-button:hover {
            background-color: #b36a35 !important;
            border-color: #b36a35 !important;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="error-code custom-color">404</div>
                    <h2 class="mb-4">Page Not Found</h2>
                    <p class="mb-4 lead">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                    <div class="border-top custom-border py-4 mb-4">
                        <a href="{{ url('/index') }}" class=" btn custom-bg text-white back-button px-4 py-2">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>