<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="C:/xampp/htdocs/public/images/icon.png" type="image/x-icon">
    <link href="/public/styles/bootstrap.css" rel="stylesheet">
    <link href="/public/styles/admin.css" rel="stylesheet">
    <link href="/public/styles/font-awesome.css" rel="stylesheet">
    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/form.js"></script>
    <script src="/public/scripts/popper.js"></script>
    <script src="/public/scripts/bootstrap.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark">
<?php echo $content; ?>
<?php if ($this->route['action'] != 'login'): ?>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>&copy; 2019, Shopping Assistent</small>
            </div>
        </div>
    </footer>
<?php endif; ?>
</body>
</html>