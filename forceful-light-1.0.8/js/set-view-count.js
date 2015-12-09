/*!
 * Kopa set view count js (http://kopatheme.com)
 * Copyright 2014 Kopasoft.
 * Licensed under GNU General Public License v3
 */

/* =========================================================
 Set view count (post, page, portfolio)
 ============================================================ */
jQuery(document).ready(function() {
    if (kopa_front_variable.template.post_id > 0) {
        jQuery.ajax({
            type: 'POST',
            url: kopa_front_variable.ajax.url,
            dataType: 'json',
            async: true,
            timeout: 5000,
            data: {
                action: 'kopa_set_view_count',
                wpnonce: jQuery('#kopa_set_view_count_wpnonce').val(),
                post_id: kopa_front_variable.template.post_id
            },
            beforeSend: function(XMLHttpRequest, settings) {
            },
            complete: function(XMLHttpRequest, textStatus) {
            },
            success: function(data) {
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});