<html>
<head>
<title>Kota Malang</title>
	<style type="text/css">
body{
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.container{
	margin: 0 auto;
	margin-top: 120px;
	width: 280px;
	height: 320px;
	padding: 40px;
	background: #f1f1f1;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.bordered-container{
	width: 280px;
	height: 320px;
	margin: 0 auto;
	}
form{
	width: 280px;
	margin: 0 auto;
	position: absolute;
	top: 340px;
}
form input{
	-moz-appearance: none;
	-webkit-appearance: none;
	appearance: none;
	display: inline-block;
	height: 36px;
	padding: 0 8px;
	background: #fff;
	border: 1px solid #d9d9d9;
	border-top: 1px solid #c0c0c0;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	-moz-border-radius: 1px;
	-webkit-border-radius: 1px;
	border-radius: 1px;
	font-size: 15px;
	color: #404040;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	cursor: auto;
	font: -webkit-small-control;
	color: initial;
	letter-spacing: normal;
	word-spacing: normal;
	text-transform: none;
	text-indent: 0px;
	text-shadow: none;
	display: inline-block;
	text-align: start;
	direction: ltr;
	height: 44px;
}
form input:focus{
	outline: none;
	border: 1px solid #4d90fe;
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
	box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
	outline-offset: -2px;
}
.input{
	position: absolute;
	border:none;
	box-shadow: 0 0 2px darkgray;
	width: 100%;
	display: block;
	z-index: 1;
	position: relative;
	box-sizing: border-box;
}
.input.top{
	border-radius: 2px 2px 0 0 ;
}
.input.bottom{
	border-radius: 0 0 2px 2px;
}
.submit{
	box-sizing:border-box;
	width: 100%;
	text-align: center;
	margin-top: 15px;
	border: 1px solid #3079ed;
	color: #fff;
	text-shadow: 0 1px rgba(0,0,0,0.1);
	background-color: #4d90fe;
	background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
	border-radius: 3px;
	font-weight: lighter;
	font-size: large;
	-webkit-font-smoothing: antialiased !important;
}
.round{
	margin: 0 auto;
	width: 160px;
	height: 160px;
	border-radius: 50%;
	overflow: hidden;
	background-color: lightgray;
}
.mini-circle{
	margin: 0 auto;
	margin-top: 24px;
	width: 60px;
	height: 60px;
	border-radius: 50%;
	background-color: whitesmoke;
}
.mini-rounded{
	margin: 0 auto;
	margin-top: 10px;
	width: 100px;
	height: 100px;
	background-color: whitesmoke;
	border-radius: 50px/25px;
}
.sign{
	position: absolute;
	font-family: Segoe UI;
	top: 80px;
	color: #555;
}
.sign h2{
	font-size: 18px;
	margin: 0 auto;
	font-weight: lighter;
}
h5{
	position: absolute;
	top: 0;
	color: #900;
}


	</style>
</head>
<body>
	<div class="container">
	<div class="sign">
	<h2>Masuk untuk melanjutkan ke Aplikasi</h2>
	<h5>@if($message = Session::get('fail')){{ $message }}@endif</h5>
	</div>
		<div class="bordered-container">
		<div class="round">
			<div class="mini-circle"></div>
			<div class="mini-rounded"></div>
		</div>
		<form action="login" method="post">
			<input class="input top" type="text" autocomplete="off" name="username" required placeholder="Nama Akun">
			<input class="input bottom" type="password" autocomplete="off" name="password" required placeholder="Kata Sandi">
			<input class="submit" type="submit" value="Masuk">
		</form>
		</div>
	</div>
</body>
</html>