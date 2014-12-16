/**
 * media-lib.js, JavaScript specialized open WP thickbox media uploader
 *
 * @version 1.1
 * @license GNU Lesser General Public License, http://www.gnu.org/copyleft/lesser.html
 * @author  Bruce Wampler
 */
var weaverii_fillin;
function weaverii_media_lib(fillarea) {
    weaverii_fillin = fillarea;
    tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true&amp;width=640&amp;height=600');
    return;
}

jQuery(document).ready(function() {
window.send_to_editor = function(html) {
    imgurl = jQuery('img',html).attr('src');
    jQuery('#' + weaverii_fillin).val(imgurl);
    tb_remove();
    jQuery('#' + weaverii_fillin).focus();
}
});
