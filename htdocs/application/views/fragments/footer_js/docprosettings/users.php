<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/docpro_settings/table/users.js"></script>
<script>
    var all_users = [];
    $.get(window_location+'/docpro_settings/users/get_all_users', function(response){
        $.each(JSON.parse(response), function(index, data){
            all_users.push(data.u_name);
        });
    });
</script>
<script>
    var no_space = function(){
        $(".no-space").on({
          keydown: function(e) {
            if (e.which === 32 && $(this).val().length === 0)
              return false;
          },
        });
    }

    var check_username = function(u_name){
        $('.add-username').keyup(function(){
            if(all_users.indexOf($(this).val()) !== -1){
                $(this).css('border', '1px solid red');
                $('#add-username-notif').css('display', 'block');
                $('#add-submit').attr('disabled', true);
            }else{
                $(this).css('border', '1px solid #ccc');
                $('#add-username-notif').css('display', 'none');
                $('#add-submit').removeAttr('disabled');
            }
        });
        $('.edit-username').keyup(function(){
            if(u_name !== $(this).val()){
                if(all_users.indexOf($(this).val()) !== -1){
                    $(this).css('border', '1px solid red');
                    $('#edit-username-notif').css('display', 'block');
                    $('#edit-submit').attr('disabled', true);
                }else{
                    $(this).css('border', '1px solid #ccc');
                    $('#edit-username-notif').css('display', 'none');
                    $('#edit-submit').removeAttr('disabled');
                }
            }else{
                $(this).css('border', '1px solid #ccc');
                $('#edit-username-notif').css('display', 'none');
                $('#edit-submit').removeAttr('disabled');
            }
        });
    }
    var does_password_match = function(){
        $('.add-password1').keyup(function(){
            if($(this).val() === $('.add-password2').val()){
                $('#add-submit').removeAttr('disabled');
                $('#add-password-match').css('display', 'none');
                $(this).css('border', '1px solid #ccc');
                $('.add-password2').css('border', '1px solid #ccc');
            }else{
                $('#add-submit').attr('disabled', true);
                $('#add-password-match').css('display', 'block');
                $(this).css('border', '1px solid red');
                $('.add-password2').css('border', '1px solid red');
            }
        });
        $('.add-password2').keyup(function(){
            if($(this).val() === $('.add-password1').val()){
                $('#add-submit').removeAttr('disabled');
                $('#add-password-match').css('display', 'none');
                $(this).css('border', '1px solid #ccc');
                $('.add-password1').css('border', '1px solid #ccc');
            }else{
                $('#add-submit').attr('disabled', true);
                $('#add-password-match').css('display', 'block');
                $(this).css('border', '1px solid red');
                $('.add-password1').css('border', '1px solid red');
            }
        });
        $('.edit-password1').keyup(function(){
            if($(this).val() === $('.edit-password2').val()){
                $('#edit-submit').removeAttr('disabled');
                $('#edit-password-match').css('display', 'none');
                $(this).css('border', '1px solid #ccc');
                $('.edit-password2').css('border', '1px solid #ccc');
            }else{
                $('#edit-submit').attr('disabled', true);
                $('#edit-password-match').css('display', 'block');
                $(this).css('border', '1px solid red');
                $('.edit-password2').css('border', '1px solid red');
            }
        });
        $('.edit-password2').keyup(function(){
            if($(this).val() === $('.edit-password1').val()){
                $('#edit-submit').removeAttr('disabled');
                $('#edit-password-match').css('display', 'none');
                $(this).css('border', '1px solid #ccc');
                $('.edit-password1').css('border', '1px solid #ccc');
            }else{
                $('#edit-submit').attr('disabled', true);
                $('#edit-password-match').css('display', 'block');
                $(this).css('border', '1px solid red');
                $('.edit-password1').css('border', '1px solid red');
            }
        });
    }
    $(document).ready(function(){
        (function(){
            $('#users-table thead tr#searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#users-table thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#users-table thead input").on( 'keyup change', function () {
                table.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        
        var table = $('#users-table').DataTable({
            ajax: window_location+'/docpro_settings/users/get',
            columns: [
                        {
                            mData: null, bSortable: false,
                            mRender: function(data, type, full){
                                if(full.u_flag === '0'){
                                    return "<button type='button' class='btn btn-primary btn-xs btn-raised title view' custom-title='View' disabled><i class='fa fa-eye'></i></button>\n\
                                       <button type='button' class='btn btn-success btn-xs btn-raised title edit' custom-title='Edit' disabled><i class='fa fa-pencil'></i></button>";
                                }
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised title view' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                       <button type='button' class='btn btn-success btn-xs btn-raised title edit' custom-title='Edit'><i class='fa fa-pencil'></i></button>";
                            }
                        },
                        {'data': 'u_seq'},
                        {
                            mRender: function(data, type, full){
                               return full.p_fname+" "+full.p_mname+" "+full.p_lname;
                            }
                        },
                        {'data': 'p_address'}, {'data': 'p_cno'}, {'data': 'p_email'}, {'data': 'u_name'}, {'data': 'u_type'}
                    ],
                    createdRow: function( row, data, dataIndex ) {
                        if(data.u_flag === '0'){
                            $(row).css('color', '#a5a5a5');
                            $(row).addClass('disabled');
                        }
                    },
                    columnDefs: [{targets: 0, width: '100px'}, {targets: 1, width: '40px'}],
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
                    popover.find('#add-user-type').selectize({});
                    var restriction = Object.create(v_restriction);
                    restriction.number();
                    restriction.required();
                    restriction.format();
                    restriction.no_space();
                    restriction.tin();
                    restriction.select_required();
                    restriction.min_date();
                    restriction.unique();

                    popover.find('button.v-submit').unbind('click');
                    popover.find('button.v-submit').click(function(){
                        var _this = $(this);
                        var validation = Object.create(v_validation);
                        var required_input = validation.required_input(popover);
                        var required_select = validation.required_select(popover);
                        var format_input = validation.format_input(popover, function(){});
                        var unique_input = validation.unique_input(popover, function(is_unique){
                            if(!required_input && !format_input && !required_select && !is_unique){
                                _this.closest('form').submit();
                                _this.attr('disabled', true);
                                _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
                            }
                        });
                    })

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
            required_readonly();
            does_password_match();
            // check_username('');
            initSingleSubmit();
        });
        $('#users-table').on('click', '.view', function(){
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
                    popover.find('input[name=view-seq]').val(data.u_seq);
                    popover.find('input[name=view-fname]').val(data.p_fname);
                    popover.find('input[name=view-mname]').val(data.p_mname);
                    popover.find('input[name=view-lname]').val(data.p_lname);
                    popover.find('input[name=view-cno]').val(data.p_cno);
                    popover.find('input[name=view-email]').val(data.p_email);
                    popover.find('input[name=view-address]').val(data.p_address);
                    popover.find('input[name=view-username]').val(data.u_name);
                    popover.find('input[name=view-company]').val(data.cb_name);
                    popover.find('input[name=view-user-type]').val(data.u_type);
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
            required_readonly();
            does_password_match();
            // check_username();
        });
        $('#users-table').on('click', '.edit', function(){
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
                    popover.find('input[name=edit-seq]').val(data.u_seq);
                    popover.find('input[name=edit-fname]').val(data.p_fname);
                    popover.find('input[name=edit-mname]').val(data.p_mname);
                    popover.find('input[name=edit-lname]').val(data.p_lname);
                    popover.find('input[name=edit-address]').val(data.p_address);
                    popover.find('input[name=edit-cno]').val(data.p_cno);
                    popover.find('input[name=edit-email]').val(data.p_email);
                    popover.find('input[name=edit-uname]').val(data.u_name);
                    popover.find('input[name=edit-uname]').attr('o_v', data.u_name);
                    popover.find('input[name=edit-company]').val(data.cb_name);
                    popover.find('select[name=edit-user-type]').val(data.u_type);
                    popover.find('input[name=p-id]').val(data.p_id);
                    popover.find('input[name=cb-id]').val(data.cb_id);
                    popover.find('input[name=edit-cb-id]').val(data.cb_id);
                    popover.find('input[name=edit-id]').val(data.u_id);
                    popover.find('select[name=edit-user-type]').selectize({});

                    var restriction = Object.create(v_restriction);
                    restriction.number();
                    restriction.required();
                    restriction.format();
                    restriction.no_space();
                    restriction.tin();
                    restriction.select_required();
                    restriction.min_date();
                    restriction.unique_edit();

                    popover.find('button.v-submit').unbind('click');
                    popover.find('button.v-submit').click(function(){
                        var _this = $(this);
                        var validation = Object.create(v_validation);
                        var required_input = validation.required_input(popover);
                        var required_select = validation.required_select(popover);
                        var format_input = validation.format_input(popover, function(){});
                        var unique_input = validation.unique_input_edit(popover, function(is_unique){
                            if(!required_input && !format_input && !required_select && !is_unique){
                                _this.closest('form').submit();
                                _this.attr('disabled', true);
                                _this.html("<i class='fa fa-circle-o-notch fa-spin'></i> &nbsp; Loading");
                            }
                        });
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
            initNumberValidation();
            required_readonly();
            does_password_match();
            // check_username(data.u_name);
            initSingleSubmit();
        });
        $('body').on('click', '.close-popover', function(){
            $('.popover').popover('hide');
            $('.box-body button').removeAttr('disabled');
            $('tr.disabled button').attr('disabled', true);
        });
    });
</script>