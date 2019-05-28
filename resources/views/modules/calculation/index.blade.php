@extends('main-layout')

@section('content')  
<style>
    .btn {
        margin-top: -5px;
    }    
</style>

<div id="container"></div>

@endsection

@section('custom_css')
<link href="https://cdn.fancygrid.com/fancy.min.css" rel="stylesheet">
@endsection

@section('custom_js')
<script src="https://cdn.fancygrid.com/fancy.full.js"></script>
<script>
Fancy.MODULESDIR="https://cdn.fancygrid.com/modules/";

$(function(){
  $('#container').FancyGrid({    
    trackOver: true,
    selModel: 'rows',
    height: 500,
    theme: 'blue',
    data: {
      proxy: {
        api: {
          create: '{{route("createDataCalculation")}}',
          read: '{{route("getDataCalculation")}}',
          update: '{{route("updateDataCalculation")}}',
          destroy: '{{route("deleteDataCalculation")}}'
        }
      }
    },
    tbar: [{
      type: 'button',
      text: 'Add',
      action: 'add'
    }, {
      type: 'button',
      text: 'Remove',
      action: 'remove'
    }],
    paging: {
        pageSize: 20,
        pageSizeData: [20,50,100]
    },
    clicksToEdit: 1,
    defaults: {
      width: 100,
      sortable: true,
      editable: true,
      titleEditable: false,
      resizable: true,
      align: 'center'
    },
    expander: {
        tpl: [
          '<div>',
                '<p><b>Days Needed :</b> {days_needed_r}</p>',
                '<hr />',
                '<p>Mould Depreciation : <b>Actual </b>{mould_actual_r} | <b>Buffer </b>{mould_buffer_r}</p>',
                '<p>Machine Depreciation : <b>Actual </b>{machine_actual_r} | <b>Buffer </b>{machine_buffer_r}</p>',
                '<p>Material : <b>Actual </b>{material_actual_r} | <b>Buffer </b>{material_buffer_r}</p>',
                '<hr />',
                '<p>Labour : <b>Actual </b>{labour_actual_r} | <b>Buffer </b>{labour_buffer_r}</p>',
                '<p>Electricity : <b>Actual </b>{elec_actual_r} | <b>Buffer </b>{elec_buffer_r}</p>',
                '<p>Packaging 1 : <b>Actual </b>{pack1_actual_r} | <b>Buffer </b>{pack1_buffer_r}</p>',
                '<p>Packaging 2 : <b>Actual </b>{pack2_actual_r} | <b>Buffer </b>{pack2_buffer_r}</p>',
                '<p>Transportation : <b>Actual </b>{trans_actual_r} | <b>Buffer </b>{trans_buffer_r}</p>',
                '<hr />',
                '<p><b>COGS</b> : <b>Actual </b>{cogs_actual_r} | <b>Buffer </b>{cogs_buffer_r}</p>',
                '<p><b>OVERHEAD</b> : <b>Actual </b>{overhead_actual_r} | <b>Buffer </b>{overhead_buffer_r}</p>',
                '<p><b>PROFIT</b> : <b>Buffer </b>{profit_buffer_r}</p>',
                '<hr />',
                '<p><b>PRICE</b> : <b>Actual <span style="font-size:14px;">{price_actual_r}</span></b> | <b>Buffer <span style="font-size:14px;">{price_buffer_r}</span></b></p>',
            '</tr>',
          '</div>'
        ].join(""),
        dataFn: function(grid, data){
            var time_efficiency = parseInt((data.time_efficiency * 86400)/100);
            data.days_needed_r = (data.quantity/((data.cavity/data.cycle_time)*time_efficiency)).toFixed(2);
            
            //MOULD
            data.mould_actual_r = ((data.mould/data.mould_depr)/data.quantity).toFixed(1);
            data.mould_buffer_r = ((data.mould_buffer/data.mould_depr_buffer)/data.quantity).toFixed(1);
            //MACHINE
            data.machine_actual_r = ((data.days_needed_buffer/data.total_days)*(data.machine/data.machine_depr)/data.quantity).toFixed(1);
            data.machine_buffer_r = ((data.days_needed_buffer/data.total_days)*(data.machine_buffer/data.machine_depr_buffer)/data.quantity).toFixed(1);
            //MATERIAL
            data.material_actual_r = (((((data.material*data.material_weight)+(data.masterbatch*data.masterbatch_weight))/((data.material_efficiency/100)*(data.material_weight+data.masterbatch_weight)))/1000)*data.weight).toFixed(1);
            data.material_buffer_r = (((((data.material_buffer*data.material_weight)+(data.masterbatch_buffer*data.masterbatch_weight))/((data.material_efficiency/100)*(data.material_weight+data.masterbatch_weight)))/1000)*data.weight_buffer).toFixed(1);
            //LABOUR
            data.labour_actual_r = (((data.days_needed_buffer/data.working_day)*data.shift*data.labour)/data.quantity).toFixed(1);
            data.labour_buffer_r = (((data.days_needed_buffer/data.working_day)*data.shift*data.labour_buffer)/data.quantity).toFixed(1);
            //ELECTRIC
            data.elec_actual_r = ((((data.days_needed_buffer/data.total_days)*data.electricity)/data.total_machine)/data.quantity).toFixed(1);
            data.elec_buffer_r = ((((data.days_needed_buffer/data.total_days)*data.electricity_buffer)/data.total_machine)/data.quantity).toFixed(1);
            //PACKAGING
            data.pack1_actual_r = (data.packaging1/data.packaging1_qty).toFixed(1);
            data.pack1_buffer_r = (data.packaging1_buffer/data.packaging1_qty).toFixed(1);
            data.pack2_actual_r = (data.packaging2/data.packaging2_qty).toFixed(1);
            data.pack2_buffer_r = (data.packaging2_buffer/data.packaging2_qty).toFixed(1);
            //TRANSPORT
            data.trans_actual_r = (data.transport/data.quantity).toFixed(1);
            data.trans_buffer_r = (data.transport_buffer/data.quantity).toFixed(1);
            
            //RESULT
            var cogs_actual = (parseInt(data.mould_actual_r)+parseInt(data.machine_actual_r)+parseInt(data.material_actual_r)+parseInt(data.labour_actual_r)+parseInt(data.elec_actual_r)+parseInt(data.pack1_actual_r)+parseInt(data.pack2_actual_r)+parseInt(data.trans_actual_r)).toFixed(1);
            var cogs_buffer = (parseInt(data.mould_buffer_r)+parseInt(data.machine_buffer_r)+parseInt(data.material_buffer_r)+parseInt(data.labour_buffer_r)+parseInt(data.elec_buffer_r)+parseInt(data.pack1_buffer_r)+parseInt(data.pack2_buffer_r)+parseInt(data.trans_buffer_r)).toFixed(1);
            data.cogs_actual_r = cogs_actual;
            data.cogs_buffer_r = cogs_buffer;
            data.overhead_actual_r = (cogs_actual*(data.overhead/100)).toFixed(1);
            data.overhead_buffer_r = (cogs_buffer*(data.overhead/100)).toFixed(1);
            data.profit_buffer_r = (((parseInt(cogs_buffer)+parseInt(data.overhead_buffer_r)))*(data.profit/100)).toFixed(1);
            
            data.price_actual_r = parseInt(cogs_actual)+parseInt(data.overhead_actual_r);
            data.price_buffer_r = parseInt(cogs_buffer)+parseInt(data.overhead_buffer_r)+parseInt(data.profit_buffer_r);
            
            return data;
        }
    },
    columns: [
        {index: 'id',locked: true,title: 'ID',type: 'number',width: 40,editable: false,resizable: false},
        {index: 'name',locked: true, title: 'Product Name', type: 'string', width: 100, align: 'center' },
        {index: 'quantity',format: 'number',locked: true, title: 'Quantity<br />(Pcs)', type: 'string', width: 100, align: 'center' },
        {type: 'action',locked: true,width: 75,items: [{text: 'Preview',cls: 'btn btn-info btn-xs',  
                    handler: function(grid, o){
                        console.log(o.id);
                        window.open('{{route("viewCalculation","")}}/'+o.id, '_blank');
                    }
                }]
        },
        {
            type: 'expand',
            locked: true
        },
        {index: 'days_needed_buffer', title: 'Days Needed<br />Buffer', type: 'number', width: 100 , align: 'center'},        
        {
            text: 'Weight (Gram)',
            columns: [
                {title: 'Actual',index: 'weight', width: 100,align: 'center'}, 
                {title: 'Buffer',index: 'weight_buffer', width: 100,align: 'center'}
            ]
        },
        {
            text: 'Mould Actual',
            columns: [
                {title: 'Price (Unit)',index: 'mould', width: 100,align: 'center'}, 
                {title: 'Depr (Month)',index: 'mould_depr', width: 100,align: 'center'}
            ]
        },
        {
            text: 'Mould Buffer',
            columns: [
                {title: 'Price (Unit)',index: 'mould_buffer', width: 100,align: 'center'}, 
                {title: 'Depr (Month)',index: 'mould_depr_buffer', width: 100,align: 'center'}
            ]
        },
        {index: 'cavity', title: 'Cavity (Pcs)', type: 'string', width: 100 ,align: 'center'},
        {index: 'cycle_time', title: 'Cycle Time (s)', type: 'string', width: 100, align: 'center'},
        {
            text: 'Machine Actual',
            columns: [
                {title: 'Price (Unit)',index: 'machine', width: 100, align: 'center'}, 
                {title: 'Depr (Month)',index: 'machine_depr', width: 100, align: 'center'}
            ]
        },
        {
            text: 'Machine Buffer',
            columns: [
                {title: 'Price (Unit)',index: 'machine_buffer', width: 100, align: 'center'}, 
                {title: 'Depr (Month)',index: 'machine_depr_buffer', width: 100, align: 'center'}
            ]
        },
        {index: 'material_efficiency', title: 'Material<br />Efficiency (%)', type: 'string', width: 100, align: 'center' },
        {
            text: 'Material',
            columns: [  
                {index: 'material', title: 'Price /Kg', type: 'string', width: 100, align: 'center' },
                {index: 'material_buffer', title: 'Buffer (Kg)', type: 'string', width: 100, align: 'center' },
                {index: 'material_weight', title: 'Weight (Kg)', type: 'string', width: 100, align: 'center' },
            ]
        },
        {
            text: 'Masterbatch',
            columns: [
                {index: 'masterbatch', title: 'Price /Kg', type: 'string', width: 100, align: 'center' },
                {index: 'masterbatch_buffer', title: 'Buffer (Kg)', type: 'string', width: 100, align: 'center' },
                {index: 'masterbatch_weight', title: 'Weight (Kg)', type: 'string', width: 100, align: 'center' },
            ]
        },
        {
            text: 'Labour',
            columns: [
                {title: 'Actual (Person)',index: 'labour', width: 100, align: 'center'}, 
                {title: 'Buffer (Person)',index: 'labour_buffer', width: 100, align: 'center'}
            ]
        },
        {
            text: 'Electricity',
            columns: [
                {title: 'Actual (Month)',index: 'electricity', width: 100, align: 'center'}, 
                {title: 'Buffer (Month)',index: 'electricity_buffer', width: 100, align: 'center'}
            ]
        },
        {index: 'shift', title: 'Shift', type: 'string', width: 100 , align: 'center'},
        {index: 'working_day', title: 'Working Day', type: 'string', width: 100 , align: 'center'},
        {
            text: 'Packaging',
            columns: [
                {index: 'packaging1',title: 'Actual 1', type: 'string', width: 100 , align: 'center'},
                {index: 'packaging1_buffer',title: 'Buffer 1', type: 'string', width: 100 , align: 'center'},
                {index: 'packaging1_qty', title: 'Qty 1 (pcs)', type: 'string', width: 100 , align: 'center'},
                {index: 'packaging2',title: 'Actual 2', type: 'string', width: 100, align: 'center' },
                {index: 'packaging2_buffer',title: 'Buffer 2', type: 'string', width: 100 , align: 'center'},
                {index: 'packaging2_qty', title: 'Qty 2 (pcs)', type: 'string', width: 100 , align: 'center'},
            ]
        },
        {
            text: 'Transportation',
            columns: [
                {title: 'Actual (Month)',index: 'transport', width: 100, align: 'center'}, 
                {title: 'Buffer (Month)',index: 'transport_buffer', width: 100, align: 'center'}
            ]
        },
        {index: 'time_efficiency', title: 'Time Efficiency (%)', type: 'number', width: 130 , align: 'center'},
        {index: 'total_days', title: 'Total Days', type: 'number', width: 100 , align: 'center'},
        {index: 'total_machine', title: 'Total Machine', type: 'number', width: 100 , align: 'center'},
        {index: 'overhead', title: 'Overhead (%)', type: 'number', width: 100 , align: 'center'},
        {index: 'profit', title: 'Profit (%)', type: 'number', width: 100 , align: 'center'},
//        {index: 'created_at', title: 'Created Date', type: 'string', width: 100 , align: 'center',editable: false},
//        {index: 'updated_at', title: 'Updated Date', type: 'string', width: 100 , align: 'center',editable: false},
      ]
  });
});


</script>
@endsection
