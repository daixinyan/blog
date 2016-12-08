/**
 * Created by darxan on 2016/10/13.
 */
;
url_base = '/blog'
var editor;
KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
                allowFileManager : true
            }
        );
        K('input[name=getHtml]').click(function(e) {
                alert(editor.html());
            }
        );
        K('input[name=isEmpty]').click(function(e) {
                alert(editor.isEmpty());
            }
        );
        K('input[name=getText]').click(function(e) {
                alert(editor.text());
            }
        );
        K('input[name=selectedHtml]').click(function(e) {
                alert(editor.selectedHtml());
            }
        );
        K('input[name=setHtml]').click(function(e) {
                editor.html('<h3>Hello KindEditor</h3>');
            }
        );
        K('input[name=setText]').click(function(e) {
                editor.text('<h3>Hello KindEditor</h3>');
            }
        );
        K('input[name=insertHtml]').click(function(e) {
                editor.insertHtml('<strong>插入HTML</strong>');
            }
        );
        K('input[name=appendHtml]').click(function(e) {
                editor.appendHtml('<strong>添加HTML</strong>');
            }
        );
        K('input[name=clear]').click(function(e) {
                editor.html('');
            }
        );
        K('input[name=submit]').click(function(e) {
                var content_html = editor.html();
                var input_title = document.getElementsByClassName('input-title')[0].value;
                var select_category = document.getElementsByClassName('select-category')[0];
                console.log(select_category);
                var index=select_category.selectedIndex
                var input_category = (select_category.options)[index].value;

                alert(content_html);
                alert(input_title);
                alert(input_category);
                $.post(url_base+'/post',
                    {
                        category:input_category,
                        title:input_title,
                        content:content_html
                    },
                    function (data) {
                        alert('success');
                        console.log(data);
                    }
                );
            }
        );

    }
);