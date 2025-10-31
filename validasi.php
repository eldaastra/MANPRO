<?php
function validasi_input($nilai) {
    if (!is_numeric($nilai)) {
        return "❌ Input harus berupa angka!";
    } elseif ($nilai < -273.15) {
        return "❌ Suhu tidak bisa lebih rendah dari -273.15°C (nol mutlak).";
    } else {
        return "✅ Input valid.";
    }
}

// Contoh penggunaan:
if (isset($_POST['konversi'])) {
    $pesan = validasi_input($_POST['nilai']);
    echo "<p>$pesan</p>";
}
?>
