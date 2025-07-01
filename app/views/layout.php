<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Dashboard' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/material-dashboard/css/material-dashboard.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="g-sidenav-show bg-gray-100">
  <?php require __DIR__ . '/_sidebar.php'; ?>
  <main class="main-content position-relative border-radius-lg">
    <?php if (file_exists(__DIR__ . '/_header.php')) require __DIR__ . '/_header.php'; ?>
    <div class="container-fluid py-4">
      <?= $content ?>
    </div>
  </main>
  <script src="/assets/material-dashboard/js/core/popper.min.js"></script>
  <script src="/assets/material-dashboard/js/core/bootstrap.min.js"></script>
  <script src="/assets/material-dashboard/js/material-dashboard.min.js"></script>
</body>
</html>
