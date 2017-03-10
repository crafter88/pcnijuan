<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/docpro_settings/table/modes_of_payment.js"></script>
<script>
    $(document).ready(function(){
        (function(){
            $('#modes-of-payment-table thead tr#searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#modes-of-payment-table thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#modes-of-payment-table thead input").on( 'keyup change', function () {
                table.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        
        var table = $('#modes-of-payment-table').DataTable({
            ajax: window_location+'/docpro_settings/modes_of_payment/get',
            columns:[
                        {
                            mData: null, bSortable: false,
                            mRender: function(data, type, full){
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised title view' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                                    <button type='button' class='btn btn-success btn-xs btn-raised title edit' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                                    <button type='button' class='btn btn-warning btn-xs btn-raised title update' custom-title='Update'><i class='fa fa-refresh'></i></button>";
                            }
                        },
                        {'data': 'mop_seq'},
                        {'data': 'mop_code'},
                        {'data': 'mop_name'},
                        {'data': 'mop_shortname'},
                        {'data': 'top_type'}
                    ],
            columnDefs: [{targets: 0, width: '70px'}, {targets: [1,2], width: '40px'}, {targets: [4,5], width: '120px'}],
            scrollX: true,
            order: [['1', 'asc']],
            orderCellsTop: true,
            bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            }

        });

        init_table_settings(table);
        init_filter(table);
        init_general_search(table);
        hide_columns(table);

        var tmp = $.fn.popover.Constructor.prototype.show;
            $.fn.popover.Constructor.prototype.show = function () {
              tmp.call(this);
              if (this.options.callback) {
                this.options.callback();
              }
        }
        

        $('#modes-of-payment-table').on('click', '.view', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('mop-view-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#mop-view-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.mop-view-modal-body');
                    popover.find('input[name=mop-view-seq]').val(data.mop_seq);
                    popover.find('input[name=mop-view-code]').val(data.mop_code);
                    popover.find('input[name=mop-view-name]').val(data.mop_name);
                    popover.find('input[name=mop-view-shortname]').val(data.mop_shortname);
                    popover.find('input[name=mop-view-type]').val(data.top_type);
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            required_readonly();
        });
        $('#add-mop').click(function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('mop-add-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#mop-add-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.mop-add-modal-body');
                    var type = popover.find('#mop-add-type').selectize({
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        }
                    });
                    var type_select = type[0].selectize;
                    type_select.clear();
                    type_select.clearOptions();
                    $.get(window_location+'/docpro_settings/modes_of_payment/get_top', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.top_type,
                                value: data.top_id,
                                code: data.top_code
                            });
                        });
                        type_select.clear();
                        type_select.clearOptions();
                        type_select.cacheRender = {};
                        type_select.load(function(callback){
                            callback(selectOptions);
                        });
                    });

                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    popover.find('button.v-submit').unbind('click');
                    popover.find('button.v-submit').click(function(){
                        var _this = $(this);
                        var validation = Object.create(v_validation);
                        var required_input = validation.required_input(popover);
                        var required_select = validation.required_select(popover);
                        if(!required_input && !required_select){
                            _this.closest('form').submit();
                            _this.attr('disabled', true);
                            _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
                        }
                    });
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            required_readonly();
            initSingleSubmit();
        });
        $('#modes-of-payment-table').on('click', '.edit', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('mop-edit-modal-body')
                    return 'right';
                },
                content: function(){
                    return $('#mop-edit-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.mop-edit-modal-body');
                    popover.find('input[name=mop-edit-seq]').val(data.mop_seq);
                    popover.find('input[name=mop-edit-code]').val(data.mop_code);
                    popover.find('input[name=mop-edit-name]').val(data.mop_name);
                    popover.find('input[name=mop-edit-shortname]').val(data.mop_shortname);
                    popover.find('input[name=mop-edit-id]').val(data.mop_id);
                    var type = popover.find('#mop-edit-type').selectize({
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        }
                    });
                    var type_select = type[0].selectize;
                    type_select.clear();
                    type_select.clearOptions();
                    $.get(window_location+'/docpro_settings/modes_of_payment/get_top', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.top_type,
                                value: data.top_id,
                                code: data.top_code
                            });
                        });
                        type_select.clear();
                        type_select.clearOptions();
                        type_select.cacheRender = {};
                        type_select.load(function(callback){
                            callback(selectOptions);
                        });

                        type_select.setValue(data.top_id);
                    });

                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    popover.find('button.v-submit').unbind('click');
                    popover.find('button.v-submit').click(function(){
                        var _this = $(this);
                        var validation = Object.create(v_validation);
                        var required_input = validation.required_input(popover);
                        var required_select = validation.required_select(popover);
                        if(!required_input && !required_select){
                            _this.closest('form').submit();
                            _this.attr('disabled', true);
                            _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
                        }
                    });
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            required_readonly();
            initSingleSubmit();
        });
        $('#modes-of-payment-table').on('click', '.update', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('mop-update-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#mop-update-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.mop-update-modal-body');
                    popover.find('input[name=mop-update-seq]').val(data.mop_seq);
                    popover.find('input[name=mop-update-code]').val(data.mop_code);
                    popover.find('input[name=mop-update-name]').val(data.mop_name);
                    popover.find('input[name=mop-update-shortname]').val(data.mop_shortname);
                    popover.find('input[name=mop-update-id]').val(data.mop_id);
                    var type = popover.find('#mop-update-type').selectize({
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        }
                    });
                    var type_select = type[0].selectize;
                    type_select.clear();
                    type_select.clearOptions();
                    $.get(window_location+'/docpro_settings/modes_of_payment/get_top', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.top_type,
                                value: data.top_id,
                                code: data.top_code
                            });
                        });
                        type_select.clear();
                        type_select.clearOptions();
                        type_select.cacheRender = {};
                        type_select.load(function(callback){
                            callback(selectOptions);
                        });

                        type_select.setValue(data.top_id);
                    });

                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    popover.find('button.v-submit').unbind('click');
                    popover.find('button.v-submit').click(function(){
                        var _this = $(this);
                        var validation = Object.create(v_validation);
                        var required_input = validation.required_input(popover);
                        var required_select = validation.required_select(popover);
                        if(!required_input && !required_select){
                            _this.closest('form').submit();
                            _this.attr('disabled', true);
                            _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
                        }
                    });
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            required_readonly();
            initSingleSubmit();
        });
        $('body').on('click', '.close-popover', function(){
            $('.popover').popover('hide');
            $('.box-body button').removeAttr('disabled');
        });

    });
</script>