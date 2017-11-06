$(document).ready(function () {
// Load the first 3 list items from another HTML file
    $('#myListBlog li:lt(3)').show();
    $('#showLess').hide();
    var items = $('#myListBlog li').length;
    var shown = 3;
    $('#loadMore').click(function () {
        $('#showLess').show();
        shown = $('#myListBlog li:visible').length +3;
        if(shown< items) {$('#myListBlog li:lt('+shown+')').show();}
        else {$('#myListBlog li:lt('+items+')').show();
            $('#loadMore').hide();
        }
    });
    $('#showLess').click(function () {
        $('#myListBlog li').not(':lt(3)').hide();
    });
});