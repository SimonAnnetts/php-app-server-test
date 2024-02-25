<?php
	header("Content-Type: text/html; charset=UTF8");
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest stable bootstrap 5 libraries --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
<body>
<?php
	$rootpath = str_replace("\\", "/", dirname(__FILE__));

	require_once $rootpath . "/support/pas_run_process_sdk.php";

	PAS_RunProcessSDK::OutputCSS();
	PAS_RunProcessSDK::OutputJS();
?>
<div id="terminal-manager"></div>

<script type="text/javascript">
// NOTE:  Always put Javascript RunProcesSDK and TerminalManager class instances in a Javascript closure like this one to limit the XSRF attack surface.
(function() {
	// Establish a new connection with a compatible WebSocket server.
	var runproc = new RunProcessSDK('<?=PAS_RunProcessSDK::GetURL()?>', false, '<?=PAS_RunProcessSDK::GetAuthToken()?>');

	// Debugging mode dumps incoming and outgoing packets to the web browser's debug console.
	runproc.debug = true;

	// Establish a new terminal manager instance.
	var elem = document.getElementById('terminal-manager');

	// Automatically attach to all channels with the 'demo' tag.
	var options = {
		tag: 'chatgpt'
	};

	var tm = new TerminalManager(runproc, elem, options);
})();
</script>
<a class="btn btn-primary" href="start-process.php">Start ChatGPT3</a>
</body>
</html>