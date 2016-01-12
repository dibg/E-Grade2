<script type="text/javascript">
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

        $('#selectedUniversityChange').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'universityNameAndReturnDepartmentId='+universityName,
                    success:function(html){
                        $('#selectedDepartmentChange').html(html).change();
                        $('#selectedGradeChange').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
                $('#selectedGradeChange').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentChange').on('change',function(){
            var courseId = $(this).val();
            if(courseId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'courseIdAndReturnGradeId='+courseId,
                    success:function(html){
                        $('#selectedGradeChange').html(html);
                    }
                });
            }else{
                $('#selectedGradeChange').html('<option value="">Select Department First</option>');
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
                        $('#selectedGradeRemove').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentRemove').html('<option value="">Select University First</option>');
                $('#selectedGradeRemove').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentRemove').on('change',function(){
            var courseId = $(this).val();
            if(courseId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'courseIdAndReturnGradeId='+courseId,
                    success:function(html){
                        $('#selectedGradeRemove').html(html);
                    }
                });
            }else{
                $('#selectedGradeRemove').html('<option value="">Select Department First</option>');
            }
        });

    });
</script>