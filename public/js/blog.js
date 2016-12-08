/**
 * Created by darxan on 2016/10/2.
 */
url_base = '/blog'
var blog ={

    init: function () {
        this.next = $('.blog-next');
        this.last = $('.blog-last');
        this.content = $('.blog-content');

        this.title = $('.blog-title');
        this.category = $('.blog-item-category');
        this.created_at = $('.created_at');
    },
    update: function (object) {

        if(object.next=='notExist'){
            this.next.text('没有更多了');
        }else{
            this.next.text(object.next.title);
            this.next.attr('href','/blog.html?'+object.next.id);
        }

        if(object.last=='notExist'){
            this.last.text('这是第一篇')
        }else{
            this.last.text(object.last.title);
            this.last.attr('href','/blog.html?'+object.last.id);
        }

        if(object.detail!='notExist'){
            this.title.text(object.detail.title);
            this.content.html(object.detail.content);
            this.category.text(object.detail.category);
            this.created_at.text(object.detail.created_at);
        }
    }
};

function wrongUrl() {
    alert('wrong url');
};

$(document).ready(function () {
    var full_url = location.search;
    var index = full_url.indexOf("?");
    blog.init();

    if(index==-1){
        wrongUrl();
    }else {
        var params = full_url.substr(index + 1);
        $.ajax(
            {
                url:url_base+'/detail/'+params,
                success:function (data) {
                    console.log(data);
                    blog.update(data)
                },
                type:'get',
                dataType:'json'
            }
        );
    }
});