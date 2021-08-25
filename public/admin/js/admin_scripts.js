$(document).ready(function() {
    var baseurl = $('#baseurl').val();
    var external_plugins = $('#external_plugins').val();
    var external_filemanager_path = $('#external_filemanager_path').val();
        $(".dataTable").DataTable({
            "ordering": false,
            "bLengthChange": false,
            "bAutoWidth": false,
            "bPaginate": false,
            "bInfo": false,
            "bDestroy":true,
            "pageLength": 20
        });
        $(".dataTablePagination").DataTable({
            "pagingType": "simple_numbers",
            "ordering": false,
            "bLengthChange": false,
            "bAutoWidth": false,
            "bPaginate": true,
            "bInfo": false,
            "bDestroy":true,
            "pageLength": 20
        });

        $(".dataTablePaginationSort").DataTable({
            "pagingType": "simple_numbers",
            "ordering": true,
            "bLengthChange": false,
            "bAutoWidth": false,
            "bPaginate": true,
            "bInfo": false,
            "bDestroy":true,
            "pageLength": 15
        });

        $('a.resetbtn').confirm({
            title: 'Delete Data ?',
            content: 'Are You Sure !',
            draggable: false,
            animation: 'zoom',
            closeAnimation: 'scale',
            autoClose: 'close|8000',
            buttons: {
                ok: function(){
                    location.href = this.$target.attr('href');
                },
                close: function(){
                }
            }
        });

        $('.select2').select2();
        // $('.single-select').select2();
        $(".multiple-select2").select2({
            tags: true,
            // tokenSeparators: [',', ' ']
        });
        
        $('.read').on('change', function () {
                read = $(this).val();
                $.ajax({
                    url: "roleChangeAccess/1/" + read,
                    type: "GET"
                });
            });
            $('.write').on('change', function () {
                write = $(this).val();
                $.ajax({
                    url: "roleChangeAccess/2/" + write,
                    type: "GET"
                });
            });
            $('.edit').on('change', function () {
                edit = $(this).val();
                $.ajax({
                    url: "roleChangeAccess/3/" + edit,
                    type: "GET"
                });
            });
            $('.delete').on('change', function () {
                del = $(this).val();
                $.ajax({
                    url: "roleChangeAccess/4/" + del,
                    type: "GET"
                });
            });
    $(".datepicker").datepicker({
        format:"yyyy-mm-dd",
        todayHighlight:true,
        autoclose:true,
        // orientation:"bottom auto",
    });
    
    $('.fancy').fancybox();
    
    $(".datetimepicker").datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });

    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "textarea.tinymce",
        relative_urls: false,
        remove_script_host: false,

        /* theme of the editor */
        theme: "modern",
        skin: "lightgray",

        /* width and height of the editor */
        width: "100%",
        height: 400,

        /* display statusbar */
        statubar: true,
        content_style: ".mce-content-body {font-size:16px;}",

        /* plugin */
        plugins: [
            "media",
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],

        /* toolbar */
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | preview code",

        /* style */
        style_formats: [
            {
                title: "Headers", items: [
                    { title: "Header 1", format: "h1" },
                    { title: "Header 2", format: "h2" },
                    { title: "Header 3", format: "h3" },
                    { title: "Header 4", format: "h4" },
                    { title: "Header 5", format: "h5" },
                    { title: "Header 6", format: "h6" }
                ]
            },
            {
                title: "Inline", items: [
                    { title: "Bold", icon: "bold", format: "bold" },
                    { title: "Italic", icon: "italic", format: "italic" },
                    { title: "Underline", icon: "underline", format: "underline" },
                    { title: "Strikethrough", icon: "strikethrough", format: "strikethrough" },
                    { title: "Superscript", icon: "superscript", format: "superscript" },
                    { title: "Subscript", icon: "subscript", format: "subscript" },
                    { title: "Code", icon: "code", format: "code" }
                ]
            },
            {
                title: "Blocks", items: [
                    { title: "Paragraph", format: "p" },
                    { title: "Blockquote", format: "blockquote" },
                    { title: "Div", format: "div" },
                    { title: "Pre", format: "pre" }
                ]
            },
            {
                title: "Alignment", items: [
                    { title: "Left", icon: "alignleft", format: "alignleft" },
                    { title: "Center", icon: "aligncenter", format: "aligncenter" },
                    { title: "Right", icon: "alignright", format: "alignright" },
                    { title: "Justify", icon: "alignjustify", format: "alignjustify" }
                ]
            }
        ],
        formats: {
            aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center', styles: { display: 'block', margin: '0px auto', textAlign: 'center' } },
        },
        filemanager_crossdomain: true,
        external_filemanager_path: external_filemanager_path,
        external_plugins: { "filemanager": external_plugins },
    });

});

function responsive_filemanager_callback(field_id) {
    if (field_id == 'image') {
        var image = $('#' + field_id).val();
        $('#prev_img').attr('src', image);
    }

    if (field_id == 'logo') {
        var image = $('#' + field_id).val();
        $('#prev_img').attr('src', image);
    }

    //  image for dark logo 
    if (field_id == 'dark_logo') {
        var image = $('#' + field_id).val();
        $('#prev_dark_logo_img').attr('src', image);
    }

    //  image for facebook 
    if (field_id == 'fb_image') {
        var image = $('#' + field_id).val();
        $('#prev_fb_image_img').attr('src', image);
    }
}

//  for dark logo 
$(".remove_dark_logo_img").click(function (event) {
    var baseurl = $('#baseurl').val();
    var no_image = baseurl + "/admin/images/no-image.png";
    $('#prev_dark_logo_img').attr('src', no_image);
    $('#dark_logo').val('');
    $('.remove_dark_logo_img').hide();
    $('.prev_box_image').show();
});

//  for fb image
$(".remove_fb_image_img").click(function (event) {
    var baseurl = $('#baseurl').val();
    var no_image = baseurl + "/admin/images/no-image.png";
    $('#prev_fb_image_img').attr('src', no_image);
    $('#fb_image').val('');
    $('.remove_fb_image_img').hide();
    $('.prev_box_fb_image').show();
});




$(".remove_box_image").click(function (event) {
    var baseurl = $('#baseurl').val();
    var no_image = baseurl + "/admin/images/no-image.png";
    $('#prev_img').attr('src', no_image);
    $('#featured_image').val('');
    $('#image').val('');
    $('#logo').val('');
    $('.remove_box_image').hide();
    $('.prev_box_image').show();
});

$(".deletefile").click(function (event) {
    if (confirm('Are You Sure ? ?') == true) {
        $('#file').val('');
        $(this).parent().remove();
    } else {
        return false;
    }
});


function deleteImage(image,typex){
    var baseurl = $('#baseurl').val();
    var no_image = baseurl + "/admin/images/no-image.png";

    if(confirm('Are You Sure ? ?') == true) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl+'/u-admin/delete-image',
            type: 'POST',
            data: {image: image},
        })
        .always(function(resp) {
            console.log(resp)
            if (resp.error == false) {
                $('#prev_'+typex+'_img').attr('src', no_image);
                $('#'+typex+'_old').val('');
                $("#btn-"+typex).hide();
            }else{
                alert(resp.message);
            }
        });
    } else {
        return false;
    }
}





    