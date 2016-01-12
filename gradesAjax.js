$(document).ready(function(){
    $('#selectedUniversityAdd').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentAdd').html(html).change();
                    $('#selectedStudentAdd').html('<option value="">Select Department First</option>');
                    $('#selectedCourseAdd').html('<option value="">Select Student First</option>');
                }
            });
        }else{
            $('#selectedDepartmentAdd').html('<option value="">Select University First</option>');
            $('#selectedStudentAdd').html('<option value="">Select Department First</option>');
            $('#selectedCourseAdd').html('<option value="">Select Student First</option>');
        }
    });
    $('#selectedDepartmentAdd').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data: 'departmentIdAndReturnStudentId=' + departmentId,
                success: function (html) {
                    $('#selectedStudentAdd').html(html).change();
                    $('#selectedCourseAdd').html('<option value="">Select Student First</option>');
                }
            });
        }else{
            $('#selectedStudentAdd').html('<option value="">Select Department First</option>');
            $('#selectedCourseAdd').html('<option value="">Select Student First</option>');
        }
    });
    $('#selectedStudentAdd').on('change',function(){
        var studentId = $(this).val();
        var departmentId =  $('#selectedDepartmentAdd').val();
        if(studentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data: {studentIdAndReturnCourseIdThatNotHaveGrade: studentId, departmentIdAndReturnCourseIdThatNotHaveGrade: departmentId},
                success: function (html) {
                    $('#selectedCourseAdd').html(html);
                }
            });
        }else{
            $('#selectedCourseAdd').html('<option value="">Select Student First</option>');
        }
    });

    $('#selectedUniversityChange').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentChange').html(html).change();
                    $('#selectedStudentChange').html('<option value="">Select Department First</option>');
                    $('#selectedCourseChange').html('<option value="">Select Student First</option>');
                    $('#selectedGradeChange').html('<option value="">Select Course First</option>');
                }
            });
        }else{
            $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
            $('#selectedStudentChange').html('<option value="">Select Department First</option>');
            $('#selectedCourseChange').html('<option value="">Select Student First</option>');
            $('#selectedGradeChange').html('<option value="">Select Course First</option>');
        }
    });
    $('#selectedDepartmentChange').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data: 'departmentIdAndReturnStudentId=' + departmentId,
                success: function (html) {
                    $('#selectedStudentChange').html(html).change();
                    $('#selectedCourseChange').html('<option value="">Select Student First</option>');
                    $('#selectedGradeChange').html('<option value="">Select Course First</option>');
                }
            });
        }else{
            $('#selectedStudentChange').html('<option value="">Select Department First</option>');
            $('#selectedCourseChange').html('<option value="">Select Student First</option>');
            $('#selectedGradeChange').html('<option value="">Select Course First</option>');
        }
    });
    $('#selectedStudentChange').on('change',function(){
        var studentId = $(this).val();
        var departmentId =  $('#selectedDepartmentChange').val();
        if(studentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data: {studentIdAndReturnCourseIdThatHaveGrade: studentId, departmentIdAndReturnCourseIdThatHaveGrade: departmentId},
                success: function (html) {
                    $('#selectedCourseChange').html(html).change();
                    $('#selectedGradeChange').html('<option value="">Select Course First</option>');
                }
            });
        }else{
            $('#selectedCourseChange').html('<option value="">Select Student First</option>');
            $('#selectedGradeChange').html('<option value="">Select Course First</option>');
        }
    });
    $('#selectedCourseChange').on('change',function(){
        var courseId = $(this).val();
        var studentId =  $('#selectedStudentChange').val();
        if(courseId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data: {courseIdAndReturnGradeId: courseId, studentIdAndReturnGradeId: studentId},
                success: function (html) {
                    $('#selectedGradeChange').html(html);
                }
            });
        }else{
            $('#selectedGradeChange').html('<option value="">Select Course First</option>');
        }
    });


});