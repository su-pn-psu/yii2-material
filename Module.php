<?php

namespace suPnPsu\material;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'suPnPsu\material\controllers';

    public $createUrl = ['/create'];
    
    public function init()
    {
        $this->createUrl = ["/".$this->id."/default/create"];
        $this->layout = 'left-menu.php';
        parent::init();

        // custom initialization code goes here
    }
}
