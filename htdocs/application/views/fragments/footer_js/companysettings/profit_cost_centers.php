<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company_settings/table/profit_cost_center.js"></script>
<script>
    var stopPropagation = function(evt) {
        if (evt.stopPropagation !== undefined) {
            evt.stopPropagation();
        } else {
            evt.cancelBubble = true;
        }
    }
    $(document).ready(function(){
        (function(){
            $('#profit-cost-centers-table thead tr#searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#profit-cost-centers-table thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#profit-cost-centers-table thead input").on( 'keyup change', function () {
                table.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();

        var table = $('#profit-cost-centers-table').DataTable({
            ajax: window_location+'/company_settings/profit_cost_centers/get',
            columns:[
                        {
                            mData: null, bSortable: false,
                            mRender: function(data, type, full){
                                if($('input#mc_id').val() === $('input#bc_id').val()){
                                    return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type='button' class='btn btn-warning btn-xs btn-raised update title' title='Update'><i class='fa fa-refresh'></i></button>";
                                }
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' title='View' disabled><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' title='Edit' disabled><i class='fa fa-pencil'></i></button>\n\
                                        <button type='button' class='btn btn-warning btn-xs btn-raised update title' title='Update' disabled><i class='fa fa-refresh'></i></button>";
                            }
                        },
                        {'data': 'co_pcc_seq'}, {'data': 'co_pcc_code'}, {'data': 'co_pcc_name'}, {'data': 'co_pcc_shortname'}, {'data': 'co_de_name'}
                    ],
            columnDefs: [{targets: 0, width: '100px'}, {targets: [1,2], width: '100px'}],
            scrollX: true,
            order: [['2', 'asc']],
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
        
        $('#add').click(function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('add-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#add-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.add-modal-body');
                    var dept = popover.find('select[name=add-department]').selectize({
                        plugins: ['no_results_found'],
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        },
                        dropdownParent: null
                    });
                    var dept_selectize = dept[0].selectize;
                    dept_selectize.clear();
                    dept_selectize.clearOptions();
                    $.get(window_location+'/company_settings/profit_cost_centers/get_departments', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.co_de_name,
                                value: data.co_de_id,
                                code: data.co_de_code
                            });
                        });
                        dept_selectize.clear();
                        dept_selectize.clearOptions();
                        dept_selectize.renderCache = {};
                        dept_selectize.load(function(callback){
                            callback(selectOptions);
                        });
                    });
                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    restriction.number();
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
            initSingleSubmit();
        });
        $('#profit-cost-centers-table').on('click', '.view', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context,src){
                    $(context).addClass('view-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#view-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.view-modal-body');
                    popover.find('input[name=view-seq]').val(data.co_pcc_seq);
                    popover.find('input[name=view-code]').val(data.co_pcc_code);
                    popover.find('input[name=view-department]').val(data.co_de_name);
                    popover.find('input[name=view-name]').val(data.co_pcc_name);
                    popover.find('input[name=view-shortname]').val(data.co_pcc_shortname);
                },
                container:'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
        });
        $('#profit-cost-centers-table').on('click', '.edit', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, json){
                    $(context).addClass('edit-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#edit-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.edit-modal-body');
                    popover.find('input[name=edit-seq]').val(data.co_pcc_seq);
                    popover.find('input[name=edit-code]').val(data.co_pcc_code);
                    popover.find('input[name=edit-name]').val(data.co_pcc_name);
                    popover.find('input[name=edit-shortname]').val(data.co_pcc_shortname);
                    popover.find('input[name=edit-id]').val(data.co_pcc_id);
                    var dept = popover.find('select[name=edit-department]').selectize({
                        plugins: ['no_results_found'],
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        },
                        dropdownParent: null
                    });
                    var dept_selectize = dept[0].selectize;
                    dept_selectize.clear();
                    dept_selectize.clearOptions();
                    $.get(window_location+'/company_settings/profit_cost_centers/get_departments', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.co_de_name,
                                value: data.co_de_id,
                                code: data.co_de_code
                            });
                        });
                        dept_selectize.clear();
                        dept_selectize.clearOptions();
                        dept_selectize.renderCache = {};
                        dept_selectize.load(function(callback){
                            callback(selectOptions);
                        });
                        dept_selectize.setValue(data.co_de_id);
                    });
                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    restriction.number();
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
            initSingleSubmit();
        });
        $('#profit-cost-centers-table').on('click', '.update', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            let seq = $(this.closest('tr')).find('td:eq(1)').text();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, json){
                    $(context).addClass('update-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#update-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.update-modal-body');
                    popover.find('input[name=update-seq]').val(data.co_pcc_seq);
                    popover.find('input[name=update-code]').val(data.co_pcc_code);
                    popover.find('input[name=update-name]').val(data.co_pcc_name);
                    popover.find('input[name=update-shortname]').val(data.co_pcc_shortname);
                    popover.find('input[name=update-id]').val(data.co_pcc_id);
                    var dept = popover.find('select[name=update-department]').selectize({
                        plugins: ['no_results_found'],
                        create: false,
                        sortField: {
                            field: 'text',
                            sort: 'asc'
                        },
                        dropdownParent: null
                    });
                    var dept_selectize = dept[0].selectize;
                    dept_selectize.clear();
                    dept_selectize.clearOptions();
                    $.get(window_location+'/company_settings/profit_cost_centers/get_departments', function(response){
                        var json_data = JSON.parse(response);
                        var selectOptions = [];
                        $.each(json_data, function(index, data){
                            selectOptions.push({
                                text: data.co_de_name,
                                value: data.co_de_id,
                                code: data.co_de_code
                            });
                        });
                        dept_selectize.clear();
                        dept_selectize.clearOptions();
                        dept_selectize.renderCache = {};
                        dept_selectize.load(function(callback){
                            callback(selectOptions);
                        });
                        dept_selectize.setValue(data.co_de_id);
                    });
                    var restriction = Object.create(v_restriction);
                    restriction.required();
                    restriction.no_space();
                    restriction.select_required();
                    restriction.number();
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
            initSingleSubmit();
        });
        $('body').on('click', '.close-popover', function(){
            $('.popover').popover('hide');
            $('.box-body button').removeAttr('disabled');
        });

        $('body').on('click', 'tr.add-department .no-results-found', function(){
            $('#add-department-modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });

        $('body').on('click', '#add-department-modal button.v-submit', function(){
            var _this = $(this);
            var modal = $(this).closest('.modal');
            var validation = Object.create(v_validation);
            var required_input = validation.required_input(modal);
            var required_select = validation.required_select(modal);
            if(!required_input && !required_select){
                $.ajax({
                    type: 'POST',
                    url: _this.closest('form').attr('action'),
                    data: _this.closest('form').serialize(),
                    success: function(return_id){
                        var popover = $('.popover');
                        popover.find('select[name$="-department"]').selectize()[0].selectize.destroy();
                        var dept = popover.find('select[name$="-department"]').selectize({
                            plugins: ['no_results_found'],
                            create: false,
                            sortField: {
                                field: 'text',
                                sort: 'asc'
                            },
                            dropdownParent: null
                        });
                        var dept_selectize = dept[0].selectize;
                        dept_selectize.clear();
                        dept_selectize.clearOptions();
                        $.get(window_location+'/company_settings/profit_cost_centers/get_departments', function(response){
                            var json_data = JSON.parse(response);
                            var selectOptions = [];
                            $.each(json_data, function(index, data){
                                selectOptions.push({
                                    text: data.co_de_name,
                                    value: data.co_de_id,
                                    code: data.co_de_code
                                });
                            });
                            dept_selectize.clear();
                            dept_selectize.clearOptions();
                            dept_selectize.renderCache = {};
                            dept_selectize.load(function(callback){
                                callback(selectOptions);
                            });
                            dept_selectize.setValue(JSON.parse(return_id).id);
                        });
                        modal.modal('hide');
                        modal.find('input').val('');
                        _this.removeAttr('disabled');
                        _this.html("Ok");
                    }
                });
                _this.attr('disabled', true);
                _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
            }

        });

        $('#add-department-modal').on('hidden.bs.modal', function(){
            $(this).find('input').val('');
            $(this).find('select').val('');
            $(this).find('input').removeClass('v-invalid');
            $(this).find('select').removeClass('v-invalid');
            $(this).find('div').removeClass('v-invalid');
        });
    });
</script>