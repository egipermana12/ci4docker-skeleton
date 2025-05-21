<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('layout/head.php') ?>
</head>

<body class="docs-page">

    <!-- header -->
    <?= $this->include('layout/header.php') ?>
    <!-- header -->

    <!-- header -->
    <?= $this->include('layout/sidebar.php') ?>
    <!-- header -->

    <div class="docs-content">
        <div class="container">
            hallowwww
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Javascript -->
    <?= $this->include('layout/script.php') ?>
</body>

</html>