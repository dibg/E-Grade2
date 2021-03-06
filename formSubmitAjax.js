$(document).ready(function() {
    $('.formContainer input[type=submit]').click(function() {
        var submitType = $(this).attr("value");
        $('.formContainer ' + '#' + submitType + ' form').submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            postData.push({ name: "submit", value: submitType });
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(html)
                {
                    //window.alert(html);
                    $('#msg').html(html);
                    $('#' + submitType + ' input[type="text"]').val("");
                    $(document).trigger("formSubmitted");
                    $('select').change();
                },
                error: function(html)
                {
                    window.alert("failed");
                }
            });
            e.preventDefault();	//don't refresh the page
            e.unbind();
        });
    });

    $(document).on("formSubmitted", function () {
        $.ajax({
            type: 'POST',
            url: 'ajaxSubmit.php',
            data: 'getUniversities=true',
            success: function (html) {
                $('.selectedUniversity').html(html).change();
                $('.formContainer select').change();
            }
        });
    });


});

