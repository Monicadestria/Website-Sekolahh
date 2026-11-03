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
$table = "downloads";

// TABEL PRIMARY KEY
$primaryKey = 'id';

// QUERY JOIN TABEL
$joinTable = $dbs->query(
                        "SELECT category_downloads.name, downloads.category_download_id FROM downloads
                        JOIN category_downloads ON downloads.category_download_id = category_downloads.id"
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
        'db' => 'category_download_id',
        'dt' => 1,
        'formatter' => function ($d, $row) use ($categoryNames) {
            // MENEMUKAN KATEGORI NAMA MENGGUNAKAN KATEGORI ID
            foreach ($categoryNames as $category) {
                if ($category['category_download_id'] == $d) {
                    return $category['name'];
                }
            }
            return '';
        }
    ),
    array('db' => 'title', 'dt' => 2),
    array('db' => 'file', 'dt' => 3),
    array('db' => 'desc', 'dt' => 4),
    array(
        'db' => 'status',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '<div style="text-align:center;">
            <a href="/download/status/'.$row['id'].'" class="btn btn-sm btn-'.($d ? 'success' : 'danger').'">'.($d ? 'Aktif' : 'Tidak Aktif').'</a></div>';
        }
    ),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '<div style="text-align:center;">
            <a href="' . str_replace('public/', 'storage/', $row['file']) . '" download title="Lihat" class="btn btn-primary btn-sm"><i class="bi bi-cloud-arrow-down-fill
"></i></a>
            <a href="/download/edit/'.$row['id'].'" title="Ubah" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
            <a href="/download/destroy/'.$row['id'].'" onclick="confirmDelete(event, \'\', \'\', \'/download/destroy/'.$row['id'].'\')" title="Hapus" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></div>';
        }
    )
);

// MEMPROSES SQL QUERY PROCESSING CLASS (TEMPLATE)
require 'ssp.class.php';

// OUTPUT DATA DALAM TYPE FORMAT JSON
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);

?>
