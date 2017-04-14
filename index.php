<?php 
$file = $_GET['file']; 
$fullPathFile = "case" . DIRECTORY_SEPARATOR . $file; 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="assets/lib/codemirror.css">
	<link rel="stylesheet" href="assets/addon/fold/foldgutter.css">
	<link rel="stylesheet" href="assets/addon/dialog/dialog.css">
	<link rel="stylesheet" href="assets/theme/monokai.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="assets/lib/codemirror.js"></script>
	<script src="assets/addon/search/searchcursor.js"></script>
	<script src="assets/addon/search/search.js"></script>
	<script src="assets/addon/dialog/dialog.js"></script>
	<script src="assets/addon/edit/matchbrackets.js"></script>
	<script src="assets/addon/edit/closebrackets.js"></script>
	<script src="assets/addon/comment/comment.js"></script>
	<script src="assets/addon/wrap/hardwrap.js"></script>
	<script src="assets/addon/fold/foldcode.js"></script>
	<script src="assets/addon/fold/brace-fold.js"></script>
	<script src="assets/mode/php/php.js"></script>
	<script src="assets/mode/htmlmixed/htmlmixed.js"></script>
	<script src="assets/mode/xml/xml.js"></script>
	<script src="assets/mode/javascript/javascript.js"></script>
	<script src="assets/mode/css/css.js"></script>
	<script src="assets/mode/clike/clike.js"></script>
	<script src="assets/keymap/sublime.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style type="text/css">
		.CodeMirror {border-top: 1px solid #eee; border-bottom: 1px solid #eee; line-height: 1.3; height: 500px}
		.CodeMirror-linenumbers { padding: 0 8px; }
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> PHP Playground</a>
				<form target="preview" action="preview.php" method="POST" id="sourceForm" class="navbar-form navbar-left">
					<div class="form-group">
						<textarea id="sourceTextareaForm" name="source" style="display:none;"></textarea>
						<input type="text" name="file" value="<?php echo $file ?>" class="form-control" placeholder="filename"/>
					</div>
				</form>

				<button id="save" type="button" class="btn btn-default navbar-btn">Run</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Existing cases <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php

							$rootDir = "case";
							$files = scandir($rootDir);

							foreach ($files as $file) 
							{
								if ($file != "." && $file != "..") 
								{
									$relativePath = $rootDir . DIRECTORY_SEPARATOR . $file;
									if (!is_dir($relativePath)) 
									{
										echo "<li><a href='?file=".$file."'>".$file."</a></li>";
									}
								}
								
							}

							?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		
	</nav>
	
	<textarea id="sourceTextarea"><?php echo file_get_contents($fullPathFile); ?></textarea>	
	

	<iframe src="preview.php" name="preview" height="500" width="100%"></iframe>

	<script>
		var myTextArea = document.getElementById("sourceTextarea");
		var editor = CodeMirror(function(elt) {
			myTextArea.parentNode.replaceChild(elt, myTextArea);
		}, {
			value: myTextArea.value,
			lineNumbers: true,
			mode: "application/x-httpd-php",
			keyMap: "sublime",
			autoCloseBrackets: true,
			matchBrackets: true,
			showCursorWhenSelecting: true,
			theme: "monokai",
			tabSize: 2
		});

		$(document).ready(function(){
			$("#save").click(function(){
				$("#sourceTextareaForm").val(editor.getValue());
				$("#sourceForm").submit();
			});
		});
	</script>
</body>
</html>

