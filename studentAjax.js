$(document).ready(function () {
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
                    $('select').change();
                },
                error: function(html)
                {
                    window.alert("failed");
                }
            });
            e.preventDefault();
        });
    });

    $('#selectedUniversityAdd').on('change', function () {
        var universityName = $(this).val();
        if (universityName) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'universityNameAndReturnDepartmentId=' + universityName,
                success: function (html) {
                    $('#selectedDepartmentAdd').html(html);
                }
            });
        } else {
            $('#selectedDepartmentAdd').html('<option value="">Select University First</option>');
        }
    });

    $('#selectedUniversityChange').on('change', function () {
        var universityName = $(this).val();
        if (universityName) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'universityNameAndReturnDepartmentId=' + universityName,
                success: function (html) {
                    $('#selectedDepartmentChange').html(html).change();
                    $('#selectedStudentChange').html('<option value="">Select Department First</option>');
                }
            });
        } else {
            $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
            $('#selectedStudentChange').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentChange').on('change', function () {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'departmentIdAndReturnStudentId=' + departmentId,
                success: function (html) {
                    $('#selectedStudentChange').html(html);
                }
            });
        } else {
            $('#selectedStudentChange').html('<option value="">Select Department First</option>');
        }
    });

    $('#selectedUniversityRemove').on('change', function () {
        var universityName = $(this).val();
        if (universityName) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'universityNameAndReturnDepartmentId=' + universityName,
                success: function (html) {
                    $('#selectedDepartmentRemove').html(html).change();
                    $('#selectedStudentRemove').html('<option value="">Select Department First</option>');
                }
            });
        } else {
            $('#selectedDepartmentRemove').html('<option value="">Select University First</option>');
            $('#selectedStudentRemove').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentRemove').on('change', function () {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'departmentIdAndReturnStudentId=' + departmentId,
                success: function (html) {
                    $('#selectedStudentRemove').html(html);
                }
            });
        } else {
            $('#selectedStudentRemove').html('<option value="">Select Department First</option>');
        }
    });

    $('#selectedUniversityTransfer').on('change', function () {
        var universityName = $(this).val();
        if (universityName) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'universityNameAndReturnDepartmentId=' + universityName,
                success: function (html) {
                    $('#selectedDepartmentTransfer').html(html).change();
                    $('#selectedStudentTransfer').html('<option value="">Select Department First</option>');
                }
            });
        } else {
            $('#selectedDepartmentTransfer').html('<option value="">Select University First</option>');
            $('#selectedStudentTransfer').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentTransfer').on('change', function () {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'departmentIdAndReturnStudentId=' + departmentId,
                success: function (html) {
                    $('#selectedStudentTransfer').html(html);
                }
            });
        } else {
            $('#selectedStudentTransfer').html('<option value="">Select Department First</option>');
        }
    });

    $('#selectedUniversityTransferTo').on('change', function () {
        var universityName = $(this).val();
        if (universityName) {
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'universityNameAndReturnDepartmentId=' + universityName,
                success: function (html) {
                    $('#selectedDepartmentTransferTo').html(html);
                }
            });
        } else {
            $('#selectedUniversityTransferTo').html('<option value="">Select University First</option>');
        }
    });
});
