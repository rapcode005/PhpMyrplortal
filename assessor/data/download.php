<?php 
	
	class DownloadFile {
			
		function download() {
			header('Content-Type: application/x-download');
			header('Content-Disposition: attachment; '
			.$this->_httpencode('filename',$this->$filename,$this->isUTF8));
			header('Cache-Control: private, max-age=0, must-revalidate');
			header('Pragma: public');
			echo $this->buffer;
		}
	}
	
	
	