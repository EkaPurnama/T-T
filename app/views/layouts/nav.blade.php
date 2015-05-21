<style type="text/css">
.nav.navbar-nav>li.dropdown>a:hover{color:#900;}
.nav.navbar-nav>li.dropdown>a{color:black;}
</style>

<div class="navbar navbar-material-light-blue-600 navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      @if ($message = Session::get('fail'))
      <ul class="nav navbar-nav">
        <li data-alert="alert">
            <a id="notifier"><i class="icon-thumbs-down"></i><strong> Gagal !!!</strong> {{ $message }}</a>
        </li>
        <script type="text/javascript">
        setTimeout(function () {
          $('#notifier').alert('close');
        }, 5000);
        </script>
      </ul>
      @endif
      @if ( Auth::check() )
      <ul class="nav navbar-nav">
      @if(Request::is('setting'))
      <li class="dropdown" style="background-color:gold">
      <a href="https://github.com/dotOlab"><i class="icon-github"></i> dot&lt;O/&gt;Lab</a>
      <ul class="dropdown-menu">
          <li><a href="https://plus.google.com/108070698399445128894"> <i class="icon-google-plus"></i> Afoe Crimmson</a></li>
          <li><a href="https://plus.google.com/106801115837143597200"> <i class="icon-google-plus"></i> Shinta Re</a></li>
          <li><a href="https://plus.google.com/110376675498415697878"> <i class="icon-google-plus"></i> Ismi Gheantaka Yuda</a></li>
          <li><a href="https://plus.google.com/112200931161944094089"> <i class="icon-google-plus"></i> Azimi Faqqihuddin Arsyad</i></a></li>
          </ul>
      </li>
      @endif
      @if(Request::is('/'))


@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
             
        $("#demo2").click(function(){
        bootstro.start(".demo2");    
    });

  })
</script>
@stop      


        
    <li class="dropdown demo2" 
    data-bootstro-step="0" 
    data-bootstro-title="Buat SPD baru !"
    data-bootstro-content="Selamat Datang di mode Trial, Hubungi Pengembang jika ingin mendapatkan versi <b>Kendali Penuh.<br><br></b>Tombol ini berfungsi untuk membuat Surat Perintah Perjalanan Dinas baru. Di dalamnya terdapat dua jenis surat perintah perjalanan dinas, yaitu '<b>UMUM</b>' dan '<b>KHUSUS</b>'."
    data-bootstro-placement="bottom" style="top:30px">
      <a style="cursor:pointer;" class="btn btn-material-light-blue-100 btn-fab dropdown-toggle">
        <i class="mdi-content-add"></i>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="#"
          data-toggle="modal" 
          data-target="#form_spd" 
          data-dismiss="modal"
          data-jenis="umum"
          data-id-baru="{{ $idbaru }}"
          onclick="formColor('bg-hijau')">
            <i class="icon-user"></i>
            SPD Umum
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#"
          data-toggle="modal" 
          data-target="#form_spd" 
          data-dismiss="modal"
          data-jenis="khusus"
          data-id-baru="{{ $idbaru }}"
          onclick="formColor('bg-biru')">
            <i class="icon-user-3"></i>
            SPD Khusus
          </a>
        </li>
      </ul>
    </li>
        @endif
        <li><img style="margin-left:15px" width="48px" height="50px" class="brand2" src="img/km.png"></li>
        <li id="nama_skpd">
          <a style="color:white"> Aplikasi SPD | 
          <?php
          $ret = DB::table('spd_setting')->select('nama_skpd')->get();
          echo $ret[0]->nama_skpd;
          ?></a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(Request::is('/'))
        <li>
           <div id="demo2" class="btn btn-material-amber-600 demo2" style="margin-top: 10px;margin-right: 10px"
           data-bootstro-step="5"
           data-bootstro-content="Untuk Mengekspor data pada monitor, dapat dilakukan dengan cara :<br><br>1. klik tombol <b>OPSI</b> pada baris data yang ingin anda eksekusi.<br>2. pilih <code class='alert-info'>Detail</code>.<br>3. klik tombol <code class='alert-info'>Ekspor Data</code>."
           data-bootstro-placement="bottom">
          <i class="icon-help"></i>
          Panduan
          </div>
        </li>
      @endif
        <li class="{{ (Request::is('/') ? 'active' : '') }}">
          <a href="/"
          class="demo2"
          data-bootstro-step="1" 
          data-bootstro-title="Monitor."
          data-bootstro-content="Monitor memuat konten <b>Table Monitoring</b>, memudahkan anda dalam hal monitoring Surat Perjalanan Dinas secara langsung."
          data-bootstro-placement="bottom">
            <i class="icon-monitor"></i>
            Monitor
          </a>
        </li>
        <li class="{{ (Request::is('setting') ? 'active' : '') }}">
          <a href="/setting"
          class="demo2"
          data-bootstro-step="2" 
          data-bootstro-title="Pengaturan."
          data-bootstro-content="Anda Masih dalam mode Trial. Untuk sementara Fitur ini tidak dapat diakses."
          data-bootstro-placement="bottom">
            <i class="icon-cog"></i>
            Pengaturan
          </a>
        </li>
        <li class="demo2"
          data-bootstro-step="6" 
          data-bootstro-title="Logout."
          data-bootstro-content="Tombol ini berfungsi untuk mengeluarkan akun anda dari otoritas aplikasi. Jangan pernah meninggalkan aplikasi dalam keadaan ter'<b>Sign in</b>' untuk mencegah tindakan - tindakan yang tidak bertanggung jawab."
          data-bootstro-placement="bottom">
          <a href="{{ URL::to('logout') }}">
            <i class="icon-exit"></i>
            Keluar</a> 
        </li>
      </ul>
        @else
        <ul class="nav navbar-nav navbar-right">
          <li class="input-group">
            <div class="col-sm-12 col-md-12 pull-right">
              <form class="navbar-form" action="login" method="post">
                <div class="input-group">
                  <div class="row demo1"
                      data-bootstro-title="Sudah mempunyai akun ?" 
                      data-bootstro-content="Jika sudah mempunyai akun, masukan <b>Nama Akun</b> dan <b>Kata Sandi</b> anda pada bidang yang sudah ditentukan. Dan nikmati <b>*seluruh fitur</b> yang tersedia. Setelah bidang <b>Nama Akun</b> dan <b>Kata Sandi</b> sudah terisi dengan benar, langkah selanjutnya adalah Login meggunakan tombol <i class='icon-enter'></i>."
                      data-bootstro-placement="bottom" data-bootstro-step="2">
                    <input type="text" required class="form-control" autocomplete="off" placeholder="Nama Akun" name="username">
                    <input type="password" required class="form-control" autocomplete="off" placeholder="Kata Sandi" name="password">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit">Masuk <i class="icon-enter"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </li>
        </ul>
        @endif
    </nav>
  </div>
</div>
<div class="clearfix" style="height:20px">
</div>
