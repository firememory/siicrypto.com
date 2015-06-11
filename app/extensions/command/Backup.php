<?php
namespace app\extensions\command;
use \ZipArchive;
use \lithium\template\View;
use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;

class Backup extends \lithium\console\Command {
	public function run(){
			$files_to_zip = array(
			"/backup/SiiCrypto/details.bson",
			"/backup/SiiCrypto/details.metadata.json",
			"/backup/SiiCrypto/logins.bson",
			"/backup/SiiCrypto/logins.metadata.json",
			"/backup/SiiCrypto/orders.bson",
			"/backup/SiiCrypto/orders.metadata.json",
			"/backup/SiiCrypto/pages.bson",
			"/backup/SiiCrypto/pages.metadata.json",
			"/backup/SiiCrypto/parameters.bson",
			"/backup/SiiCrypto/parameters.metadata.json",
			"/backup/SiiCrypto/requests.bson",
			"/backup/SiiCrypto/requests.metadata.json",
			"/backup/SiiCrypto/reasons.bson",
			"/backup/SiiCrypto/reasons.metadata.json",
			"/backup/SiiCrypto/system.indexes.bson",
			"/backup/SiiCrypto/system.users.bson",
			"/backup/SiiCrypto/system.users.metadata.json",
			"/backup/SiiCrypto/settings.bson",
			"/backup/SiiCrypto/settings.metadata.json",
			"/backup/SiiCrypto/trades.bson",
			"/backup/SiiCrypto/trades.metadata.json",
			"/backup/SiiCrypto/transactions.bson",
			"/backup/SiiCrypto/transactions.metadata.json",
			"/backup/SiiCrypto/users.bson",
			"/backup/SiiCrypto/users.metadata.json",
			"/.bitcoin/wallet.dat",
			"/.greencoin/wallet.dat",			
		);
//if true, good; if false, zip creation failed
		$result = $this->create_zip($files_to_zip,BACKUP_DIR.'Backup.zip',true);

		$filename = BACKUP_DIR.'Backup.zip';

			$view  = new View(array(
				'loader' => 'File',
				'renderer' => 'File',
				'paths' => array(
					'template' => '{:library}/views/{:controller}/{:template}.{:type}.php'
				)
			));

			$body = $view->render(
				'template',
				compact('filename'),
				array(
					'controller' => 'admin',
					'template'=>'backup',
					'type' => 'mail',
					'layout' => false
				)
			);

			$transport = Swift_MailTransport::newInstance();
			$mailer = Swift_Mailer::newInstance($transport);
	
			$message = Swift_Message::newInstance();
			$message->setSubject("Data Backup: ".COMPANY_URL);
			$message->setFrom(array(NOREPLY => 'Data Backup: '.COMPANY_URL));
			$message->setTo("nilamdoc@gmail.com");
			$message->addBcc(MAIL_1);
			$message->addBcc(MAIL_2);			
			$message->addBcc(MAIL_3);		
			$message->attach(Swift_Attachment::fromPath($filename));
			$message->setBody($body,'text/html');
			
			$mailer->send($message);


	}

	function create_zip($files = array(),$destination = '',$overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }
		//vars
		$valid_files = array();
		//if files were passed in...
		if(is_array($files)) {
			//cycle through each file
			foreach($files as $file) {
				//make sure the file exists
				if(file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}
		//if we have good files...
		if(count($valid_files)) {
			//create the archive
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			//add the files
			foreach($valid_files as $file) {
				$zip->addFile($file,$file);
			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
			
			//close the zip -- done!
			$zip->close();
			
			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}
}
?>