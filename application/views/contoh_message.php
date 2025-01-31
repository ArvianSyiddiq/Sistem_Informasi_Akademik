<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Mercubuana University</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
			background-color: #f4f4f9;
			margin: 0;
			font-family: 'Helvetica Neue', Arial, sans-serif;
			color: #333;
			line-height: 1.6;
		}

		/* Styling untuk link */
		a {
			color: #3498db;
			text-decoration: none;
			transition: color 0.3s ease;
		}

		a:hover {
			color: #e74c3c;
		}

		/* Styling untuk judul */
		h1 {
			color: #2c3e50;
			background-color: #ecf0f1;
			border-bottom: 2px solid #bdc3c7;
			font-size: 24px;
			font-weight: bold;
			margin: 0;
			padding: 20px;
			text-align: center;
		}

		/* Styling untuk kode */
		code {
			font-family: 'Courier New', Courier, monospace;
			font-size: 14px;
			background-color: #f9f9f9;
			border: 1px solid #e1e1e1;
			border-radius: 4px;
			color: #c0392b;
			display: block;
			margin: 10px 0;
			padding: 10px;
		}

		/* Styling untuk kontainer */
		#container {
			margin: 50px auto;
			max-width: 900px;
			border: 1px solid #ddd;
			border-radius: 8px;
			background-color: #fff;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			overflow: hidden;
		}

		/* Styling untuk konten halaman */
		#body {
			padding: 20px;
		}

		p {
			margin-bottom: 20px;
		}

		/* Styling untuk footer */
		p.footer {
			text-align: right;
			font-size: 12px;
			color: #7f8c8d;
			border-top: 1px solid #ecf0f1;
			padding: 10px 20px;
			margin: 0;
			background-color: #ecf0f1;
		}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to </h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="userguide3/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
