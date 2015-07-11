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
        $.ajax({
            dataType: "json",
            method: "POST",
            url: Easol_SiteUrl+"datamanagement/showalltableinfo",
            data: { tableName: this.value},
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

                    htmlData='<table class="table table-bordered">';
                    htmlData+='<thead>';
                    htmlData+='<tr>' +
                    '<th>Column Name</th>' +
                    '<th>Nullable</th>' +
                    '<th>Data Type</th>' +
                    '<th>Maximum Length</th>' +
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



});