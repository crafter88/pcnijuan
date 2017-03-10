<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/docpro_settings/table/company.js"></script>
<script>
    var no_space = function(){
        $(".no-space").on({
          keydown: function(e) {
            if (e.which === 32 && $(this).val().length === 0)
              return false;
          },
        });
    }
    $(document).ready(function(){
        (function(){
            $('#company-table thead tr#searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#banks-table thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#company-table thead input").on( 'keyup change', function () {
                table.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        
        var table = $('#company-table').DataTable({
            ajax: window_location+'/docpro_settings/company/get',
            columns:[
                        {
                            mData: null, bSortable: false,
                            mRender: function(data, type, full){
                                if(full.flag === '0'){
                                    return "<button type='button' class='btn btn-primary btn-xs btn-raised title view' custom-title='View' disabled><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised title edit' custom-title='Edit' disabled><i class='fa fa-pencil'></i></button>\n\
                                        <button type='button' class='btn btn-warning btn-xs btn-raised title update' custom-title='Update' disabled><i class='fa fa-refresh'></i></button>";
                                }
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised title view' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised title edit' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type='button' class='btn btn-warning btn-xs btn-raised title update' custom-title='Update'><i class='fa fa-refresh'></i></button>";
                            }
                        },
                        {'data': 'ch_cb_seq'}, 
                        {'data': 'ch_name'},
                        {
                            mRender: function(row, setting, full){
                                return full.ch_cb_address.replace(/;/g, " ");
                            }
                        },
                        {'data': 'ch_cb_tin'}, 
                        {'data': 'ch_cb_bp_type'}, 
                        {'data': 'ch_cb_tax_type'},
                        {'data': 'ch_cb_cno'}, 
                        {'data': 'ch_cb_email'}
                    ],
            createdRow: function( row, data, dataIndex ) {
                if(data.flag === '0'){
                    $(row).css('color', '#a5a5a5');
                    $(row).addClass('disabled');
                }
            },
            columnDefs: [{targets: 0, width: '110px'}, {targets: 1, width: '40px'}],
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
        // init_filter(table);
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

                },
                container: 'body'
            });
            $(this).popover('toggle');
            $('.edit').popover('hide');
            $('.view').popover('hide');
            $('.update').popover('hide');
            initRipple();
        });
        $('#company-table').on('click', '.view', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('view-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#view-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.view-modal-body');
                    popover.find('input[name=view-seq]').val(data.ch_cb_seq);
                    popover.find('input[name=view-code]').val(data.ch_cb_code);
                    popover.find('input[name=view-class]').val(data.ch_cb_class);
                    popover.find('input[name=view-type]').val(data.ch_cb_bp_type);
                    popover.find('input[name=view-name]').val(data.ch_cb_name);
                    popover.find('input[name=view-ind-name]').val(data.ch_cb_ind_name);
                    popover.find('input[name=view-address]').val(data.ch_cb_address);
                    popover.find('input[name=view-tin]').val(data.ch_cb_tin);
                    popover.find('input[name=view-tax-type]').val(data.ch_cb_tax_type);
                    popover.find('input[name=view-cno]').val(data.ch_cb_cno);
                    popover.find('input[name=view-email]').val(data.ch_cb_email);
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            initNumberValidation();
        });
        $('#company-table').on('click', '.edit', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('edit-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#edit-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.edit-modal-body');
                    popover.find('input[name=edit-seq]').val(data.ch_cb_seq);
                    popover.find('input[name=edit-class]').val(data.ch_cb_class);
                    popover.find('input[name=edit-type]').val(data.ch_cb_bp_type);
                    popover.find('input[name=edit-name]').val(data.ch_cb_name);
                    popover.find('input[name=edit-ind-name]').val(data.ch_cb_ind_name);
                    popover.find('input[name=edit-address]').val(data.ch_cb_address);
                    popover.find('input[name=edit-tin]').val(data.ch_cb_tin);
                    popover.find('input[name=edit-tax-type]').val(data.ch_cb_tax_type);
                    popover.find('input[name=edit-cno]').val(data.ch_cb_cno);
                    popover.find('input[name=edit-email]').val(data.ch_cb_email);
                    popover.find('input[name=edit-id]').val(data.ch_cb_id);
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            initNumberValidation();
            initSingleSubmit();
        });
        $('#company-table').on('click', '.update', function(){
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
            var data = table.row(this.closest('tr')).data();
            $(this).popover({
                animation: true,
                html: true,
                placement: function(context, src){
                    $(context).addClass('update-modal-body');
                    return 'right';
                },
                content: function(){
                    return $('#update-popover').html();
                },
                callback: function(){
                    var popover = $('.popover.update-modal-body');
                    popover.find('input[name=update-seq]').val(data.ch_cb_seq);
                    popover.find('input[name=update-class]').val(data.ch_cb_class);
                    popover.find('input[name=update-type]').val(data.ch_cb_bp_type);
                    popover.find('input[name=update-name]').val(data.ch_cb_name);
                    popover.find('input[name=update-ind-name]').val(data.ch_cb_ind_name);
                    popover.find('input[name=update-address]').val(data.ch_cb_address);
                    popover.find('input[name=update-tin]').val(data.ch_cb_tin);
                    popover.find('input[name=update-tax-type]').val(data.ch_cb_tax_type);
                    popover.find('input[name=update-cno]').val(data.ch_cb_cno);
                    popover.find('input[name=update-email]').val(data.ch_cb_email);
                    popover.find('input[name=update-id]').val(data.ch_cb_id);
                },
                container: 'body'
            }).on('show.bs.popover', function(){
                $('.popover').not(this).popover('hide');
                $('.box-body button').attr('disabled', true);
            });
            $(this).popover('toggle');
            initRipple();
            no_space();
            initNumberValidation();
            initSingleSubmit();
        });
        $('body').on('click', '.close-popover', function(){
            $('.popover').popover('hide');
            $('.box-body button').removeAttr('disabled');
            $('tr.disabled button').attr('disabled', true);
        });
    });
</script>