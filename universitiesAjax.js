$(document).ready(function () {
    $('.formContainer input[type=submit]').change(function () { //todo not refreshing
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'getUniversities=true',
                success: function (html) {
                    $('.selectedUniversity').html(html).change();
                }
            });
    });
});