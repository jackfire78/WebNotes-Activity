<?php
namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger implements ILoggerService {
	private static $logger = null;
	static function getLogger(){
		if (self::$logger == null){
			self::$logger = new Logger('MyApp');
			//$stream = new StreamHandler(__DIR__ . 'storage/logs/myapp.log', Logger::DEBUG);
			//$stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g:iA n/j/Y"));
			//self::$logger->pushHandler($stream);
			//self::$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/myapp.log', Logger::DEBUG));
			//Logging in Heroku
			// self::$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
			//Logging in Heroku with Loggly
			self::$logger->pushHandler(new StreamHandler('e96850b8-fd08-4dc0-9929-e255ae16e887/tag/webnotesHeroku', Logger::DEBUG));
		}
		return self::$logger;
	}
	
	public static function debug($message, $data = array ()) {
		self::getLogger ()->debug ( $message, $data );
	}
	public static function info($message, $data = array ()) {
		self::getLogger ()->info ( $message, $data );
	}
	public static function warning($message, $data = array ()) {
		self::getLogger ()->warning ( $message, $data );
	}
	public static function error($message, $data = array ()) {
		self::getLogger ()->error ( $message, $data );
	}
}

