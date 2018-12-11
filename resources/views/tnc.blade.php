<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>kupesan.id | Terms and Condition</title>

        <link rel="icon" href="{{ URL::asset('dist/images/logo.png') }}" type="image/x-icon">
        
       <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i%7CMerriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono" rel="stylesheet">
        
        <!-- Bootstrap Stylesheet -->   
        <link rel="stylesheet" href="{{URL::asset('dist/css/bootstrap.min.css') }}">
        
        <!-- Font Awesome Stylesheet -->
        <link rel="stylesheet" href="{{URL::asset('dist/css/font-awesome.min.css') }}">
            
        <!-- Custom Stylesheets --> 
        <link rel="stylesheet" href="{{URL::asset('dist/css/style.css') }}">
        <link rel="stylesheet" id="cpswitch" href="{{URL::asset('dist/css/orange.css') }}">
        <link rel="stylesheet" href="{{URL::asset('dist/css/responsive.css') }}">
        
        <!-- Color Panel -->
        <link rel="stylesheet" href="{{URL::asset('dist/css/jquery.colorpanel.css') }}">
    </head>
    
    
    <body>
    
        <div class="loader"></div>
       <!--======== SEARCH-OVERLAY =========-->       
        <div class="header-absolute">
            <nav class="navbar navbar-default main-navbar navbar-custom navbar-transparent landing-page-navbar" id="mynavbar">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" id="menu-button">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>                        
                        </button>

                        <a href="home" class="navbar-brand">
                            <img src=" {{ URL::asset('dist/images/logo-navbar.png') }} " >
                        </a>
                    </div><!-- end navbar-header -->
                    
                    <div class="collapse navbar-collapse" id="myNavbar1">
                <ul class="nav navbar-nav navbar-right navbar-search-link">
                    <li><a href="{{route('index')}}">Home</a></li>
                @if(Auth::guest())
                    <li><a href="{{ route('login') }}" >Log-in</a></li>
                    <li><a href="{{ route('register') }}" >Register</a></li>
                    <li>                                      
                        <button class="btn btn-orange" style=" padding: 10px 30px; margin-top: 6px;" >
                            <a href="{{route('jadi.mitra')}}" style="color: white; text-decoration: none;">PARTNER-KU </a>
                        </button>
                    </li>
                @elseif(Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('dashboard')}}">Profil-KU</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </li>
                @endif
                    
                    <li></li>
            </ul>
                    </div>
                </div><!-- end container -->
            </nav><!-- end navbar -->
        </div>
        
        <div class="sidenav-content">
    <div id="mySidenav" class="sidenav" >
        <h2 id="web-name"><span ><img src=" {{ URL::asset('dist/images/logo-navbar.png') }} " style="width: 165px;" ></span></h2>

        <div id="main-menu">
            <div class="closebtn">
                <button class="btn btn-default" id="closebtn">&times;</button>
            </div><!-- end close-btn -->
            
            <div class="list-group panel">

                        <form action="#" method="get" class="searchform navbar-form" role="search">
        <!--                         <input type="hidden" value="search" name="view"> -->
                                <div class="input-group">
                                    <input type="text"  name="searchword" required class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-btn">
                                        <button class="btn" type="submit" style="background-color: #EA410C"><i class="glyphicon glyphicon-search" style="padding: 4px 0; color: white "></i></button>
                                    </div>
                            </div>
                        </form>
                <a href="{{route('index')}}" class="list-group-item"> <span><i class="fa fa-home link-icon"></i></span>Home</a>
                 
                @if(Auth::guest())
                
                    <a href="{{ route('login') }}" class="list-group-item" ><span><i class="fa fa-sign-in link-icon"></i></span>Log-In</a>
                    
                    <a href="{{ route('register') }}" class="list-group-item" ><span><i class="fa fa-user link-icon"></i></span>Register</a>

                    <button class="btn btn-orange" style=" padding: 10px 30px; margin-top: 6px; width: 100%;" >
                        <a href="{{route('jadi.mitra')}}" style="color: white; text-decoration: none;">Jadi Mitra </a>
                    </button>
                 @elseif(Auth::user())

                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @endguest                
                
            </div><!-- end list-group -->
        </div><!-- end main-menu -->
    </div><!-- end mySidenav -->
