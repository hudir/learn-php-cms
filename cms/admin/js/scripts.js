$(document).ready(function() {
    $('#summernote').summernote({
        height:180
    });
});


$(document).ready(function() {
    $('#selectAllBoxes').click(function (event) {
        if(this.checked) {
            $('.checkBoxes').each(function (){
                this.checked = true;
            })
        } else {
            $('.checkBoxes').each(function (){
                this.checked = false;
            })
        }
    })
});
