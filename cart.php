<?php
session_start();
include 'header.php';
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("
    SELECT products.id, products.brand, products.model, products.price, products.image, cart.quantity
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();
?>
<main>
<div class="cart">
    <h1>Корзина</h1>
    
    <?php if (count($cart_items) > 0): ?>
        <div class="cart-items">
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['model']; ?>" class="cart-item-image">
                    <h3><?php echo $item['brand'] . ' ' . $item['model']; ?></h3>
                    <p>Цена: <?php echo $item['price']; ?> ₽</p>

                    
                    <form method="POST" action="update_cart.php" class="quantity-form">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <label>Количество:</label>
                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                        <button type="submit">Обновить</button>
                    </form>

                    
                    <form method="POST" action="remove_from_cart.php" class="remove-form">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" class="remove-btn">Удалить</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Ваша корзина пуста.</p>
    <?php endif; ?>
</div>
</main>
<?php include 'footer.php'; ?>