</div><!-- end sidenav-content -->
        
        <!--===== INNERPAGE-WRAPPER ====-->
        <section class="innerpage-wrapper">
            <div id="faq-page" class="innerpage-section-padding">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-12 col-md-12 content-side">
                            <div class="faq-block" style="text-align: justify;">
                                <h3 class="faq-heading">Terms and Condition</h3>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse1" data-parent="#accordion"><h4 class="panel-title">Sambutan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            
                                                <p>Selamat datang di KUPESAN.ID <br><br>
                                                   Silakan membaca Syarat dan Ketentuan Penggunaan ini dengan seksama. Dengan mengakses dan/atau menggunakan Situs, Anda setuju bahwa Anda telah membaca, memahami, dan menyetujui untuk terikat oleh Syarat dan Ketentuan Penggunaan yang ditetapkan di bawah ini.<br><br>
                                                    Jika Anda tidak menyetujui Syarat dan Ketentuan Penggunaan ini, maka Anda dianjurkan untuk berhenti mengakses dan/atau menggunakan Platform atau Layanan ini.<br><br>
                                                    PT Marlex Mandiri Jaya adalah sebuah perusahaan yang didirikan berdasarkan hukum Indonesia dan mengoperasikan Situs ini.<br><br>
                                                    Syarat dan Ketentuan Penggunaan ini dianggap merangkum Kebijakan Privasi dan setiap Kebijakan Tambahan. Kami dapat menetapkan atau mengubah bagian dari hak-hak di bawah Syarat dan Ketentuan Penggunaan tanpa izin atau pemberitahuan terlebih dahulu. Persyaratan Penggunaan dan Kebijakan Privasi merupakan perjanjian yang mengikat secara hukum antara Kami dan Anda.

                                                </p>
                                            </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse2" data-parent="#accordion"><h4 class="panel-title"> Definisi</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <li><p>“Akun” berarti akun yang terdaftar dimana Anda akan diminta untuk membuat akun tersebut jika Anda ingin mengakses dan menggunakan fasilitas dan fitur lengkap dari Situs ini, sebagai Konsumen atau PARTNER-KU.</p></li>
                                                <li><p>“Kebijakan Tambahan” berarti setiap dan semua aturan operasi lainnya, kebijakan dan/atau pedoman selain Syarat dan Ketentuan Penggunaan, yang dapat mengatur penggunaan Situs dan diberitahukan kepada Anda secara berkala.
                                                </p></li>
                                                <li><p>“Layanan/Jasa KUPESAN.ID” berarti fasilitas yang disediakan oleh Situs termasuk namun tidak terbatas pada (i) menerima pengajuan penggunaan layanan dan menyebarkannya kepada PARTNER-KU; (ii) memfasilitasi PARTNER-KU untuk memberikan penawaran kepada Konsumen; (iii) memfasilitasi Konsumen dan PARTNER-KU untuk melakukan kontak (iv) menjaga nama baik/profil PARTNER-KU, dan (v) jasa tambahan atau terkait lainnya.
                                                </p></li>
                                                <li><p>“Password/Kata Sandi” berarti kata sandi dimana Anda akan diminta untuk membuat, menyediakan, dan menggunakan kata sandi tersebut untuk membuat dan menggunakan Akun.
                                                </p></li>
                                                <li><p>“Konsumen” berarti individu atau perusahaan yang telah (i) menggunakan atau mengakses Situs; dan/ atau (ii) mengajukan permohonan untuk layanan profesional yang ditawarkan oleh Penyedia Tempat/Jasa, melalui Situs, untuk menerima penawaran harga, terlepas dari keputusan konsumen untuk menyewa atau tidak menyewa PARTNER-KU melalui Situs ini.
                                                </p></li>
                                                <li><p>“PARTNER-KU” berarti individu atau perusahaan yang telah mendaftarkan diri untuk menawarkan Tempat/Jasa mereka kepada masyarakat dan untuk konsumen melalui Situs.
                                                </p></li>
                                                <li><p></p>“Syarat dan Ketentuan Penggunaan” mengacu kepada Syarat dan Ketentuan Penggunaan, Kebijakan Privasi, dan Kebijakan Tambahan yang dapat berubah sewaktu-waktu.
                                                </p></li>
                                                <li><p>“Situs” berarti (i) situs dengan domain www.kupesan.id dan situs tambahan terkait lainnya, dan/atau aplikasi web atau telepon genggam yang dimiliki dan dioperasikan oleh KUPESAN.ID, dengan nama yang serupa atau tidak, dan (ii) fasilitas atau fungsi terkait/tambahan seperti pesan elektronik/e-mail, pesan singkat/SMS, laporan berkala, pemberitahuan, atau konten/komunikasi lainnya.
                                                </p></li>
                                            </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse3" data-parent="#accordion"><h4 class="panel-title"> Fungsi dan Tujuan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          <p>Anda mengakui bahwa Situs ini berfungsi sebagai sebuah platform online yang menghubungkan Konsumen dan PARTNER-KU dengan tujuan melakukan transaksi (menerima dan memberikan layanan). </p>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse4" data-parent="#accordion"><h4 class="panel-title">  Pernyataan Pengguna</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Dengan menggunakan atau berpartisipasi dalam Situs ini, Anda menyatakan, menjamin, dan menjalankan bahwa:</p>
                                           <ul>
                                               <li><p>Anda berusia minimal 18 (delapan belas) tahun;</p></li>
                                               <li><p>Anda wajib mengikuti dan mematuhi ketentuan dan persyaratan yang berlaku (termasuk dan tidak terbatas pada hukum dan peraturan yang berlaku); </p></li>
                                               <li><p>Semua pendaftaran atau informasi lain yang diminta dari Anda dengan tujuan mendapatkan layanan penuh/lengkap dari Situs untuk kehendak Anda sebagai Konsumen atau PARTNER-KU adalah benar dan akurat, dan Anda akan menjaga keakuratan informasi tersebut;</p></li>
                                               <li><p>Anda setuju untuk melakukan pembayaran, dan jika diperlukan, untuk setiap layanan yang diajukan melalui penggunaan Situs.
                                                </p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse5" data-parent="#accordion"><h4 class="panel-title">   Izin Untuk Mengakses</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Dengan ini, Kupesan memberikan Anda izin untuk menggunakan Situs sebagaimana diatur dalam Syarat & Ketentuan Penggunaan, namun bahwa:</p>
                                           <ul>
                                               <li><p>Anda tidak akan menyalin, mendistribusikan, atau membuat karya turunan dalam media apapun tanpa persetujuan tertulis KUPESAN.ID terlebih dahulu.</p></li>
                                               <li><p>Anda tidak akan mengubah atau memodifikasi bagian apapun dari Situs ini selain menggunakan Situs ini untuk tujuan atau keperluan yang beralasan.</p></li>
                                               <li><p>Pencabutan izin akses dikarenakan tindakan yang melanggar isi dari syarat dan ketentuan KUPESAN.ID serta hukum dan peraturan yang berlaku.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse6" data-parent="#accordion"><h4 class="panel-title">   Akun</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse6" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Anda dapat menggunakan dan mengakses Situs tanpa mendaftar atau memberikan informasi pribadi Anda. Akan tetapi, untuk mengakses dan menggunakan fasilitas dan fitur lengkap dari Situs ini, Anda akan diminta untuk membuat Akun. Untuk membuat Akun, Anda harus menyediakan dan memberikan nama, alamat e-mail, nomor handphone, lokasi dan membuat password/kata sandi</p></li>
                                               <li><p>Anda bertanggung jawab secara pribadi untuk menjaga kerahasiaan kata sandi Anda dan diharuskan untuk menjaga keamanan kata sandi setiap saat. Anda bertanggung jawab atas semua aktivitas yang terjadi pada Akun Anda dan diharuskan untuk memberitahukan KUPESAN.ID segera atas segala pelanggaran keamanan atau penggunaan yang tidak sah dari Akun Anda. </p></li>
                                               <li><p>Sebagai tambahan dan sehubungan dengan penggunaan Akun Anda, Anda mengakui dan menyetujui bahwa:<br>
                                               a)	Anda tidak akan menyalin atau mendistribusikan bagian dari Situs ini dalam media apapun tanpa persetujuan tertulis dari KUPESAN.ID terlebih dahulu.<br>
                                               b)	Anda tidak akan mengubah atau memodifikasi bagian apapun dari Situs ini selain menggunakan Situs ini untuk tujuan/keperluan yang beralasan.<br>
                                               c)	Anda akan menyediakan informasi yang lengkap dan akurat ketika membuat Akun;<br>
                                               d)	Anda tidak akan, secara manual atau otomatis, mengumpulkan informasi PARTNER-KU atau Konsumen, termasuk namun tidak terbatas pada nama, alamat, nomor telepon, atau alamat e-mail, menyalin teks dengan hak cipta, atau menyalahgunakan informasi atau konten dari Situs, termasuk namun tidak terbatas pada penggunaan pada situs ‘mirrored’, kompetitor, atau pihak ketiga;<br>
                                               e)	Anda tidak akan merekrut, meminta, atau menghubungi melalui media apapun, PARTNER-KU atau Konsumen untuk pekerjaan atau kontrak bisnis lainnya yang tidak berkaitan dengan KUPESAN.ID tanpa izin tertulis dari KUPESAN.ID sebelumnya;<br>
                                               f)	Anda tidak akan melakukan tindakan yang (i) membebani atau, dalam kebijakan mutlak KUPESAN.ID, yang dapat menghalangi infrastruktur Situs (ii) mengganggu atau mencoba mengganggu kerja Situs atau partisipasi pihak ketiga dalam Situs; atau (iii) melewati tolak ukur KUPESAN.ID yang digunakan untuk mencegah atau membatasi akses ke Situs;<br>
                                               g)	Anda setuju untuk tidak mengumpulkan atau memanen data pribadi, termasuk namun tidak terbatas pada nama atau informasi Akun lainnya dari Situs, atau menggunakan sistem komunikasi yang disediakan oleh Situs untuk tujuan komersial.
                                               </p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse7" data-parent="#accordion"><h4 class="panel-title"> Konten yang Dikirim - Larangan, Pernyataan, dan Jaminan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse7" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <ul>
                                                    <li><p>Anda tidak akan mengupload, memasang, mengirimkan, mentransfer, menyebarkan, atau memfasilitasi distribusi konten, termasuk teks, gambar, video, suara, data, informasi, atau perangkat lunak, kepada bagian apapun dari Situs termasuk namun tidak terbatas pada (i) profil; (ii) Posting Layanan Anda (iii) Posting Layanan yang Anda inginkan (iv) Postingan pendapat atau ulasan yang berkaitan dengan Situs, Layanan/Jasa, PARTNER-KU, atau Konsumen yang:<br>
                                                    a)	Memberikan informasi yang salah / Memalsukan sumber dari postingan Anda, termasuk peniruan individu atau badan lain atas setiap informasi biografis yang salah atau tidak akurat untuk PARTNER-KU, menyediakan atau menciptakan links ke Situs eksternal yang melanggar Syarat dan Ketentuan Penggunaan, yang ditujukan untuk membahayakan atau mengeksploitasi individu dalam cara apapun atau dirancang untuk mengumpulkan informasi pribadi seseorang tanpa persetujuan pihak yang bersangkutan;<br>
                                                    b)	Melanggar privasi seseorang dengan percobaan untuk memanen, mengumpulkan atau menggunakan atau mempublikasikan informasi tanpa sepengetahuan dan persetujuan pihak yang bersangkutan;<br>
                                                    c)	Mengandung unsur kebohongan atau kekeliruan yang dapat merusak pihak KUPESAN.ID atau pihak ketiga;<br>
                                                    d)	Mengandung unsur pornografi, pelecehan, kebencian, ilegal, kecabulan, pencemaran nama baik, fitnah (lisan atau tertulis), ancaman, diskriminasi, unsur SARA yang bersifat ofensif, senonoh, advokat, atau unsur yang mengekspresikan pornografi, kecabulan, kevulgaran, kesenonohan, kebencian, fanatisme, rasisme, atau kekerasan serampangan, mendorong perilaku yang dianggap sebagai pelanggaran pidana, menimbulkan tanggung jawab perdata atau melanggar hukum, mempromosikan rasisme, kebencian, atau kerugian fisik apapun terhadap kelompok atau individu, mengandung unsur ketelanjangan, kekerasan atau materi yang tidak pantas;<br>
                                                    e)	Dalam keseluruhan atau sebagian dari hak cipta, rahasia dagang yang dilindungi atau tunduk terhadap hak kepemilikan pihak ketiga, termasuk privasi dan hak publisitas, kecuali Anda adalah pemilik hak tersebut atau memiliki izin dari pemilik yang sah untuk mengirim materi dan memberikan KUPESAN.ID semua hak lisensi yang terdapat di dalamnya;<br>
                                                    f)	Dimaksudkan untuk mengancam, menguntit, mencemarkan nama baik, menipu, menurunkan, mengorbankan, mengintimidasi individu atau kelompok demi alasan apapun atau untuk menghasut atau mendorong orang lain untuk melakukannya;<br>
                                                    g)	Bertujuan untuk menyakiti, mengganggu pengguna komputer lain, atau membiarkan pihak lain untuk mengakses perangkat lunak secara ilegal atau menembus sistem keamanan Situs atau server dengan cara apapun;<br>
                                                    h)	Mengiklankan atau memohon bisnis yang tidak berhubungan atau sesuai untuk Situs (sebagaimana ditentukan dalam KUPESAN.ID dalam kebijakan mutlaknya);<br>
                                                    i)	Mengandung atau dianggap sebagai “junk mail”, “spam”, “chain letters”, “pyramid schemes”, “affiliate marketing”, atau iklan komersial yang tidak diinginkan;<br>
                                                    j)	Mengandung iklan untuk skema ponzi, kartu diskon, konseling kredit, survei atau kontes online;<br>
                                                    k)	Menyebarkan atau mengandung virus atau bentuk teknologi lain yang dapat membahayakan KUPESAN.ID, kepentingan atau properti dari pengguna KUPESAN.ID;<br>
                                                    l)	Mengandung links ke layanan komersial atau Situs lain, kecuali diizinkan dan sesuai dengan Syarat dan Ketentuan Penggunaan;<br>
                                                    m)	Adalah non-lokal atau konten tidak relevan; atau<br>
                                                    n)	Mengandung konten yang serupa dengan postingan terbuka lain, atau menggunakan segala bentuk perangkat otomatis atau program komputer yang memungkinkan pengajuan postingan tanpa izin tertulis dari KUPESAN.ID.
                                                    </p></li>
                                                    <li><p>Anda tidak akan mengirim pesan kepada pengguna lain dimana Anda telah melakukan kontak melalui Situs yang berisi:<br>
                                                    a)	Penawaran untuk melakukan transfer uang nasional atau internasional untuk jumlah yang melebihi harga layanan, dengan maksud untuk meminta pengembalian dana dari setiap bagian pembayaran; atau<br>
                                                    b)	Iklan yang tidak diminta atau pemasaran layanan yang (i) tidak ditawarkan di Situs; atau (ii) yang ditawarkan di sebuah situs eksternal.
                                                    </p></li>
                                                    <li><p>
                                                        Saat menggunakan Situs ini, Anda tidak akan:<br>
                                                        a)	Memasang konten atau item yang dikategorikan tidak pantas pada Situs;<br>
                                                        b)	Melanggar hukum, Hak Pihak Ketiga, Kebijakan Akun, atau ketentuan dalam Syarat dan Ketentuan Penggunaan, seperti larangan yang dijelaskan di atas;<br>
                                                        c)	Gagal untuk melakukan pembayaran untuk layanan/jasa yang Anda beli, terkecuali PARTNER-KU telah mengubah deskripsi layanan dalam hal material setelah Anda menegosiasikan kesepakatan untuk layanan tersebut, kesalahan pengetikan yang jelas dibuat, atau Anda tidak dapat mengotentikasi identitas PARTNER-KU;<br>
                                                        d)	Gagal untuk memberikan layanan yang dibeli dari Anda, kecuali Konsumen gagal memenuhi syarat-syarat yang disepakati bersama secara material;<br>
                                                        e)	Menipu atau memanipulasi struktur pembiayaan atau proses penagihan yang mungkin kita miliki atau terapkan;<br>
                                                        f)	Memasang konten yang salah, tidak akurat, menyesatkan, mencemarkan nama baik, atau memfitnah (termasuk informasi pribadi tentang Konsumen lainnya);<br>
                                                        g)	Mengambil tindakan yang dapat merusak fitur yang dimiliki KUPESAN.ID atau yang mungkin muncul dari tujuan penggunaan Situs;<br>
                                                        h)	Membiarkan masukan yang salah atau tidak sesuai yang berkaitan dengan PARTNER-KU dan Anda harus mempertimbangkan dengan baik dan hati-hati ketika memberikan ulasan dalam bentuk apapun.

                                                    </p></li>
                                                    <li><p>
                                                        Anda bertanggung jawab penuh atas Konten yang Dikirim, serta konsekuensi dari postingan atau penerbitan tersebut. Anda dengan ini menegaskan, menyatakan, dan/ atau menjamin bahwa: <br>
                                                        a)	Anda memiliki lisensi yang diperlukan, hak-hak, persetujuan, dan izin untuk menggunakan dan membenarkan KUPESAN.ID untuk menggunakan semua paten, merek dagang, rahasia dagang, hak cipta, atau hak milik lainnya, di dalam dan untuk semua Konten yang Dikirim;<br>
                                                        b)	Anda memiliki persetujuan tertulis, rilis, dan/atau izin dari masing-masing dan setiap individual dalam Konten yang Dikirim untuk menggunakan nama atau kemiripan dari masing-masing dan setiap individual; dan<br>
                                                        c)	Anda setuju untuk membayar semua biaya royalti, ongkos, dan biaya lainnya yang dapat timbul akibat Konten yang Dikirim oleh Anda untuk atau melalui Situs.

                                                    </p></li>
                                                    <li><p>Anda mempertahankan semua hak kepemilikan dalam Konten yang Dikirim. Dengan ini, Anda memberikan, menyatakan, dan menjamin bahwa Anda berhak untuk memberikan KUPESAN.ID lisensi yang kekal, mendunia, non-eksklusif, bebas royalti untuk menghubungkan, menggunakan, mereproduksi, menyebarkan, memformat ulang, menerjemahkan, menyediakan kerja turunan, menampilkan, dan mempersembahkan Konten yang Dikirim sehubungan dengan Situs dan operasi bisnis KUPESAN.ID (dan penerusnya), termasuk namun tanpa batasan, untuk promosi dan redistribusi sebagian atau seluruh Situs (dan karya turunan dalam format media dan melalui saluran media)</p></li>
                                                    <li><p>Anda memberikan lisensi non-eksklusif kepada setiap Pengguna Situs untuk mengakses Konten yang Dikirim melalui Situs, untuk membaca dan menggunakan Konten yang Dikirim sesuai izin melalui fungsi Situs dan di bawah Syarat dan Ketentuan Penggunaan.</p></li>
                                                </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse8" data-parent="#accordion"><h4 class="panel-title">  Penolakan dan Hak untuk Menghapus Konten yang Diunggah/Dikirim</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse8" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>KUPESAN.ID tidak mengesahkan/membenarkan Konten yang Diunggah/Dikirim atau pendapat, rekomendasi, atau saran yang diberikan oleh pengguna dan KUPESAN.ID menolak secara tegas untuk bertanggung jawab atas perkara yang berkaitan dengan Konten yang Dikirim.</p></li>
                                               <li><p>KUPESAN.ID tidak mengizinkan dan mendukung aktivitas yang berkaitan dengan pelanggaran hak cipta maupun pelanggaran hak kekayaan intelektual pada Situs, KUPESAN.ID akan menghapus Data atau Konten yang Diunggah/Dikirim, setelah adanya pemberitahuan berserta bukti yang akurat dan jelas bahwa telah terjadi pelanggaran, KUPESAN.ID akan menindaklanjuti pelanggaran tersebut dengan memberikan sanksi yang berlaku kepada pihak yang terkait.</p></li>
                                               <li><p>KUPESAN.ID berhak untuk menentukan apakah Data atau Konten yang Diunggah/Dikirim sudah sesuai atau tidak sesuai dengan Persyaratan dan ketentuan yang berlaku.</p></li>
                                               <li><p>Anda mengakui dan memahami bahwa saat menggunakan Situs, Anda akan terekspos pada Konten yang Diunggah/Dikirim:<br>
                                                a.	Dari berbagai sumber dan KUPESAN.ID tidak bertanggung jawab atas keakuratan, kegunaan, dan hak kekayaan intelektual yang berhubungan dengan Konten yang Diunggah/Dikirim tersebut; dan <br>
                                                b.	Yang tidak akurat, mengandung unsur kekerasan, SARA dan pornografi, tidak senonoh, dan dengan ini Anda setuju untuk melepaskan hak hukum atau remedi yang mungkin Anda miliki terhadap Kupesan, dan setuju untuk mengganti kerugian dan  tidak melibatkan Kupesan beserta pejabat, anggota, manajer, operator, direktur, karyawan, agen, afiliasi, dan/atau pemberi lisensi sepenuhnya dari semua perkara yang berkenaan dengan penggunaan Situs.
                                               </p></li>
                                               <li><p>Anda bertanggung jawab atas foto, profil, dan konten lain, termasuk namun tidak terbatas pada Konten yang Diunggah/Dikirim yang Anda tampilkan atau terbitkan pada atau melalui Situs, atau yang Anda sebarkan kepada pengguna Situs lain. Anda memahami dan menyetujui bahwa Kupesan berhak, meninjau dan menghapus Konten yang Diunggah/Dikirim yang melanggar Syarat dan Ketentuan Penggunaan dimana konten tersebut bersifat ofensif, berunsur SARA atau pornografi, ilegal, atau melanggar, membahayakan, mengusik, dan mengancam hak atau keamanan pengguna Situs lainnya.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse9" data-parent="#accordion"><h4 class="panel-title">   PARTNER-KU</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse9" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Jika Anda adalah individu yang menggunakan Situs dan/atau telah mendaftar untuk pembuatan Akun sebagai PARTNER-KU, Anda menyatakan dan menjamin bahwa Anda memiliki wewenang untuk mengikat individu dan/atau perusahaan yang bertanggung jawab dan mengoperasikan bisnis sebagai PARTNER-KU dan penerimaan Syarat dan Ketentuan Penggunaan Anda akan dianggap sebagai penerimaan oleh PARTNER-KU tersebut.</p></li>
                                               <li><p>Dengan mendaftar atau membuat Akun pada Situs sebagai PARTNER-KU, Anda menyetujui dan berjanji untuk memenuhi setiap permohonan atas informasi untuk tujuan verifikasi legalitas, legitimasi, tingkah laku dan pendirian yang tepat dari (i) bisnis, perusahaan atau operasi Anda; dan/atau (ii) ketentuan/persediaan Layanan Anda.</p></li>
                                               <li><p>PARTNER-KU tidak akan:<br>
                                                a.	Mendaftarkan jasa pada Situs di dalam kategori layanan yang tidak mereka tawarkan atau tidak relevan/sesuai dengan jasa yang mereka tawarkan;<br>
                                                b.	Memberikan informasi yang salah mengenai lokasi/tempat dimana mereka beroperasi/memberikan layanan;<br>
                                                c.	Memasukkan nama merek pihak ketiga atau kata kunci yang tidak pantas dalam profil mereka, judul atau postingan lainnya, pesan atau penyampaian yang dilakukan di atau melalui Situs;<br>
                                                d.	Menggunakan judul yang menyesatkan/misleading, kata atau frasa yang tidak mendeskripsikan layanan mereka secara akurat;<br>
                                                e.	Memuat informasi palsu dan tidak sesuai dengan kondisi yang sebenarnya pada profil mereka;<br>
                                                f.	Melakukan tindakan untuk mengelak atau menghindari biaya yang akan dikenakan oleh KUPESAN.ID;<br>
                                                g.	Melakukan penipuan atau kesalahan atas promosi atau kemitraan yang akan diselenggarakan oleh KUPESAN.ID;<br>
                                                h.	Menggunakan profil mereka atau Situs ini untuk mempromosikan (i) barang atau produk; (ii) layanan yang tidak disediakan oleh PARTNER-KU melalui Situs; (iii) layanan yang tidak diakui dalam kategori pada Situs; (iv) Situs, layanan, produk, partai atau hal apapun yang tidak terkait secara langsung dengan layanan mereka atau melanggar ketentuan dan persyaratan yang berlaku; atau (iv) layanan yang melanggar hukum yang berlaku;<br>
                                                i.	Membujuk/mendesak Konsumen atau orang lain untuk membayar atau melakukan hal yang tidak diperbolehkan secara khusus oleh Syarat dan Ketentuan Penggunaan atau oleh KUPESAN.ID, yang ditentukan secara berkala.<br>
                                                j.	Mengajak atau menawarkan layanan atau melakukan hal yang bertentangan dengan Syarat dan Ketentuan Penggunaan, Kebijakan Privasi, atau hukum lainnya.<br>
                                                k.	Memanipulasi review konsumen terhadap PARTNER-KU tersebut.
                                               </p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse11" data-parent="#accordion"><h4 class="panel-title">   Konsumen</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse11" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Pengguna Layanan tidak akan:<br>
                                                a)	Melakukan pembelian atau penggunaan layanan/jasa tanpa niat untuk membayar layanan tersebut.<br>
                                                b)	Mendaftar, memohon, atau menegosiasikan harga untuk menggunakan atau meminta layanan/jasa <br>(i) dengan tidak adanya niat untuk membayar layanan tersebut;<br> (ii) dengan tujuan menggunakan harga, penawaran, dan informasi lainnya untuk tujuan komersial dan kompetitif, tujuan bisnis atau market intelligence atau survei umum; atau <br> (iii) penggunaan non-personal lainnya;<br>
                                                c)	Memohon atau setuju untuk menggunakan jasa saat <br>(i) Anda menyadari, mempercayai, atau merasa bahwa Anda tidak memenuhi Syarat dan Ketentuan Penyedia Layanan; atau <br>(ii) dengan tujuan untuk mengakibatkan gangguan, melakukan penipuan, atau tujuan ilegal lainnya.

                                               </p></li>
                                               <li><p>Sebagai Konsumen, Anda disarankan untuk melakukan pertimbangan secara beralasan dan berdikari, kebijakan dan perhatian dalam pengambilan keputusan untuk menyewa atau terlibat dengan PARTNER-KU.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <!--<div class="panel panel-default">-->
                                <!--    <div class="panel-heading">-->
                                <!--        <a data-toggle="collapse" href="#collapse11" data-parent="#accordion"><h4 class="panel-title">   TRANSAKSI PARTNER-KU</h4></a>-->
                                <!--    </div>-->
                                    
                                <!--    <div id="collapse11" class="panel-collapse collapse">-->
                                <!--        <div class="panel-body">-->
                                <!--           <ul>-->
                                <!--               <li><p>Partner-Ku dilarang memanipulasi harga sewa dengan tujuan apapun.</p></li>-->
                                <!--               <li><p>Partner-Ku dilarang menyewakan/menyediakan layanan diluar kemampuan Partner-Ku itu sendiri terlebih terkait layanan yang tidak memiliki izin yang lengkap sesuai tatanan hukum yang berlaku.</p></li>-->
                                <!--               <li><p>Dalam menggunakan Fasilitas Rules & Amenitie", Partner-Ku dilarang membuat peraturan atau ketentuan pribadi yang bertentangan dengan Syarat & Ketentuan KUPESAN.ID. Jika terdapat pertentangan antara keduanya maka peraturan yang berlaku adalah Syarat & Ketentuan KUPESAN.ID.</p></li>-->
                                <!--               <li><p>Partner-Ku wajib memberikan konfirmasi untuk menerima atau menolak pesanan Konsumen dalam batas waktu 6 jam terhitung sejak adanya pemberitahuan peesanan dari KUPESAN.ID. Jika dalam batas waktu tersebut tidak ada balasan dari Partner-Ku maka secara otomatis pesanan dianggap dibatalkan</p></li>-->
                                <!--               <li><p>Partner-Ku memahami dan menyetujui bahwa pembayaran atas harga sewa tempat (diluar biaya transfer/administrasi) akan dikembalikan sepenuhnya ke Konsumen apabila transaksi dibatalkan dan/atau transaksi tidak berhasil dan/atau ketentuan lain yang diatur dalam Syarat dan Ketentuan terkait Transaksi Layanan.</p></li>-->
                                <!--               <li><p>KUPESAN.ID memiliki kewenangan untuk menahan pembayaran dana di Rekening Resmi KUPESAN.ID sampai waktu yang tidak ditentukan apabila terdapat permasalahan dan klaim dari pihak Konsumen terkait proses layanan dan fasilitas. Pembayaran baru akan diteruskan kepada Partner-Ku apabila permasalahan tersebut telah selesai dan/atau Konsumen telah menggunakan layanan.</p></li>-->
                                <!--               <li><p>Partner-Ku memahami dan menyetujui bahwa Pajak Penghasilan Partner-Ku akan dilaporkan dan diurus sendiri oleh masing-masing Partner-Ku sesuai dengan ketentuan pajak yang berlaku di peraturan perundang-undangan di Indonesia.</p></li>-->
                                <!--               <li><p>KUPESAN.ID berwenang mengambil keputusan atas permasalahan-permasalahan transaksi yang belum terselesaikan akibat tidak adanya kesepakatan penyelesaian, baik antara Partner-Ku dan Konsumen, dengan melihat bukti-bukti yang ada. Keputusan KUPESAN.ID adalah keputusan akhir yang tidak dapat diganggu gugat dan mengikat pihak Partner-Ku dan Konsumen untuk mematuhinya. Keputusan yang diambil akan dipertimbangkan berdasarkan ketentuan dan syarat yang berlaku serta berdasarkan hukum yang berlaku.</p></li>-->
                                <!--               <li><p>KUPESAN.ID berwenang memotong kelebihan tarif layanan dari dana pembayaran Konsumen dan mengembalikan selisih kelebihan tarif pengiriman kepada Konsumen.</p></li>-->
                                <!--               <li><p>Transfer dana akan dilakukan secara akumulasi transaksi layanan dari hari Rabu. Transfer dana akan dilakukan setiap hari Rabu, jika hari Rabu bertepatan dengan hari libur / hari besar, maka transfer dana akan dilakukan pada hari kerja berikutnya.</p></li>-->
                                <!--               <li><p>Bukti Transfer akan dikirimkan melalui e-mail sesuai yang tercantum oleh Partner-Ku.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--           </ul>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="panel panel-default">-->
                                <!--    <div class="panel-heading">-->
                                <!--        <a data-toggle="collapse" href="#collapse11" data-parent="#accordion"><h4 class="panel-title">   TRANSAKSI LAYANAN</h4></a>-->
                                <!--    </div>-->
                                    
                                <!--    <div id="collapse11" class="panel-collapse collapse">-->
                                <!--        <div class="panel-body">-->
                                <!--           <ul>-->
                                <!--               <li><p>Setiap transaksi yang dilakukan pada situs wajib menggunakan metode pembayaran melalui rekening resmi dari KUPESAN.ID sesuai dengan tahapan transaksi yang berlaku. Tahapan tersebut antara lain, Konsumen akan melakukan transfer sejumlah uang sesuai harga layanan yang tertera pada rekening resmi KUPESAN.ID, kemudian KUPESAN.ID akan meneruskan kiriman uang tersebut kepada Partner-Ku setelah tahapan transaksi layanan selesai.</p></li>-->
                                <!--               <li><p>Konsumen menyetujui bahwa: <br>-->
                                <!--               •	Konsumen bertanggung jawab untuk membaca, memahami, dan menyetujui segala bentuk informasi/deskripsi keseluruhan tempat (termasuk didalamnya namun tidak terbatas pada warna, fasilitas, kelengkapan, dan lainnya) sebelum membuat pesanan atau komitmen untuk menggunakan layanan.<br>-->
                                <!--               •	Konsumen mengakui bahwa warna dan spesifikasi atau segala bentuk visualisasi yang terlihat pada situs tergantung pada tampilan perangkat (smartphone, komputer, laptop, dll.) konsumen. KUPESAN.ID telah melakukan upaya terbaik untuk memastikan segala bentuk visualisasi yang ditampilkan pada situs muncul seakurat mungkin, tetapi tidak dapat menajmin bahwa tampilan tempat terkait akan akurat.<br>-->
                                <!--               •	Konsumen masuk kedalam kontrak yang mengikat secara hukum ketika Konsumen menggunakan layanan baik selama proses transaksi ataupun pada saat transaksi (termasuk didalamnya namun tidak terbatas pada Konsumen, Partner-Ku, dll.) yang juga bersangkutan dengan KUPESAN.ID.<br>-->
                                <!--               •	Kupesan.id tidak mengalihkan kepemilikan secara hukum atas barang-barang dari Partner-Ku (Pemilik Tempat/Jasa) ketika Konsumen menggunakan layanan. <br>-->
                                <!--               •	Mengikuti segala peraturan yang ada pada saat menggunakan layanan, baik peraturan yang tertulis pada situs terkait Partner-Ku ataupun peraturan tertulis yang tidak tercantum pada situs tetapi berlaku untuk menjaga keutuhan Tempat/Jasa Partner-Ku.-->
                                <!--               </p></li>-->
                                <!--               <li><p>3.	Konsumen memahami dan menyetujui bahwa ketersediaan waktu layanan merupakan tanggung jawab Partner-Ku yang menawarkan layanan tersebut. Terkait ketersediaan jam sewa dapat berubah sewaktu-waktu, sehingga dalam keadaan waktu layanan penuh, maka Partner-Ku berhak menolak transaksi (pasal berapa nomor berapa), dan pembayaran atas layanan yang bersangkutan akan dikembalikan kepada Konsumen. (ditambahkan “penolakan transaksi akan berdasarkan ketentuan dan syarat yang berlaku” dan tambahi minimal waktu pemberitahuan penolakan transaksi)</p></li>-->
                                <!--               <li><p>4.	Konsumen memahami sepenuhnya dan menyetujui bahwa segala bentuk transaksi yang dilakukan antara Konsumen dan Partner-Ku selain melalui Rekening Resmi KUPESAN.ID dan/atau tanpa sepengetahuan KUPESAN.ID (melalui fasilitas/jaringan pribadi, pengiriman pesan, pengaturan transaksi khusus diluar situs KUPESAN.ID atau upaya lainnya) merupakan tanggung jawab pribadi dari Konsumen. Segala bentuk transaksi yang terjadi diluar pembayaran melalui rekening resmi KUPESAN.ID, Konsumen tidak diperkenankan untuk melibatkan KUPESAN.ID dalam bentuk apapun. </p></li>-->
                                <!--               <li><p></p></li>-->
                                <!--               <li><p>KUPESAN.ID memiliki kewenangan untuk menahan pembayaran dana di Rekening Resmi KUPESAN.ID sampai waktu yang tidak ditentukan apabila terdapat permasalahan dan klaim dari pihak Konsumen terkait proses layanan dan fasilitas. Pembayaran baru akan diteruskan kepada Partner-Ku apabila permasalahan tersebut telah selesai dan/atau Konsumen telah menggunakan layanan.</p></li>-->
                                <!--               <li><p>Partner-Ku memahami dan menyetujui bahwa Pajak Penghasilan Partner-Ku akan dilaporkan dan diurus sendiri oleh masing-masing Partner-Ku sesuai dengan ketentuan pajak yang berlaku di peraturan perundang-undangan di Indonesia.</p></li>-->
                                <!--               <li><p>KUPESAN.ID berwenang mengambil keputusan atas permasalahan-permasalahan transaksi yang belum terselesaikan akibat tidak adanya kesepakatan penyelesaian, baik antara Partner-Ku dan Konsumen, dengan melihat bukti-bukti yang ada. Keputusan KUPESAN.ID adalah keputusan akhir yang tidak dapat diganggu gugat dan mengikat pihak Partner-Ku dan Konsumen untuk mematuhinya. Keputusan yang diambil akan dipertimbangkan berdasarkan ketentuan dan syarat yang berlaku serta berdasarkan hukum yang berlaku.</p></li>-->
                                <!--               <li><p>KUPESAN.ID berwenang memotong kelebihan tarif layanan dari dana pembayaran Konsumen dan mengembalikan selisih kelebihan tarif pengiriman kepada Konsumen.</p></li>-->
                                <!--               <li><p>Transfer dana akan dilakukan secara akumulasi transaksi layanan dari hari Rabu. Transfer dana akan dilakukan setiap hari Rabu, jika hari Rabu bertepatan dengan hari libur / hari besar, maka transfer dana akan dilakukan pada hari kerja berikutnya.</p></li>-->
                                <!--               <li><p>Bukti Transfer akan dikirimkan melalui e-mail sesuai yang tercantum oleh Partner-Ku.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                <!--               <li><p>No Rekening Partner-Ku harus diisi dan bila ingin diganti harus melalui e-mail ke kupesan.id@gmail.com.</p></li>-->
                                               
                                <!--           </ul>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse12" data-parent="#accordion"><h4 class="panel-title">   Tidak Ada Kerahasiaan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse12" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Tanpa prasangka terhadap Kebijakan Privasi, Anda mengakui dan menyetujui bahwa KUPESAN.ID tidak menjamin kerahasiaan setiap hubungan terhadap Konten yang Dikirim oleh pengguna, termasuk namun tidak terbatas pada profil Anda atau informasi yang disalurkan, dipasang atau disebarluaskan oleh Anda, yang diterima/ diterbitkan di Situs.</p>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse13" data-parent="#accordion"><h4 class="panel-title">   Modifikasi Syarat dan Ketentuan Penggunaan atau Kebijakan Privasi</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse13" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>KUPESAN.ID berhak, dalam kebijakannya yang mutlak, mengganti, memodifikasi atau memperbaiki Syarat dan Ketentuan Penggunaan dan dokumen/referensi lainnya setiap saat. Anda bertanggung jawab untuk meninjau Syarat dan Ketentuan Penggunaan untuk segala perubahan. Penggunaan Situs dan semua perubahan Syarat dan Ketentuan Penggunaan menandakan persetujuan dan penerimaan Anda atas perubahan Syarat dan Ketentuan Penggunaan. Jika Anda tidak menyetujui atau mematuhi Syarat dan Ketentuan ini, baik sekarang atau di masa mendatang, jangan menggunakan atau mengakses Situs ini.</p>
                                           
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse14" data-parent="#accordion"><h4 class="panel-title">   Izin Untuk Mengakses</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse14" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Dengan ini, Kupesan memberikan Anda izin untuk menggunakan Situs sebagaimana diatur dalam Syarat & Ketentuan Penggunaan, namun bahwa:</p>
                                           <ul>
                                               <li><p>Anda tidak akan menyalin, mendistribusikan, atau membuat karya turunan dalam media apapun tanpa persetujuan tertulis Kupesan terlebih dahulu.</p></li>
                                               <li><p>Anda tidak akan mengubah atau memodifikasi bagian apapun dari Situs ini selain menggunakan Situs ini untuk tujuan atau keperluan yang beralasan.</p></li>
                                               <li><p>Sebaliknya, Anda akan bertindak sesuai dengan Syarat & Ketentuan Penggunaan dan semua hukum yang berlaku.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse15" data-parent="#accordion"><h4 class="panel-title">   Pemberhentian</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse15" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>KUPESAN.ID berhak untuk mengubah atau menghentikan Situs atau bagian daripadanya untuk sementara atau permanen dengan atau tanpa pemberitahuan atas kebijakan mutlaknya, sewaktu-waktu dan secara berkala. Anda menyetujui bahwa KUPESAN.ID tidak bertanggung jawab pada Anda atau pihak ketiga atas modifikasi, penangguhan, atau pemberhentian layanan KUPESAN.ID.</p></li>
                                               <li><p>Anda mengakui dan menyetujui bahwa KUPESAN.ID dalam kebijakan mutlaknya, berhak namun tidak berkewajiban untuk menghapus, menghentikan, atau menonaktifkan Akun, menahan alamat e-mail atau alamat IP, membatalkan Situs atau menghentikan akses atau partisipasi Anda dalam penggunaan Situs dan bagian daripadanya, segera menghapus atau menarik Konten yang Dikirim pada Situs dan tanpa pemberitahuan atau alasan apapun, mampu namun tidak berkewajiban untuk mengungkapkannya.</p></li>
                                               <li><p>Setelah pemberhentian Akun, hak Anda untuk berpartisipasi di Situs dalam bentuk apapun akan berakhir secara otomatis.</p></li>
                                               <li><p>Setelah pemberhentian Akun, hal berikut akan terjadi: <br>
                                                a)	Akun Anda akan dinonaktifkan dan Anda tidak akan diberikan akses ke Akun atau data/dokumen lain yang terdapat dalam Akun Anda. Akan tetapi, data residual tersebut mungkin tetap tertinggal dalam sistem KUPESAN.ID.<br>
                                                b)	Semua lisensi/izin yang diberikan kepada Anda akan segera dihentikan.<br>
                                                c)	KUPESAN.ID tidak bertanggung jawab pada Anda atau pihak ketiga atas pemutusan akses Anda ke Situs. KUPESAN.ID mempertahankan hak untuk menggunakan data yang terkumpul dari penggunaan Situs.<br>
                                                d)	Semua lisensi/izin terkait yang Anda berikan pada KUPESAN.ID akan tetap berlaku untuk tujuan di atas. KUPESAN.ID tidak berkewajiban untuk mengembalikan Konten yang Dikirim kepada Anda. Semua Syarat dan Ketentuan Penggunaan melewati pemberhentian dan tetap ada untuk pemanfaatan penuh oleh KUPESAN.ID.
                                               </p></li>
                                               <li><p>Anda setuju untuk mengganti kerugian dan membebaskan KUPESAN.ID beserta pejabat, manajer, anggota, afiliasi, penerus, wakil, direktur, agen, pemasok, dan karyawannya dari segala gugatan atau tuntutan, termasuk biaya pengacara dan pengadilan, yang dibuat oleh pihak ketiga sebagai akibat dari pemberhentian.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse16" data-parent="#accordion"><h4 class="panel-title">   Hak Kekayaan Intelektual</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse16" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Konten yang terdapat pada Situs (eksklusif: Konten yang Dikirim), termasuk namun tidak terbatas pada teks, perangkat lunak, naskah, grafis, foto, suara, music, video, atau fitur interaktif dan sejenisnya (“Data”) dan merek dagang dan logo yang terdapat di dalamnya (“Marks”), dimiliki oleh KUPESAN.ID ataupun perusahaan terkait dengan KUPESAN.ID (“Pemilik”), menurut hak cipta dan hak kekayaan intelektual lainnya dibawah hukum dan konvensi internasional. Data/Marks dilindungi oleh hak cipta, merek dagang, paten, rahasia dagang dan hukum lainnya, dan KUPESAN.ID ataupun Pemilik memiliki dan mempertahankan semua hak yang terdapat dalam Data dan Marks. Semua merek dagang, nama, dan logo pada Situs ini adalah kepunyaan dari masing-masing pemiliknya.</p></li>
                                               <li><p>Data pada Situs ini tersedia untuk kepentingan informasi dan penggunaan pribadi Anda, dan tidak digunakan, disalin, ditiru, disebarkan, dikirimkan, disiarkan, ditampilkan, dijual, dilisensi, atau dieksploitasi untuk tujuan lainnya tanpa persetujuan tertulis dari pemiliknya terlebih dahulu.</p></li>
                                               <li><p>Anda setuju untuk tidak menggunakan, menyalin, mendistribusikan Data selain dari yang diizinkan, termasuk segala penggunaan, penyalinan, atau pendistribusian Konten yang Dikirim yang bersumber dari Situs ini untuk tujuan komersial. Jika Anda mengunduh atau mencetak salinan Data untuk kegunaan pribadi, Anda harus mempertahankan hak cipta dan hak pemberitahuan kepemilikan yang terkadung di dalamnya. Anda setuju untuk tidak menggagalkan, menonaktifkan, atau mengganggu fitur keamanan pada Situs atau fitur yang melindungi dan membatasi penggunaan atau penyalinan Data, atau fitur yang menegakkan batasan atas penggunaan Situs atau Data di dalamnya.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse17" data-parent="#accordion"><h4 class="panel-title">   Perselisihan/Sengketa</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse17" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Interaksi yang terjadi antara Anda dan pengguna lain, baik individu, perusahaan, dan/atau organisasi, baik PARTNER-KU atau Konsumen, yang ditemukan di atau melalui Situs, termasuk pembayaran dan kinerja layanan, dan syarat-syarat, kondisi, jaminan, atau perwakilan terkait dengan transaksi tersebut, adalah antara Anda dan pihak ketiga atau pengguna. Anda sebaiknya melakukan tindakan pencegahan atau melakukan penyelidikan yang Anda anggap perlu/sesuai sebelum menyewa, membayar, atau melakukan transaksi dengan pihak ketiga atau pengguna untuk tujuan apapun.</p></li>
                                               <li><p>Anda memahami dan mengakui bahwa pengambilan keputusan untuk:<br>
                                                    a)	Menggunakan layanan dari PARTNER-KU;<br>
                                                    b)	Memberikan layanan untuk Konsumen;<br>
                                                    c)	dan Menggunakan informasi yang terdapat dalam Konten yang Dikirim;<br>
                                                    adalah keputusan pribadi dan Anda sendirilah yang bertanggung jawab. Anda memahami bahwa KUPESAN.ID tidak dan tidak dapat mewakili dalam hal kesesuaian dari setiap pengguna dimana Anda melakukan interaksi di atau melalui Situs dan/atau ketepatan atau kesesuaian anjuran, informasi, atau rekomendasi yang dibuat oleh Pengguna.
                                               </p></li>
                                               <li><p>Dalam perselisihan/sengketa yang terjadi antara Anda dan Konsumen, PARTNER-KU, atau pihak ketiga/pengguna yang berkaitan dengan Situs, perselisihan tersebut harus diselesaikan antara Anda dan Konsumen, PARTNER-KU, atau pihak ketiga/pengguna, dan KUPESAN.ID tidak bertanggung jawab atau berkewajiban untuk terlibat.</p></li>
                                               <li><p>Sekalipun demikian, Anda menyetujui bahwa KUPESAN.ID tidak bertanggung jawab atas segala kehilangan atau kerusakan apapun yang terjadi/timbul sebagai akibat transaksi tersebut. Sekalipun terjadi perselisihan/sengketa antar Pengguna, atau antara Pengguna dan pihak ketiga, Anda mengakui dan menyetujui bahwa KUPESAN.ID tidak bertanggung jawab untuk terlibat. Jika terjadi sengketa antara Anda dan satu atau lebih pengguna atau pihak ketiga, Anda membebaskan KUPESAN.ID beserta pejabat, manajer, anggota, direktur, karyawan, pengacara, agen, dan penerusnya dari segala jenis tuntutan, gugatan, dan kerusakan (aktual dan konsekuensial), dalam bentuk apapun, dikenal atau tidak dikenal, diduga atau tidak diduga, diramalkan atau tidak diramalkan, diungkapkan atau tidak diungkapkan, timbul dari atau dalam bentuk apapun berkaitan dengan sengketa tersebut dan/atau Situs atau layanan yang tersedia didalamnya.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse18" data-parent="#accordion"><h4 class="panel-title">   Iklan dan Sponsor Pihak Ketiga</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse18" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Dengan ini, Kupesan memberikan Anda izin untuk menggunakan Situs sebagaimana diatur dalam Syarat & Ketentuan Penggunaan, namun bahwa:</p>
                                           <ul>
                                               <li><p>Aspek dari Situs atau layanan KUPESAN.ID lainnya mungkin disokong oleh periklanan. Dengan demikian, KUPESAN.ID dapat menampilkan iklan dan promosi pada layanan. Cara, mode, dan lingkup iklan oleh KUPESAN.ID di Situs dapat berubah-ubah dan munculnya iklan di Situs tidak menandakan pengesahan/pembenaran oleh KUPESAN.ID atas produk atau jasa yang diiklankan. Anda menyetujui bahwa KUPESAN.ID tidak bertanggung jawab atas kerugian atau kerusakan apapun yang timbul sebagai akibat dari transaksi tersebut atau hadirnya pemasangan iklan di Situs.</p></li>
                                               <li><p>Situs atau pihak ketiga dapat menyediakan links, kontak, dan/atau nomor telepon ke Situs/sumber lain, termasuk namun tidak terbatas pada jejaring sosial, blog, dan Situs serupa dimana Anda dapat login ke Situs menggunakan Akun yang ada dan informasi login untuk Situs pihak ketiga. Anda mengakui dan menyetujui bahwa KUPESAN.ID tidak bertanggung jawab atas kehadiran Situs/sumber eksternal, dan tidak bertanggung jawab atas konten, iklan, produk, barang dan jasa di atau dari Situs/sumber tersebut. Kecuali secara tegas dinyatakan di Situs ini, links ke Situs pihak ketiga tidak dapat dianggap sebagai pengesahan/pembenaran KUPESAN.ID terhadap Situs Pihak ketiga atau produk atau jasa yang ditawarkan.</p></li>
                                               <li><p>Kami tidak memantau atau mengontrol, dan tidak membuat gugatan atau mewakili hal yang berkaitan dengan Situs pihak ketiga. Sekalipun links tersebut disediakan oleh kami, links tersebut disediakan semata-mata untuk kenyamanan belaka, dan link ke Situs pihak ketiga tidak menandakan pengesahan/pembenaran, pemakaian, dan penyokongan dari kami atau afiliasi dengan Situs pihak ketiga.</p></li>
                                               <li><p>Anda mengakui dan sepakat bahwa KUPESAN.ID tidak bertanggung jawab atau berkewajiban, secara langsung atau tidak langsung, atas kerusakan atau kehilangan apapun yang disebabkan atau diduga disebabkan oleh atau yang berhubungan dengan penggunaan atau ketergantungan pada konten, iklan, produk, barang atau layanan yang tersedia di atau melalui Situs/sumber tersebut. Setelah Anda meninggalkan Situs kami, Syarat dan Ketentuan Penggunaan ini tidak lagi mengatur Anda dan Anda disarankan untuk memeriksa Syarat dan Ketentuan Penggunaan Situs. Anda juga mengakui bahwa Anda berkewajiban untuk mematuhi syarat dan kondisi dari pihak ketiga, secara langsung atau tidak langsung melalui penggunaan Situs, dan Anda menerima semua tanggung jawab tersebut. Hubungan dan komunikasi melalui Situs dengan pihak lain selain KUPESAN.ID adalah antara Anda dan pihak ketiga tersebut. Keluhan, masalah atau pertanyaan yang berhubungan dengan materi yang disediakan oleh pihak ketiga harus diteruskan/ditujukan langsung ke pihak ketiga yang berlaku.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse19" data-parent="#accordion"><h4 class="panel-title">   Penolakan Jaminan, Batasan Tanggung Jawab & Ganti Rugi</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse19" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Anda mengakui dan menyetujui bahwa penggunaan Situs merupakan risiko Anda sendiri. KUPESAN.ID beserta pejabat, direktur, karyawan, dan agennya tidak memberikan jaminan dan/atau perwakilan dan menolak semua jaminan, perwakilan dan/atau kondisi baik tersurat maupun tersirat yang timbul sebagai akibat dari dan sehubungan dengan Situs dan dari penggunaan atau ketidakmampuan penggunaan, termasuk namun tidak terbatas pada;<br>
                                                a)	Ketepatan, kelengkapan, kualitas kepuasan, layanan/operasi bebas gangguan atau error, kontinuitas dan ketersediaan layanan/operasi, kecocokan dan kegunaan sesuai dengan pihak ketiga atau layanan lainnya, kecocokan sesuai dengan tujuan tertentu, hak privasi, dan tidak adanya pelanggaran hak pihak ketiga atas Situs/ layanan yang KUPESAN.ID berikan;<br>
                                                b)	Kesalahan, kelalaian, atau ketidakakuratan dalam materi, isi, pesan, transmisi atau tindakan, baik yang dipasang, dikirim melalui surat elektronik, disebarkan, dikirimkan, diiklankan, ditawarkan atau yang terdapat pada Situs (baik oleh KUPESAN.ID atau pihak ketiga melalui Situs);<br>
                                                c)	Akses ilegal pada atau penggunaan Situs, server, data, atau informasi KUPESAN.ID;<br>
                                                d)	Penghentian atau gangguan transmisi ke atau dari Situs;<br>
                                                e)	Virus komputer, Worms, Trojan Horses, atau malware lainnya, atau melalui akses tanpa izin atau pembebanan kapasitas jaringan, baik yang disebarkan ke atau melalui Situs, baik karena tindakan pihak ketiga atau kondisi lainnya;<br>
                                                f)	Transaksi atau transmisi antara Anda dan pihak ketiga yang meyediakan produk atau layanan dalam bentuk dan medium apapun;<br>
                                                g)	Penyalahgunaan, pelecehan, penguntitan, ancaman, pencemaran nama baik, dan pengiriman, materi, isi, pesan, transmisi atau tindakan yang bersifat ofensif, melanggar, atau ilegal oleh pengguna Situs.
                                               </p></li>
                                               <li><p>Anda mengakui dan menyetujui sepenuhnya sesuai dengan hukum yang berlaku, bahwa tidak dalam keadaan apapun, KUPESAN.ID beserta pejabat, direktur, karyawan, dan agennya bertanggung jawab atas bentuk kerusakan, kerugian, atau cedera lainnya yang bersifat langsung atau tidak langsung, kebetulan, khusus, umum, menghukum, memperingatkan, dan konsekuensial, termasuk namun tidak terbatas pada kerugian profit, korupsi, kehilangan data, kegagalan transmisi data atau gangguan operasi terlepas dari the Theory of Liability (kontrak, kesalahan, dain lainnya) yang timbul sebagai akibat dari dan sehubungan dengan Situs dan dari penggunaan atau ketidakmampuan penggunaan, termasuk namun tidak terbatas pada;<br>
                                                a)	Ketepatan, kelengkapan, kualitas kepuasan, layanan/operasi bebas gangguan atau error, kontinuitas dan ketersediaan layanan/ operasi, kecocokan dan kegunaan sesuai dengan pihak ketiga atau layanan lainnya, kecocokan sesuai dengan tujuan tertentu, hak privasi, dan tidak adanya pelanggaran hak pihak ketiga atas Situs/ layanan yang KUPESAN.ID berikan;<br>
                                                b)	Kesalahan, kelalaian, atau ketidakakuratan dalam materi, isi, pesan, transmisi atau tindakan, baik yang dipasang, dikirim melalui surat elektronik, disebarkan, dikirimkan, diiklankan, ditawarkan atau yang terdapat pada Situs (baik oleh KUPESAN.ID atau pihak ketiga melalui Situs);<br>
                                                c)	Akses ilegal pada atau penggunaan Situs, server, data, atau informasi KUPESAN.ID;<br>
                                                d)	Penghentian atau gangguan transmisi ke atau dari Situs;<br>
                                                e)	Virus komputer, Worms, Trojan Horses, atau malware lainnya, atau melalui akses tanpa izin atau pembebanan kapasitas jaringan, baik yang disebarkan ke atau melalui Situs, baik karena tindakan pihak ketiga atau kondisi lainnya;<br>
                                                f)	Transaksi atau transmisi antara Anda dan pihak ketiga yang meyediakan produk atau layanan dalam bentuk dan medium apapun;<br>
                                                g)	Penyalahgunaan, pelecehan, penguntitan, ancaman, pencemaran nama baik, dan pengiriman, materi, isi, pesan, transmisi atau tindakan yang bersifat ofensif, melanggar, atau ilegal oleh pengguna Situs.
                                               </p></li>
                                               <li><p>Anda setuju untuk mengganti kerugian sepenuhnya, sesuai dengan hukum yang berlaku, KUPESAN.ID beserta pejabat, direktur, karyawan, dan agennya dari dan terhadap setiap dan semua gugatan, kerusakan, kewajiban, kehilangan, ganti rugi, hutang dan/atau biaya lain sebagai akibat dari penggunaan Situs, pelanggaran Anda terhadap Syarat dan Ketentuan Penggunaan dan hak pihak ketiga dalam kondisi apapun, termasuk namun tidak terbatas pada hak cipta, kekayaan intelektual, hak privasi/properti.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse20" data-parent="#accordion"><h4 class="panel-title">   Biaya dan Pajak</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse20" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>KUPESAN.ID berhak, dalam kebijakan mutlaknya, mengenakan biaya kepada Konsumen/PARTNER-KU untuk layanan yang diberikan KUPESAN.ID dan penggunaan Situs, termasuk namun tidak terbatas pada biaya untuk menghubungi Pengguna Layanan, menanggapi permohonan/pengajuan dari Pengguna Layanan, atau melakukan transaksi dengan Pengguna Layanan melalui KUPESAN.ID. KUPESAN.ID berhak, dalam kebijakan mutlaknya, untuk mengenakan biaya atas fasilitas dan penggunaan Situs dan Anda setuju untuk membayar biaya sesuai dengan jumlah yang ditetapkan oleh KUPESAN.ID dan atau yang ditetapkan dari waktu ke waktu.</p></li>
                                               <li><p>KUPESAN.ID bertindak semata-mata sebagai platform online untuk menghubungkan Konsumen dengan PARTNER-KU untuk tujuan transaksi (menerima dan memberikan layanan/jasa). KUPESAN.ID sendiri bukan merupakan PARTNER-KU atau Konsumen dan tidak bertanggung jawab untuk membayar pajak atau tunduk pada hukum yang berkenaan dengan pajak untuk transaksi, penjualan, atau layanan yang disediakan oleh PARTNER-KU kepada Konsumen. Anda memahami, mengakui, dan menyetujui bahwa Anda bertanggung jawab sepenuhnya atas pelaporan pajak Anda dan berkewajiban untuk mematuhi hukum yang berlaku.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse21" data-parent="#accordion"><h4 class="panel-title">   Tidak Terlibat Agen / Partai / Persekutuan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse21" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <ul>
                                               <li><p>Anda mengakui dan menyetujui bahwa KUPESAN.ID BUKAN merupakan sebuah pihak/partai untuk perjanjian lisan atau tertulis, atau perjanjian atau kontrak yang dibuat antara Konsumen dan PARTNER-KU sehubungan dengan layanan yang tersedia, secara langsung atau tidak langsung, melalui Situs.</p></li>
                                               <li><p>Tidak ada agensi, kemitraan, usaha patungan, atau jabatan yang terbentuk dari Syarat dan Ketentuan Penggunaan maupun penggunaan Situs dan bagian daripadanya. Anda tidak memiliki wewenang untuk mengikat KUPESAN.ID dalam hal apapun. Semua PARTNER-KU bersifat independen/berdikari. KUPESAN.ID ataupun pengguna Situs tidak mengatur atau mengontrol aktivitas sehari-hari, atau membuat dan menjalankan kewajiban atas nama pengguna lainnya.</p></li>
                                           </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse22" data-parent="#accordion"><h4 class="panel-title">   Seluruh Persyaratan</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse22" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <p>Syarat dan Ketentuan Penggunaan beserta Kebijakan Privasi atau Kebijakan Tambahan lainnya yang diterbitkan oleh KUPESAN.ID pada Situs merupakan seluruh perjanjian antara Anda dan KUPESAN.ID mengenai Situs ini. Jika ada kententuan dalam Syarat dan Ketentuan Penggunaan yang dianggap tidak sah oleh pengadilan atau pihak yang berwenang, ketidaksahan ketentuan tersebut tidak akan mempengaruhi Syarat dan Ketentuan Penggunaan sah lainnya dan akan tetap berlaku sepenuhnya.</p>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse23" data-parent="#accordion"><h4 class="panel-title">   Peraturan Pemerintah</h4></a>
                                    </div><!-- end panel-heading -->
                                    
                                    <div id="collapse23" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <p>Syarat dan Ketentuan Penggunaan akan diatur oleh Hukum Indonesia dan Anda setuju untuk tunduk pada yurisdiksi pengadilan Indonesia dalam hal gugatan atau sengketa.</p>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->

                            </div><!-- end faq-block -->
                        </div><!-- end columns -->
                        
                    </div><!-- end row -->
                </div><!-- end container -->   
            </div><!-- end faq-page -->
        </section><!-- end innerpage-wrapper -->

        <!--======================= FOOTER =======================-->
