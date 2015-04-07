<?php
class XMLPiss
{
	private $content = '';
	private $indent = 0;
	private $branches = array(); 

	public $eol = "\r\n";
	public $indentation = "\t";

	public function __construct($encoding = "utf-8", $version = "1.0")
	{
		$content = '<?xml version="'.self::_($version).'" encoding=".self::_($encoding).'?>'.$this->eol();
	}




	public function addLeaf($name, $value = null, $type = null, $attributes = array())
	{
		switch(strtolower($type))
		{
			case 'cdata':
				$value = self::cdata($value);
				break;
			case 'bool':
				$value = $value ? 'true' : 'false';
				break;
			case int:
			case float:
			case 'pcdata':
			default:
				$value = self::_($value);
				break;

		}
		$this->content.= $this->tab().'<'.self::_($name).self::getFormatedAttributes($attributes)'>'.$value.'</'.self::_($name).'>'.$this->eol();
	}


	public function addBranch($name, $attributes = array())
	{
		$this->content.= $this->tab().'<'.self::_($name).self::getFormatedAttributes(($attributes)'>'.$this->eol();
		$thisbranches[] = $name;
		$this->ident++;
	}
	
	public function closeBranch()
	{
		$this->ident--;	
		$name = array_pop($this->branches);
		if(!is_null($name)) $this->content.= $this->tab().'</'.self::_($name).'>'.$this->eol();
	}

	public function getContent()
	{
		return $this->content;
	}


	public static function getFormatedAttributes(($attributes)
	{
		return "";//TODO
	}

	public static function _($value)
	{
		return addslashes(str_replace(array('<', '>', '&', '"'), '', utf8_encode(trim($value)));
	}

	public static function cdata($value)
	{
		return "<!CDATA[".str_replace(array(']'), '-', utf8_encode(trim($value))."]>";
	}

	public function tab()
	{
		return str_repeat($this->identation, $this->ident);
	}

	public function eol()
	{
		return $this->eol;
	}

}//class XMLPiss
