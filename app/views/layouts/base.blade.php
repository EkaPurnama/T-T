<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
@include('layouts.head')
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
    @include('layouts.nav')
    <div class="container">
        @yield('content')
        <footer class="clearfix">
            <hr>
            <p><strong><?php
$ret = DB::table('spd_setting')->select('kode_skpd','nama_skpd')->get();
echo $ret[0]->nama_skpd." | (".$ret[0]->kode_skpd.")";
?></strong><span class="pull-right" style="text-align:right"><i class="icon-history"></i> Masa trial aplikasi ini tersisa <span id="trialtime" class="badge"></span> hari lagi<br>Hak cipta dilindungi, <strong>&copy; <a href="https://github.com/dotOlab" style="text-decoration:none">dot&lt;O/&gt;Lab</a>, Malang, Jawa Timur. 2014</strong></span></p>
            
        </footer>
    </div>
{{ HTML::script('js/vendor/jquery-2.1.0.min.js') }}
{{ HTML::script('js/vendor/doT.min.js') }}
{{ HTML::script('js/vendor/bootstrap.min.js') }}
{{ HTML::script('js/vendor/bootstrap-multiselect.js') }}
{{ HTML::script('js/vendor/prettify.js') }}
{{ HTML::script('js/vendor/material.min.js') }}
{{ HTML::script('js/vendor/ripple.min.js') }}
{{ HTML::script('js/jquery.hotkeys.js') }}
{{ HTML::script('js/pace.js') }}
{{ HTML::script('js/bootstro.min.js') }}
@if( Auth::check() )
@if(Request::is('/'))
{{ HTML::script('js/dotOLab.js') }}
@endif
@endif
    <div id="static_zone">
        @include('layouts.foot')
    </div>
    @yield('scripts')

    <script type="text/javascript">
$(document).ready(function () {
<?php 
if($bools = Session::get('bulan')){
    echo "takeDot(".$bools.");";
    echo "bulanizer(".$bools.")";
}else{
    echo "takeDot();";
    echo "bulanizer(".date_format(date_create(date('Y-m-d')),'m').")";
}
?> 
});
<?php 
$startTimeStamp = $_SERVER['REQUEST_TIME'];
$endTimeStamp = strtotime("2014/04/28");

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  // 86400 seconds in one day

// and you might want to convert to integer
$numberDays = intval($numberDays);
?>
$('span#trialtime').html(<?php echo $numberDays ?>);
    </script>
</body>
</html>