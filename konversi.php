<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konversi Suhu</title>
</head>
<body>
    <h2>Konversi Suhu</h2>
    <form method="POST">
        <label>Masukkan Suhu:</label><br>
        <input type="number" name="nilai" step="any" required><br><br>

        <label>Dari:</label><br>
        <select name="dari">
            <option value="C">Celsius</option>
            <option value="F">Fahrenheit</option>
            <option value="K">Kelvin</option>
        </select><br><br>

        <label>Ke:</label><br>
        <select name="ke">
            <option value="C">Celsius</option>
            <option value="F">Fahrenheit</option>
            <option value="K">Kelvin</option>
        </select><br><br>

        <button type="submit" name="konversi">Konversi</button>
    </form>

    <?php
    if (isset($_POST['konversi'])) {
        $nilai = $_POST['nilai'];
        $dari = $_POST['dari'];
        $ke = $_POST['ke'];
        $hasil = 0;

        if ($dari == $ke) {
            $hasil = $nilai;
        } elseif ($dari == "C" && $ke == "F") {
            $hasil = ($nilai * 9/5) + 32;
        } elseif ($dari == "C" && $ke == "K") {
            $hasil = $nilai + 273.15;
        } elseif ($dari == "F" && $ke == "C") {
            $hasil = ($nilai - 32) * 5/9;
        } elseif ($dari == "F" && $ke == "K") {
            $hasil = ($nilai - 32) * 5/9 + 273.15;
        } elseif ($dari == "K" && $ke == "C") {
            $hasil = $nilai - 273.15;
        } elseif ($dari == "K" && $ke == "F") {
            $hasil = ($nilai - 273.15) * 9/5 + 32;
        }

        echo "<h3>Hasil Konversi: $hasil °$ke</h3>";
    }
    ?>
</body>
</html>
