<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин телефонов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
?>
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="phone1.jpg" alt="PhoneStore Logo">
            </a>
            <a href="index.php">PhoneStore</a>
        </div>
        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="index.php">Главная</a></li>
                <li><a href="catalog.php">Магазин</a></li>
                
            </ul>
        </nav>
        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Если пользователь авторизован, показываем корзину и обратную связь -->
                <a href="cart.php" class="cart-icon">🛒 Корзина</a>
                <a href="feedback.php" class="feedback-btn">Обратная связь</a>
                <span class="username">Привет, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="login-btn">Выйти</a>
            <?php else: ?>
                <a href="login.php" class="login-btn">Войти</a>
            <?php endif; ?>
        </div>
    </div>
</header>

