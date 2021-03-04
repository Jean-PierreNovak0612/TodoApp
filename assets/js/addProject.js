$(document).on('submit', 'form.addproject', function(event){
    // Prevents form from submiting
    event.preventDefault();
    // Storing elements that will be used into variables to shorten the length of this code
    var _form = $(this);
    var _success = $('.success', _form);
    var _error = $('.error', _form);
    var objData = {
        prname : $("#projectName").val(),
    }
    // Sending the receved data with ajax to an PHP file
    $.ajax({
        dataType: 'json', 
        data: objData,
        type: 'POST',
        url: 'ajax/addProject.php',
        async: true,
    })
    // Function will be executed if there were no errors on the way
    .done(function ajaxDone(data){
        console.log(data);
    })
    // Function will execute if there was an error on the way
    .fail(function ajaxFail(e){
        console.log(e);
    })
    return false;
})