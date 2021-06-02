<ol class="dd-list">
    
@foreach ($components as $component)
    <?php
        $count = $component->childernCount();
        $categories = "";
        foreach($component->category as $category){
            $categories .= $category->name;
        }
    ?>
   
        <li class="dd-item" data-id="{{ $component->id }}" >
            <div class="pull-right item_actions">
                <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $component->id }}">
                    <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                </div>
                <div class="btn btn-sm btn-primary pull-right edit"
                    data-id="{{ $component->id }}"
                    data-name="{{ $component->name }}"
                    data-img="{{ $component->img }}"
                    data-attributes="{{ json_encode( \AttributeHelper::instance()->attrToArray($component->attributes()->get() )) }}"
                >
                    <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                </div>
            </div>
            <div class="dd-handle">
                <small>[{{ $component->id }}]</small>
                <img src='{{ asset(Voyager::image($component->img)) }}' style="height: 20px; width: 20px"/>
                <span>{{ $component->name }}</span> <i><small>{{ $categories }}</small></i>
            </div>
            @if ($count < 10)
                @if(!$component->children->isEmpty())
                    @include('providers.list', ['components' => $component->children])
                @endif
            @else
                <ol class="dd-list">
                    <li class="dd-item" data-id="NULL">
                        <span>Has {{ $count }}+ child components [not shown for performance reasons]</span>
                    </li>
                </ol>
            @endif    
        </li>
@endforeach
</ol>
