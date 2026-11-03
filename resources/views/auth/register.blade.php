<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <title>Daftar</title>
    <style>
        .focus-border {
            border-color: blue !important;
        }

        .bol {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h2>Daftar</h2>
                        <p>Silahkan Buat Akun Anda terlebih dahulu!</p>
                    </div>
                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="w-100"
                        onsubmit="validateForm(event)">
                        @csrf
                        <div class="form-item input-group">
                            <input id="name" class="rounded-3 input" type="text" name="name"
                                autocomplete="off" value="{{ old('name') }}">
                            <label for="name" class="label">Nama</label>
                            <div id="name-error" class="text-danger" style="display: none;"><i
                                    class="fas fa-exclamation-circle"></i> Nama harus diisi.</div>
                            @error('name')
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-item input-group">
                            <input id="email" class="rounded-3 input" type="email" name="email"
                                autocomplete="username" value="{{ old('email') }}">
                            <label for="email">Email</label>

                            <div id="email-error" class="text-danger" style="display: none;"><i
                                    class="fas fa-exclamation-circle"></i> Email harus diisi.</div>
                            <div id="email-format-error" class="text-danger" style="display: none;"><i
                                    class="fas fa-exclamation-circle"></i> Format email tidak valid.</div>

                            @if ($errors->has('email'))
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> Email sudah ada</div>
                            @endif
                        </div>

                        <div class="form-item input-group">
                            <input id="school_name" class="rounded-3 input" type="text" name="school_name"
                                autocomplete="off" value="{{ old('school_name') }}">
                            <label for="school_name">Nama Sekolah</label>
                            <div id="school_name-error" class="text-danger" style="display: none;"><i
                                    class="fas fa-exclamation-circle"></i> Nama Sekolah harus diisi.</div>
                            @error('school_name')
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-item password-group input-group">
                            <input id="password" class="rounded-3 input" type="password" name="password" autocomplete="new-password">
                            <label for="password">Kata Sandi</label>
                            <span class="password-toggle p-t-1" onclick="togglePassword('password')">
                                <i id="password-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div id="password-error" class="text-danger error-password" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi harus diisi.</div>
                            <div id="password-length-error" class="text-danger error-password" style="display: none;"><i class="fas fa-exclamation-circle"></i> Isikan minimal 8 karakter.</div>
                        </div>
                        
                        <div class="form-item password-group input-group">
                            <input id="password_confirmation" class="rounded-3 input" type="password" name="password_confirmation" autocomplete="new-password">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <span class="password-toggle p-t-2" onclick="togglePassword('password_confirmation')">
                                <i id="password_confirmation-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div id="password_confirmation-error" class="text-danger error-password-1" style="display: none;"><i class="fas fa-exclamation-circle"></i> Konfirmasi kata sandi harus diisi.</div>
                            <div id="mismatchError" class="text-danger error-password-1" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi tidak sama.</div>
                        </div>
                        

                        <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-dark">
                                    <small>Dengan mendaftar, Anda menyetujui
                                        <a href="#" class="regulasi" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">Syarat & Ketentuan dan Kebijakan Privasi
                                            kami.</a>
                                    </small>
                                </label>
                                <div id="formCheck-error" class="text-danger" style="display: none;"><i
                                        class="fas fa-exclamation-circle"></i> Anda harus menyetujui syarat &
                                    ketentuan.</div>
                            </div>
                        </div>

                        <div class="input-group mb-3 justify-content-center">
                            <button class="btn btn-lg btn-primary w-40 fs-6" type="submit">Buat Akun</button>
                        </div>
                    </form>

                    <div class="align-items-center text-center">
                        <small class="mt-4 mb-4 align-items-center">
                            Sudah memiliki akun?
                            <a href="{{ route('login') }}" class="regulasi mb-4"> Masuk</a>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/gambar.jpeg') }}"
                    class="img-fluid img-sekolah rounded-4 mb-2 justify-content-center align-items-center">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('img/logo3.png') }}" alt="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h1>Syarat dan Ketentuan</h1>
                        <p>Ketentuan perjanjian ini ( “Persyaratan Layanan”) mengatur hubungan antara Anda dan Vetencode
                            dan afiliasinya (selanjutnya disebut ” Vetencode” atau “Kami”) mengenai penggunaan situs web
                            dan layanan terkait (“Layanan”). Penggunaan Layanan juga diatur oleh Kebijakan Privasi
                            Vetencode ini, yang tergabung disini sebagai referensi.</p>

                        <p>Sebelum mengakses atau menggunakan Layanan, termasuk yang sedang berada di website Vetencode
                            atau mengakses layanan, Anda harus menyetujui Persyaratan Layanan dan Kebijakan Privasi.
                            Anda mungkin juga akan diminta untuk mendaftarkan akun pada layanan (sebuah “Akun”). Dengan
                            mendaftar untuk Akun atau menggunakan Layanan, Anda menyatakan bahwa Anda berusia 13 atau
                            lebih tua dan Anda memahami dan menyetujui Ketentuan Layanan ini. Jika Anda berusia antara
                            13 dan 17, Anda menyatakan bahwa wali Anda telah mengkaji dan menyetujui Syarat ini. Jika
                            Anda mengakses Layanan dari Situs Jejaring Sosial ( “SNS”), seperti Facebook atau Google+,
                            Anda harus memenuhi persyaratan layanan / menggunakan serta Ketentuan Layanan ini.</p>

                        <p class="bol">DENGAN MENGINSTAL, MENGGUNAKAN ATAU MENGAKSES LAYANAN, ANDA SETUJU UNTUK
                            KETENTUAN LAYANAN. JIKA ANDA TIDAK SETUJU DENGAN KETENTUAN LAYANAN INI, JANGAN MENGGUNAKAN
                            ATAU MENGAKSES LAYANAN. PENGGUNAAN LAYANAN TIDAK DIPERBOLEHKAN APABILA ANDA TIDAK
                            MENYETUJUINYA.</p>

                        <p>Vetencode berhak, atas kebijakannya, untuk mengubah, memodifikasi, menambah atau menghapus
                            bagian-bagian dari Ketentuan Layanan ini dan Kebijakan Privasi setiap saat dengan memposting
                            hal yang diubah pada Layanan Vetencode. Anda akan dianggap telah menerima perubahan tersebut
                            dengan terus menggunakan Layanan. Jika pada kemudian Anda tidak setuju untuk setiap bagian
                            dari versi Persyaratan Layanan kami saat ini, Kebijakan Privasi Vetencode, atau kebijakan
                            Vetencode lainnya, aturan atau kode etik yang berkaitan dengan penggunaan Layanan, lisensi
                            untuk menggunakan Layanan harus segera menghentikan, dan Anda harus segera berhenti
                            menggunakan Layanan.</p>

                        <h5>1. Lisensi</h5>
                        <p>1.1. Pemberian Lisensi Terbatas untuk Menggunakan Layanan Tunduk pada perjanjian Anda dan
                            melanjutkan sesuai dengan Ketentuan Layanan ini dan setiap kebijakan Vetencode terkait
                            lainnya, Vetencode memberi Anda non-eksklusif, tidak dapat dipindahtangankan, tidak
                            disublisensikan, subjek lisensi dibatalkan terbatas untuk keterbatasan bawah untuk mengakses
                            dan menggunakan Layanan untuk keperluan yang tidak bertentangan dengan hukum yang berlaku di
                            wilayah Negara Kesatuan Republik Indonesia. Anda setuju untuk tidak menggunakan Layanan
                            untuk tujuan lain.</p>

                        <h5>Pembatasan berikut berlaku untuk penggunaan Layanan:</h5>
                            <p>Anda harus menggunakan Akun Anda hanya untuk tujuan yang tidak bertentangan dengan hukum
                                yang berlaku di wilayah Negara Kesatuan Republik Indonesia; Anda tidak akan menggunakan
                                Layanan untuk PENIPUAN , PEMALSUAN, FITNAH, PERJUDIAN, SARA, PORNOGRAFI, ANCAMAN, UJARAN
                                KEBENCIAN, BLACK CAMPAGIN, BERITA BOHONG / HOAX DAN SEGALA HAL YANG BERTENTANGAN DENGAN
                                HUKUM YANG BERLAKU DI WILAYAH REPUBLIK INDONESIA, termasuk surat berantai, junk atau
                                spam sms atau pesan berulang kepada siapa pun.</p>

                        <h5>Informasi login dan Akun Anda</h5>
                        <p>Selama proses pembuatan Account, Anda akan diminta untuk memilih password ( “Login
                            Information”). Anda tidak akan berbagi Account atau Informasi Login, atau membiarkan orang
                            lain mengakses akun Anda atau melakukan hal lain yang mungkin membahayakan keamanan Akun
                            Anda. Jika pada suatu saat anda sadar atau cukup mencurigai adanya pelanggaran keamanan,
                            termasuk tanpa batasan kerugian, pencurian, atau pengungkapan yang tidak sah dari Informasi
                            Login, Anda harus segera memberitahukan Vetencode dan memodifikasi Informasi Login Anda.
                            Anda bertanggung jawab untuk menjaga kerahasiaan Informasi Login, dan Anda akan bertanggung
                            jawab untuk semua penggunaan dari Informasi Login, termasuk pembelian, apakah atau tidak
                            diizinkan oleh Anda. Anda bertanggung jawab untuk apa pun yang terjadi melalui Rekening
                            Anda.</p>

                        <p>Vetencode berhak untuk menghapus atau mengambil alih nama pengguna setiap saat dan untuk
                            alasan apapun, termasuk namun tidak terbatas pada klaim oleh pihak ketiga yang nama pengguna
                            melanggar hak pihak ketiga.</p>

                        <h5>Keterbatasan lisensi</h5>
                        <p>Setiap pengguna Layanan yang melanggar Keterbatasan Lisensi ini sangat dilarang, bisa
                            mengakibatkan pencabutan segera lisensi terbatas dan dapat dikenai kewajiban untuk
                            pelanggaran hukum.</p>
                        <p>Anda setuju bahwa Anda tidak akan, dalam keadaan apapun:</p>
                        <p>Terlibat dalam tindakan yang Vetencode anggap menjadi bertentangan dengan semangat atau
                            maksud dari Layanan atau membuat penggunaan yang tidak benar dari layanan Vetencode ini.
                            Menggunakan untuk menipu, eksploitasi, perangkat lunak otomatis, bot, hacks, mods atau
                            perangkat lunak pihak ketiga yang tidak sah yang dirancang untuk mengubah atau
                            mengganggu Layanan, setiap layanan Vetencode atau semua layanan Vetencode atau tanpa
                            persetujuan tertulis Vetencode ini, memodifikasi atau menyebabkan untuk dimodifikasi
                            file yang merupakan bagian dari Layanan Vetencode.
                        </p>
                        <p>Mengganggu, membebani, atau bantu membantu dalam gangguan atau membebani setiap komputer
                            atau server ( “Server”) yang digunakan untuk menawarkan atau mendukung Layanan atau
                            lingkungan layanan Vetencode.</p>
                        <p>Institute, membantu, atau terlibat dalam semua jenis serangan, termasuk tanpa distribusi
                            pembatasan virus, penolakan serangan layanan pada Layanan, atau upaya lain untuk
                            mengacaukan Layanan atau penggunaan orang lain atau kenyamanan Layanan.</p>
                        <p>Upaya untuk mendapatkan akses tidak sah ke Layanan, Account terdaftar kepada orang lain
                            atau ke komputer, Server, atau jaringan yang terhubung ke Layanan dengan cara apa pun
                            selain user interface yang disediakan oleh Vetencode, termasuk namun tidak terbatas
                            pada, dengan menghindari atau memodifikasi, mencoba untuk menghindari atau memodifikasi,
                            atau mendorong atau membantu orang lain untuk menghindari atau memodifikasi, setiap
                            keamanan, teknologi, perangkat, atau perangkat lunak yang merupakan bagian dari Layanan.
                        </p>
                        <p>Mengirim SMS informasi yang kasar, mengancam, cabul, memfitnah, perjudian, mencemarkan
                            nama baik, atau ras, seksual, agama, atau tidak pantas atau menyinggung.
                        </p>
                        <p>Mengirim SMS yang berisi ketelanjangan, kekerasan yang berlebihan, atau subjek
                            menyinggung atau yang berisi link ke konten tersebut.</p>
                        <p>Mencoba untuk, atau melecehkan, penyalahgunaan, atau bahaya, atau advokat atau menghasut
                            pelecehan, kekerasan, atau membahayakan orang lain, kelompok, termasuk karyawan
                            Vetencode, termasuk perwakilan layanan pelanggan Vetencode ini.</p>
                        <p>Membuat tersedia melalui Layanan materi atau informasi yang melanggar hak cipta, merek
                            dagang, paten, rahasia dagang, hak privasi, hak publisitas, atau hak lainnya dari setiap
                            orang atau badan atau meniru orang lain, termasuk tanpa batasan karyawan Vetencode.</p>
                        <p>balik, menguraikan, membongkar, menguraikan, atau berupaya memperoleh kode sumber untuk
                            setiap perangkat lunak yang mendasari atau kekayaan intelektual lain yang digunakan
                            untuk menyediakan Layanan Vetencode, atau untuk mendapatkan informasi apapun dari
                            Layanan Vetencode menggunakan metode apapun secara tegas tidak diizinkan oleh Vetencode.
                        </p>
                        <p>Meminta atau mencoba untuk meminta informasi pribadi dari pengguna lain dari Layanan
                            Vetencode atau mengumpulkan atau mengirim informasi pribadi siapa pun, termasuk
                            informasi pribadi (baik dalam teks, gambar atau bentuk video), dokumen identifikasi,
                            atau informasi keuangan melalui Layanan.</p>
                        <p>Vetencode berhak menentukan untuk melakukan apa yang dianggapnya melanggar aturan
                            penggunaan atau di luar maksud atau semangat Ketentuan Layanan ini atau Layanan itu
                            sendiri. Vetencode berhak untuk mengambil tindakan sebagai akibat, yang mungkin termasuk
                            mengakhiri Akun Anda dan melarang Anda untuk menggunakan Layanan secara keseluruhan atau
                            sebagian.</p>
                        <h5>1.2. Suspensi dan Pemutusan Akun dan Layanan</h5>
                        <p class="bol">TANPA MEMBATASI PEMULIHAN APAPUN LAINNYA, VETENCODE MUNGKIN MEMBATASI,
                            PENANGGUHAN, MENGAKHIRI, MENGUBAH, ATAU MENGHAPUS AKUN ATAU AKSES KE LAYANAN VETENCODE JIKA
                            ANDA, ATAU VETENCODE MENGANGGAP ANDA, GAGAL MEMATUHI SETIAP KETENTUAN LAYANAN ATAU UNTUK
                            PENGGUNAAN ILEGAL ATAU DIDUGA TIDAK BENAR MENGGUNAKAN LAYANAN, DENGAN ATAU TANPA
                            PEMBERITAHUAN KEPADA ANDA. ANDA BISA KEHILANGAN NAMA PENGGUNA ANDA DAN DATA PERSONAL AKIBAT
                            PENGHENTIAN ACCOUNT ATAU PEMBATASAN, SERTA SETIAP MANFAAT, PRIVILEGES, CREDIT YANG DIPEROLEH
                            DAN YANG TELAH DIBELI TERKAIT DENGAN PENGGUNAAN LAYANAN, DAN VETENCODE TIDAK BERKEWAJIBAN
                            UNTUK MEMBERIKAN KOMPENSASI ATAS APAPUN DARI KERUGIAN ATAU HASIL TERSEBUT.</p>
                        <p class="bol">TANPA MEMBATASI PEMULIHAN KAMI YANG LAINNYA, KAMI DAPAT MEMBATASI,
                            MENANGGUHKAN ATAU MENGHENTIKAN LAYANAN DAN AKUN PENGGUNAATAU SEBAGIAN DARINYA, MELARANG
                            KASES KE LAYANAN KAMI DAN SITUS, DAN ISINYA, LAYANAN DAN ALAT, KETERLAMBATAN ATAU HAPUS
                            KONTEN, DAN MENGAMBIL LANGKAH TEKNIS DAN HUKUM UNTUK MENCEGAH PENGGUNA MENGAKSES LAYANAN
                            JIKA KAMI PERCAYA BAHWA MEREKA MENCIPTAKAN RISIKO ATAU MUNKGIN KEWAJIBAN HUKUM, MELANGGAR
                            HAK KEKAYAAN INTELEKTUAL PIHAK KETIGA, ATAU BERTINDAK TIDAK KONSISTEN DENGAN SURAT ATAU
                            SEMANGAT SYARAT ATAU KEBIJAKAN KAMI. SELAIN ITU, KAMI MUNGKIN, DALAM KONDISI YANG TEPAT DAN
                            ATAS KEBIJAKAN KAMI, MENANGGUHKAN ATAU MENGAKHIRI AKUN PENGGUNA YANG MUNGKIN SEBAGAI
                            PELANGGAR BERULANG HAK KEKAYAAN INTELEKTUAL PIHAK KETIGA.VETENCODE BERHAK MENGAKHIRI ATAU
                            MENGHAPUS SETIAP AKUN YANG TELAH TIDAK AKTIF UNTUK 180 HARI.
                        </p>
                        <p>Vetencode berhak untuk berhenti menawarkan dan / atau mendukung Service atau layanan tertentu
                            atau bagian dari Layanan setiap saat, di mana titik lisensi Anda untuk menggunakan Layanan
                            atau bagian daripadanya akan secara otomatis dihentikan. Dalam hal tersebut, Vetencode tidak
                            akan diminta untuk memberikan pengembalian dana, manfaat atau kompensasi lain untuk pengguna
                            sehubungan dengan Jasa dihentikan tersebut. Penghentian Akun Anda bisa termasuk
                            menonaktifkan akses Anda ke Layanan atau bagiannya termasuk konten apapun yang Anda kirimkan
                            atau orang lain yang diajukan.</p>
                        <p>Anda dapat mengakhiri Akun Anda setiap saat dan untuk alasan apapun dan menginformasikan
                            Vetencode bahwa Anda ingin menghentikan Akun Anda.</p>
                        <h5 class="bol">2.Kepemilikan</h5>
                        <p>Semua hak, kepemilikan dan kepentingan dalam dan ke Layanan (termasuk tanpa batasan apapun
                            judul, kode komputer, tema, objek, karakter, konsep, karya seni, suara, metode operasi, hak
                            moral, dokumentasi, gambar dan perangkat lunak server) yang dimiliki oleh Vetencode. Semua
                            hak Vetencode, termasuk tanpa batasan, semua hak kekayaan intelektual atau hak kepemilikan
                            lainnya, sehubungan dengan Layanan.</p>
                        <h5>2.1. Layanan</h5>
                        <p>Semua hak, kepemilikan dan kepentingan dalam dan ke Layanan (termasuk tanpa batasan apapun
                            judul, kode komputer, tema, objek, karakter, konsep, karya seni, suara, metode operasi, hak
                            moral, dokumentasi, gambar dan perangkat lunak server) yang dimiliki oleh Vetencode. Semua
                            hak Vetencode, termasuk tanpa batasan, semua hak kekayaan intelektual atau hak kepemilikan
                            lainnya, sehubungan dengan Layanan.</p>
                        <h5>2.2. Akun</h5>
                        <p class="bol">MESKIPUN HAL YANG BERTENTANGAN DISINI, ANDA MEMAHAMI DAN SETUJU BAHWA ANDA
                            TIDAK MEMILIKI KEPEMILIKAN ATAU KEPENTINGAN PROPERTI LAINNYA PADA AKUN, DAN ANDA JUGA
                            MEMAHAMI DAN SETUJU BAHWA SEMUA HAK DALAM DAN KE AKUN YANG DAN AKAN SELAMANYA AKAN MILIK DAN
                            DIBERLAKUKAN UNTUK MANFAAT VETENCODE.
                        </p>
                        <h5>2.3. virtual Item</h5>
                        <p>Vetencode memiliki, memiliki lisensi, atau memiliki hak untuk menggunakan semua konten yang
                            muncul dalam Layanan Vetencode.</p>
                        <h5>2.4. Konten pengguna</h5>
                        <p>“Pengguna Konten” berarti setiap komunikasi, gambar, suara, dan semua bahan, data, dan
                            informasi yang Anda upload atau kirimkan melalui Layanan Vetencode, atau bahwa pengguna lain
                            meng-upload atau mengirimkan, termasuk tanpa batasan sms teks apapun. Dengan transmisi atau
                            mengirimkan Konten Pengguna saat menggunakan Layanan, Anda menegaskan, mewakili dan menjamin
                            bahwa transmisi atau penyerahan tersebut adalah (a) akurat dan tidak bersifat rahasia; (B)
                            tidak melanggar hukum, pembatasan kontrak atau hak pihak ketiga lainnya, dan bahwa Anda
                            memiliki izin dari pihak ketiga yang informasi pribadi atau kekayaan intelektual terdiri
                            dalam Konten Pengguna; (C) bebas dari virus, adware, spyware, worm atau kode berbahaya
                            lainnya; dan (d) Anda mengakui dan setuju bahwa setiap informasi pribadi Anda dalam konten
                            tersebut akan selalu diproses oleh Vetencode sesuai dengan Kebijakan Privasi. Vetencode
                            berhak atas kebijakannya sendiri untuk meninjau, memantau, melarang, mengedit, menghapus,
                            menonaktifkan akses ke atau membuat tersedia setiap Konten Pengguna (termasuk tanpa batasan
                            Konten Pengguna Anda) tanpa pemberitahuan untuk alasan apapun atau tanpa alasan setiap saat.
                        </p>
                        <h5>2.5. Data Konten pengguna</h5>
                        <p>Konten pengguna yang tersedia pada layanan Vetencode yang dapat tersimpan, terupdate,
                            terbackup dan diakses oleh pengguna selama maksimal 180 hari sebelumnya. Vetencode berhak
                            menghapus seluruh konten sebelumnya untuk menjaga konektifitas, kinerja, performa dan
                            stabilisasi layanan.</p>
                        <h5 class="bol">3.Konten Pengguna</h5>
                        <h5>3.1. konten Screening</h5>
                        <p>Vetencode tidak bertanggung jawab untuk pelaksanaan setiap pengguna mengirimkan Konten
                            Pengguna, dan tidak bertanggung jawab untuk memantau Layanan untuk konten atau perilaku yang
                            tidak pantas. Kami tidak, dan tidak bisa, pra-layar atau memonitor semua Konten Pengguna.
                            Penggunaan Anda atas Layanan adalah risiko Anda sendiri. Dengan menggunakan Layanan, Anda
                            mungkin akan menemukan Materi Pengguna yang menyinggung, tidak senonoh atau tidak sesuai
                            dengan harapan Anda. Anda menanggung semua risiko yang terkait dengan penggunaan setiap
                            Konten Pengguna yang tersedia dalam kaitannya dengan Layanan. Kebijaksanaan kami, perwakilan
                            atau teknologi kami dapat memantau dan / atau merekam interaksi Anda dengan Layanan atau
                            komunikasi (termasuk tanpa batasan sms teks) bila Anda menggunakan Layanan.</p>
                        <p>Dengan memasuki Ketentuan Layanan ini, Anda dengan ini memberikan persetujuan tidak dapat
                            dibatalkan untuk pemantauan dan pencatatan tersebut. Anda mengakui dan setuju bahwa Anda
                            tidak memiliki harapan privasi mengenai transmisi dari setiap Konten Pengguna, termasuk
                            tanpa teks atau komunikasi suara.</p>
                        <p>Jika sewaktu-waktu Vetencode memilih, atas kebijakannya sendiri, untuk memantau Layanan,
                            Vetencode tetap tidak bertanggung jawab atas Konten Pengguna dan tidak berkewajiban untuk
                            mengubah atau menghapus Konten Pengguna. Kami memiliki hak, bukan kewajiban, pertimbangan
                            kami sendiri untuk mengedit, menolak untuk mengirim, atau menghapus Konten Pengguna.</p>
                        <h5>3.2. Informasi Yang Gunakan oleh Anggota lain dari Layanan</h5>
                        <h5>3.2.1. Wacana publik</h5>
                        <p>Layanan ini termasuk berbagai forum, blog dan fitur chatting di mana Anda dapat mengirim
                            Konten Pengguna, termasuk pengamatan dan komentar tentang topik-topik yang ditunjuk.
                            Vetencode tidak dapat menjamin bahwa anggota lain tidak akan menggunakan ide-ide dan
                            informasi yang Anda bagi. Oleh karena itu, jika Anda memiliki ide atau informasi yang Anda
                            ingin menyimpan secara rahasia dan / atau tidak ingin orang lain untuk menggunakan, jangan
                            posting pada Layanan. Vetencode tidak bertanggung jawab untuk mengevaluasi, menggunakan atau
                            memberikan kompensasi atas ide atau informasi yang Anda telah pilih untuk dikirimkan.</p>
                        <h5>3.2.2. Bertanggung jawab untuk Konten Anda Sendiri</h5>
                        <p>Anda bertanggung jawab atas informasi yang Anda posting, melalui atau dalam kaitannya dengan
                            Layanan dan yang Anda berikan kepada orang lain. Vetencode mungkin menolak, menolak untuk
                            mengirim atau menghapus Konten Pengguna untuk alasan apapun atau tidak, termasuk, namun
                            tidak terbatas pada, Konten Pengguna Vetencode yang melanggar Ketentuan Layanan ini.
                            Pengguna bertanggung jawab atas data konten pengguna termasuk/tidak terkecuali backup data
                            konten pengguna dengan layanan yang telah disediakan.</p>
                        <h5>3.3. Lisensi</h5>
                        <p>Anda dengan ini memberikan kepada Vetencode tidak dapat ditarik kembali, abadi,
                            dipindahtangankan, disetor penuh, bebas royalti, lisensi di seluruh dunia (termasuk hak
                            untuk mensublisensikan dan menetapkan ke pihak ketiga) dan hak untuk menyalin, mereproduksi,
                            memperbaiki, beradaptasi, memodifikasi, membuat derivatif bekerja dari, manufaktur,
                            mengkomersialkan, mempublikasikan, mendistribusikan, menjual, lisensi, mensublisensikan,
                            transfer, sewa, mengirimkan, menampilkan secara publik, melakukan, atau menyediakan akses ke
                            elektronik, siaran, mengkomunikasikan kepada publik melalui telekomunikasi, menampilkan,
                            masuk ke dalam memori komputer, dan penggunaan dan praktek, dengan cara apapun, Konten
                            Pengguna Anda serta semua karya dimodifikasi dan turunannya sehubungan dengan penyediaan
                            Layanan, termasuk pemasaran dan promosi dari Layanan. Anda juga memberikan kepada Vetencode
                            hak untuk mengotorisasi orang lain untuk melaksanakan hak-hak yang diberikan kepada
                            Vetencode di bawah Ketentuan Layanan ini. Anda lebih lanjut dengan ini memberikan kepada
                            Vetencode tanpa syarat, hak yang tidak dapat dibatalkan untuk menggunakan dan memanfaatkan
                            nama Anda, gambar dan informasi lainnya atau bahan termasuk dalam Konten Pengguna dan
                            sehubungan dengan Konten Pengguna, tanpa kewajiban untuk Anda. Kecuali dilarang oleh hukum,
                            Anda mengesampingkan hak atribusi dan / atau hak moral yang mungkin Anda miliki dalam Konten
                            Pengguna Anda, terlepas dari apakah Konten Pengguna Anda diubah atau diubah dengan cara
                            apapun. Vetencode tidak mengklaim hak kepemilikan di Konten Pengguna Anda dan tidak ada
                            dalam Ketentuan Layanan ini dimaksudkan untuk membatasi hak yang Anda mungkin harus gunakan
                            dan manfaatkan Konten Pengguna Anda. Vetencode tidak memiliki kewajiban untuk memantau atau
                            menegakkan hak kekayaan intelektual Anda di atau ke Konten Pengguna Anda.</p>
                        <h5>3.4. Interaksi pengguna</h5>
                        <p>Anda bertanggung jawab untuk interaksi dengan pengguna lain dari Layanan dan pihak lain
                            dengan siapa Anda berinteraksi melalui Layanan Vetencode. Vetencode berhak, tapi tidak
                            berkewajiban, untuk terlibat dalam cara apapun dengan perselisihan ini. Anda akan sepenuhnya
                            bekerja sama dengan Vetencode untuk menyelidiki setiap yang dicurigai melanggar hukum,
                            aktivitas penipuan atau tidak layak, termasuk, tanpa batasan, memberikan akses Vetencode
                            untuk setiap bagian yang dilindungi sandi Akun Anda.</p>
                        <p>Jika Anda memiliki perselisihan dengan satu atau lebih pengguna, Anda melepaskan kami (dan
                            petugas kami, direktur, agen, anak perusahaan, usaha patungan dan karyawan) dari klaim,
                            tuntutan dan kerusakan (aktual dan konsekuensial) dari setiap jenis dan sifat, dikenal dan
                            tidak dikenal , yang timbul dari atau dengan cara apapun terkait dengan sengketa tersebut.
                        </p>
                        <h5 class="bol">4.Biaya dan Syarat Pembelian</h5>
                        <h5>4.1. pembelian</h5>
                        <p>Dalam Layanan Anda dapat membeli, dengan uang “dunia nyata”, terbatas, pribadi, tidak dapat
                            dipindahtangankan, non-disublisensikan, lisensi dicabut untuk menggunakan (a) “mata uang
                            virtual”, termasuk namun tidak terbatas pada uang virtual atau berlian, semua untuk
                            digunakan dalam layanan Vetencode.</p>
                        <h5>4.2. Pembayaran Biaya</h5>
                        <p>Anda setuju untuk membayar semua biaya dan pajak yang berlaku yang dikeluarkan oleh Anda atau
                            siapa saja yang menggunakan Akun yang terdaftar untuk Anda. Vetencode mungkin merevisi harga
                            untuk barang dan jasa yang ditawarkan melalui Layanan setiap saat.
                            ANDA MENGAKUI BAHWA VETENCODE TIDAK DIPERLUKAN UNTUK MEMBERIKAN PENGEMBALIAN UNTUK ALASAN
                            APAPUN, DAN BAHWA ANDA TIDAK AKAN MENERIMA UANG ATAU KOMPENSASI LAIN UNTUK BARANG VIRTUAL
                            YANG TERSISA SAAT ACCOUNT DITUTUP, BAIK PENUTUPAN TERSEBUT ADALAH SUKARELA ATAU TERPAKSA.
                        </p>
                        <h5>5. Update Layanan</h5>
                        <p>Anda memahami bahwa Layanan merupakan salah satu yang berkembang. Vetencode mungkin
                            mengharuskan Anda menerima update ke Layanan Vetencode ini. Anda mengakui dan setuju bahwa
                            Vetencode dapat memperbarui layanan Vetencode, dengan atau tanpa memberitahu Anda. Anda
                            mungkin perlu untuk memperbarui perangkat lunak pihak ketiga dari waktu ke waktu untuk
                            menerima Layanan Vetencode.</p>
                        <h5 class="bol">6. Penolakan jaminan</h5>
                        <p>TANPA MEMBATASI KEWAJIBAN VETENCODE PADA POIN 7 DI BAWAH, LAYANAN DISEDIAKAN “SEBAGAIMANA
                            ADANYA” DAN “SEBAGAIMANA TERSEDIA” UNTUK PENGGUNAAN, TANPA JAMINAN APAPUN, TERSURAT MAUPUN
                            TERSIRAT, TERMASUK NAMUN TIDAK TERBATAS PADA JAMINAN DIPERDAGANGKAN, UNTUK TUJUAN TERTENTU,
                            JUDUL, NON-PELANGGARAN, DAN APA-APA YANG TIMBUL DARI TRANSAKSI ATAU PENGGUNAAN DAGANG.
                            VETENCODE TIDAK MENJAMIN BAHWA ANDA AKAN DAPAT MENGAKSES ATAU MENGGUNAKAN LAYANAN DI WAKTU
                            ATAU LOKASI YANG TELAH ANDA PILIH BAHWA LAYANAN AKAN TERGANGGU ATAU BEBAS DARI KESALAHAN
                            YANG CACAT AKAN DIPERBAIKI ATAU BAHWA LAYANAN BEBAS DARI VIRUS ATAU KOMPONEN BERBAHAYA
                            LAINNYA.</p>
                        <h5>7. Batasan Tanggung Jawab; Tunggal dan Remedy Eksklusif</h5>
                        <p>Penggantian rugi</p>
                        <p>VETENCODE TIDAK BERTANGGUNG JAWAB KEPADA ANDA SECARA TIDAK LANGSUNG, INSIDENTAL, AKIBAT,
                            KHUSUS, HUKUMAN ATAU KERUSAKAN SERUPA, TERMASUK NAMUN TIDAK TERBATAS PADA KEHILANGAN
                            PENDAPATAN, KERUGIAN, DATA HILANG ATAU GANGGUAN BISNIS ATAU KERUGIAN TIDAK BERWUJUD LAINNYA
                            (NAMUN KERUGIAN TERSEBUT ADALAH RESMI ), TIMBUL DARI ATAU BERKAITAN DENGAN CARA APAPUN
                            DENGAN KETENTUAN LAYANAN ATAU LAYANAN ITU SENDIRI, BAIK BERDASARKAN KONTRAK, KESALAHAN ATAU
                            TEORI HUKUM LAINNYA, DAN BAIK ATAU TIDAK VETENCODE TELAH DIBERITAHU TENTANG KEMUNGKINAN
                            KERUSAKAN TERSEBUT. VETENCODE TIDAK BERTANGGUNG JAWAB KEPADA ANDA UNTUK JUMLAH PEMBELIAN
                            YANG LEBIH UNTUK VETENCODE SESUAI DENGAN KETENTUAN LAYANAN JIKA SETELAH ENAM (6) BULAN ANDA
                            TIDAK MENGAJUKAN KLAIM. ANDA MEMAHAMI DAN SETUJU BAHWA JIKA ANDA BELUM MEMBAYAR APA SAJA
                            UNTUK VETENCODE SELAMA PERIODE WAKTU TERSEBUT, PERBAIKAN SATU-SATUNYA (DAN KEWAJIBAN
                            EKSKLUSIF VETENCODE) ATAS SENGKETA DENGAN VETENCODE ADALAH UNTUK BERHENTI MENGGUNAKAN
                            LAYANAN DAN UNTUK MEMBATALKAN AKUN ANDA.</p>
                        <p>Anda setuju untuk mengganti kerugian, membela, dan membebaskan Vetencode dari setiap klaim,
                            permintaan, kerusakan atau kerugian lainnya, termasuk biaya pengacara yang wajar, menegaskan
                            oleh pihak ketiga yang dihasilkan dari atau yang timbul dari penggunaan Layanan, atau setiap
                            pelanggaran oleh Anda dari Ketentuan Layanan ini, namun hal tersebut tidak berlaku jika
                            pelanggaran hak tidak disebabkan perilaku disengaja atau lalai Anda.</p>
                        <h5 class="bol">8. Penyelesaian sengketa dan hukum</h5>
                        <p>Jika timbul sengketa antara Anda dan Vetencode, kami sangat mendorong Anda untuk pertama
                            menghubungi kami secara langsung untuk mencari resolusi dengan pergi ke situs dukungan
                            pelanggan kami di https://vetencode.com. Persyaratan Layanan ini dan sengketa yang timbul
                            dari atau terkait dengan atau Kebijakan Privasi atau Layanan akan diatur dalam segala hal
                            oleh hukum di Indonesia, tanpa memperhatikan pertentangan ketentuan hukum. Anda setuju bahwa
                            setiap klaim atau sengketa yang mungkin Anda miliki terhadap Vetencode harus diselesaikan
                            secara eksklusif oleh pengadilan yang terletak di Indonesia</p>
                        <h5 class="bol">9. Pemutusan</h5>
                        <p>Anda dan Vetencode setuju bahwa jika ada bagian dari Ketentuan Layanan ini atau dari
                            Kebijakan Privasi Vetencode ditemukan ilegal atau tidak dapat diterapkan, secara keseluruhan
                            atau sebagian oleh pengadilan yang berwenang, ketentuan tersebut, untuk yurisdiksi tersebut,
                            tidak efektif semata-mata untuk sejauh mana penentuan seperti cacat atau unenforceability
                            tanpa mempengaruhi keabsahan atau keberlakuan daripadanya dengan cara lain atau yurisdiksi
                            dan tanpa mempengaruhi ketentuan lainnya dari syarat, yang akan terus berada dalam kekuatan
                            penuh dan efek.</p>
                        <h5 class="bol">Ketentuan</h5>
                        <h5>10.Ketentuan</h5>
                        <h5>10.1. Tugas</h5>
                        <p>Vetencode dapat menetapkan atau mendelegasikan Ketentuan Layanan ini dan / atau Kebijakan
                            Privasi Vetencode, secara keseluruhan atau sebagian, untuk setiap orang atau badan setiap
                            saat dengan atau tanpa persetujuan Anda. Anda mungkin tidak memberikan atau menyerahkan hak
                            atau kewajiban berdasarkan Persyaratan Layanan atau Kebijakan Privasi tanpa persetujuan
                            tertulis Vetencode ini, dan setiap tugas yang tidak sah dan delegasi oleh Anda tidak
                            efektif.</p>
                        <h5>10.2. Kebijakan tambahan</h5>
                        <p>Vetencode dapat mempublikasikan kebijakan tambahan yang terkait dengan layanan tertentu
                            seperti forum, kontes atau program loyalitas. Hak Anda untuk menggunakan layanan tersebut
                            tunduk pada kebijakan-kebijakan tertentu dan Ketentuan Layanan ini.</p>
                        <h5>10.3. Seluruh perjanjian</h5>
                        <p>Ketentuan Layanan ini, setiap Kebijakan Tambahan dan dokumen apapun tegas disatukan menurut
                            referensi (termasuk Kebijakan Privasi Vetencode), berisi seluruh pemahaman Anda dan
                            Vetencode, dan menggantikan semua pemahaman sebelumnya para pihak yang berkepentingan yang
                            berkaitan dengan materi pokok dalam perjanjian, apakah elektronik, lisan atau tertulis, atau
                            apakah yang didirikan oleh adat, praktek, kebijakan atau preseden, antara Anda dan kami
                            sehubungan dengan Layanan dengan.</p>
                        <h5>10.4. Force Majeure</h5>
                        <p>Vetencode tidak bertanggung jawab atas keterlambatan atau kegagalan untuk memberikan hasil
                            yang disebabkan oleh sesuatu diluar kontrol yang wajar dari Vetencode, termasuk tanpa
                            batasan kegagalan untuk melakukan di bawah ini karena untuk keadaan yang tidak terduga atau
                            penyebab di luar kendali Vetencode ini seperti tindakan Tuhan, perang, terorisme, kerusuhan
                            , embargo, tindakan otoritas sipil atau militer, kebakaran, banjir, kecelakaan, pemogokan,
                            atau kekurangan sarana transportasi, bahan bakar, energi, tenaga kerja atau bahan.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
   <script>
    function validateForm(event) {
        event.preventDefault();
        let isValid = true;

        // Clear previous errors and reset input borders
        const formItems = document.querySelectorAll('.form-item input');
        formItems.forEach(item => item.classList.remove('invalid-border'));

        document.querySelectorAll('.text-danger').forEach(error => error.style.display = 'none');

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const schoolName = document.getElementById('school_name').value.trim();
        const password = document.getElementById('password').value.trim();
        const passwordConfirmation = document.getElementById('password_confirmation').value.trim();
        const formCheck = document.getElementById('formCheck').checked;

        // Validate name
        if (!name) {
            document.getElementById('name-error').style.display = 'block';
            document.getElementById('name').classList.add('invalid-border');
            isValid = false;
        }

        // Validate email
        if (!email) {
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').classList.add('invalid-border');
            isValid = false;
        } else if (!isValidEmailFormat(email)) {
            document.getElementById('email-format-error').style.display = 'block';
            document.getElementById('email').classList.add('invalid-border');
            isValid = false;
        }

        // Validate school name
        if (!schoolName) {
            document.getElementById('school_name-error').style.display = 'block';
            document.getElementById('school_name').classList.add('invalid-border');
            isValid = false;
        }

        // Validate password
        if (!password) {
            document.getElementById('password-error').style.display = 'block';
            document.getElementById('password').classList.add('invalid-border');
            isValid = false;
        } else if (password.length < 8) {
            document.getElementById('password-length-error').style.display = 'block';
            document.getElementById('password').classList.add('invalid-border');
            isValid = false;
        }

        // Validate password confirmation
        if (!passwordConfirmation) {
            document.getElementById('password_confirmation-error').style.display = 'block';
            document.getElementById('password_confirmation').classList.add('invalid-border');
            isValid = false;
        } else if (password !== passwordConfirmation) {
            document.getElementById('mismatchError').style.display = 'block';
            document.getElementById('password_confirmation').classList.add('invalid-border');
            isValid = false;
        }

        // Validate terms checkbox
        if (!formCheck) {
            document.getElementById('formCheck-error').style.display = 'block';
            isValid = false;
        }

        if (isValid) {
            document.getElementById('registerForm').submit();
        }
        adjustTogglePosition();
    }

    function adjustTogglePosition() {
            const passwordToggles1 = document.querySelectorAll('.p-t-1');
            const passwordToggles2 = document.querySelectorAll('.p-t-2');
            const passwordErrors1 = document.querySelectorAll('.error-password');
            const passwordErrors2 = document.querySelectorAll('.error-password-1');
    
            const hasPasswordError = [...passwordErrors1].some(el => el.style.display !== 'none');
            const hasPasswordConfirmationError = [...passwordErrors2].some(el => el.style.display !== 'none');
    
            if (hasPasswordError && hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '36%');
                passwordToggles2.forEach(toggle => toggle.style.top = '36%');
            } else if (hasPasswordError && !hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '36%');
                passwordToggles2.forEach(toggle => toggle.style.top = '47%');
            } else if (!hasPasswordError && hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '49%');
                passwordToggles2.forEach(toggle => toggle.style.top = '37%');
            } else {
                passwordToggles1.forEach(toggle => toggle.style.top = '50%');
                passwordToggles2.forEach(toggle => toggle.style.top = '50%');
            }
        }

    function isValidEmailFormat(email) {
        // Regular expression to validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.querySelector(`#${inputId}-icon`);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const formItems = document.querySelectorAll('.form-item input');
        formItems.forEach(item => {
            item.addEventListener('input', (event) => {
                const value = event.target.value.trim();
                const errorId = event.target.id + '-error';
                const passwordErrors = document.querySelectorAll('.error-password'); // Select all password-related error messages
                const passwordErrors1 = document.querySelectorAll('.error-password-1');
// Clear all password-related error messages and reset input borders
passwordErrors.forEach(error => error.style.display = 'none');
passwordErrors1.forEach(error => error.style.display = 'none');
document.getElementById(event.target.id).classList.remove('invalid-border');


                if (value) {
                    if (errorId === 'email-error' && isValidEmailFormat(value)) {
                        document.getElementById('email-format-error').style.display = 'none';
                    }
                    document.getElementById(errorId).style.display = 'none';
                    event.target.classList.remove('invalid-border');
                } else {
                    document.getElementById(errorId).style.display = 'block';
                    event.target.classList.add('invalid-border');
                }

                // Special handling for password fields
                if (event.target.id === 'password') {
                if (!value) {
                    document.getElementById('password-error').style.display = 'block';
                    event.target.classList.add('invalid-border');
                } else if (value.length < 8) {
                    document.getElementById('password-length-error').style.display = 'block';
                    event.target.classList.add('invalid-border');
                }
            }

            if (event.target.id === 'password_confirmation') {
                const password = document.getElementById('password').value;
                if (!value) {
                    document.getElementById('password_confirmation-error').style.display = 'block';
                    event.target.classList.add('invalid-border');
                } else if (value !== password) {
                    document.getElementById('mismatchError').style.display = 'block';
                    event.target.classList.add('invalid-border');
                }
            }
                 // Adjust toggle positions on input change
            adjustTogglePosition();
            });
        });
    });
</script>



</body>

</html>
