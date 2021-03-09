
$(document).ready(function(){
    $('.deleteForm').click(function(evt){
        var name = $(this).data('name');
        var form =$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`คุณต้องการลบข้อมูล ${name} หรือไม่ ?`,
            text : "ถ้าลบแล้วไม่สามารถกู้คืนได้",
            icon:"warning",
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        });
    });
    $('.UpdateForm').click(function(evt){
        var name = $(this).data('name');
        var form =$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`คุณต้องการยืนยันการทำรายการ ${name} หรือไม่ ?`,
            icon:"info",
            buttons:true,
            dangerMode:true
        }).then((willUpdate)=>{
            if(willUpdate){
                form.submit();
            }
        });
    });
});

   
