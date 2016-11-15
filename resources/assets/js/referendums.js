$(document).ready(function () {
    var max_fields = 10;
    var wrapper = $(".wrap_answers");
    var add_button = $(".add_answer");

    var x = 1;
    $(add_button).click(function (e) {
        var answer = '<li class="list-group-item">' +
            '<div class="form-group">' +
            '<h4><label for="answers[]" class="control-label">Answer:</label></h4>' +
            '<textarea class="form-control" name="answers[]" cols="50" rows="10" id="answers[]"></textarea>' +
            '</div>' +
            '<a href="#" id="rm" class="btn btn-danger remove_field"><i class="fa fa-remove"></i>Remove</a>' +
            '</li>';
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $("#rm").remove();
            $(wrapper).append(answer);
        }
    })


    $(wrapper).on("click", ".remove_field", function (e) {
        e.preventDefault();
        $("#divs").remove();
        x--;
    })

});
