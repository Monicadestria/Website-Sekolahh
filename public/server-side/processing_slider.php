<?php

// KONEKSI DATABASE
$dbDetails = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'sekolah'
);

// BUAT DATABASE
$dbs = new mysqli($dbDetails['host'], $dbDetails['user'], $dbDetails['pass'], $dbDetails['db']);

// CEK KONEKSI EROR
if ($dbs->connect_error) {
    die("Connection failed: " . $dbs->connect_error);
}

// DB TABEL
$table = "sliders";

// TABEL PRIMARY KEY
$primaryKey = 'id';

// QUERY JOIN TABEL
$joinTable = $dbs->query(
    "SELECT category_sliders.name, sliders.category_slider_id FROM sliders
    JOIN category_sliders ON sliders.category_slider_id = category_sliders.id"
);

// CEK QUERY JOIN TABEL
if (!$joinTable) {
    die("Query failed: " . $dbs->error);
}

// MEMPROSES SEMUA KATEGORI DOWNLOAD
$categoryNames = $joinTable->fetch_all(MYSQLI_ASSOC);

// ARRAY DATABASE DALAM KOLOM YANG AKAN DIKIRIM KEMBALI PADA DATATABLES.
$columns = array(
    array(
        'db' => 'id',
        'dt' => 0,
        'formatter' => function ($d, $row) {
            static $no = 1; // INISIASI NO ++ YANG BERULANG
            return '<div style="text-align: center;">' . $no++ . '</div>';
        }
    ),
    array(
        'db' => 'category_slider_id',
        'dt' => 1,
        'formatter' => function ($d, $row) use ($categoryNames) {
            // MENEMUKAN KATEGORI NAMA MENGGUNAKAN KATEGORI ID
            foreach ($categoryNames as $category) {
                if ($category['category_slider_id'] == $d) {
                    return $category['name'];
                }
            }
            return '';
        }
    ),
    array('db' => 'title', 'dt' => 2),
    array(
        'db' => 'photo',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '<center><img src="' . str_replace('public/', 'storage/', $row['photo']) . '" alt="Preview Gambar" width="80px" height="70px"></center>';
        }
    ),
    
    array('db' => 'desc', 'dt' => 4),
    array(
        'db' => 'status',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '<div style="text-align:center;">
            <a href="/slider/status/' . $row['id'] . '" class="btn btn-sm btn-' . ($d ? 'success' : 'danger') . '">' . ($d ? 'Aktif' : 'Tidak Aktif') . '</a></div>';
        }
    ),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '<div style="text-align:center;">           
            <a href="/slider/edit/' . $row['id'] . '" title="Ubah" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
            <a href="/slider/destroy/' . $row['id'] . '" id="hapusBtn" onclick="confirmDelete(event, \'\', \'\', \'/slider/destroy/' . $row['id'] . '\')" title="Hapus" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></div>';
        }
    )
);

// MEMPROSES SQL QUERY PROCESSING CLASS (TEMPLATE)
require_once 'ssp.class.php';

// OUTPUT DATA DALAM TYPE FORMAT JSON
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);

?>
