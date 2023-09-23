


var button = document.getElementById("fetch-Student");
button.addEventListener("click", function(e){
e.preventDefault();
$("#error").addClass("d-none");
if($("#course").val() == ""){
$("#error").removeClass("d-none");
$("#error").html("Select Course");
}else if($("#units").val() == ""){
$.notify("Please select unit", "error");
return false;
}
else{
$.ajax({
url:'{{ url("tutor/fetch_students") }}',
method:'GET',
dataType:"json",
data:{
"course":$("#course").val(),
},
success:function(response){
if(response.length > 0){
$(".marks-entry").removeClass("d-none");
var html = '';
$.each(response, function (key, value) {
html +=
'<tr>'+
'<td>'+ value.ad_no + '<input type="hidden" value="'+value.student_id+'" name="student_id[]">'+
'<input type="hidden" value="'+value.id+'" name="user_id[]">'+
'</td>'+
'<td>'+ value.name +'</td>'+
'<td>'+ '<input type="text" name="marks[]" required="required"  class="form-control" >'+'</td>'+
'</tr>';

});
html = $(".marks-row").html(html);
}
else {
$(".marks-entry").addClass("d-none");
$.notify("No students Found", {globalPosition:'top right',className:'error'});
}
},
error:function(error){
console.log(error)
},
});
}
});

$(document).ready(function(){
$("#marksForm").validate({
    rules:{

        "marks[]":{
            required:true
        }
    },
    messages:{

   
    },

      errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }

})
});
