<?php
	$sTemplate 		= "<div class='container'><p><a href='?dir={DIR}/{NAME}'>{NAME}</a></p>{SUBS}</div>";
	$sSubTemplate	= " - <a href='{DIR}{SUB}'>{SUB}</a><br />";
	$sCurrend = __DIR__;
	if (isset($_GET["dir"]) && !empty($_GET["dir"])) {
		$sCurrend .= "/".$_GET["dir"];
	}
	
	function getSubfolderTemplate($sDir) {
		global $sSubTemplate;
		
		$sOutput = "";
		foreach (scandir($sDir) AS $sSubdir) {	
			if ($sSubdir !== "." && $sSubdir !== "..") {
				if (is_dir($sSubdir)) {
					$sSubdir = "/".$sSubdir;
				}
				$_sTpl		= str_replace("{DIR}", $sDir, $sSubTemplate);
				$sOutput	.= str_replace("{SUB}", $sSubdir, $_sTpl);
			}
		}
		return $sOutput;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>fancaDirectoryView</title>
	<style type="text/css">
		body {
			margin: 0;
		}
		nav {
			background-color: #E1E1E1;
    		margin: 0;
    		min-height: 30px;
    		padding: 10px 60px 0;
		}
		nav #current {
			float: left;
		}
		nav #back {
			float: right;
		}		
		div.container {
			width: 20%;
			margin-left: 3%;
			margin-top: 20px;
			float: left;
			border: solid black 1px;
			min-height: 100px;
			padding: 5px;
		}
		.container p {
			width: 100%;
			text-align: center;
			margin: 0;
		}
	</style>
</head>
<body>
	<nav>
		<div id="current">Current: <?php echo str_replace(__DIR__."/", "", $sCurrend); ?></div>
		<div id="back"><a href="#" onClick="window.history.back();"><<<</a></div>
	</nav>

	<?php // current directory
		$_sTmpOutput = str_replace("{DIR}", "", $sTemplate);
		$_sTmpOutput = str_replace("{NAME}", "", $_sTmpOutput);
		$_sTmpOutput = str_replace("{SUBS}", getSubfolderTemplate($sCurrend), $_sTmpOutput);
		echo $_sTmpOutput;
	?>

	<?php // Subfolder ?>
	<?php foreach (scandir($sCurrend) AS $sDir) : ?>
		<?php if (strpos($sDir, ".") === false || strpos($sDir, ".") >= 1) : ?>
			<?php if (is_dir($sCurrend."/".$sDir)) : ?>
				<?php $_sSubdir = getSubfolderTemplate($sCurrend."/".$sDir); ?>
				<?php
					$_sTmpOutput = str_replace("{DIR}", str_replace(__DIR__, "", $sCurrend), $sTemplate);
					$_sTmpOutput = str_replace("{NAME}", $sDir, $_sTmpOutput);
					$_sTmpOutput = str_replace("{SUBS}", $_sSubdir, $_sTmpOutput);
					echo $_sTmpOutput;
				?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</body>
</html>