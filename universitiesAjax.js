$(document).ready(function () {
    $(document).on("formSubmitted", function () {
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