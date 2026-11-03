$(document).ready(function () {
    $('#fileTambah').on('change', function () {
        handleFileChange(this, '#pdfViewer1', '.card-file');
    });

    $('#fileUbah').on('change', function () {
        $('#pdf-viewer').hide();
        $('.card-file').hide();
        handleFileChange(this, '#pdfViewer2', '.card-file');
    });

    function handleFileChange(input, viewerSelector, cardSelector) {
        let pdfViewer = $(viewerSelector);
        let cardFile = $(cardSelector).first();

        pdfViewer.empty(); // Clear any previous content

        if (input.files.length === 0) {
            pdfViewer.css('display', 'none');
            cardFile.css('display', 'none');
        } else {
            displayPDF(input, viewerSelector, cardSelector);
        }
    }

    function displayPDF(input, viewerSelector, cardSelector) {
        let file = input.files[0];
        let pdfViewer = $(viewerSelector);
        let cardFile = $(cardSelector).first(); // Assuming the first .card-file for each input

        pdfViewer.empty(); // Clear any previous content

        if (file && file.type === 'application/pdf') {
            let reader = new FileReader();
            reader.onload = function (event) {
                let pdfData = new Uint8Array(event.target.result);
                pdfjsLib.getDocument({ data: pdfData }).promise.then(function (pdf) {
                    // Render the first page initially
                    pdf.getPage(1).then(function (page) {
                        renderPage(page, pdfViewer, cardFile, function () {
                            // Render the remaining pages
                            for (let pageNumber = 2; pageNumber <= pdf.numPages; pageNumber++) {
                                pdf.getPage(pageNumber).then(function (page) {
                                    renderPage(page, pdfViewer, cardFile);
                                });
                            }
                        });
                    });
                });
            };
            reader.readAsArrayBuffer(file);
        } else {
            pdfViewer.css('display', 'none');
            cardFile.css('display', 'none');
        }
    }
});

    function renderPage(page, pdfViewer, cardFile, callback) {
        let scale = 1.0;
        let viewport = page.getViewport({ scale: scale });

        let canvas = document.createElement('canvas');
        canvas.className = 'pdf-page';
        let context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        let renderContext = {
            canvasContext: context,
            viewport: viewport
        };

        page.render(renderContext).promise.then(function () {
            pdfViewer.append(canvas);
            if (callback) {
                callback();
            }
            pdfViewer.css('display', 'block');
            cardFile.css('display', 'block'); // Show the card-file div
        });
    }

//   -------- Library PDF.JS Pratinjau Value  ------------ 
$(document).ready(function () {
    let $container = $('#pdf-viewer');
    let $cardFile = $('#card-file-value');
    let url = $container.data('src');

    if (!url) {
        // Jika tidak ada URL, sembunyikan card-file dan pdf-viewer
        $cardFile.hide();
        $container.hide();
        return;
    }

    // Inisialisasi PDF.js
    let pdfjsLib = window['pdfjs-dist/build/pdf'];

    // Menetapkan workerSrc
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

    // Mendapatkan dokumen PDF
    pdfjsLib.getDocument(url).promise.then(function (pdfDoc) {
        // Tampilkan card-file dan pdf-viewer jika URL valid
        $cardFile.show();
        $container.show();

        // Fungsi untuk merender halaman PDF
        function renderPage(pageNumber) {
            pdfDoc.getPage(pageNumber).then(function (page) {
                let scale = 1.5;
                let viewport = page.getViewport({ scale: scale });

                // Buat elemen canvas untuk menampilkan halaman
                let $canvas = $('<canvas>').addClass('pdf-page')[0];
                let context = $canvas.getContext('2d');
                $canvas.height = viewport.height;
                $canvas.width = viewport.width;

                // Tambahkan canvas ke container
                $container.append($canvas);

                // Render halaman ke canvas
                let renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext).promise.then(function () {
                    // Jika ada halaman berikutnya, render halaman tersebut
                    if (pageNumber < pdfDoc.numPages) {
                        renderPage(pageNumber + 1);
                    }
                });
            });
        }

        // Render halaman pertama
        renderPage(1);
    }).catch(function (error) {
        // Jika terjadi kesalahan saat mendapatkan dokumen PDF, sembunyikan elemen
        $cardFile.hide();
        $container.hide();
        console.error('Gagal memuat PDF: File tidak ada dalam Penyimpanan');
    });
});


// -------- Alert Warning Otomatis Validasi JS Files ------------
$('.file-input').on('change', function() {
    var fileInput = $(this)[0];
    var file = fileInput.files[0];

    if (file) {
        var fileName = file.name;
        var fileSize = file.size;
        var validExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

        // Get the file extension
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var errorMessage = '';

        // Check file extension
        if (!validExtensions.includes(fileExtension)) {
            errorMessage = 'Format berkas harus PDF, Word, Excel, dan PowerPoint.';
        }

        // Check file size (5 MB = 5 * 1024 * 1024 bytes)
        if (fileSize > 5 * 1024 * 1024) {
            errorMessage = 'Ukuran berkas maksimal 5MB.';
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: errorMessage
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'File siap untuk diunggah.',
                timer: 3000,
                timerProgressBar: true
            });
            
        }
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: 'Silakan pilih file untuk diunggah.'
        });
    }
});


$(document).ready(function() {
    $('#resetButton').on('click', function() {
        $('value').each(function() {
            var defaultValue = $(this).attr('value');
            $(this).val(defaultValue);
        });
    });
});

// -------- Reset Form Button Batal ------------
function clearForm() {
    // Mengambil semua elemen dengan kelas "form-control" dan "form-select" di dalam .form-group dan mengosongkan nilainya
    $('.form-group .form-control, .form-group .form-select').each(function() {
        if (this.tagName === 'SELECT') {
            $(this).prop('selectedIndex', 0); // Mengatur elemen select ke opsi yang paling awal
        } else {
            $(this).val(''); // Mengosongkan nilai input atau textarea
        }
    });
    
    // Sembunyikan elemen dengan kelas "embed-responsive-item" dan "card-file"
    $('.embed-responsive-item').hide();
    $('.card-file').hide();
}


