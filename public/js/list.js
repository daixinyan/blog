;
url_base = '/blog'
var blogList ={
    init: function () {
        this.ul = $("#list");

        this.item = this.ul.children('.list-item').eq(0).clone(true);
        this.ul.empty();
    },

    updateList: function (list) {

        this.ul.empty();
        this.addElements(list)
    },


    addElements: function (list) {

        console.log(list);
        var myself = this;
        $.each(list,function (i, item) {
            console.log(item);
            var object = myself.item.clone(true);
            var href = object.find('a').eq(0);
            href.text(item.title);
            href.attr('href','/blog.html?'+item.id);
            myself.ul.append(object);
        })

    }
};



function list_time() {

    $.ajax(
        {
            url:url_base+'/search/100000/desc',
            success:function (data) {
                console.log('success load.');
                blogList.updateList(data);
            },
            type:'get',
            dataType:'json'
        }
    );
}

function list_category() {
}

function list_search() {
    $.post(
        url_base+'/search',
        {
            bound: 1,
            order:'desc',
            key:'p',
            category:'all'
        },
        function (list) {
            blogList.updateList(list)
        }
    );
}


$(document).ready(function () {
    blogList.init();
    list_time();
});

