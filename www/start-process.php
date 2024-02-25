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

	// Load the PHP App Server common functions.
	require_once $_SERVER["PAS_ROOT"] . "/support/process_helper.php";
	require_once $_SERVER["PAS_ROOT"] . "/support/pas_functions.php";

	// $cmd = escapeshellarg(PAS_GetPHPBinary());
	// $cmd .= " " . escapeshellarg(realpath($_SERVER["PAS_ROOT"] . "/support/scripts/test.php"));
    // $cmd = escapeshellarg("/home/simona/src/ChatGPT3/bin/Release/net6.0/linux-x64/publish/ChatGPT3");

	$os = substr(strtoupper(PHP_OS_FAMILY), 0, 3);
	switch ($os)
	{
		case "WIN":
			$cmd = escapeshellarg(realpath($_SERVER["PAS_ROOT"] . "/www/support/scripts/win64/ChatGPT3.exe"));
			break;
		case "LIN":
			$cmd = escapeshellarg(realpath($_SERVER["PAS_ROOT"] . "/www/support/scripts/linux64/ChatGPT3"));
			break;
		case "OSX":
			$cmd = escapeshellarg(realpath($_SERVER["PAS_ROOT"] . "/www/support/scripts/osx64/ChatGPT3"));
			break;
		default:
			echo "Unsupported OS: " . PHP_OS_FAMILY;
			exit();
	}

	// printf("<pre>%s</pre>", print_r($cmd, true));
	// exit();

	$options = array(
//		"rules" => array(
//			"start" => time() + 5,
//			"maxqueued" => 3
//		),
//		"stdin" => false,
//		"dir" => $_SERVER["PAS_ROOT"] . "/support/scripts/",
//		"env" => ProcessHelper::GetCleanEnvironment(),
//		"extraenv" => array("PASSWORD" => "supersecret"),
//		"extra" => array(
//			"title" => "Custom window title",
//			"inputmode" => "readline"
//		)
		"env" => ProcessHelper::GetCleanEnvironment(),
		"extra" => array(
			"title" => "ChatGPT3",
			"inputmode" => "readline"
		)
	);

	// Start the process.
	require_once $rootpath . "/support/pas_run_process_sdk.php";

	$rp = new PAS_RunProcessSDK();

	echo "<a class=\"btn btn-primary\" href=\"view-process.php\">View ChatGPT3</a>";

	$result = $rp->StartProcess("chatgpt", $cmd, $options);
	if (!$result["success"])  echo "An error occurred while starting a long-running process.";

	printf("<pre>%s</pre>", print_r($result, true));

	$result = $rp->StartProcess("chatgpt", $cmd, $options);
	if (!$result["success"])  echo "An error occurred while starting a long-running process.";

	printf("<pre>%s</pre>", print_r($result, true));

	echo "Done.";
?>
</body>
</html>