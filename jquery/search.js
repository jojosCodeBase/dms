$(document).ready(function() {
    // listen for changes in the search input field
    $('#searchInput').on('input', function() {
        // get the search query from the input field
        var query = $(this).val();

        // send the AJAX request
        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: {searchQuery: query},
            success: function(response) {
                $('#searchResults').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ' + textStatus);
            }
        });
    });
});