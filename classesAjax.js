$(document).ready(function(){
    $('#selectedUniversityAdd').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentAdd').html(html);
                }
            });
        }else{
            $('#selectedDepartmentAdd').html('<option value="">Select University First</option>');
        }
    });

    $('#selectedUniversityProAdd').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentProAdd').html(html).change();
                    $('#selectedProfessorProAdd').html('<option value="">Select Department First</option>');
                }
            });
        }else{
            $('#selectedDepartmentProAdd').html('<option value="">Select University First</option>');
            $('#selectedProfessorProAdd').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentProAdd').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnProfessorId='+departmentId,
                success:function(html){
                    $('#selectedProfessorProAdd').html(html);
                }
            });
        }else{
            $('#selectedProfessorProAdd').html('<option value="">Select Department First</option>');
        }
    });

    $('#selectedUniversityCouAdd').on('change',function(){
        var universityName = $(this).val();
        if(universityName){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityNameAndReturnDepartmentId='+universityName,
                success:function(html){
                    $('#selectedDepartmentCouAdd').html(html).change();
                    $('#selectedCourseCouAdd').html('<option value="">Select Department First</option>');
                }
            });
        }else{
            $('#selectedDepartmentCouAdd').html('<option value="">Select University First</option>');
            $('#selectedCourseCouAdd').html('<option value="">Select Department First</option>');
        }
    });
    $('#selectedDepartmentCouAdd').on('change',function(){
        var departmentId = $(this).val();
        if(departmentId){
            $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'departmentIdAndReturnCourseId='+departmentId,
                success:function(html){
                    $('#selectedCourseCouAdd').html(html);
                }
            });
        }else{
            $('#selectedCourseCouAdd').html('<option value="">Select Department First</option>');
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