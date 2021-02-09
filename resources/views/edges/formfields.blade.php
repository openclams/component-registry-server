@include('attributes.formfields')

<?php

//$view can be browse, read, edit, add or order
//$content the content for this field
//$dataType the DataType
//$dataTypeContent the whole model-instance
//$row the DataRow
//$options the DataRow details

$json = $dataTypeContent->constraints()->get()->toArray(); 

?>
<div id="{{ $row->field."_root_const" }}">
    <div class="form-group row">
        <div class="col-xs-5" style="margin-bottom:0;">
         Edge Constraints
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-2" style="margin-bottom:0;">
            <label class="control-label" >Type</label>
            <select class="form-control" id="edgeConstrain">
                <option>Allow</option>
                <option>Exclude</option>
            </select>
        </div>
        <div class="col-xs-4" style="margin-bottom:0;">
            <label class="control-label">From</label>
            <select class="form-control select2-ajax" id="fromComponent"
                    data-get-items-route="{{route('voyager.edge-constraints.relation')}}"
                    data-get-items-field="edge_constraint_belongsto_component_relationship"
                    data-method="add">
                </select>
        </div>
        <div class="col-xs-4" style="margin-bottom:0;">
            <label class="control-label" >To</label>
            <select class="form-control select2-ajax" id="toComponent"
                    data-get-items-route="{{route('voyager.edge-constraints.relation')}}"
                    data-get-items-field="edge_constraint_belongsto_component_relationship"
                    data-method="add">
            </select>
        </div>
        <div class="col-xs-1" style="margin-bottom:0;">
            <label class="control-label">Action</label>
            <button type="button" class="btn btn-success btn-xs" style="margin-top:0px;" @click="add()"><i class="voyager-plus"></i></button>
        </div>
    </div>
    <div class="form-group row" v-for="item in constrains" >
        <div class="col-xs-2" style="margin-bottom:0;">
              @{{ item.type }}
        </div>
        <div class="col-xs-4" style="margin-bottom:0;">
              @{{ item.fromName }}
        </div>
        <div class="col-xs-4" style="margin-bottom:0;">
                @{{ item.toName }}
        </div>
        <div class="col-xs-1" style="margin-bottom:0;">
            <button type="button" class="btn old_btn btn-xs" style="margin-top:0px;" @click="remove(item)"><i class="voyager-trash"></i></button>
        </div>
    </div>
    <input type="hidden" class="form-control" name="{{ "constrainsList" }}"  v-model="JSON.stringify(constrains)">
</div>

@push('javascript')
<script>
var store = [].concat(@json($json));

var constData = { constrains: store};

new Vue({
    el: "#{{ $row->field."_root_const" }}",
    data: constData,
    methods: {
        add: function() {
          this.constrains.push({
              'id' : null,
              "type" : $('#edgeConstrain').val(),
              "from" :  $('#fromComponent').select2('data')[0].id,
              "to" :  $('#toComponent').select2('data')[0].id, 
              "fromName" :  $('#fromComponent').select2('data')[0].text,
              "toName" :  $('#toComponent').select2('data')[0].text
          });
        },
        remove: function(item) {
          this.constrains.splice(this.constrains.indexOf(item), 1);
        }
    }
});


</script>
@endpush