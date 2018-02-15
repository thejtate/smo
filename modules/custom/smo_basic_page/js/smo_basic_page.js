(function ($) {
    Drupal.behaviors.smoBasicPageActions = {
        attach: function (context, settings) {

            var $blockWraps = $('.group-block-wrap', context);

            $blockWraps.once('content-block-actions', function(){
               var $wrap = $(this)
                   ,$typeSelect = $wrap.find('.field-name-field-basic-content-block-type select')
                   ,$colorSelectWrap = $wrap.find('.field-name-field-basic-content-color-scheme')
                   ,$widthSelectWrap = $wrap.find('.field-name-field-basic-content-block-width')
                   ,$text1FieldWrap = $wrap.find('.field-name-field-basic-content-block-col1')
                   ,$text2FieldWrap = $wrap.find('.field-name-field-basic-content-block-col2')
                   ,$tableFieldWrap = $wrap.find('.field-name-field-basic-content-block-table')
                   ,$imgFieldWrap = $wrap.find('.field-name-field-basic-content-block-image')
                   ,$colorSelect = $colorSelectWrap.find('select')
                   ,$text1 = $text1FieldWrap.find('textarea')
                   ,$text2 = $text2FieldWrap.find('textarea');

                processBlockType();

                $typeSelect.on('change', processBlockType);
                $colorSelectWrap.on('change', processBlockColor);

                function processBlockType() {
                    var type = $typeSelect.val();
                    switch(type) {
                        case 'image':
                            $imgFieldWrap.show();
                            //hide
                            $text1FieldWrap.hide();
                            $text2FieldWrap.hide();
                            $colorSelectWrap.hide();
                            $widthSelectWrap.hide();
                            $tableFieldWrap.hide();
                            break;
                        case 'text':
                            $text1FieldWrap.show();
                            $colorSelectWrap.show();
                            $widthSelectWrap.show();
                            //hide
                            $imgFieldWrap.hide();
                            $text2FieldWrap.hide();
                            $tableFieldWrap.hide();
                            break;
                        case 'columns2':
                            $text1FieldWrap.show();
                            $text2FieldWrap.show();
                            $colorSelectWrap.show();
                            $widthSelectWrap.show();
                            //hide
                            $imgFieldWrap.hide();
                            $tableFieldWrap.hide();
                            break;
                        case 'text_table':
                            $text1FieldWrap.show();
                            $text2FieldWrap.show();
                            $colorSelectWrap.show();
                            $widthSelectWrap.show();
                            $tableFieldWrap.show();
                            //hide
                            $imgFieldWrap.hide();
                            break;
                    }

                    //add block type css
                    $wrap.removeClass (function (index, css) {
                        return (css.match (/(^|\s)block-type-\S+/g) || []).join(' ');
                    });
                    $wrap.addClass('block-type-' + type);
                }

                function processBlockColor() {
                    var color = $colorSelect.val();

                    switch(color) {
                        case 'default':
                            ckeditorChangeBgClasses($text1, 'defalut');
                            ckeditorChangeBgClasses($text2, 'defalut');
                            break;
                        case 'grey':
                            ckeditorChangeBgClasses($text1, 'editor b-with-bg style-gray');
                            ckeditorChangeBgClasses($text2, 'editor b-with-bg style-gray');
                            break;
                        case 'purple':
                            ckeditorChangeBgClasses($text1, 'editor b-with-bg style-purple');
                            ckeditorChangeBgClasses($text2, 'editor b-with-bg style-purple');
                            break;
                        case 'blue':
                            ckeditorChangeBgClasses($text1, 'editor b-with-bg style-blue');
                            ckeditorChangeBgClasses($text2, 'editor b-with-bg style-blue');
                            break;
                    }
                }

                function ckeditorChangeBgClasses(textarea, classes) {
                    var id = textarea.prop('id');
                    textarea.prop('editor-classes', classes);

                    if(typeof CKEDITOR.instances[id] !== 'undefined') {
                        var config = CKEDITOR.instances[id].config;

                            CKEDITOR.instances[id].destroy();
                            CKEDITOR.replace(id, config);

                    }
                }

            });

        }
    };

    CKEDITOR.on('instanceReady', function(e) {
        var body = e.editor.document.getBody();
        var classes = $(e.editor.element.$).prop('editor-classes');

        if(classes) {

            body.setAttribute('class', e.editor.config.bodyClass + ' ' + classes);
        } else {
            classes = $(e.editor.element.$).attr('editor-classes');
            if(classes) {
                body.setAttribute('class', e.editor.config.bodyClass + ' ' + classes);
            }
        }
    });

})(jQuery);