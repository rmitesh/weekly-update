function copy( $elem ) {
    if ( $elem.length ) {
        var target = $elem[0];
        var range, select;
        if (document.createRange) {
            range = document.createRange();
            range.selectNode(target)
            select = window.getSelection();
            select.removeAllRanges();
            select.addRange(range);
            document.execCommand('copy');
            select.removeAllRanges();
        } else {
            range = document.body.createTextRange();
            range.moveToElementText(target);
            range.select();
            document.execCommand('copy');
        }
    }
}

setTimeout(() => {
    $(document).find('.alert:not(.stay)').fadeOut('slow');
}, 5000);

/* Remove tasks from the list */
$(document).on('click', '.remove-task', function(event) {
    event.preventDefault();
    let href = $(this).attr('href');
    swal({
        title: 'Are you sure you want to delete this?',
        text: 'You will not be able to recover this record after deletion.',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No, Cancel It',
        confirmButtonText: 'Yes, I am sure',
    }, () => {
        window.location.href = href;
    });
});
