$(document).ready(function () {
// Load the first 3 list items from another HTML file
    $('#myListBlog li:lt(3)').show();
    var items = $('#myListBlog li').length;
    var shown = 3;
    $('#loadMore').click(function () {
        shown = $('#myListBlog li:visible').length +3;
        if(shown< items) {$('#myListBlog li:lt('+shown+')').show();}
        else {$('#myListBlog li:lt('+items+')').show();
            $('#loadMore').hide();
        }
    });
});