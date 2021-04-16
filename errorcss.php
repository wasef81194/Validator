<?php
include_once 'typeerror.php';
include_once 'warningcss.php';

/**
 * Erreur CSS de l'API validator.w3.org
 * @param : line context type message
 * @return : les erreurs de la pages donner
 */
//namespace Error;
class ErrorCSS extends WarningCSS{
	
	private $context;

	public function __construct(int $line, string $context , string $type,  string $message){

        parent::__construct($line, $type,$message);
		$this->context = $context;
	}

	public function GetType(){
			return parent::GetType();
	}

	public function GetContext(){
			return $this->context;
	}

	public function GetMessage(){
			return $this->message;
	}

	public function GetLine(){
			return $this->line;
	}
	
	public function __toString(){

        $out = parent::__toString();
        $out .= "<p>Context : <code> ". $this->context ."</code></p>";
        
        return $out;
    }

	}

?>
