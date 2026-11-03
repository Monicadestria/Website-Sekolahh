//Konfirmasi Data Alert Hapus Data
function confirmDelete(event, title, text, deleteUrl) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus?',
        text: 'Apakah Anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
}

//Konfirmasi Data Alert Logout
function confirmLogout(event, title, text, deleteUrl) {
    event.preventDefault();
    Swal.fire({
        title: 'Keluar',
        text: 'Apakah Anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
            Swal.fire({
                title: "Berhasil!",
                text: "Anda berhasil keluar.",
                icon: "success"
            });
        }
    });
}


