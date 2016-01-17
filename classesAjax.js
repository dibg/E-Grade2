$(document).ready(function(){
    $(document).ready(function () {
        $(document).on("formSubmitted", function () {
            var departmentId = $('#selectedDepartmentIdSec').val();
            $.ajax({
                type: 'POST',
                url: 'ajaxSubmit.php',
                data: 'departmentIdAndReturnClassId=' + departmentId,
                success: function (html) {
                    $('#selectedClassChange').html(html).change();
                    $('#selectedClassRemove').html(html).change();
                    $('.formContainer select').change();
                }
            });
        });
    });

     $('#selectedUniversityAdd').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentAdd').html(html).change();
                    $('#selectedProfessorAdd').html('<option value="">Select Department First</option>');
                    $('#selectedCourseAdd').html('<option value="">Select Professor First</option>');
                }
            });
        }else{
            $('#selectedDepartmentAdd').html('<option value="">Select University First</option>');
            $('#selectedProfessorAdd').html('<option value="">Select Department First</option>');
            $('#selectedCourseAdd').html('<option value="">Select Professor First</option>');
        }
    });
    $('#selectedDepartmentAdd').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnProfessorId='+departmentId,
                success:function(html){
                    $('#selectedProfessorAdd').html(html).change();
                    $('#selectedCourseAdd').html('<option value="">Select Professor First</option>');
                }
            });
        }else{
            $('#selectedProfessorAdd').html('<option value="">Select Department First</option>');
            $('#selectedCourseAdd').html('<option value="">Select Professor First</option>');
        }
    });
    $('#selectedProfessorAdd').on('change',function(){
        var departmentId = $('#selectedDepartmentAdd').val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnCourseId='+departmentId,
                success:function(html){
                    $('#selectedCourseAdd').html(html);
                }
            });
        }else{
            $('#selectedCourseAdd').html('<option value="">Select Department First</option>');
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
                    $('#selectedClassChange').html('<option value="">Select Department First</option>');
                }
            });
        }else{
            $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
            $('#selectedClassChange').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentChange').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnClassId='+departmentId,
                success:function(html){
                    $('#selectedClassChange').html(html);
                }
            });
        }else{
            $('#selectedClassChange').html('<option value="">Select Department First</option>');
        }
    });

    $('#selectedUniversityRemove').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentRemove').html(html).change();
                    $('#selectedClassRemove').html('<option value="">Select Department First</option>');
                }
            });
        }else{
            $('#selectedDepartmentRemove').html('<option value="">Select University First</option>');
            $('#selectedClassRemove').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentRemove').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnClassId='+departmentId,
                success:function(html){
                    $('#selectedClassRemove').html(html);
                }
            });
        }else{
            $('#selectedClassRemove').html('<option value="">Select Department First</option>');
        }
    });

});