<?php 
    include("process/conn.php");

    $msg = "";

    if (isset($_SESSION["msg"])) {

        $msg = $_SESSION["msg"];
        $status = $_SESSION["status"];

        $_SESSION["msg"] = "";
        $_SESSION["status"] = "";

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu Pedido!</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- App CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a href="index.php" class="navbar-brand">
            <img src="img/pizza.svg" alt="Pizzaria do João" id="brand-logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">Peça sua pizza!</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php if ($msg != ""): ?>
    <div class="alert alert-<?= $status ?>">
        <p><?= $msg ?></p>
    </div>
    <?php endif; ?>