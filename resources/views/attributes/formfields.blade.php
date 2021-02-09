<?php
//$view can be browse, read, edit, add or order
//$content the content for this field
//$dataType the DataType
//$dataTypeContent the whole model-instance
//$row the DataRow
//$options the DataRow details

$json = \AttributeHelper::instance()->attrToArray($dataTypeContent->attributes()->get()); 
?>

<div id="{{ $row->field."_root" }}">
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
    <input type="hidden" class="form-control" name="{{ "attributesList" }}" id="m_attributes" v-model="JSON.stringify(attributes)">
    <input type="hidden" class="form-control" name="{{ $row->field }}" value="{{ $content }}">
</div>

@push('javascript')
<script>
var store = [].concat(@json($json));

var attrData = { attributes: store};

var attributeList = new Vue({
    el: "#{{ $row->field."_root" }}",
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

</script>
@endpush