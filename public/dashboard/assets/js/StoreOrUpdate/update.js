$(function() {
    $('#formUpdate').on('submit', function(e) {

        const formUpdate = $(this);
        const buttonUpdate = formUpdate.find('button[type="submit"]');

        buttonUpdate.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updateing...
        `);
    })
})