$(document).ready(function () {
    function loadPosts(page = 1) {
        let form = $('#filterForm');
        let data = form.serialize();
        data += '&type=999&tx_blog_bloglist[currentPage]=' + page;
        
        $.ajax({
            url: form.attr('action') || window.location.href,
            type: 'POST',
            data: data,
            success: function (html) {
                let temp = $('<div>').html(html);
                if (temp.find('tr').length === 0) return;
                $('#postContainer').html(temp.find('tbody tr'));
                $('#paginationContainer').html(
                    temp.find('#paginationContainer').html()
                );
            }
        });
    }

    $(document).on('click', '#clearFilter', function () {
        let form = $('#filterForm')[0];
        form.reset();        
        loadPosts(1);
    });

    $(document).on('keyup', '#filterForm input[type="text"]', function () {
        loadPosts();
    });

    $(document).on('change', '#filterForm input[type="date"]', function () {
        loadPosts();
    });

    // Pagination click
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        let page = $(this).data('page'); // IMPORTANT CHANGE
        loadPosts(page);
    });

});