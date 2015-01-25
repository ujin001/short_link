var main = {
    beforeValidate: function(form) {
        var url_block = $('#short_url'),
            success_block = url_block.parent();
        success_block.hide();
        $('input[type="submit"]').attr('disabled', 'disabled');
    },
    afterValidate: function(data) {
        var url_block = $('#short_url'),
            success_block = url_block.parent();

        $('input[type="submit"]').removeAttr('disabled');

        if(data.generated_url) {
            $('#Url_original_url').val(null);
            url_block.html(data.generated_url);
            success_block.show();
        }

        return false;
    }
};