$(document).ready(function () {
    // Load the first 6 list items from another HTML file
    //$('#myList').load('externalList.html li:lt(6)');
    $('#myList li:lt(6)').show();
    // $('#showLess').hide();
    var items =  $('#myList li').length;
    console.log(items);
    var shown =  6;
    $('#loadMore').click(function () {
        $('#showLess').show();
        shown = $('#myList li:visible').length +6;
        if(shown< items) {$('#myList li:lt('+shown+')').show();}
        else {$('#myList li:lt('+items+')').show();
            $('#loadMore').hide();

        }
    });
});