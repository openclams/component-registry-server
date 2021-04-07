@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop


@section('page_title', 'Template')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Order Components for {{ $component->title }}
        <div class="btn btn-success add_item"><i class="voyager-plus"></i> Add Component</div>
    </h1>
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <p class="panel-title" style="color:#777">Drag and drop the components below to re-arrange them in the template.</p>
                    </div>

                    <div class="panel-body" style="padding:30px;">
                        <div class="dd" id="listComponents">
                            {!! $component->display() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::menu_builder.delete_item_question') }}</h4>
                </div>
                <div class="modal-footer">
                    <form action=""
                          id="delete_form"
                          method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input id="m_delete_component" type="hidden" name="pivot" value="">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal modal-info fade" tabindex="-1" id="menu_item_modal" role="dialog">
        <div class="modal-dialog"  style="width:90%" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button> 
                    <h4 id="m_hd_add" class="modal-title hidden"><i class="voyager-plus"></i> Create New </h4>
                    <h4 id="m_hd_edit" class="modal-title hidden"><i class="voyager-edit"></i> Edit </h4>
                </div>
                <form action="{{ route('voyager.template.add_item', ['component' => $component->id]) }}" id="m_form" method="POST">

                    <input id="m_form_method" type="hidden" name="_method" value="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div>
                            <div class="form-group  col-md-12">
                                <label for="component_id">Name</label>

                                <select
                                    class="form-control select2-ajax" name="component_id"
                                    data-get-items-route="http://localhost/admin/components/relation"
                                    data-get-items-field="component_belongsto_component_relationship"
                                    data-method="add">
                                                <option value="">None</option>
                                </select>
                            </div>
                        </div>        
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-right delete-confirm__" value="{{ __('voyager::generic.update') }}">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')

    <script>
        $(document).ready(function () {


            $('#listComponents').nestable({
                expandBtnHTML: '',
                collapseBtnHTML: '',
                maxDepth: 1
            });
            
             /**
             * Delete menu item
             */
            $('.item_actions').on('click', '.delete', function (e) {
                id = $(e.currentTarget).data('pivot');
                $('#delete_form')[0].action = '{{ route('voyager.template.delete_item', ['component' => $component->id]) }}';
                $('#m_delete_component').val(id);
                $('#delete_modal').modal('show');
            });

             /**
             * Add Menu
             */
            $('.add_item').click(function() {
                  $('#menu_item_modal').modal('show', {data: null});
            });
                

            /**
             * Reorder items
             */
            $('#listComponents').on('change', function (e) {
                $.post('{{ route('voyager.template.order_item',['component' => $component->id]) }}', {
                    order: JSON.stringify($('#listComponents').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    toastr.success("Order has been updated");
                });
            });
            
            
        });
    </script>
@stop