<section id="footer" class="ftr-heading-o ftr-heading-mgn-1">
        
    <div id="footer-top" class="banner-padding ftr-top-grey ftr-text-white">
        <div class="container">
            <div class="row">
                
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-widget ftr-contact">
                    <div id="abt-cnt-2-img">
                        <img src="{{ URL::asset('dist/images/logo-navbar.png') }}" class="img-responsive" alt="about-img" />
                    </div>
                </div><!-- end columns -->
                
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-widget ftr-links ftr-pad-left">
                    <h3 class="footer-heading">Social Media</h3>
                    <ul class="social-links list-unstyled list-unstyled">
                        <li><a href="https://www.facebook.com/Kupesan.ID/" target="_blank"><span><i class="fa fa-facebook"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; Kupesan.ID </a></li>
                        <li><a href="https://twitter.com/Kupesan_ID" target="_blank"><span><i class="fa fa-twitter"></i></span>&nbsp;&nbsp;&nbsp;&nbsp; @Kupesan.id</a></li>
                        <li><a href="https://www.instagram.com/kupesan.id/" target="_blank"><span><i class="fa fa-instagram"></i></span>&nbsp;&nbsp;&nbsp;&nbsp; Kupesan_ID</a></li>
                        <li><a href="https://id.pinterest.com/Kupesan_ID/" target="_blank"><span><i class="fa fa-pinterest"></i></span>&nbsp;&nbsp;&nbsp;&nbsp; Kupesan_ID</a></li>
                        <li><a href="#"><span><i class="fa fa-whatsapp"></i></span>&nbsp;&nbsp;&nbsp;&nbsp; +6282 233-610-702</a></li>

                    </ul>
                </div><!-- end columns -->
                
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-widget ftr-links ftr-pad-left">
                    <h3 class="footer-heading">Resources</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('login') }}">Log-In</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{route('jadi.mitra')}}">Register PARTNER-KU</a></li>
                    </ul>
                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-widget ftr-about">
                    <h3 class="footer-heading">About US</h3>
                    <p style="text-align: justify;">KUPESAN.ID adalah sebuah marketplace online yang ingin membawa perubahan dalam bentuk memudahkan masyarakat untuk mencari persewaan spot foto (dalam atau luar ruangan), persewaan busana, penyedia jasa fotografer, serta penyedia jasa penata rias (make-up artist).</p>
                    
                </div><!-- end columns -->
                
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end footer-top -->

    <div id="footer-bottom" class="ftr-bot-black" >
        <div class="container" style="color: white;">
            <div class="row" >
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="copyright" >
                    <p>© 2018 <a href="home">Kupesan.id</a> | All rights reserved.</p>
                </div><!-- end columns -->
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="terms">
                    <ul class="list-unstyled list-inline">
                        <li><a href="{{ route('term') }}">Terms & Condition</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end footer-bottom -->
    
</section><!-- end footer -->
        
        
        <!-- Page Scripts Starts -->
        <script src="{{URL::asset('dist/js/jquery.min.js') }}"></script>
        <script src="{{URL::asset('dist/js/jquery.colorpanel.js') }}"></script>
        <script src="{{URL::asset('dist/js/bootstrap.min.js') }}"></script>
        <script src="{{URL::asset('dist/js/custom-navigation.js') }}"></script>
        <!-- Page Scripts Ends -->
    </body>
</html>
