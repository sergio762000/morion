<?php include_once __DIR__ . '/../layout/footer.html';?>

<form method="post" action="index.php">
    <label for="ipaddr">Введите ip-адрес хоста (IPv4)</label>
    <input type="text" name="ipaddr">
    <input type="submit" name="submit" value="Отправить">
</form>
<br>
<?php if (empty($_SESSION['answer_ping'])): ?>
<b>IP-address not valid!!!</b>
<?php endif; ?>

<?php include_once __DIR__ . '/../layout/footer.html'; ?>
