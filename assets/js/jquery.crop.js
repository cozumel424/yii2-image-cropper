function preview(img, selection) {
    if (!selection.width || !selection.height) {
        return;
    }
    
    $('#js_photo_preview').show();
    
    var scaleX = $('#js_profile_photo_preview_container').width() / selection.width;
    var scaleY = $('#js_profile_photo_preview_container').height() / selection.height;

    $('#js_profile_photo_preview').css({
        width: Math.round(scaleX * img.clientWidth),
        height: Math.round(scaleY * img.clientHeight),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });

    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);    
}