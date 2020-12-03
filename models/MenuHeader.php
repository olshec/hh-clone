<?php
namespace app\models;

class MenuHeader
{
    private $resumeState;
    private $listResumeState;
    
    public const RESUME = 1;
    public const LIST_RESUME = 2;
    
    public static function getMenuHeader(MenuHeader $menuHeader){
        $menu = new MenuHeader();
        $menu->setResumeState($menuHeader->getResumeState());
        $menu->setListResumeState($menuHeader->getListResumeState());
        return $menu;
    }
    
    /**
     * @param int $resumeState. It's should be const: RESUME, LIST_RESUME
     */
    private function setResumeState($resumeState)
    {
        $this->resumeState = $resumeState;
    }
    
    /**
     * @param mixed $listResumeState. It's should be const: RESUME, LIST_RESUME
     */
    private function setListResumeState($listResumeState)
    {
        $this->listResumeState = $listResumeState;
    }
    
    /**
     * @return string $resumeState
     */
    public function getResumeState()
    {
        return $this->resumeState;
    }

    /**
     * @return string $listResumeState
     */
    public function getListResumeState()
    {
        return $this->listResumeState;
    }
    
    /**
     * Activates resume menu item.
     */
    public function activateResume(){
        $this->setResumeState('active');
        $this->setListResumeState('');
    }

    /**
     * Activates list resume menu item.
     */
    public function activateListResume(){
        $this->setResumeState('');
        $this->setListResumeState('active');
    }
    
}

