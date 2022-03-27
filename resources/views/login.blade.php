@extends('layout')

@section('content')
    <div class="body-login">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10 my-5">
                            <div class="row justify-content-center px-3 mb-3"> 
                                <img id="logo" src="{{asset('assets/bogor.png')}}"> 
                            </div>
                            <h3 class="mb-5 text-center heading">Aspirasi Masyarakat</h3>
                            <h6 class="msg-info">Silahkan untuk login terlebih dahulu</h6>
                            @if ($message = Session::get('failed'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal! </strong>{{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form method="POST" action="{{route('authenticate')}}">
                            @csrf
                            <div class="form-group"> 
                                <label class="form-control-label text-muted" for="username">Username</label> 
                                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan Username" class="form-control"> 
                                <small class="text-danger">@error('username'){{ $message }}@enderror</small>
                            </div>
                            <div class="form-group"> 
                                <label class="form-control-label text-muted" for="password">Password</label> 
                                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Masukkan Password" class="form-control"> 
                                <small class="text-danger">@error('password'){{ $message }}@enderror</small>
                            </div>
                            <div class="row justify-content-center my-3 px-3"> 
                                <button class="btn-block btn-color" type="submit">Login</button> 
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card card2">
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <h3>Informasi</h3> 
                        <small>Pendaftaran akun hanya dapat dilakukan oleh pihak adminisitrasi kabupaten Bogor. Login hanya diperuntukkan bagi para pegawai yang telah memiliki akun terdaftar. Mohon untuk menghubungi pihak administrasi apabila terdapat kesalahan pada akun.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection