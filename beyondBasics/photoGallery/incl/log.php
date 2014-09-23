<?php 
	class Log{

		public $logfile = "".SITE_ROOT.DS."logs".DS."log.txt";
		


		public function log_action($action="", $message="")
		{
			if($handle = fopen($this->logfile, 'a')){
				$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
				$content = "{$timestamp} | {$action}: {$message}\n";
				fwrite($handle, $content);
				fclose($handle);
				
				
			} else {
				echo "Couldn't open log file for writing.";
			}
		}
	}

	$log = new Log();
?>