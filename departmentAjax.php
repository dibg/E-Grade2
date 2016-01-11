<script src="jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#selectedUniversityRename').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityName='+universityName,
                success:function(html){
                    $('#selectedDepartmentRename').html(html);
                }
            });
        }else{
                $('#selectedDepartmentRename').html('<option value="">Select University First</option>');
            }
        });

        $('#selectedUniversityTransfer').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'universityNameAndReturnDepartmentId='+universityName,
                    success:function(html){
                        $('#selectedDepartmentTransferId').html(html);
                    }
                });
            }else{
                $('#selectedDepartmentTransferId').html('<option value="">Select University First</option>');
            }
        });

        $('#selectedUniversityDelete').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'universityNameAndReturnDepartmentId='+universityName,
                    success:function(html){
                        $('#selectedDepartmentDelete').html(html);
                    }
                });
            }else{
                $('#selectedDepartmentDelete').html('<option value="">Select University First</option>');
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
                        $('#selectedSecretaryChange').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
                $('#selectedSecretaryChange').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentChange').on('change',function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'departmentIdAndReturnSecretaryId='+departmentId,
                    success:function(html){
                        $('#selectedSecretaryChange').html(html);
                    }
                });
            }else{
                $('#selectedSecretaryChange').html('<option value="">Select Department First</option>');
            }
        });


    });
</script>