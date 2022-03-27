<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pengaduan Masyarakat</title>
        <link rel="shortcut icon" href="{{asset('assets/bogor.png')}}" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('styles.css')}}">
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Raleway:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <!-- header -->
        <header>
            <div class="navigation-container">
                <div class="top-head">
                    <div class="web-name">
                        <h3>Aspirasi Masyarakat Kab. Bogor</h3>
                        <a href="{{route('check_for_login')}}" class="a-nav">Administrator</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="banner">
            <div class="banner-main-content">
                <h2>BAGAIMANA CARA MENYAMPAIKAN ASPIRASI SAYA?</h2>
                <h3>Berikut tahapan yang dapat anda lakukan untuk menyampaikan aspirasi secara online :</h3>

                <div class="current-news-head">
                    <h3>Kunjungi bagian "Buat Pengaduan",<a href="#section-two">atau klik disini</a></h3>

                    <h3>Mengisi data diri anda secara lengkap dan benar,</h3>

                    <h3>Mengisi formulir pengaduan secara jelas dan terperinci,</h3>

                    <h3>Pastikan semua data terisi secara benar,</h3>

                    <h3>Klik tombol "Kirim Pengaduan",</h3>

                    <h3>Apabila berhasil terkirim, maka akan terdapat kotak hijau bertanda "berhasil" pada bagian atas "Buat Pengaduan".</h3>
                </div>
            </div>

            <div class="banner-sub-content">
                <article>
                    <img src="{{asset('assets/spanduk-bg.png')}}">

                    <div>
                        <h3>Terdapat Permasalahan Pembangunan dan Pelayanan Publik di Kabupaten Bogor?</h3>

                        <p>Laporkan permasalahan di laman resmi kami. Ikuti tahapannya dan kami akan secara profesional menerima dan mengevaluasi aspirasi anda.</p>
                    </div>
                </article>
            </div>
        </section>
        
        <hr>

        <main>
            <section class="main-container-left" id="section-two">
                <h2>Buat Pengaduan</h2>
                <div class="container-left">
                    <div class="outer-card">
                        @if ($message = Session::get('success'))
                            <div class="alert success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                <strong>Berhasil!</strong> {{$message}}
                            </div>
                        @endif
                        <form class="forms" method="post" action="{{route('report.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-items"> 
                                <span>NIK</span> 
                                <input placeholder=".... .... .... ...." data-slots="." data-accept="\d" size="19" name="nik" value="{{ old('nik') }}" {{ !auth()->user() ? '' : 'disabled'}}> 
                                <span class="text-danger">@error('nik'){{ $message }}@enderror</span>
                            </div>
                            <div class="input-items"> 
                                <span>Nama Lengkap</span> 
                                <input type="text" placeholder="Fema Flamelina Putri" name="name" value="{{ old('name') }}" {{ !auth()->user() ? '' : 'disabled'}}> 
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                            <div class="input-items"> 
                                <span>No. Telp</span> 
                                <input type="text" placeholder="08----------" name="telp" value="{{ old('telp') }}" {{ !auth()->user() ? '' : 'disabled'}}> 
                                <span class="text-danger">@error('telp'){{ $message }}@enderror</span>
                            </div>
                            <div class="input-items"> 
                                <span>Pengaduan/Aspirasi</span> 
                                <textarea rows="5" name="message" {{ !auth()->user() ? '' : 'disabled'}}>{{ old('message') }}</textarea> 
                                <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                            </div>
                            <div class="input-items"> 
                                <span>Upload Gambar Terkait</span> 
                                <input type="file" class="custom-file-input" name="image" {{ !auth()->user() ? '' : 'disabled'}}>
                                <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                            </div>
                            <div class="input-buttons"> 
                                <button type="submit" {{ !auth()->user() ? '' : 'disabled'}}>Kirim Pengaduan</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="main-container-right">
                <h2>Aspirasi dan Pengaduan</h2>
                @foreach ($data as $report)
                <article>
                    <div>
                        <h5 class="report-title capitalize">{{$report['date']}} : {{$report['citizen']['name']}}</h5>

                        <p class="report-desc">{{$report['message']}}</p>

                        <a href="{{route('report.show', $report['id'])}}">Selengkapnya <span>>></span></a>
                    </div>
                    <img src="{{asset('images/'.$report['nik'].'/'.$report['image'])}}">
                </article>
                @endforeach
                @if (count($data) > 5)
                    <a href="{{route('report.all')}}" class="see-all">Lihat Seluruh Pengaduan</a>
                @endif
            </section>
        </main>

        <footer>
            <p>Copyright &copy; 2022</p>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
                    const pattern = el.getAttribute("placeholder");
                    const slots = new Set(el.dataset.slots || "_");
                    const prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0);
                    const first = [...pattern].findIndex(c => slots.has(c));
                    const accept = new RegExp(el.dataset.accept || "\\d", "g");
                    const clean = input => {
                        input = input.match(accept) || [];
                        return Array.from(pattern, c =>
                            input[0] === c || slots.has(c) ? input.shift() || c : c
                        );
                    };
                    const format = () => {
                        const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                            i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                            return i<0? prev[prev.length-1]: back? prev[i-1] || first: i; 
                        }); 
                        el.value=clean(el.value).join``; 
                        el.setSelectionRange(i, j); back=false; 
                    }; 
                    let back=false; 
                    el.addEventListener("keydown", (e)=> back = e.key === "Backspace");
                    el.addEventListener("input", format);
                    el.addEventListener("focus", format);
                    el.addEventListener("blur", () => el.value === pattern && (el.value=""));
                }
            });
        </script>
    </body>
</html>