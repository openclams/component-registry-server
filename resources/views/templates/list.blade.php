<ol class="dd-list">
 
@foreach ($components as $component)
        <li class="dd-item" data-id="{{ $component->id }}" data-pivot="{{$component->pivot->id}}">
            <div class="pull-right item_actions">
                <div class="btn btn-sm btn-danger pull-right delete" data-pivot="{{$component->pivot->id }}">
                    <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                </div>
            </div>
            <div class="dd-handle">
                <img src='{{ asset(Voyager::image($component->img)) }}' style="height: 20px; width: 20px"/>
                <span>{{ $component->name }}</span>
            </div>
        </li>
@endforeach
</ol>
