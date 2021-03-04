$('input[type="checkbox"').on('change', function(event){
    var _check = $(this);
    var itemId = $(this).attr('id');
    console.log(itemId)
    var checked;
    if(_check.prop('checked')){
        checked = 1;
    }
    if(!_check.prop('checked')){
        checked = 0;
    }
    var objData = {
        id : itemId,
        check : checked,
    }
    console.log(objData)
    $.ajax({
        type: 'post', 
        url:'../ajax/done.php',
        dataType: 'json',
        data: objData,
        asyinc: true,
    })
    .done(function ajaxDone(data){
        console.log(data);
        setTimeout(function(){
            location.reload();
        }, 200);
    })
    .fail(function ajaxFail(e){
        console.log(e);
    })
})