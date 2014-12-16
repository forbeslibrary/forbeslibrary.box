<?php
/* editor-style-css.php
  Weaver II Theme - Copyright 2011, Bruce E Wampler

	Dynamically generate CSS for tinyMCE. This is called from the tinyMCE script.
	When this file is invoked, there is no context at all. There is no access to any
	WordPress functions - nothing.
	Since there really are not very many options needed to get the editor to match
	a post or content area, parameters are passed via $_GET.
	Note that all this is desireable to avoid having to create an actual override
	file since the WordPress theme requirements don't allow the use of fopen or fwrite.
	This turns out to be much easier, anyway.
*/

function weaverii_mce_opt($opt) {
	if (isset($_GET[$opt]))
        return urldecode($_GET[$opt]);
	else
        return false;
}

header( 'Content-type: text/css' ); // gotta honor HTTP protocol for css


if (($val=weaverii_mce_opt('fontsize'))) {
	// hand tuned font size conversion
	//                0   1   2   3   4   5     6   7    8    9    10   11   12   13
	$convert = array('1','2','3','4','5','6.5','8','9','10.5','12','13','15','16','17',
			 '19', '20','21','23','24','25','27');
		//   '14', '15','16','17','18','19','20'
	if ($val > 0 && $val <= 20)
        $val = $convert[(int)$val];
	else
        $val = round($val * 1.333, 0 , PHP_ROUND_HALF_UP);// need to adjust to MCE. Don't exactly know why, but this works.
	echo "label,th,thead th,tr,td,.mceContentBody,body{font-size:" . $val . "px;}\n";
}

if (($val=weaverii_mce_opt('twidth'))) {
	echo "html .mceContentBody {width:" . $val . "px;}\n";
}

if (($val=weaverii_mce_opt('fontfamily'))) {
	echo ".mceContentBody,body,tr,td {font-family:" . $val . ";}\n";
}

if (($val = weaverii_mce_opt('titlefont')) != '') {
	echo "thead th, tr th {font-family:" . $val . ";}\n";
}

// tables are harder... emit before colors
   $table = weaverii_mce_opt('table');

	if ($table == 'wide') {
        echo(sprintf("table {border: 1px solid #e7e7e7;margin: 0 -1px 24px 0;text-align: left;width: 100%%;}
tr th, thead th {color: #888;font-size: 12px;font-weight: bold;line-height: 18px;padding: 9px 24px;}
#content tr td {border-style:none; border-top: 1px solid #e7e7e7; padding: 6px 24px;}
#content tr.odd td {background: #f2f7fc;}\n"));
	} elseif ($table == 'bold') {
        echo(sprintf("table {border: 2px solid #888;}
tr th, thead th {font-weight: bold;}
tr td {border: 1px solid #888;}\n"));
	} elseif ($table == 'noborders') {
        echo(sprintf("table {border-style:none;}
tr th, thead th {font-weight: bold;border-bottom: 1px solid #888;background-color:transparent;}
tr td {border-style:none;}\n"));
	} elseif ($table == 'fullwidth') {
        echo(sprintf("table {width:100%%;}
tr th, thead th {font-weight:bold;}\n"));
	} elseif ($table == 'plain') {
        echo(sprintf(
"table {border: 1px solid #888;text-align:left;margin: 0 0 0 0;width:auto;}
tr th, #content thead th {color: inherit;background:none;font-weight:normal;line-height:normal;padding:4px;}
tr td {border: 1px solid #888; padding:4px;}\n"));
	}

if (($val=weaverii_mce_opt('bg'))) {
	echo ".mceContentBody,body{background:" . $val . ";padding:10px;}\n";
}

if (($val=weaverii_mce_opt('textcolor'))) {
	echo ".mceContentBody,body, tr, td {color:" . $val . ";}\n";
}

if (($val=weaverii_mce_opt('hdgcolor'))) {
	echo "h1, h2, h3, h4, h5, h6, dt, th {color:" . $val . ";}\n";
}

if (($val=weaverii_mce_opt('inbg'))) {
	echo "input, textarea, ins, pre{background:" . $val . ";}\n";
}

if (($val=weaverii_mce_opt('incolor'))) {
	echo "input, textarea, ins, del, pre{color:" . $val . ";}\n";
}

if (($val=weaverii_mce_opt('a'))) {
	echo "a {color:" . $val . ";}\n";
}

if (($val=weaverii_mce_opt('ahover'))) {
	echo "a:hover {color:" . $val . ";}\n";
}

$val = weaverii_mce_opt('list');
if ($val != '' && $val != 'disc') {
	if ($val != 'custom') {
		echo(sprintf("ul {list-style-type:%s;}\n",$val));
	}
}

// images

if (($val=weaverii_mce_opt('imgcapt'))) {	// caption color
	echo ".wp-caption p.wp-caption-text,.wp-caption-dd {color:$val;}\n";
}
if (($val=weaverii_mce_opt('imgbcolor'))) {	// border color
	echo ".wp-caption, img {background:$val;}\n";
}
if (($val=weaverii_mce_opt('imgbwide'))) {	// width
	$caplr = $val - 5;
	if ($caplr < 0) $caplr = 0;
	echo "img {padding:" . $val . "px;}\n";
	echo(sprintf(".wp-caption{padding: %dpx %dpx %dpx %dpx;}\n", $val, $caplr, $val, $caplr));
}
?>
