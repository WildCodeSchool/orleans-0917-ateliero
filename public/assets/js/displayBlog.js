$(document).ready(function () {
// Load the first 3 list items from another HTML file
    $('#myListBlog li:lt(3)').show();
    var items = $('#myListBlog li').length;
    var shown = 3;
    if (items <= 3) {$('#seeMore').hide();};
    $('#seeMore').click(function () {
        shown = $('#myListBlog li:visible').length +3;
        if(shown< items) {$('#myListBlog li:lt('+shown+')').show();}
        else {$('#myListBlog li:lt('+items+')').show();
            $('#seeMore').hide();
        }
    });
});