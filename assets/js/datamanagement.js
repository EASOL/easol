/**
 * Created by Nahid Hossain on 7/9/2015.
 */

var  ajxTabDisplayHidden = true;

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
            var selectedTable = this.value;
        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showalltableinfo",
            data: { tableName: selectedTable},
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
                    htmlData="<br><h2>"+selectedTable+"</h2><br><br>";
                    htmlData+="<h3>Download Template</h3><br>";
                    htmlData+='<a href="#" class="download_csv">'+selectedTable+'.csv</a>';
                    htmlData+="<h4>Table Metadata</h4><br>";
                    htmlData+='<table class="table table-bordered" id="table_inf_table">';
                    htmlData+='<thead>';
                    htmlData+='<tr>' +
                    '<td>Column Name</td>' +
                    '<td>Nullable</td>' +
                    '<td>Data Type</td>' +
                    '<td>Maximum Length</td>' +
                    '</tr>';
                    htmlData+='</thead>';

                    $.each(  msg['objects'], function( key, obj ) {
                        htmlData+='<tr>' +
                        '<td>'+obj.COLUMN_NAME+'</td>' +
                        '<td>'+obj.IS_NULLABLE+'</td>' +
                        '<td>'+obj.DATA_TYPE+'</td>' +
                        '<td>'+obj.CHARACTER_MAXIMUM_LENGTH+'</td>' +
                        '</tr>';

                    });

                    htmlData+="<table>";

                    $('#table_info').html(htmlData);
                    if(ajxTabDisplayHidden){
                        ajxTabDisplayHidden = false;
                        $('#ajxTabDisplay').show();

                    }
                    location.hash = "#ajxTabDisplay" ;
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

   // $(".download_csv").on('click', function (event) {
    $(document).on("click", ".download_csv", function(event){
        // CSV
        exportTableToCSV.apply(this, [$('#table_inf_table'), $('.download_csv').text()]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
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


