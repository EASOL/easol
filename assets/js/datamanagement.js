/**
 * Created by Nahid Hossain on 7/9/2015.
 */


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
                    htmlData+='<option value="'+obj.ID+'">'+obj.TableName+'</option>';

                });
                htmlData+='</select>';
                $('#dm_'+reqType+' .panel-body').html(htmlData);
                $('#dm_'+reqType+' .panel-footer').html("Showing All");
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