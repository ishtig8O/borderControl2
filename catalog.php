<?php
include 'header.php';
include 'db.php';


$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll();
?>
<main>
<div class="catalog">
    <h1>Каталог телефонов</h1>
    
    <table class="product-table">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['model']; ?>" class="product-image"></td>
                    <td><?php echo $product['brand'] . ' ' . $product['model']; ?></td>
                    <td><?php echo $product['price']; ?> ₽</td>
                    <td>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="details-btn">Подробнее</a>
                        <form method="POST" action="add_to_cart.php" class="add-to-cart-form">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="add-to-cart-btn">Добавить в корзину</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</main>
<?php include 'footer.php'; ?>