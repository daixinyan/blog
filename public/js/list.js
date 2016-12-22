;


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

        var myself = this;
        $.each(list,function (i, item) {
            var object = myself.item.clone(true);
            var href = object.find('a').eq(0);
            href.text(item.title);
            href.attr('href',generateBlogHtmlAddress(item.id));
            myself.ul.append(object);
        })

    }
};


var userSetting = {
    init: function () {
        this.bound = -1;
        this.keyword = '';
        this.category = 'all';
        this.order = 'desc';
        this.isEnd = false;
    },

    getBound: function() {
        return this.bound.toString();
    },



    updateSetting: function (data) {
        this.bound = data.bound
        this.isEnd = data.isEnd
    },

    getKeyword: function () {
        return this.keyword;
    },

    updateKeyword: function () {
        var updated_keyword= $("#search-key").val();
        if(this.keyword==updated_keyword)
        {
            return false
        }
        this.keyword = updated_keyword
        return true;
    },

    getCategory: function () {
        return this.category;
    },

    updateCategory: function (cate) {
        if(this.category==cate){
            return false
        }
        this.category = cate;
        return true
    },

    getOrder: function () {
        return this.order;
    }

};

function add_data(data) {
    console.log(data)
    blogList.addElements(data.list);
    userSetting.updateSetting(data)
}

function post_and_update() {
    $.post(
        generateAddress('/list'),
        {
            bound: userSetting.getBound(),
            order: userSetting.getOrder(),
            key: userSetting.getKeyword(),
            category: userSetting.getCategory()
        },
        function (string) {
            add_data($.parseJSON(string))
        }
    );
}

function get_and_add() {

    var get_url = generateAddress('/search/'+userSetting.getBound()
                  +'/desc/'+userSetting.getKeyword()+'/'+userSetting.getCategory());
    console.log(get_url)
    $.ajax(
        {
            url: get_url,
            success:function (data) {
                add_data(data)
            },
            type:'get',
            dataType:'json'
        }
    );
    categoryList.updateCateColor()
}

function get_and_update() {
    userSetting.bound = -1;
    blogList.ul.empty()
    get_and_add()
}

function list_search() {
    if(userSetting.updateKeyword())
    {
        get_and_update()
    }
}

var categoryList = {

    init: function () {
        this.ul = $("#category-selectors");
        this.item = this.ul.children('.category-selector').eq(0).clone(true);
        this.ul.empty()

        var get_url = generateAddress('/category');
        console.log(get_url)
        $.ajax(
            {
                url: get_url,
                success:function (data) {
                    console.log(data)
                    categoryList.updateCategory(data)
                },
                type:'get',
                dataType:'json'
            }
        );
    },

    updateCategory: function (data) {
        this.ul.empty()
        this.addCategory(data)
    },

    addCategory: function (data) {
        var myself = this;
        $.each(data, function (i, item) {
            var category = myself.item.clone(true);
            category.click(function () {
                onclick_update_category(item)
            });
            category.find('a').eq(0).text(item);
            myself.ul.append(category);
        });
        myself.updateCateColor()

    },

    updateCateColor: function () {
      $.each(this.ul.children(), function (i, category) {
          var link = $(category).find('a').eq(0)
          link.css('color', '#337ab7')
          console.log(link.text())
          if(link.text()==userSetting.getCategory()) {
              link.css('color', '#9A12B3');
          }
      })
    }
}


$(document).ready(function () {
    blogList.init();
    userSetting.init();
    categoryList.init()
    var parameters = (getURLParameters())
    if(parameters['key']!=undefined) {
        $("#search-key").val(parameters['key']);
    }
    list_search()
});

function getCurrentTime() {
    var date = new Date();
    return date.getTime()
}


function onclick_update_category(category) {
    if(userSetting.updateCategory(category))
    {
        userSetting.bound = -1;
        blogList.ul.empty()
        get_and_add()
    }
}

$(function(){
    var time = getCurrentTime()
    var limit_interval = 100000
    $(window).scroll(function() {
        if ($(this).scrollTop() + $(window).height() + 20 >= $(document).height() && $(this).scrollTop() > 20) {
            currentTime = getCurrentTime()
            if(currentTime-time>limit_interval && !userSetting.isEnd)
            {
                get_and_add();
            }
        }
    });
});