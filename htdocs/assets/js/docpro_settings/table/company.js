var stopPropagation = function(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

var init_table_settings = function(table){
    $('body').on('click', '#advance-search', function(){
        var table_filter = $(".dataTable").find('.searchfilterrow');
        if($(table_filter).hasClass('show-searchfilter')){
            $(table_filter).removeClass('show-searchfilter');
            $(table_filter).addClass('hide-searchfilter');
        }else{
            $(table_filter).removeClass('hide-searchfilter');
            $(table_filter).addClass('show-searchfilter');
        }

        if($(this).attr('data-status') === '1'){
            $(this).attr('data-status', '0');
            $(this).html("Show Advance Search");
        }else{
            $(this).attr('data-status', '1');
            $(this).html("<span style='font-size: 11px; font-weight: bold;'><i class='fa fa-check'></i>&nbsp; Show Advance Search</span>");
        }
    });
    $('body').on('click', '#show-all-col', function(){
        var column1 = table.column(1);
        column1.visible(!column1.visible());

        var column4 = table.column(4);
        column4.visible(!column4.visible());

        var column5 = table.column(5);
        column5.visible(!column5.visible());

        var column6 = table.column(6);
        column6.visible(!column6.visible());

        if($(this).attr('data-status') === '1'){
            $(this).attr('data-status', '0');
            $(this).html("Show All Columns");
        }else{
            $(this).attr('data-status', '1');
            $(this).html("<span style='font-size: 11px; font-weight: bold;'><i class='fa fa-check'></i>&nbsp; Show All Columns</span>");
        }
    });
}
var init_general_search = function(table){
    $('.general-search').on('keyup', function () {
        table.search(this.value).draw();
    });
}
var hide_columns = function(table){
    var column1 = table.column(1);
    column1.visible(!column1.visible());

    var column4 = table.column(4);
    column4.visible(!column4.visible());

    var column5 = table.column(5);
    column5.visible(!column5.visible());

    var column6 = table.column(6);
    column6.visible(!column6.visible());
}

