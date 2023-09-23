
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
