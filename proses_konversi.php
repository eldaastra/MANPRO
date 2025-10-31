<?php
// Ambil data dari form
$jenis = strtolower(trim($_POST['jenis']));
$nilai = $_POST['nilai'];
$dari = strtolower(trim($_POST['dari']));
$ke = strtolower(trim($_POST['ke']));

// Validasi input (dibuat oleh Qiya)
if (!is_numeric($nilai)) {
    $hasil = "❌ Nilai harus berupa angka.";
    header("Location: index.php?hasil=" . urlencode($hasil));
    exit;
}
if ($nilai < 0 && $jenis == 'suhu' && $dari == 'kelvin') {
    $hasil = "❌ Suhu dalam Kelvin tidak boleh negatif.";
    header("Location: index.php?hasil=" . urlencode($hasil));
    exit;
}

// Logika konversi (dibuat oleh Eldaa)
function konversi($jenis, $nilai, $dari, $ke) {
    switch ($jenis) {
        case 'suhu':
            return konversiSuhu($nilai, $dari, $ke);
        case 'panjang':
            return konversiPanjang($nilai, $dari, $ke);
        case 'berat':
            return konversiBerat($nilai, $dari, $ke);
        default:
            return "Jenis konversi tidak dikenali.";
    }
}

// ====== KONVERSI SUHU ======
function konversiSuhu($nilai, $dari, $ke) {
    if ($dari == $ke) return $nilai;

    // Celcius ke lainnya
    if ($dari == 'celcius') {
        if ($ke == 'fahrenheit') return ($nilai * 9/5) + 32;
        if ($ke == 'kelvin') return $nilai + 273.15;
    }
    // Fahrenheit ke lainnya
    if ($dari == 'fahrenheit') {
        if ($ke == 'celcius') return ($nilai - 32) * 5/9;
        if ($ke == 'kelvin') return ($nilai - 32) * 5/9 + 273.15;
    }
    // Kelvin ke lainnya
    if ($dari == 'kelvin') {
        if ($ke == 'celcius') return $nilai - 273.15;
        if ($ke == 'fahrenheit') return ($nilai - 273.15) * 9/5 + 32;
    }

    return "Satuan suhu tidak dikenali.";
}

// ====== KONVERSI PANJANG ======
function konversiPanjang($nilai, $dari, $ke) {
    $faktor = [
        'meter' => 1,
        'kilometer' => 1000,
        'centimeter' => 0.01
    ];

    if (!isset($faktor[$dari]) || !isset($faktor[$ke])) return "Satuan panjang tidak dikenali.";

    return $nilai * ($faktor[$dari] / $faktor[$ke]);
}

// ====== KONVERSI BERAT ======
function konversiBerat($nilai, $dari, $ke) {
    $faktor = [
        'kilogram' => 1,
        'gram' => 0.001,
        'pon' => 0.453592
    ];

    if (!isset($faktor[$dari]) || !isset($faktor[$ke])) return "Satuan berat tidak dikenali.";

    return $nilai * ($faktor[$dari] / $faktor[$ke]);
}

// Proses hasil
$hasil_konversi = konversi($jenis, $nilai, $dari, $ke);
$hasil = "$nilai $dari = $hasil_konversi $ke";

header("Location: index.php?hasil=" . urlencode($hasil));
exit;
?>
