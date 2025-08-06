$(function() {
    $('#formStore').on('submit', function(e) {

        const formStore = $(this);
        const buttonStore = formStore.find('button[type="submit"]');

        buttonStore.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...
        `);
    })
})