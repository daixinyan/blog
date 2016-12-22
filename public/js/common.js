/**
 * Created by darxan on 2016/12/8.
 */
url_base = '/blog';
url_base = '';

var isFromAdmin = location.href.indexOf('/admin')!=-1;

function getURLParameters() {
    var full_url = location.search;
    var index = full_url.indexOf("?");
    var result = new Object();
    if(index>-1)
    {
        var parametersString = full_url.substr(index+1).split('&')
        for(var i =0; i<parametersString.length; i++){
            var keyValue=parametersString[i].split('=');
            if(keyValue.length==2)
            {
                result[keyValue[0]] = keyValue[1];
            }
        }
    }

    console.log(result)
    return result
}

function generateBlogHtmlAddress(id)
{
    if(isFromAdmin)
    {
        return generateAddress('/admin/edit.html?id='+id)
    }
    return generateAddress('/blog.html?id='+id);
}
function generateAddress(address)
{
    return url_base+address;
}

function onclick_function() {
    if( typeof list_search === 'function' && $('.list-item').size()>0){
        list_search();
    }else{
        window.location.href=generateAddress(isFromAdmin?'/admin/index':'/index'+'?key='+$("#search-key").val());
    }

}


$(document).ready(function () {
    var href = $('a.title')
    href.attr('href',generateAddress(isFromAdmin?'/admin/index':'/index'));
});