<script type="text/javascript">
	var lvl_1_id = parseFloat($('input[name=default_lvl_1_id]').val());
	var lvl_2_id = parseFloat($('input[name=default_lvl_2_id]').val());
	var lvl_3_id = parseFloat($('input[name=default_lvl_3_id]').val());
	var lvl_1_code = $('input[name=default_lvl_1_code]').val();
	var lvl_2_code = $('input[name=default_lvl_2_code]').val();
	var lvl_3_code = $('input[name=default_lvl_3_code]').val();
	var lvl_1_name = $('input[name=default_lvl_1_name]').val();
	var lvl_2_name = $('input[name=default_lvl_2_name]').val();
	var lvl_3_name = $('input[name=default_lvl_3_name]').val();
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>libs/selectize_2/js/standalone/selectize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/docpro_setup/coa_setup_seq.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/docpro_setup/table/chart_of_accounts.js"></script>
<script>
	var no_space = function(){
        $(".no-space").on({
          keydown: function(e) {
            if (e.which === 32 && $(this).val().length === 0)
              return false;
          },
        });
    }
    var disable_button = function(){
    	if($('.popover').length > 0){
			$('table button').attr('disabled', true);
			$('#add-acc-classification').attr('disabled', true);
			$('#add-line-items').attr('disabled', true);
			$('#add-acc-sub').attr('disabled', true);
		}
    }

	$(document).ready(function(){
		(function(){
            $('#account-elements thead tr.searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#account-elements thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#account-elements thead input").on( 'keyup change', function () {
                acc_elements.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        (function(){
            $('#account-classification thead tr.searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#account-classification thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#account-classification thead input").on( 'keyup change', function () {
                acc_classification.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        (function(){
            $('#line-items thead tr.searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#line-items thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#line-items thead input").on( 'keyup change', function () {
                line_items.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();
        (function(){
            $('#account-subclassification thead tr.searchfilterrow th').each( function () {
                if($(this).index() !== 0){
                    var title = $('#account-subclassification thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
                }
            });
            $("#account-subclassification thead input").on( 'keyup change', function () {
                account_subclassification.column($(this).parent().index()+':visible')
                     .search(this.value)
                     .draw();
            } );
        })();

		var acc_elements = $('#account-elements').DataTable({
			ajax: window_location+'/docpro_setup/chart_of_accounts/acc_elements_get',
			columns: [
                        {
                            mData: null, bSortable: false, bSearchable: false,
                            mRender: function(data, type, full){
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete'><i class='fa fa-times'></i></button>";
                            }
                        },
						{'data': 'lvl_1_seq'},
						{'data': 'lvl_1_code'},
						{
							mRender: function(row, setting, full){
								return full.lvl_1_name + "<button type='button' class='btn btn-raised btn-default btn-xs next-level show-lvl-2 seq-btn-next' title='Show Classifications'><i class='fa fa-angle-right'></i></button>";

							}
						},
					],
			columnDefs: [{targets: 0, width: '100px'}, {targets: 1, width: '40px'}, {targets: 2, width: '80px'}],
            scrollX: true,
            order: [['2', 'asc']],
            orderCellsTop: true,
            bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            },
    		fnDrawCallback: function(oSettings) {
    			$.each(oSettings.aoData, function(index, data){
    				if(data._aData.lvl_1_id+'' === lvl_1_id+''){
    					$('#account-elements tbody tr:eq('+index+')').addClass('selected');
    				}
    			});
    		}
		});
		var acc_classification = $('#account-classification').DataTable({
			ajax: window_location+'/docpro_setup/chart_of_accounts/reload_lvl_2/'+lvl_1_id,
			columns: [
                        {
                            mData: null, bSortable: false, bSearchable: false,
                            mRender: function(data, type, full){
                            	if(full.lvl_2_code+'' === '0'){
                            		return "<span type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View' disabled><i class='fa fa-eye'></i></span>\n\
                                        <span type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit' disabled><i class='fa fa-pencil'></i></span>\n\
                                        <span type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete' disabled><i class='fa fa-times'></i></span>";
                            	}
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete'><i class='fa fa-times'></i></button>";
                            }
                        },
						{'data': 'lvl_2_seq'},
						{'data': 'lvl_1_code'},
						{'data': 'lvl_2_code'},
						{
							mRender: function(row, setting, full){
								return "<button type='button' class='btn btn-raised btn-default btn-xs prev-level show-lvl-1 seq-btn-prev' title='Show Elements'><i class='fa fa-angle-left'></i></button>" + full.lvl_2_name + "<button type='button' class='btn btn-raised btn-default btn-xs next-level show-lvl-3 seq-btn-next' title='Show Line Items'><i class='fa fa-angle-right'></i></button>";
							}
						},
					],
			columnDefs: [{targets: 0, width: '100px'}, {targets: 1, width: '40px'}, {targets: 2, width: '80px'}, {targets: 3, width: '150px'}],
    		scrollX: true,
            order: [['2', 'asc']],
            orderCellsTop: true,
            bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            },
    		fnDrawCallback: function(oSettings) {
    			$.each(oSettings.aoData, function(index, data){
    				if(data._aData.lvl_2_id+'' === lvl_2_id+''){
    					$('#account-classification tbody tr:eq('+index+')').addClass('selected');
    				}
    			});
    		}
		});
		var line_items = $('#line-items').DataTable({
			ajax: window_location+'/docpro_setup/chart_of_accounts/reload_lvl_3/'+lvl_2_id,
			columns: [
                        {
                            mData: null, bSortable: false, bSearchable: false,
                            mRender: function(data, type, full){
                            	if(full.lvl_3_code_int === '0'){
									return "<span type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View' disabled><i class='fa fa-eye'></i></span>\n\
                                        <span type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit' disabled><i class='fa fa-pencil'></i></span>\n\
                                        <span type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete' disabled><i class='fa fa-times'></i></span>";
								}
                               	return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete'><i class='fa fa-times'></i></button>";
                            }
                        },
						{'data': 'lvl_3_seq'},
						{'data': 'lvl_1_code'},
						{'data': 'lvl_2_code'},
						{'data': 'lvl_3_code'},
						{
							mRender: function(row, setting, full){
								return "<button type='button' class='btn btn-raised btn-default btn-xs prev-level show-lvl-2 seq-btn-prev' title='Show Classifications'><i class='fa fa-angle-left'></i></button>" + full.lvl_3_name + "<button type='button' class='btn btn-raised btn-default btn-xs next-level show-lvl-4 seq-btn-next' title='Show Subclassifications'><i class='fa fa-angle-right'></i></button>";
							}
						}
					],
			columnDefs: [{targets: 0, width: '100px'}, {targets: 1, width: '40px'}, {targets: 2, width: '80px'}, {targets: 3, width: '150px'}, {targets: 4, width: '100px'}],
    		scrollX: true,
            order: [['2', 'asc']],
            orderCellsTop: true,
            bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            },
    		fnDrawCallback: function(oSettings) {
    			$.each(oSettings.aoData, function(index, data){
    				if(data._aData.lvl_3_id+'' === lvl_3_id+''){
    					$('#line-items tbody tr:eq('+index+')').addClass('selected');
    				}
    			});
    		}
		});
		var account_subclassification = $('#account-subclassification').DataTable({
			ajax: window_location+'/docpro_setup/chart_of_accounts/reload_lvl_4/'+lvl_3_id,
			columns: [
                        {
                            mData: null, bSortable: false, bSearchable: false,
                            mRender: function(data, type, full){
                            	if(full.lvl_4_code+'' === '0'){
                            		return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <span type=button class='btn btn-danger btn-xs btn-raised title' custom-title='Delete' disabled><i class='fa fa-times'></i></span>";
                            	}
                                return "<button type='button' class='btn btn-primary btn-xs btn-raised view title' custom-title='View'><i class='fa fa-eye'></i></button>\n\
                                        <button type='button' class='btn btn-success btn-xs btn-raised edit title' custom-title='Edit'><i class='fa fa-pencil'></i></button>\n\
                                        <button type=button class='btn btn-danger btn-xs btn-raised delete title' custom-title='Delete'><i class='fa fa-times'></i></button>";
                            }
                        },
						{'data': 'lvl_4_seq'},
						{'data': 'lvl_1_code'},
						{'data': 'lvl_2_code'},
						{'data': 'lvl_3_code'},
						{'data': 'lvl_4_code'},
						{
							mRender: function(row, setting, full){
								return "<button type='button' class='btn btn-raised btn-default btn-xs prev-level show-lvl-3 seq-btn-prev' title='Show Line Items'><i class='fa fa-angle-left'></i></button>" + full.lvl_4_name;
							}
						},
						{'data': 'bir'},
					],
			columnDefs: [{targets: 0, width: '100px'}, {targets: 1, width: '40px'}, {targets: 2, width: '80px'}, {targets: 3, width: '150px'}, {targets: 4, width: '100px'}, {targets: 5, width: '150px'}],
    		scrollX: true,
            order: [['2', 'asc']],
            orderCellsTop: true,
            bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            }
		});
		
		if(lvl_1_id === 0 || isNaN(lvl_1_id)){
			$('#add-acc-classification').attr('disabled', true);
			$('#lvl-2-alert').css('display', 'block');
		}else{
			$('#add-acc-classification').removeAttr('disabled');
			$('#lvl-2-alert').css('display', 'none');
		}
		if(lvl_2_id === 0 || isNaN(lvl_2_id)){
			$('#add-line-items').attr('disabled', true);
			$('#lvl-3-alert').css('display', 'block');
		}else{
			$('#add-line-items').removeAttr('disabled');
			$('#lvl-3-alert').css('display', 'none');
		}
		if(lvl_3_id === 0 || isNaN(lvl_3_id)){
			$('#add-acc-sub').attr('disabled', true);
			$('#lvl-4-alert').css('display', 'block');
		}else{
			$('#add-acc-sub').removeAttr('disabled');
			$('#lvl-4-alert').css('display', 'none');
		}

		var init_breadcrumb = function(){
			$('#coa_breadcrumb').html(
									"<li><a href='#'>"+((lvl_1_name === '') ? '...' : lvl_1_name)+"</a></li>"+
									"<li><a href='#'>"+((lvl_2_name === '') ? '...' : lvl_2_name)+"</a></li>"+
									"<li><a href='#'>"+((lvl_3_name === '') ? '...' : lvl_3_name)+"</a></li>"
								);
		}
		init_breadcrumb();

		init_general_search(acc_elements, '.general-search-lvl1');
        init_general_search(acc_classification, '.general-search-lvl2');
        init_general_search(line_items, '.general-search-lvl3');
        init_general_search(account_subclassification, '.general-search-lvl4');

        hide_columns(acc_elements, acc_classification, line_items, account_subclassification,);
        init_table_settings(acc_elements, acc_classification, line_items, account_subclassification);

		$('#account-elements').on('click', 'tbody tr', function(){
			$(this).closest('table').find('tr').removeClass('selected');
			$(this).addClass('selected');
			lvl_1_code = acc_elements.row($(this)).data().lvl_1_code;
			lvl_1_id = acc_elements.row($(this)).data().lvl_1_id;
			lvl_1_name = acc_elements.row($(this)).data().lvl_1_name;
			lvl_2_code = 0;
			lvl_3_code = 0;
			lvl_2_id = 0;
			lvl_3_id = 0;
			lvl_2_name = '';
			lvl_3_name = '';
			init_breadcrumb();
		});

		$('#account-classification').on('click', 'tbody tr', function(){
			$(this).closest('table').find('tr').removeClass('selected');
			$(this).addClass('selected');
			lvl_2_code = acc_classification.row($(this)).data().lvl_2_code;
			lvl_2_id = acc_classification.row($(this)).data().lvl_2_id;
			lvl_2_name = acc_classification.row($(this)).data().lvl_2_name;
			lvl_3_code = 0;
			lvl_3_id = 0;
			lvl_3_name = '';
			init_breadcrumb();
		});

		$('#line-items').on('click', 'tbody tr', function(){
			$(this).closest('table').find('tr').removeClass('selected');
			$(this).addClass('selected');
			lvl_3_code = line_items.row($(this)).data().lvl_3_code;
			lvl_3_id = line_items.row($(this)).data().lvl_3_id;
			lvl_3_name = line_items.row($(this)).data().lvl_3_name;
			init_breadcrumb();
		});


// ACCOUNT ELEMENTS POPOVER
		$('#add-acc-elements').click(function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-elements-add');
					return 'right';
				},
				content: function(){
					return $('#add-acc-elements-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-elements-add');
					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-elements').on('click', 'button.view', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = acc_elements.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-elements-view');
					return 'right';
				},
				content: function(){
					return $('#view-acc-elements-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-elements-view');
					popover.find('input[name=acc-elements-view-code]').val(data.lvl_1_code);
					popover.find('input[name=acc-elements-view-name]').val(data.lvl_1_name);
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
		$('#account-elements').on('click', 'button.edit', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = acc_elements.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-elements-edit');
					return 'right';
				},
				content: function(){
					return $('#edit-acc-elements-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-elements-edit');
					popover.find('input[name=acc-elements-edit-code]').val(data.lvl_1_code);
					popover.find('input[name=acc-elements-edit-name]').val(data.lvl_1_name);
					popover.find('input[name=acc-elements-edit-id]').val(data.lvl_1_id);
					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					restriction.number();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-elements').on('click', 'button.delete', function(){
			var data = acc_elements.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-elements-delete');
					return 'right';
				},
				content: function(){
					return $('#delete-acc-elements-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-elements-delete');
					popover.find('input[name=acc-elements-delete-code]').val(data.lvl_1_code);
					popover.find('input[name=acc-elements-delete-name]').val(data.lvl_1_name);
					popover.find('input[name=acc-elements-delete-id]').val(data.lvl_1_id);
					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
				},
				container: 'body'
			});
			$(this).popover('toggle');
			initRipple();
			no_space();
		});
// ACCOUNT CLASSIFICATION POPOVER
		$('#add-acc-classification').click(function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-classification-add');
					return 'right';
				},
				content: function(){
					return $('#add-acc-classification-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-classification-add');
					popover.find('input[name=add-lvl2-lvl1-code]').val(lvl_1_code);
					popover.find('input[name=acc-classification-add-elements]').val(lvl_1_id);
					popover.find('#acc-classification-add-elements').val(lvl_1_id);
					popover.find('#acc-classification-add-elements').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body',
						onChange: function(){
							var val = popover.find('#acc-classification-add-elements').val();
							var code = popover.find('#add-acc-classification-popover #acc-classification-add-elements').find("option[value="+val+"]").attr('code');
							$('#add-lvl2-lvl1-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-classification').on('click', 'button.view', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = acc_classification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-classification-view');
					return 'right';
				},
				content: function(){
					return $('#view-acc-classification-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-classification-view');
					popover.find('input[name=acc-classification-view-code]').val(data.lvl_2_code);
					popover.find('input[name=acc-classification-view-name]').val(data.lvl_2_name);
					popover.find('input[name=view-lvl2-lvl1-code]').val(data.lvl_1_code);
					popover.find('#acc-classification-view-elements').val(data.lvl_1_id);
					popover.find('#acc-classification-view-elements').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
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
		});
		$('#account-classification').on('click', 'button.edit', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = acc_classification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-classification-edit');
					return 'right';
				},
				content: function(){
					return $('#edit-acc-classification-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-classification-edit');
					popover.find('input[name=acc-classification-edit-code]').val(data.lvl_2_code);
					popover.find('input[name=acc-classification-edit-name]').val(data.lvl_2_name);
					popover.find('input[name=acc-classification-edit-id]').val(data.lvl_2_id);
					popover.find('input[name=acc-classification-edit-join-id]').val(data.coalvl12_id);
					popover.find('input[name=acc-classification-edit-elements]').val(data.lvl_1_id);
					popover.find('input[name=edit-lvl2-lvl1-code]').val(data.lvl_1_code);
					popover.find('#acc-classification-edit-elements').val(lvl_1_id);
					popover.find('#acc-classification-edit-elements').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: null,
						onChange: function(){
							var val = popover.find('#acc-classification-edit-elements').val();
							var code = popover.find('#edit-acc-classification-popover #acc-classification-edit-elements').find("option[value="+val+"]").attr('code');
							$('#edit-lvl2-lvl1-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					restriction.number();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-classification').on('click', 'button.delete', function(){
			var data = acc_classification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-classification-delete');
					return 'right';
				},
				content: function(){
					return $('#delete-acc-classification-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-classification-delete');
					popover.find('input[name=acc-classification-delete-code]').val(data.lvl_2_code);
					popover.find('input[name=acc-classification-delete-name]').val(data.lvl_2_name);
					popover.find('input[name=acc-classification-delete-id]').val(data.lvl_2_id);
					popover.find('input[name=acc-classification-delete-join-id]').val(data.coalvl12_id);
					popover.find('input[name=delete-lvl2-lvl1-code]').val(data.lvl_1_code);
					popover.find('#acc-classification-delete-elements').val(data.lvl_1_id);
					popover.find('#acc-classification-delete-elements').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
				},
				container: 'body'
			});
			$(this).popover('toggle');
			initRipple();
			no_space();
		});
// LINE ITEMS POPOVER
		$('#add-line-items').click(function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('line-items-add');
					return 'right';
				},
				content: function(){
					return $('#add-line-items-popover').html();
				},
				callback: function(){
					var popover = $('.popover.line-items-add');
					popover.find('input[name=add-lvl3-lvl2-code]').val(lvl_2_code);
					popover.find('input[name=line-items-add-classification]').val(lvl_2_id);
					popover.find('#line-items-add-classification').val(lvl_2_id);
					popover.find('#line-items-add-classification').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body',
						onChange: function(){
							var val = popover.find('#line-items-add-classfication').val();
							var code = popover.find('#add-line-items-popover #line-items-add-classfication').find("option[value="+val+"]").attr('code');
							$('#add-lvl3-lvl2-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#line-items').on('click', 'button.view', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = line_items.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('line-items-view');
					return 'right';
				},
				content: function(){
					return $('#view-line-items-popover').html();
				},
				callback: function(){
					var popover = $('.popover.line-items-view');
					popover.find('input[name=line-items-view-code]').val(data.lvl_3_code);
					popover.find('input[name=line-items-view-name]').val(data.lvl_3_name);
					popover.find('input[name=view-lvl3-lvl2-code]').val(data.lvl_2_code);
					popover.find('#line-items-view-classfication').val(data.lvl_2_id);
					popover.find('#line-items-view-classfication').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
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
		});
		$('#line-items').on('click', 'button.edit', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = line_items.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('line-items-edit');
					return 'right';
				},
				content: function(){
					return $('#edit-line-items-popover').html();
				},
				callback: function(){
					var popover = $('.popover.line-items-edit');
					popover.find('input[name=line-items-edit-code]').val(data.lvl_3_code);
					popover.find('input[name=line-items-edit-name]').val(data.lvl_3_name);
					popover.find('input[name=line-items-edit-id]').val(data.lvl_3_id);
					popover.find('input[name=line-items-edit-join-id]').val(data.coalvl23_id);
					popover.find('input[name=line-items-edit-classification]').val(data.lvl_2_id);
					popover.find('input[name=edit-lvl3-lvl2-code]').val(data.lvl_2_code);
					popover.find('#line-items-edit-classification').val(lvl_2_id);
					popover.find('#line-items-edit-classification').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body',
						onChange: function(){
							var val = popover.find('#line-items-edit-classification').val();
							var code = popover.find('#edit-line-items-popover #line-items-edit-classification').find("option[value="+val+"]").attr('code');
							$('#edit-lvl3-lvl2-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					restriction.number();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#line-items').on('click', 'button.delete', function(){
			var data = line_items.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('line-items-delete');
					return 'right';
				},
				content: function(){
					return $('#delete-line-items-popover').html();
				},
				callback: function(){
					var popover = $('.popover.line-items-delete');
					popover.find('input[name=line-items-delete-code]').val(data.lvl_3_code);
					popover.find('input[name=line-items-delete-name]').val(data.lvl_3_name);
					popover.find('input[name=line-items-delete-id]').val(data.lvl_3_id);
					popover.find('input[name=line-items-delete-join-id]').val(data.coalvl23_id);
					popover.find('input[name=delete-lvl3-lvl2-code]').val(data.lvl_2_code);
					popover.find('#line-items-delete-classification').val(data.lvl_2_id);
					popover.find('#line-items-delete-classification').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
				},
				container: 'body'
			});
			$(this).popover('toggle');
			initRipple();
			no_space();
		});
// Account Subclassification POPOVER
		$('#add-acc-sub').click(function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-sub-add');
					return 'right';
				},
				content: function(){
					return $('#add-acc-sub-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-sub-add');
					popover.find('input[name=add-lvl4-lvl3-code]').val(lvl_3_code);
					popover.find('input[name=acc-sub-add-line-item]').val(lvl_3_id);
					popover.find('#acc-sub-add-line-item').val(lvl_3_id);
					popover.find('#acc-sub-add-line-item').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body',
						onChange: function(){
							var val = popover.find('#acc-sub-add-line-item').val();
							var code = popover.find('#add-acc-sub-popover #acc-sub-add-line-item').find("option[value="+val+"]").attr('code');
							$('#add-lvl4-lvl3-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-subclassification').on('click', 'button.view', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = account_subclassification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-sub-view');
					return 'right';
				},
				content: function(){
					return $('#view-acc-sub-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-sub-view');
					popover.find('input[name=acc-sub-view-code]').val(data.lvl_4_code);
					popover.find('input[name=acc-sub-view-name]').val(data.lvl_4_name);
					popover.find('input[name=bir]').val(data.bir);
					popover.find('input[name=view-lvl4-lvl3-code]').val(data.lvl_3_code);
					popover.find('#acc-sub-view-line-item').val(data.lvl_3_id);
					popover.find('#acc-sub-view-line-item').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
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
		});
		$('#account-subclassification').on('click', 'button.edit', function(){
			$('body').on('hidden.bs.popover', function (e) {
			    $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
			});
			var data = account_subclassification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-sub-edit');
					return 'right';
				},
				content: function(){
					return $('#edit-acc-sub-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-sub-edit');
					popover.find('input[name=acc-sub-edit-code]').val(data.lvl_4_code);
					popover.find('input[name=acc-sub-edit-name]').val(data.lvl_4_name);
					popover.find('input[name=acc-sub-edit-id]').val(data.lvl_4_id);
					popover.find('input[name=acc-sub-edit-join-id]').val(data.coalvl34_id);
					popover.find('input[name=acc-sub-edit-line-item]').val(data.lvl_3_id);
					popover.find('input[name=edit-lvl4-lvl3-code]').val(data.lvl_3_code);
					popover.find('input[name=acc-sub-edit-line-item-val]').val(lvl_3_id);
					popover.find('input[name=edit-lvl4-lvl3-code]').val(lvl_3_code);
					if(data.lvl_4_code === '0'){
						popover.find('input[name=acc-sub-edit-code]').attr('readonly', true);
						popover.find('input[name=acc-sub-edit-name]').attr('readonly', true);
					}else{
						popover.find('input[name=acc-sub-edit-code]').removeAttr('readonly');
						popover.find('input[name=acc-sub-edit-name]').removeAttr('readonly');
					}
					popover.find('input[name=bir]').val(data.bir);
					popover.find('#acc-sub-edit-line-item').val(lvl_3_id);
					popover.find('#acc-sub-edit-line-item').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body',
						onChange: function(){
							var val = $('#acc-sub-edit-line-item').val();
							var code = $('#edit-acc-sub-popover #acc-sub-edit-line-item').find("option[value="+val+"]").attr('code');
							$('#edit-lvl4-lvl3-code').val(code);
						},
					});

					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
					var restriction = Object.create(v_restriction);
					restriction.required();
					restriction.no_space();
					restriction.number();
					$(popover).find('button.v-submit').unbind('click');
					$(popover).find('button.v-submit').click(function(){
						var _this = $(this);
						var validation = Object.create(v_validation);
						var required_input = validation.required_input(popover);
						var format_input = validation.format_input(popover);
						if(!required_input && !format_input){
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
			initNumberValidation();
			initSingleSubmit();
		});
		$('#account-subclassification').on('click', 'button.delete', function(){
			var data = account_subclassification.row(this.closest('tr')).data();
			$(this).popover({
				animation: true,
				html: true,
				placement: function(context, src){
					$(context).addClass('acc-sub-delete');
					return 'right';
				},
				content: function(){
					return $('#delete-acc-sub-popover').html();
				},
				callback: function(){
					var popover = $('.popover.acc-sub-delete');
					popover.find('input[name=acc-sub-delete-code]').val(data.lvl_4_code);
					popover.find('input[name=acc-sub-delete-name]').val(data.lvl_4_name);
					popover.find('input[name=acc-sub-delete-id]').val(data.lvl_4_id);
					popover.find('input[name=acc-sub-delete-join-id]').val(data.coalvl34_id);
					popover.find('input[name=delete-lvl4-lvl3-code]').val(lvl_3_code);
					popover.find('#acc-sub-delete-line-item').val(data.lvl_3_id);
					popover.find('input[name=bir]').val(data.bir);
					popover.find('#acc-sub-delete-line-item').selectize({
						create: false,
						sortField: {
							field: 'text',
							direction: 'asc'
						},
						dropdownParent: 'body'
					});
					
					popover.find('input[name=lvl_1_id]').val(lvl_1_id);
					popover.find('input[name=lvl_2_id]').val(lvl_2_id);
					popover.find('input[name=lvl_3_id]').val(lvl_3_id);
					popover.find('input[name=lvl_1_code]').val(lvl_1_code);
					popover.find('input[name=lvl_2_code]').val(lvl_2_code);
					popover.find('input[name=lvl_3_code]').val(lvl_3_code);
					popover.find('input[name=lvl_1_name]').val(lvl_1_name);
					popover.find('input[name=lvl_2_name]').val(lvl_2_name);
					popover.find('input[name=lvl_3_name]').val(lvl_3_name);
				},
				container: 'body'
			});
			$(this).popover('toggle');
			initRipple();
			no_space();
		});
// CLOSE BTN
		$('body').on('click', '.close-popover', function(){
	        $('.popover').popover('hide');
	        $('.box-body button').removeAttr('disabled');
	    });



        coa_seq.currentPhaseStarted = function(id, sequence){
            if(lvl_1_id === 0 || isNaN(lvl_1_id)){
                $('#lvl-2-alert').css('display', 'block');      
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-classification').attr('disabled', true);
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }else{
                $('#lvl-2-alert').css('display', 'none');       
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-classification').removeAttr('disabled');
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }
            if(lvl_2_id === 0 || isNaN(lvl_2_id)){
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }else{
                $('#lvl-3-alert').css('display', 'none');       
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-line-items').removeAttr('disabled');
                $('#add-acc-sub').attr('disabled', true);
            }
            if(lvl_3_id === 0 || isNaN(lvl_3_id)){
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-sub').attr('disabled', true);
            }else{  
                $('#lvl-4-alert').css('display', 'none');       
                $('#add-acc-sub').removeAttr('disabled');
            }
            if(!$.active){
                $('#lvl-2-plate').css('opacity', '1');
                $('#lvl-3-plate').css('opacity', '1');
                $('#lvl-4-plate').css('opacity', '1');
            }else{
                $('#lvl-2-plate').css('opacity', '0');
                $('#lvl-3-plate').css('opacity', '0');
                $('#lvl-4-plate').css('opacity', '0');
            }
            $(document).ajaxComplete(function(){
                $('#lvl-2-plate').css('opacity', '1');
                $('#lvl-3-plate').css('opacity', '1');
                $('#lvl-4-plate').css('opacity', '1');
                $(document).unbind('ajaxComplete');
            });

            acc_classification.ajax.url(window_location+'/docpro_setup/chart_of_accounts/reload_lvl_2/'+lvl_1_id).load(function(){});
            line_items.ajax.url(window_location+'/docpro_setup/chart_of_accounts/reload_lvl_3/'+lvl_2_id).load(function(){});
            account_subclassification.ajax.url(window_location+'/docpro_setup/chart_of_accounts/reload_lvl_4/'+lvl_3_id).load(function(){});
        }

        var init = function(){
            if(lvl_1_id === 0 || isNaN(lvl_1_id)){
                $('#lvl-2-alert').css('display', 'block');      
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-classification').attr('disabled', true);
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }else{
                $('#lvl-2-alert').css('display', 'none');       
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-classification').removeAttr('disabled');
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }
            if(lvl_2_id === 0 || isNaN(lvl_2_id)){
                $('#lvl-3-alert').css('display', 'block');      
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-line-items').attr('disabled', true);
                $('#add-acc-sub').attr('disabled', true);
            }else{
                $('#lvl-3-alert').css('display', 'none');       
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-line-items').removeAttr('disabled');
                $('#add-acc-sub').attr('disabled', true);
            }
            if(lvl_3_id === 0 || isNaN(lvl_3_id)){
                $('#lvl-4-alert').css('display', 'block');      
                $('#add-acc-sub').attr('disabled', true);
            }else{  
                $('#lvl-4-alert').css('display', 'none');       
                $('#add-acc-sub').removeAttr('disabled');
            }
            if(!$.active){
                $('#lvl-2-plate').css('opacity', '1');
                $('#lvl-3-plate').css('opacity', '1');
                $('#lvl-4-plate').css('opacity', '1');
            }else{
                $('#lvl-2-plate').css('opacity', '0');
                $('#lvl-3-plate').css('opacity', '0');
                $('#lvl-4-plate').css('opacity', '0');
            }
            $(document).ajaxComplete(function(){
                $('#lvl-2-plate').css('opacity', '1');
                $('#lvl-3-plate').css('opacity', '1');
                $('#lvl-4-plate').css('opacity', '1');
                $(document).unbind('ajaxComplete');
            });

            acc_classification.ajax.url(window_location+'/company_settings/chart_of_accounts/reload_lvl_2/'+lvl_1_id).load(function(){});
            line_items.ajax.url(window_location+'/company_settings/chart_of_accounts/reload_lvl_3/'+lvl_2_id).load(function(){});
            account_subclassification.ajax.url(window_location+'/company_settings/chart_of_accounts/reload_lvl_4/'+lvl_3_id).load(function(){});
        }
        init();

	});
</script>