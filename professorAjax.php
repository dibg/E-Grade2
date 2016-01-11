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
                        $('#selectedDepartmentChange').html(html);
                    }
                });
            }else{
                $('#selectedDepartmentChange').html('<option value="">Select University First</option>');
            }
        });

    });
</script>