var blank_txt = "<span class='col-md-12 blank_error' style='color:red;'>Please Fill Existing Field.</span>";

$(document).ready(function() {
    $('#client_name, #project_name, #tl_name').trigger('keyup');
});

$(document).on('keyup', '.task_detail', function(e) {
    if( e.keyCode === 13 ) {
        $(this).parent().find('.components').click();
    } else {
        let txtValue = $(this).val();
        if( txtValue == '' ) {
            $(this).val($(this).next().next().val());
            $(this).next().next().next().remove();
            $(this).next().next().remove();
            setHtml($(this));
        }
        if( $(this).val() != '' ) {
            setHtml( $(this) );
        }
    }
});

function setHtml( txt_box ) { 
    var txt_name = txt_box.attr('name');
    if( $('input[name="'+ txt_name +'"]').length == 1 && $('input[name="'+ txt_name +'"]').val() == '' ) {
        var task_detail = '';
        if( txt_name == 'list_done' ) {
            $('.review_note').html('');
        }
    } else {
        var task_detail = "<b><u>" + txt_box.parent().parent().prev().text() + "</u></b>";
        task_detail += "<br>";
        task_detail += "<ol type='1'>";
        $('input[name="'+ txt_name +'"]').each(function(){
            if ( $(this).val() != '' ){
                if( txt_name == 'list_done[]'){
                    $('.review_note').html('Please check with the latest updates and let us know your thoughts for the same.<br>')
                    task_detail += "<li>" + $(this).val() + "<b> [Done]</b></li>";
                } else {
                    task_detail += "<li>" + $(this).val() + "</li>";
                }
                if( $(this).next('input.extra_detail').length > 0 ){
                    task_detail += "<ul>";
                    $(this).nextAll('input.extra_detail').each(function(){
                        task_detail += "<li>" + $(this).val() + "</li>";
                    })
                    task_detail += "</ul>";
                }
            }
        });
        task_detail += "</ol>";
    }
    $('.' + txt_name.slice(0, -2)).empty();
    $('.' + txt_name.slice(0, -2)).html(task_detail);
}

$(document).on('click', '.components', function(){
    let $input = $(this).prev('input.task_detail');
    if ( !$input.length ) {
        $input = $(this).prev().prev('input.task_detail');
    }
    let textbox_placeholder = $input.attr('placeholder');
    let textbox_name = $input.attr('name');
    let firstText = $input.val();
    let last_val = $(this).nextAll('input.task_detail').last().val();
    if( firstText !="" && last_val != ""){
        let auto = "<input type='text' placeholder='"+ textbox_placeholder +"' name="+ textbox_name +" class='form-control custom-input task_detail'>\n\
                <i class='fa fa-minus-circle font-20 component_close'></i>";
        $(this).parent().append(auto);
        $(this).parent().find('.task_detail').last().focus();
        $(this).nextAll('span.blank_error').remove();
    } else {
        if ( ! $(this).nextAll('span').hasClass('blank_error') ) {
            $(this).parent().append(blank_txt);
        }
    }
});

$(document).on('click','.component_close',function(){
    $(this).prev('input').val('');
    setHtml($(this).prev('input'));
    $(this).prev('input').remove();
    $(this).next('.extra').remove();
    $(this).nextAll('.extra_close').remove();
    $(this).nextAll('input.extra_detail').remove();
    $(this).nextAll('span.blank_error').remove();
    $(this).remove();
});

$(document).on('click', '.extra', function(){
    var textbox_placeholder = 'Extra Description';
    var textbox_name = 'extra_detail';
    var firstText = $(this).prev('input').val();
    var last_val = $(this).nextAll('input.extra_detail').last().val();
    if( firstText !="" && last_val != ""){
        var auto = "<input type='text' placeholder='"+ textbox_placeholder +"' name="+ textbox_name +" class='form-control custom-input extra_detail'>\n\
                <i class='fa fa-minus-circle font-20 extra_close'></i>";
        $(this).parent().append(auto);
        $(this).nextAll('span.blank_error').remove();
    }
    else{
        if( ! $(this).nextAll('span').hasClass('blank_error') ){
            $(this).parent().append(blank_txt);
        }
    }
});

$(document).on('click','.extra_close',function(){
    $(this).prev('input').remove();
    $(this).remove();
});

function getOrdinal(n) {
    if((parseFloat(n) == parseInt(n)) && !isNaN(n)){
        var s=["th","st","nd","rd"],
        v=n%100;
        return n+(s[(v-20)%10]||s[v]||s[0]);
    }
    return n;     
}

function currentDate(){
    var date = new Date();
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";
    return getOrdinal(date.getDate()) + " " + month[date.getMonth()] + ", " + date.getFullYear();
}

function setClientName(client_name){
    if ( $(client_name).val() != '' ){
        var welcome_msg = 'Hi ' + $(client_name).val() + ',<br><br>';
        $('.client_name').html(welcome_msg);
    }
}

function setProjectName(project_name){
    if( $(project_name).val() !='' ){
        var projectName = $(project_name).val();
        var update_msg = 'Following are the updates for ' + projectName + ' as on ' + currentDate() +' :<br><br>';
        var subject = 'Updates for ' + projectName + ' as on ' + currentDate() + '<hr>';
        $('.update_msg').html(update_msg);
        $('.subject').html(subject);
    }
}

function SetTlName(tl_name){
    if ($(tl_name).val() != ''){
        var thanks_msg = '<br>Thanks,<br>' + $(tl_name).val();
        $('.thanks').html(thanks_msg);
    }
}

/*$(document).find('#daily-updates-form').validate({
    submitHandler: form => {
        $(document).find('.copy-and-save').attr('disabled');
        copy( $('.mail_body') );
        $(form).submit();
    }
});*/

$(document).on('click', '.copy-and-save', function(event) {
    event.preventDefault();
    $(this).attr('disabled')
    // copy( $('.mail_body') );

    $(this).parents('form').submit();
});
