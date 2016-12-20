/**
 * Created by darxan on 2016/12/20.
 */

/**
 * Created by darxan on 2016/10/13.
 */
;

var editor;

var blogObject = {
    init: function (data) {
        this.editBlogId = data.detail.id;
        editor.html(data.detail.content)
        $("#select-category").val(data.detail.category);
        $("#blog-title-input").val(data.detail.title);

    }
}

KindEditor.ready(function(K) {

        editor = K.create('textarea[name="content"]', {
                allowFileManager : true
            }
        );

        K('input[name=getHtml]').click(function(e) {
                alert(editor.html());
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
                $.post(generateAddress('/update'),
                    {
                        category:input_category,
                        title:input_title,
                        content:content_html,
                        id:blogObject.editBlogId,
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


$(document).ready(function () {

    var id = getURLParameters().id;
    id = id==undefined?1:id;
    var url = '/detail/'+id;
    console.log(url)
    $.ajax(
        {
            url:generateAddress(url),
            success:function (data) {
                console.log(data);
                blogObject.init(data)
            },
            type:'get',
            dataType:'json'
        }
    );
});