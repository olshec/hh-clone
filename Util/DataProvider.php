<?php
namespace app\Util;

class DataProvider
{
    public $models;
    private $limit;
    private $offset;
    private $page;
    
    public function __construct(array $models, int $limit, int $offset) {
        $this->setModels($models);
        $this->setLimit($limit);
        $this->setOffset($offset);
    }
    
    /**
     * 
     * @return array
     */
    public function getModels():array
    {
        $countModelsOnPage = $this->limit;
        $countPages = $this->getCountPages();
        if($this->offset >= $countPages) {
            $size = count($this->models);
            $length = intdiv($size, $this->limit);
            $countModelsOnPage = $size - $length*$this->limit;
//             echo '$length = '.$length.'<br>';
//             echo '$$countModelsOnPage = '.$countModelsOnPage.'<br>';
        }
        
        $indexStart = ($this->offset * $this->limit);
        $this->models = array_slice($this->models, $indexStart, $countModelsOnPage);
//         echo '$countModelsOnPage = '.$countModelsOnPage.'<br>';
//         echo 'start = '.$indexStart.'<br>';
//         var_dump($this->models);
//         exit();
        return $this->models;
    }

    /**
     * 
     * @return int
     */
    public function getLimit():int
    {
        return $this->limit;
    }

    /**
     * 
     * @return int
     */
    public function getOffset():int
    {
        return $this->offset;
    }

    /**
     * 
     * @param array $models
     */
    public function setModels(array $models)
    {
        $this->models = $models;
    }

    /**
     * 
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * 
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }
    /**
     * 
     * @return int
     */
    public function getPage():int
    {
        return $this->page;
    }

    /**
     * 
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }
    
    /**
     * 
     * @return int
     */
    public function getCountPages():int
    {
        $size = count($this->models);
        $length = intdiv($size, $this->limit);
        if($size - $length*$this->limit != 0) {
            $length++;
        }
        $countPages = $length;
        return $countPages;
    }
  
    
}

