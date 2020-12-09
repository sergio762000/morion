<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ping Test</title>
</head>
<body>

<form method="post" action="index.php">
    <label for="ipaddr">Введите ip-адрес хоста</label>
    <input type="text" name="ipaddr">

    <input type="radio" id="IPv4" name="protocol" value="4" checked="checked">
    <label for="IPv4">IPv4</label>

    <input type="radio" id="IPv6" name="protocol" value="6">
    <label for="IPv6">IPv6</label>
    <input type="submit" name="submit" value="Проверить">

    <br>
</form>
<?php if (!empty($ipAddr)): ?>
    <?php if (!empty($data[$ipAddr])):?>
        Результаты проверки хоста: <b><?= $ipAddr?></b>  <br>
        <?php foreach ($data[$ipAddr] as $key => $value): ?>
            <?= $key . ' = ' . $value . PHP_EOL?>
        <?php endforeach; ?>
    <?php endif;?>
<?php endif;?>

<?php if (!empty($data)):?>
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

    <?php foreach ($data as $ipaddr => $listParam): {
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

</body>
</html>
