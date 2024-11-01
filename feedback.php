<?php
session_start();
include 'header.php';
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message_sent = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);
    
    if (!empty($message)) {
       
        $stmt = $pdo->prepare("INSERT INTO feedback (user_id, message) VALUES (?, ?)");
        $stmt->execute([$user_id, $message]);
        $message_sent = true;
    } else {
        $error = "Сообщение не может быть пустым.";
    }
}
?>
<main>
<div class="feedback-container">
    <h2>Форма обратной связи</h2>
    
    <?php if ($message_sent): ?>
        <p class="success-message">Спасибо за ваше сообщение! Мы свяжемся с вами в ближайшее время.</p>
    <?php else: ?>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="feedback.php">
            <label for="message">Ваше сообщение:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            <button type="submit">Отправить сообщение</button>
        </form>
    <?php endif; ?>
</div>
</main>
<?php include 'footer.php'; ?>