<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Facebook Developer Circle: Lusaka Code Challenge</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->
	<p><strong>Input: 3[abc]4[ab]c</strong></p>
	<?php
		$compressed_1 = "3[abc]4[ab]c";
		function decompress($compressed_string)
		{
			while (strpos($compressed_string, "[") !== false)
			{
				// Last '[' occurrence
				$start = strrpos($compressed_string, '[');
				// First ']' occurrence after last '[' occurrence
				$end = strpos($compressed_string, ']', $start);
				// find multiplier
				// Negative start position for last '[' occurrence
				$negative_start = ($start - strlen($compressed_string)) - 1;
				$preceding_open_bracket = strrpos($compressed_string, "[", $negative_start);
				$preceding_close_bracket = strrpos($compressed_string, "]", $negative_start);
				if ($preceding_close_bracket > $preceding_open_bracket)
				{
					$preceding_bracket = $preceding_close_bracket;
				} elseif ($preceding_open_bracket > $preceding_close_bracket)
				{
					$preceding_bracket = $preceding_open_bracket;
				} else
				{
					$preceding_bracket = 0;
				}
				// multiplier for last [] group
				if ($preceding_bracket == 0)
				{
					$multiplier = substr($compressed_string, $preceding_bracket, ($start - $preceding_bracket));
				} else
				{
					$multiplier = substr($compressed_string, $preceding_bracket + 1, ($start - $preceding_bracket) - 1);
				}
				// String section to be multiplied
				$section = substr($compressed_string, ($start + 1), ($end - $start) - 1);
				// expand compressed string section
				$result = str_repeat($section, (int)$multiplier);
				// replace compressed string section with expanded string section
				if ($preceding_bracket == 0)
				{
					$compressed_string = substr_replace($compressed_string, $result, $preceding_bracket, strlen($multiplier . "[" . $section . "]"));
				} else
				{
					$compressed_string = substr_replace($compressed_string, $result, $preceding_bracket + 1, strlen($multiplier . "[" . $section . "]"));
				}
			}
			
			return $compressed_string;
		}
		echo decompress($compressed_1);
	?>
	<p><strong>Input: 19[a]</strong></p>
	<?php
		$compressed_2 = "19[a]";
		echo decompress($compressed_2);
	?>
	<p><strong>Input: 2[3[a]b]</strong></p>
	<?php
		$compressed_3 = "2[3[a]b]";
		echo decompress($compressed_3);
	?>
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <!--
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
  -->
</body>
</html>
