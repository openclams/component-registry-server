<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class TemplateAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Components';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-left',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.template.builder',['component'=>$this->data->id]);
    }
    
    public function getDataType() {
       return 'components';
    }
    
    public function isAllowed(){
        return $this->data->isTemplate;
    }
}