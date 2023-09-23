
$(function () {
$(document).on("change", "#course", function (e) {
e.preventDefault();
courseId = $(this).val();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
}
});
//    use Axios here
if (courseId == "") {
$("#error").removeClass("d-none");
$("#error").html("Select Course");
}
else {
$("#error").addClass("d-none");
$.ajax({
url: `/tutor/fetch_subjects/${courseId}`,
method: "POST",
dataType: "json",
success: function (response) {

if(response.length > 0){
var html = "<option value=''> Select Unit</option>";
$.each(response, function (key, value) {
html += '<option value="' + value.id + '">' + value.title + '</option>';
});
$("#units").html(html);
}
else {
var html = "<option value=''> No unit is available</option>";
$("#units").html(html);
}

},
error: function (error) {
console.log(error);
}
});
}
// use Axios here

});
});



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





