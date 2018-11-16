$(document).ready(function(){
    $('#file-btn').click(uploadFile);
});

function uploadFile(){
    $('#submit').removeClass('disabled');
    $('#real-file-btn').click();
}