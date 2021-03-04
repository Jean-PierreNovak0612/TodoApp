$(document).on('submit', 'form.addtolist', function(event){
    // Prevents form from submiting
    event.preventDefault();
    // Storing elements that will be used into variables to shorten the length of this code
    var _form = $(this);
    var _success = $('.success', _form);
    var _error = $('.error', _form);
    var objData = {
        tskname : $("#listItem").val(),
        prname : $('title').text(),
    }
    console.log(objData)
    // Sending the receved data with ajax to an PHP file
    $.ajax({
        dataType: 'json', 
        data: objData,
        type: 'POST',
        url: '../ajax/addTask.php',
        async: true,
    })
    // Function will be executed if there were no errors on the way
    .done(function ajaxDone(data){

        // If there was no project with the same name as an existing one, display the success message
        if(data.success !== undefined){
            _success.text(data.success).fadeIn(500);
            setTimeout(function(){
                _success.fadeOut(500);
            }, 3000);
            setTimeout(function(){
                location.reload();
            }, 3100);
        }

        // If there was a project with the same name as an existing one, display the error message
        if(data.error !== undefined){
            _error.text(data.success).fadeIn(500);
            setTimeout(function(){
                _error.fadeOut(500);
            }, 3000);
        }
    })
    // Function will execute if there was an error on the way
    .fail(function ajaxFail(e){
        console.log(e);
    })
    return false;
})