<?php include_once __DIR__ . '/../layout/footer.html';?>

<form method="post" action="index.php">
    <label for="ipaddr">Введите ip-адрес хоста (IPv4)</label>
    <input type="text" name="ipaddr">
    <input type="submit" name="submit" value="Отправить">

    <br>
</form>
<?php if (!empty($_POST['ipaddr'])): ?>
    <?php if (!empty($_SESSION[$_POST['ipaddr']])):?>
        Результаты проверки хоста: <b><?= $_POST['ipaddr']?></b>  <br>
        <?php foreach ($_SESSION[$_POST['ipaddr']] as $key => $value): ?>
            <?= $key . ' = ' . $value . PHP_EOL?>
        <?php endforeach; ?>
    <?php endif;?>
<?php endif;?>

<?php if (!empty($_SESSION)):?>
    <br>
<table>
    <thead>
        <tr>
            <td>Адрес хоста:             </td>
            <td>Время отклика, мин (мс): </td>
            <td>Время отклика, сред (мс):</td>
            <td>Время отклика, макс (мс):</td>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($_SESSION as $ipaddr => $listParam): {
    }?>
        <tr>
            <td><?= $ipaddr?></td>
            <td align="center"><?= $listParam['min']?></td>
            <td align="center"><?= $listParam['avg']?></td>
            <td align="center"><?= $listParam['max']?></td>
        </tr>
    <?php endforeach;?>
    </tbody>

</table>

<?php endif;?>

<?php include_once __DIR__ . '/../layout/footer.html'; ?>