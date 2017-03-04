<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#table').DataTable({
			ajax: window_location+'/read_products',
			columns: [
		                {
		                  mRender: function(row, setting, full){
		                    return "<button type='button' class='btn btn-success btn-xs checkin' title='Checkin'>Checkin</button>"+
		                          "<button type='button' class='btn btn-danger btn-xs disable' title='Delete'>Delete</button>"+
		                          "<button type='button' class='btn btn-info btn-xs checkout' title='Checkout'>Checkout</button>";
		                  }
		                },
		                {
		                  mRender: function(row, setting, full){
		                    if(full.image){
		                      return "<img src='"+window.location.origin+'/uploads/'+full.image+"' width='100px'>";
		                    }else{
		                      return "<img src='"+window.location.origin+'/uploads/default.jpg'+"' width='100px'>";
		                    }
		                  }
		                },
		                {
		                  mRender: function(row, setting, full){
		                    if(parseFloat(full.prodQty) <= parseFloat(full.prodOrderLvl)){
		                      return "<form method='POST' action='"+window.location.origin+"/Admin/functions/prodHistory.php'>"+
		                            "<input type='hidden' name='itemNum' value='"+full.itemNum+"'>"+
		                            "<a href='#' class='submit_form' style='color: red;'>"+full.prodName+"</a>"+
		                            "</form>";
		                    }
		                    return "<form method='POST' action='"+window.location.origin+"/Admin/functions/prodHistory.php'>"+
		                            "<input type='hidden' name='itemNum' value='"+full.itemNum+"'>"+
		                            "<a href='#' class='submit_form'>"+full.prodName+"</a>"+
		                            "</form>";
		                  }
		                },
		                {data: 'prodBrand'},
		                {data: 'prodDesc'},
		                {data: 'prodPrice'},
		                {data: 'prodQty'},
		                {data: 'prodOrderLvl'},
		                {data: 'suppName'},
		              ],
		    columnDefs: [{targets: 0, width: '50px'}],
		    scrollX: true,
			bPaginate: false,
            language: {
                info: 'Total number of records: <b> _MAX_ </b>',
                infoEmpty: 'Total number of records: <b> 0 </b>'
            }
		});
		table.column(3).visible(false);
		table.column(4).visible(false);
		table.column(7).visible(false);
		table.column(8).visible(false);

		$('#show_all_columns').click(function(){
			table.column(3).visible(true);
			table.column(4).visible(true);
			table.column(7).visible(true);
			table.column(8).visible(true);
		});

		$('#table_search').on('keyup', function () {
	        table.search(this.value).draw();
	    });

	    $('table').on('click', '.checkin', function(){
			var form = $('#checkin-modal').find('form');
			var data = table.row($(this).closest('tr')).data();
			var prodName 	= data.prodName;
			var prodBrand 	= data.prodBrand;
			var prodQty 	= data.prodQty;
			var itemNum 	= data.itemNum;
			form.find('input[name=pname]').val(prodName);
			form.find('input[name=brand]').val(prodBrand);
			form.find('input[name=qty]').val(prodQty);
			form.find('input[name=edit_prod_id]').val(itemNum);
			$('#checkin-modal').modal('show');
			setTimeout(function(){
				form.find('input[name=pname]').focus();
				form.find('input[name=brand]').focus();
				form.find('input[name=qty]').focus();
			}, 300);
		});
		$('#checkin-modal').on('keyup', 'input[name=qty_add]', function(){
			var form = $(this).closest('form');
			var qty_add = parseFloat($(this).val());
			var qty = parseFloat(form.find('input[name=qty]').val());
			form.find('input[name=qty_total]').val(qty_add + qty);
			form.find('input[name=qty_total]').focus();
			form.find('input[name=qty_add]').focus();
		});
		$('table').on('click', '.disable', function(){
			
		});
		$('table').on('click', '.checkout', function(){
			
		});
	});

	$(document).ready(function(){
		$('#add').click(function(){
			$('#add-modal').modal('show');
		});
		$('#return').click(function(){
			$('#return-modal').modal('show');
		});
		$('#products').change(function(){
			var remaining_qty = $(this).find('option:selected').attr('remaining_qty');
			var supplier = $(this).find('option:selected').attr('supplier');
			var suppID = $(this).find('option:selected').attr('suppID');
			var brand = $(this).find('option:selected').attr('brand');
			var form = $(this).closest('form');
			form.find("input[name='remaining_qty']").val(remaining_qty);
			form.find("input[name='supplier']").val(supplier);
			form.find("input[name='suppID']").val(suppID);
			form.find("input[name='brand']").val(brand);
			form.find("input[name='qty']").attr('max', remaining_qty);
			form.find("input[name='brand']").focus();
			form.find("input[name='supplier']").focus();
		});

	});
</script>
<script>
    $('#img').change(function(ev){
      readURL(this);
    });

    var readURL = function(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
               $('#temp-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>