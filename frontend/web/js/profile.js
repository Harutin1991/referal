var url = window.location.pathname;
var language = url.split('/')[1];
function saveUserData(element,model) {
    var dataValue = $(element).val();
    var dataName = $(element).attr('name');
    $($(element).parent().parent().find('input')).removeClass("inputactive");
    $(element).parent().parent().find('input').attr('disabled', 'disabled');
    $(element).find('i').addClass('fa-pencil').removeClass('fa-check');
    $.ajax({
        url: '/' + language + '/user/update-item/',
        method: 'post',
        data: {value: dataValue,name:dataName},
        success: function (res) {
           
        }
    });
}

function pencileEdit(id,element){
    var elementInput = '#'+id;
    if($(element).attr('class') != 'fa fa-pencil'){
        saveUserData(elementInput);
    }
    
}
document.getElementById("copy-referal").addEventListener("click", function() {
    if(copyToClipboard(document.getElementById("refreal-link"))){
        $('#refreal-link').select();
    }
});
function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}



