
$(function () {
     "use strict";
var path = 'tinymce';
    // TinyMCE Full
    tinymce.init({
        selector: 'textarea',
        language: 'ru',
        height: 250,
        theme: 'modern',
        fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 36px',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools moxiemanager'
        ],
        toolbar1: 'undo redo | styleselect fontsizeselect | forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media insertfile',
        toolbar2: "pagebreak paste  hr spellchecker  visualblocks visualchars inserttime insertdate charmap searchreplace removeformat inserttable outdent indent emoticons print preview fullscreen",
        image_advtab: true,
        relative_urls: false
    });

});
