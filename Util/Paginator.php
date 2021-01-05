<?php
namespace app\Util;

class Paginator
{
    public $models;
    private $limit;
    private $offset;
    
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
  
    public function getPaginationLinks(): string {
        $stringPagination = '';
        $currentPage = $this->getOffset()+1;
        $pageBack = ($currentPage<=1)? 1: ($currentPage - 1);
        
        
        
        $stringPagination = '
                             <ul class="dor-pagination mb128">
                                <li class="page-link-prev"> <a href="/hh-clone/web/resume#" '.
                                'onclick="SerchPage('.$pageBack.'); return false;"'.' value="'.$pageBack.'"><img class="mr8"
                                 src="/hh-clone/web/images/mini-left-arrow.svg" alt="arrow"> Назад</a></li>
                                 ';
        $countPages = $this->getCountPages();
        
        //         var_dump($currentPage);
        //         exit();
        if($countPages < 7) {
            for($i = 0; $i<$countPages; $i++) {
                if($currentPage == $i+1){
                    $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.($i+1).'); return false;">'.($i+1).'</a></li>';
                } else {
                    $stringPagination .= '
                                   <li><a href="/hh-clone/web/resume#" onclick="SerchPage('.($i+1).'); return false;">'.($i+1).'</a></li>';
                }
                
            }
        } else if ($countPages >= 7) {
            
            $middleDigit =  intval(($countPages+$currentPage)/2);
            $secondDigit = intval((1 + $middleDigit)/2);
            $secondMiddleDigit =  $middleDigit+1;
            $penultimateDigit = intval(($secondMiddleDigit + $countPages)/2);
            
//              echo '$currentPage= '.$currentPage.'<br>';
//             echo '$secondDigit= '.$secondDigit.'<br>';
//             echo '$middleDigit= '.$middleDigit.'<br>';
//             echo '$secondMiddleDigit= '.$secondMiddleDigit.'<br>';
//             echo '$penultimateDigit= '.$penultimateDigit.'<br>';
//             exit();
            
            
            if($currentPage == 1){
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage(1); return false;">1</a></li>';
            } else {
                $stringPagination .= '
                                   <li><a href="/hh-clone/web/resume#" onclick="SerchPage(1); return false;">1</a></li>';
            }
            
            if($secondDigit == $currentPage) {
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$secondDigit.'); return false;">'.$secondDigit.'</a></li>';
            } else {
                $stringPagination .= '
                                    <li class="grey"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$secondDigit.'); return false;">...</a></li>';
            }
            if($middleDigit == $currentPage) {
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$middleDigit.'); return false;">'.$middleDigit.'</a></li>';
            } else {
                $stringPagination .= '
                                    <li> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$middleDigit.'); return false;">'.$middleDigit.'</a></li>';
            }
            if($secondMiddleDigit == $currentPage) {
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$secondMiddleDigit.'); return false;">'.$secondMiddleDigit.'</a></li>';
            } else {
                $stringPagination .= '
                                    <li> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$secondMiddleDigit.'); return false;">'.$secondMiddleDigit.'</a></li>';
            }
            if($penultimateDigit == $currentPage) {
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$penultimateDigit.'); return false;">'.$penultimateDigit.'</a></li>';
            } else {
                $stringPagination .= '
                                    <li class="grey"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$penultimateDigit.'); return false;">...</a></li>';
            }
            if($countPages == $currentPage) {
                $stringPagination .= '
                                    <li class="active"> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$countPages.'); return false;">'.$countPages.'</a></li>';
            } else {
                $stringPagination .= '
                                    <li> <a href="/hh-clone/web/resume#" onclick="SerchPage('.$countPages.'); return false;">'.$countPages.'</a></li>';
            }
            
        }
        
        
        //         '<li><a href="#">1</a></li>
        //          <li><a class="grey" href="#">...</a></li>
        //          <li class="active"><a href="#">4</a></li>
        //          <li><a href="#">5</a></li>
        //          <li><a class="grey" href="#">...</a></li>
        //          <li><a href="#">10</a></li>';
        
        $countPages = $this->getCountPages();
        $pageForward = ($currentPage>=$countPages)? $currentPage: ($currentPage + 1);
        $stringPagination .= '<li class="page-link-next"> <a href="/hh-clone/web/resume#" value="'.$pageForward.'" '.
            'onclick="SerchPage('.$pageForward.'); return false;"'.' >Далее <img class="ml8"
                                 src="/hh-clone/web/images/mini-right-arrow.svg" alt="arrow"></a> </li>
                             </ul>';
        
        return $stringPagination;
        
    }
}

