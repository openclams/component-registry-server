@extends('voyager::master')

@section('page_title', 'Providers')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Order Components for {{ $provider->title }}
        <div class="btn btn-success add_item"><i class="voyager-plus"></i> Add New Component</div>
    </h1>
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <p class="panel-title" style="color:#777">Drag and drop the components below to re-arrange them.</p>
                    </div>

                    <div class="panel-body" style="padding:30px;">
                        <div class="dd" id="listComponents">
                            {!! $provider->display() !!}
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
                    <form action="{{ route('voyager.providers.item.destroy', ['provider' => $provider->id, 'component' => '__id']) }}"
                          id="delete_form"
                          method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input class="form-check-input" type="checkbox" value="1" checked id="removeAll" name='removeAll'>
                        <label class="form-check-label" for="removeAll">
                          Delete all leaves.
                        </label>
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::menu_builder.delete_item_confirm') }}">
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
                <form action="" id="m_form" method="POST"
                      data-action-add="{{ route('voyager.providers.item.add', ['provider' => $provider->id]) }}"
                      data-action-update="{{ route('voyager.providers.item.update', ['provider' => $provider->id]) }}">

                    <input id="m_form_method" type="hidden" name="_method" value="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div>
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="m_name" name="name" placeholder="Component Name"><br>
                        </div>
                        <label for="type">Type</label>
                        <select id="m_type" class="form-control" name="isTemplate">
                            <option value="0" selected="selected">Component</option>
                            <option value="1">Template</option>
                        </select><br>
                        
                         <label for="type">Attribute List</label>
                        <div id="attributeList">
                            <div class="form-group row">
                                <div class="col-xs-1" style="margin-bottom:0;">
                                        <button type="button" class="btn btn-success btn-xs" style="margin-top:0px;" @click="add()"><i class="voyager-plus"></i></button>
                                       
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <label class="control-label" for="name">Key</label>
                                </div>
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <label class="control-label" for="name">Title</label>
                                </div>
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <label class="control-label" for="name">Type</label>
                                </div>
                                <div class="col-xs-5" style="margin-bottom:0;">
                                    <label class="control-label" for="name">Value</label>
                                </div>
                                <div class="col-xs-1" style="margin-bottom:0;">
                                     <label class="control-label" for="name">Action</label>
                                </div>
                            </div>
                            <div class="form-group row" v-for="item in attributes" >
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <input   type="text" class="form-control"  v-model="item.id_name" />
                                </div>
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <input   type="text"  class="form-control"  v-model="item.name" />
                                </div>
                                <div class="col-xs-2" style="margin-bottom:0;">
                                    <input   type="text" class="form-control"  v-model="item.type" />
                                </div>
                                <div class="col-xs-5" style="margin-bottom:0;">
                                    <input   type="text"  class="form-control"  v-model="item.value" />
                                </div>
                                <div class="col-xs-1" style="margin-bottom:0;">
                                    <button type="button" class="btn old_btn btn-xs" style="margin-top:0px;" @click="remove(item)"><i class="voyager-trash"></i></button>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="attributes" id="m_attributes" v-model="JSON.stringify(attributes)">
                        </div>    
                    
                        <div>
                            <label for="img">Image</label>
                            <div id="media_picker">
                                <media-manager
                                    base-path="{{ '/components/' }}"
                                    filename="null"
                                    :allow-multi-select="false"
                                    :max-selected-files="1"
                                    :min-selected-files="0"
                                    :show-folders="true"
                                    :show-toolbar="true"
                                    :allow-upload="true"
                                    :allow-move="true"
                                    :allow-delete="true"
                                    :allow-create-folder="true"
                                    :allow-rename="true"
                                    :allow-crop="false"
                                    :allowed-types="[]"
                                    :pre-select="false"
                                    :expanded="true"
                                    :show-expand-button="true"
                                    :element="'input[name=&quot;img&quot;]'"
                                    :details="{&quot;max&quot;:1,&quot;min&quot;:0,&quot;expanded&quot;:true,&quot;show_folders&quot;:true,&quot;allow_upload&quot;:true,&quot;allow_move&quot;:true,&quot;allow_delete&quot;:true,&quot;allow_rename&quot;:true,&quot;allowed&quot;:[],&quot;hide_thumbnails&quot;:false,&quot;show_as_images&quot;:true}"
                                ></media-manager>
                                <input type="hidden"  v-model="img" :value="&#039;&#039;"  id="m_img" name="img">
                            </div>
                        </div>
                       
                        <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                        <input type="hidden" name="id" id="m_id" value="">
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

            var collapseList = localStorage.getItem("collapseList");
            if (!collapseList){
                collapseList = []
            }else{
                collapseList =  JSON.parse(collapseList)
                collapseList.forEach(function(e){
                    c = $('#listComponents .dd-item[data-id="'+e+'"]');
                    console.log(c,e)
                    if(c){
                        c.addClass('dd-collapsed');
                    }
                });
            }

            $('#listComponents').nestable({
                //expandBtnHTML: '',
                //collapseBtnHTML: '',
                maxDepth: 30
            });
            
            var imgData = {img : ""}
            
            var vMedaPicker = new Vue({
                el: '#media_picker',
                data: imgData
            });
            
            var attrData = { attributes: []}

            var attributeList = new Vue({
                el: "#attributeList",
                data: attrData,
                methods: {
                  add: function() {
                    this.attributes.push({
                        'id' : null,
                        "id_name" : '',
                        "name" : '',
                        "type" : 'text',
                        "value" : '' 
                    });
                  },
                  remove: function(item) {
                    this.attributes.splice(this.attributes.indexOf(item), 1);
                  }
                }
            });
            

            /**
             * Set Variables
             */
            var $m_modal       = $('#menu_item_modal'),
                $m_hd_add      = $('#m_hd_add').hide().removeClass('hidden'),
                $m_hd_edit     = $('#m_hd_edit').hide().removeClass('hidden'),
                $m_form        = $('#m_form'),
                $m_form_method = $('#m_form_method'),
                $m_name       = $('#m_name'),
                $m_type        = $('#m_type'),
                $m_img         = $('#m_img'),
                $m_attr        = $('#m_attributes')
                $m_id          = $('#m_id');

            /**
             * Add Menu
             */
            $('.add_item').click(function() {
                $m_form.trigger('reset');
                $m_form.find("input[type=submit]").val('{{ __('voyager::generic.add') }}');
                $m_modal.modal('show', {data: null});
            });

            /**
             * Edit Menu
             */
            $('.item_actions').on('click', '.edit', function (e) {
                $m_form.find("input[type=submit]").val('{{ __('voyager::generic.update') }}');
                $m_modal.modal('show', {data: $(e.currentTarget)});
            });

            /**
             * Menu Modal is Open
             */
            $m_modal.on('show.bs.modal', function(e, data) {
                var _adding      = e.relatedTarget.data ? false : true;
                if (_adding) {
                    $m_form.attr('action', $m_form.data('action-add'));
                    $m_form_method.val('POST');
                    $m_hd_add.show();
                    $m_hd_edit.hide();
                    $m_name.val('');
                    $m_type.val('0').change();
                    $m_img.val("");
                    attributeList.attributes = []
                } else {
                    $m_form.attr('action', $m_form.data('action-update'));
                    $m_form_method.val('PUT');
                    $m_hd_add.hide();
                    $m_hd_edit.show();

                    var _src = e.relatedTarget.data, // the source
                        id   = _src.data('id');
                    
                    $m_name.val(_src.data('name'));
                    //$m_img.val(_src.data('img')).trigger("change");
                    vMedaPicker.img = _src.data('img')
                    attributeList.attributes = _src.data('attributes')
                    console.log(_src.data('attributes'))
                    $m_id.val(id);

                    if (_src.data('isTemplate') == '0') {
                        $m_type.val('0').change();
                    } else if (_src.data('isTemplate') == '1') {
                        $m_type.find("option[value='0']").removeAttr('selected');
                        $m_type.find("option[value='1']").attr('selected', 'selected');
                        $m_type.val('1');
                    } 
                }
            });
            
            /**
             * Delete menu item
             */
            $('.item_actions').on('click', '.delete', function (e) {
                id = $(e.currentTarget).data('id');
                $('#delete_form')[0].action = '{{ route('voyager.providers.item.destroy', ['provider' => $provider->id, 'component' => '__id']) }}'.replace('__id', id);
                $('#delete_modal').modal('show');
            });


            /**
             * Reorder items
             */
            $('#listComponents').on('change', function (e) {
                $.post('{{ route('voyager.providers.order_item',['provider' => $provider->id]) }}', {
                    order: JSON.stringify($('#listComponents').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    toastr.success("Order has been updated");
                });
            });
            
            
         
            
            $('#listComponents').on('click', 'button', function(e) {
                var target = $(e.currentTarget),
                    action = target.data('action');
                    id = target.parents().eq(0).data('id');
                if (action === 'collapse') {
                   collapseList.push(id)
                   localStorage.setItem("collapseList",JSON.stringify(collapseList))
                }
                if (action === 'expand') {
                    const index = collapseList.indexOf(id);
                    if (collapseList > -1) {
                      collapseList.splice(index, 1);
                      localStorage.setItem("collapseList",JSON.stringify(collapseList))
                    }
                }
            });
            
        });
    </script>
@stop
