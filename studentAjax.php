<script src="jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
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
                        $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
                    }
                });
            } else {
                $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
                $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentChange').on('change', function () {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    type: 'POST',
                    url: 'ajaxSubmit.php',
                    data: 'departmentId=' + departmentId,
                    success: function (html) {
                        $('#selectedProfessorChange').html(html);
                    }
                });
            } else {
                $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
            }
        });
    });
</script>