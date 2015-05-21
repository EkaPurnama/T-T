<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
<?php
$ret = DB::table('spd_setting')->select('nama_skpd')->get();
echo $ret[0]->nama_skpd;
?>
</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<style>
    body {
        padding-top: 50px;
        padding-bottom: 20px;
    }
</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-multiselect.css">
<link rel="stylesheet" href="css/bootstro.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/pace.css">
<link rel="stylesheet" href="css/prettify.css">
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/material-fullpalette.min.css">
<link rel="stylesheet" href="css/ripple.min.css">
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>