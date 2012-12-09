<?php
include_once('error.debug.php');
class RESTObject
{
	protected $queryString;
	protected $RESTParser;
	protected $currentBlock;
	protected $dataManager;
	protected $debug;
	protected $list;
	protected $parameter;
	public function __construct($list, $parameter = false, $parser = false, $debug = false)
	{
		$this->parameter = $parameter; 
		$this->list = $list;
		if (!$parser)
		{
			$this->queryString = $_SERVER['QUERY_STRING'];
			$this->RESTParser = new RESTParser($this->queryString, $debug);
			$this->debug = new Debug($debug);
			$this->dataManager = new DataManager($debug);
		} else
		{
			$this->RESTParser = $parser;
			$this->debug = new Debug($debug);
			$this->dataManager = new DataManager($debug);
		}
	}

	public function getList()
	{
		return $this->list;
	}
	public function getParameter()
	{
		return $this->parameter;
	}
	public function start()
	{
		if (!$this->RESTParser->isEmpty())
		{
			$this->currentBlock = $this->RESTParser->nextBlock();
			$i = 0;
			$stop = false;
			while($i < count($this->list) && $stop == false )
			{
				if ($this->currentBlock == $this->list[$i]->getParameter())
				{
					$stop = true;
					$this->list[$i]->start();	
				}
				$i++;
			};
			if ($i == 0)
			{
				Error::send(NullQuery);
			} else
			{
				if (!$stop)
				{
					Error::send(InvalidQuery);
				};
			}

		}
	}
}


?>