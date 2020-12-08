$(document).ready(function(){
    $('.updateProject').click(function(evt){
        var name = $(this).data('name');
        var form =$(this).closest("form");
        var reg_std1 = document.getElementById("reg_std1").value;
        var reg_std2 = document.getElementById("reg_std2").value;
        var reg_std3 = document.getElementById("reg_std3").value;
        evt.preventDefault();
        if( reg_std1 !== "" &&  reg_std2 !=="" &&  reg_std3 !==""){
          swal({
            title: "คุณแน่ใจแล้วที่จะบันทึกข้อมูล ?",
            text: `นักศึกษาคนที่ 1 ${reg_std1}  , นักศึกษาคนที่ 2 ${reg_std2}  ,นักศึกษาคนที่ 3 ${reg_std3}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willUpdate) => {
            if (willUpdate) {
                form.submit();
              swal("เสร็จสิ้น", {
                icon: "success",
              });
            } else {
              swal("ยกเลิกการบันทึก !");
            }
          });
        }
        });

        $('.rejectProject').click(function(evt){
          var name = $(this).data('name');
          var form =$(this).closest("form");
          evt.preventDefault();
          swal({
            title:`คุณต้องการส่งคืนโครงการ ${name} หรือไม่ ?`,
              text : "ยืนยันหรือไม่",
              icon:"warning",
              buttons:true,
              dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                  form.submit();
              }
          });
      });
    
});
   
