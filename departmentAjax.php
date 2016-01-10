<script src="jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#selectedUniversity').on('change',function(){
            var universityName = $(this).val();
            if(universityName){
                $.ajax({
                type:'POST',
                url:'ajaxSubmit.php',
                data:'universityName='+universityName,
                success:function(html){
                    $('#selectedDepartment').html(html);
                }
            });
        }else{
                $('#selectedDepartment').html('<option value="">Select University First</option>');
            }
        });
    });
</script>