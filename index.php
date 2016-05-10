<?php
	$sTemplate = "<div class='container'><p><a href='{NAME}'>{NAME}</a></p>{SUBDIR}</div>";

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
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
	<?php foreach (scandir(__DIR__) AS $sDir) : ?>
		<?php if ($sDir !== "." && $sDir !== "..") : ?>
			<?php $_sSubdir = ""; ?>
			<?php if (is_dir(__DIR__."/".$sDir)) : ?>
				<?php foreach (scandir(__DIR__."/".$sDir) AS $sSubdir) : ?>
					<?php if ($sSubdir !== "." && $sSubdir !== "..") : ?>
						<?php $_sSubdir = " - <a href='".$sDir."/".$sSubdir."'>".$sSubdir."</a><br />"; ?>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php
					$_sTmpOutput = str_replace("{NAME}", $sDir, $sTemplate);
					$_sTmpOutput = str_replace("{SUBDIR}", $_sSubdir, $_sTmpOutput);
					echo $_sTmpOutput;
				?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</body>
</html>