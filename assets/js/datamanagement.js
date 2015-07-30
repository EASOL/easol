/**
 * Created by Nahid Hossain on 7/9/2015.
 */

var  ajxTabDisplayHidden = true;

var currentTable = null;
var dm_currentPage = 1;
var dm_PageSize = 50;

$(function() {


$( ".dm_tables .panel-footer a" ).click(function(event) {

    event.preventDefault();
    var reqType =$(this).parent().parent().attr("id").replace("dm_","");

        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showalltable",
            data: { tableType: reqType},
            cache: false,
            beforeSend: function(  ) {
               $('#dm_'+reqType+' .panel-body').html('<img src="'+Easol_SiteUrl+'assets/img/loading.gif" >');
               $('#loading-img').show();
            }
        })
        .success(function( msg ) {
            if(msg['status']['type']==undefined){
                alert('Data Transport Error');
            }
            else if(msg['status']['type']=='failed'){
                alert(msg['status']['msg']);
            }
            else if(msg['status']['type']=='success'){
                var htmlData= '<select class="form-control" size="10">';
                $.each(  msg['objects'], function( key, obj ) {
                    htmlData+='<option value="'+obj.TableName+'">'+obj.TableName+'</option>';

                });
                htmlData+='</select>';
                $('#dm_'+reqType+' .panel-body').html(htmlData);
                $('#dm_'+reqType+' .panel-footer').html("Showing All");
                $('#loading-img').hide();


            }
            else {
                alert('Data Transport Error');
            }
        })
        .fail(function(  ) {

                alert('Data Transport Error');

        });

});

   // $( ".dm_tables .panel-body select" ).on( "change", function() {
        $(document).on("change", ".dm_tables .panel-body select", function(){
            currentTable = this.value;
            currentSelect = this.id;
            $('.dm_select').each(function(itr, sel_obj) {
                if(this.id!=currentSelect){
                    $(this).val("");
                }
            });

        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showtableinfo",
            data: { tableName: currentTable},
            cache: false,
            beforeSend: function(  ) {
                $('#loading-img').show();
            }
        })

            .success(function( msg ) {
                if(msg['status']['type']==undefined){
                    alert('Data Transport Error');
                }
                else if(msg['status']['type']=='failed'){
                    alert(msg['status']['msg']);
                }
                else if(msg['status']['type']=='success'){
                    var htmlData="<br><h2>"+currentTable+"</h2><br><br>";
                    htmlData+="<h3>Download Template</h3><br>";
                    htmlData += '<a href="'+Easol_SiteUrl+'datamanagement/downloadtabletemplate/'+currentTable+'.csv" >'+currentTable+'.csv</a>';
                    htmlData+="<h4>Table Metadata</h4><br>";
                    htmlData+='<table class="table table-bordered" id="table_inf_table">';
                    htmlData+='<thead>';
                    htmlData+='<tr>' +
                    '<td>Column Name</td>' +
                    '<td>Required</td>' +
                    '<td>Data Type</td>' +
                    '<td>Maximum Length</td>' +
                    '</tr>';
                    htmlData+='</thead>';

                    $.each(  msg['objects'], function( key, obj ) {
                        htmlData+='<tr>' +
                        '<td>'+obj.COLUMN_NAME+'</td>';
                        if(obj.IS_NULLABLE=="NO")
                            htmlData+='<td style="text-align: center"><span class="glyphicon glyphicon-check"></span></td>';
                        else htmlData+='<td></td>';

                        htmlData+='<td>'+obj.DATA_TYPE+'</td>' ;
                        if(obj.CHARACTER_MAXIMUM_LENGTH==null)
                        htmlData+='<td></td>';
                        else
                        htmlData+='<td>'+obj.CHARACTER_MAXIMUM_LENGTH+'</td>';
                        htmlData+='</tr>';

                    });

                    htmlData+="<table>";

                    $('#table_info').html(htmlData);
                    if(ajxTabDisplayHidden){
                        ajxTabDisplayHidden = false;
                        $('#ajxTabDisplay').show();

                    }
                    else {
                        $('#dm_data_tabs a[href="#table_info"]').tab('show');
                    }
                    location.hash = "#page-header" ;
                    $('#loading-img').hide();
                    $('#dm_upload_form').trigger("reset");



                }
                else {
                    alert('Data Transport Error');
                }
            })
            .fail(function(  ) {

                alert('Data Transport Error');

            });
    });

   // $(".download_csv").on('click', function (event) {
    $(document).on("click", ".download_csv", function(event){
        // CSV
        exportTableToCSV.apply(this, [$('#table_inf_table'), $('.download_csv').text()]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

    $('#dm_data_tabs a[href="#table_browse"]').click(function (e) {
        e.preventDefault();


        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showtabledetails",
            data: { tableName: currentTable, start: dm_currentPage,pageSize: dm_PageSize},
            cache: false,
            beforeSend: function(  ) {
                $('#loading-img').show();
                //$('#table_info').html('<div style="text-align: center"><img src="'+Easol_SiteUrl+'assets/img/loading.gif" ></div>');
            }
        })

            .success(function( msg ) {
                if(msg['status']['type']==undefined){
                    alert('Data Transport Error');
                }
                else if(msg['status']['type']=='failed'){
                    alert(msg['status']['msg']);
                }
                else if(msg['status']['type']=='success'){
                    var htmlData = "<br><h2>"+currentTable+"</h2><br><br>";


                   if(msg['objects'].length > 0) {
                       htmlData += '<div class="pull-right">\
                       <a href="'+Easol_SiteUrl+'datamanagement/downloadtabledata/'+currentTable+'"><button><i class="fa fa-download"> </i> Download CSV</button></a>\
                       </div><br><br><br>';
                        htmlData+='<table class="table table-bordered" id="table_details_table">';

                       $.each(msg['objects'], function (key, obj) {
                           if(key==0){
                               htmlData+='<thead>';
                               htmlData+='<tr>';
                               $.each(obj, function (tb_col, col_val) {
                                   htmlData+='<th>'+tb_col+'</th>';

                               });

                               htmlData+='</thead>';

                           }

                           htmlData += '<tr>';
                           $.each(obj, function (tb_col, col_val) {
                               htmlData+='<td>'+col_val+'</td>';

                           });
                           htmlData +='</tr>';
                       });

                       htmlData += "<table>";
                       htmlData += '<nav>\
                       <ul class="pagination" id="ajxPagination">';

                       var totPage=Math.ceil(parseInt(msg['total'])/dm_PageSize);

                       for(ci=1;ci <= totPage; ci++) {
                           htmlData += '<li';
                           if(ci==1){
                               htmlData +=' class="active"';
                           }
                           htmlData += '><a href="#" data-page-id="'+ci+'">'+ci+'</a></li>';
                       }
                       htmlData+= '</ul>';
                   }
                    else htmlData+= 'Table contains no data';
                    $('#table_browse').html(htmlData);

                    $('#loading-img').hide();
                    $('#dm_data_tabs a[href="#table_browse"]').tab('show');
                }
                else {
                    alert('Data Transport Error');
                }
            })
            .fail(function(  ) {
                alert('Data Transport Error');
            });


    });
    $(document).on("click", "#ajxPagination a", function(event){
        event.preventDefault();
        dm_currentPage = $( this ).attr( "data-page-id" );
        $("#ajxPagination li.active").removeClass("active");
        $(this).parent().addClass('active');

        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showtabledetails",
            data: { tableName: currentTable, start: dm_currentPage,pageSize: dm_PageSize},
            cache: false,
            beforeSend: function(  ) {
                $('#loading-img').show();
                //$('#table_info').html('<div style="text-align: center"><img src="'+Easol_SiteUrl+'assets/img/loading.gif" ></div>');
            }
        })
            .success(function( msg ) {
                if(msg['status']['type']==undefined){
                    alert('Data Transport Error');
                }
                else if(msg['status']['type']=='failed'){
                    alert(msg['status']['msg']);
                }
                else if(msg['status']['type']=='success'){
                    var htmlData = "";

                    if(msg['objects'].length > 0) {
                        $.each(msg['objects'], function (key, obj) {
                            if(key==0){
                                htmlData+='<thead>';
                                htmlData+='<tr>';
                                $.each(obj, function (tb_col, col_val) {
                                    htmlData+='<th>'+tb_col+'</th>';

                                });
                                htmlData+='</thead>';
                            }
                            htmlData += '<tr>';
                            $.each(obj, function (tb_col, col_val) {
                                htmlData+='<td>'+col_val+'</td>';
                            });
                            htmlData +='</tr>';
                        });

                    }
                    $('#table_details_table').html(htmlData);

                    $('#loading-img').hide();

                }
                else {
                    alert('Data Transport Error');
                }
            })
            .fail(function(  ) {
                alert('Data Transport Error');
            });

    });

    $('#dm_data_tabs a[href="#table_upload"]').click(function (e) {
        e.preventDefault();
        $('#table_upload .tableName').html(currentTable);
        $('#form-table-name').val(currentTable);
        $(this).tab('show');

    });

    $("#dm_upload_form").on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData($('#dm_upload_form')[0]);
        $.ajax({
            /*statusCode: {
                500: function(data) {
                    $('#msgBox').html(data);
                    $('#loading-img').hide();
                }
            }, */
            url: Easol_SiteUrl+"datamanagement/uploadcsv",
            data: formData,
            async: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            cache: false,
            type: 'POST',
            beforeSend: function(  ) {
                $('#loading-img').show();
            }
        })
            .success(function(data  ) {
                $('#msgBox').html(($.parseJSON(data))['status']['msg']);
                $('#loading-img').hide();
            })
            .fail(function( data ) {
                $('#msgBox').html(data.responseText);
                $('#loading-img').hide();
            });

    });
});


function exportTableToCSV($table, filename) {

    var $rows = $table.find('tr:has(td)'),

    // Temporary delimiter characters unlikely to be typed by keyboard
    // This is to avoid accidentally splitting the actual contents
        tmpColDelim = String.fromCharCode(11), // vertical tab character
        tmpRowDelim = String.fromCharCode(0), // null character

    // actual delimiter characters for CSV format
        colDelim = '","',
        rowDelim = '"\r\n"',

    // Grab text from table into CSV formatted string
        csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

    // Data URI
        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    $(this)
        .attr({
            'download': filename,
            'href': csvData,
            'target': '_blank'
        });
}


