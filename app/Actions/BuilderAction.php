<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class BuilderAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Builder';
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
        return route('voyager.providers.builder',['provider'=>$this->data->id]);
    }
    
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'providers';
    }
}