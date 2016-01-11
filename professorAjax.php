<script src="jquery.min.js"></script>
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
                        $('#selectedDepartmentChange').html(html).change(); // generate change event
                        $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
                $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentChange').on('change',function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'departmentIdAndReturnProfessorId='+departmentId,
                    success:function(html){
                        $('#selectedProfessorChange').html(html);
                    }
                });
            }else{
                $('#selectedProfessorChange').html('<option value="">Select Department First</option>');
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
                        $('#selectedDepartmentTransfer').html(html).change(); // generate change event
                        $('#selectedProfessorTransfer').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentTransfer').html('<option value="">Select University First</option>');
                $('#selectedProfessorTransfer').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentTransfer').on('change',function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'departmentIdAndReturnProfessorId='+departmentId,
                    success:function(html){
                        $('#selectedProfessorTransfer').html(html);
                    }
                });
            }else{
                $('#selectedProfessorTransfer').html('<option value="">Select Department First</option>');
            }
        });

        $('#selectedUniversityTransferTo').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'universityNameAndReturnDepartmentId='+universityName,
                    success:function(html){
                        $('#selectedDepartmentTransferTo').html(html);
                    }
                });
            }else{
                $('#selectedDepartmentTransferTo').html('<option value="">Select University First</option>');
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
                        $('#selectedDepartmentRemove').html(html).change(); // generate change event
                        $('#selectedProfessorRemove').html('<option value="">Select Department First</option>');
                    }
                });
            }else{
                $('#selectedDepartmentRemove').html('<option value="">Select University First</option>');
                $('#selectedProfessorRemove').html('<option value="">Select Department First</option>');
            }
        });
        $('#selectedDepartmentRemove').on('change',function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:'POST',
                    url:'ajaxSubmit.php',
                    data:'departmentIdAndReturnProfessorId='+departmentId,
                    success:function(html){
                        $('#selectedProfessorRemove').html(html);
                    }
                });
            }else{
                $('#selectedProfessorRemove').html('<option value="">Select Department First</option>');
            }
        });


    });
</script>