$(document).ready(function () {
    // Load the first 6 list items from another HTML file
    $('#myList li:lt(6)').show();
    var items =  $('#myList li').length;
    var shown =  6;
    $('#loadMore').click(function () {
        shown = $('#myList li:visible').length +6;
        if(shown< items) {$('#myList li:lt('+shown+')').show();}
        else {$('#myList li:lt('+items+')').show();
            $('#loadMore').hide();

        }
    });
});