
window.onload = (function(){
    var form = document.getElementById("fee_payment_form");
    form.addEventListener("submit", function(e){
        e.preventDefault();
        var courseId = $("#course").val();
        if(courseId == ""){
            $.notify("Please Select Course", "error");
            return false;
        }
        else if($("#user").val() == ""){
             $.notify("Please Select Student", "error");
            return false;
        }

        else if($("#billing_date").val() == ""){
           $.notify("Please Choose Billing Date", "error");
            return false;
        }

        else if($("#net_days").val() == ""){
            $.notify("Please Enter Net Days", "error");
             return false;
        }
        else if($("#due_date").val() == ""){
            $.notify("Please Choose Due Date", "error");
             return false;
         }

        else if($("#remarks").val().trim().length < 1){
           $.notify("Please Enter Fee Billing Remarks", "error");
            return false;
        }



        else {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $this = $('#submit');
    $this.prop('disabled', true);
    $.ajax({
      url:"/accounts/bill_students",
      method:"post",
      data:$("#fee_payment_form").serialize(),
      success:function(response){
     if (response.status == 200) {
         $('#success').html("<div class='alert alert-success'><strong>" + response.message + "</strong></div>");
         $('#fee_payment_form').trigger('reset');
     }
      else if (response.status == 400) {
         $('#success').html("<div class='alert alert-danger'><strong>" + response.message + "</strong></div>");
         $('#fee_payment_form').trigger('reset');
     } else if (response.status == 404) {
        $('#success').html("<div class='alert alert-danger'><strong>" + response.message + "</strong></div>");
        $('#fee_payment_form').trigger('reset');
     }

      },
      error:function(error){
        console.log(error);
        },
        complete:function(){
            setTimeout(function(){
             $this.prop("disabled", false);
                $('#success').html('');
            }, 5000);
           }

    });

    }

    });
});
