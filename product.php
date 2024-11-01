<?php
include 'header.php';
include 'db.php'; 

$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;


$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();


if (!$product) {
    echo "<p>Товар не найден.</p>";
    include 'footer.php';
    exit();
}
?>
<main>
<div class="product-details">
    <h1><?php echo htmlspecialchars($product['brand'] . ' ' . $product['model']); ?></h1>
    
    <div class="product-image">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['model']); ?>">
    </div>
    
    <div class="product-info">
        <p><strong>Цена:</strong> <?php echo number_format($product['price'], 0, '.', ' '); ?> ₽</p>
        <p><strong>Описание:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
        
       
        <h3>Краткие характеристики</h3>
        <ul>
            <li><strong>Бренд:</strong> <?php echo htmlspecialchars($product['brand']); ?></li>
            <li><strong>Модель:</strong> <?php echo htmlspecialchars($product['model']); ?></li>
            <li><strong>Наличие на складе:</strong> <?php echo (int) $product['stock']; ?> шт.</li>
           
        </ul>
        <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit" class="add-to-cart-btn">Добавить в корзину</button>
    </form>
        
        <a href="catalog.php" class="back-btn">Вернуться в каталог</a>
    </div>
</div>

</main>
<?php include 'footer.php'; ?>