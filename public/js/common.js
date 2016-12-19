/**
 * Created by darxan on 2016/12/8.
 */
url_base = '/blog'
url_base = ''
function generateBlogHtmlAddress(id)
{
    return generateAddress('/blog.html?'+id);
}
function generateAddress(address)
{
    return url_base+address;
}
$(document).ready(function () {
    var href = $('a.title')
    href.attr('href',generateAddress('/index'));
});