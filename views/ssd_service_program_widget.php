<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="ssd_service_program-widget">
        <div id="ssd_service_program-widget" class="panel-heading" data-container="body" data-i18n="[title]smart_stats.ssd_service_program_info">
            <h3 class="panel-title"><i class="fa fa-wrench"></i> 
                <span data-i18n="smart_stats.ssd_service_program"></span>
                    —&nbsp;<a href="https://www.apple.com/support/13-inch-macbook-pro-solid-state-drive-service-program/" target="_blank" data-i18n="smart_stats.ssd_service_program_url"></a> 
                <list-link data-url="/show/listing/smart_stats/smart_stats"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/smart_stats/ssd_service_check', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#ssd_service_program-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/smart_stats/smart_stats/#';
        panel.empty();
        // Set blocks, disable if zero
        if(data.unfixed != "0"){
            panel.append(' <a href="'+baseUrl+'CXS4JA0Q" class="btn btn-danger"><span class="bigger-150">'+data.unfixed+'</span><br>'+i18n.t('smart_stats.unfixed')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'CXS4JA0Q" class="btn btn-danger disabled"><span class="bigger-150">'+data.unfixed+'</span><br>'+i18n.t('smart_stats.unfixed')+'</a>');
        }
        if(data.fixed != "0"){
            panel.append(' <a href="'+baseUrl+'CXS4LA0Q" class="btn btn-success"><span class="bigger-150">'+data.fixed+'</span><br>'+i18n.t('smart_stats.fixed')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'CXS4LA0Q" class="btn btn-success disabled"><span class="bigger-150">'+data.fixed+'</span><br>'+i18n.t('smart_stats.fixed')+'</a>');
        }
        if(data.not_affected != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info"><span class="bigger-150">'+data.not_affected+'</span><br>'+i18n.t('smart_stats.not_affected')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info disabled"><span class="bigger-150">'+data.not_affected+'</span><br>'+i18n.t('smart_stats.not_affected')+'</a>');
        }
    });

});

</script>
