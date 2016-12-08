/**
 * Created by darxan on 2016/12/8.
 */
url_base = '/blog'
function generateBlogHtmlAddress(id)
{
    return generateAddress('/blog.html?'+id);
}
function generateAddress(address)
{
    return url_base+address;
}