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
<br>
<b>IP-address: "<?= $ipaddr ?>" not valid IPv<?= $protocol ?>  address </b>
