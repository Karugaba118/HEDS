// Global variables at call time

var xhr = new XMLHttpRequest();

// "this" will provide the form aboject from the inline call
function someajax(form){
    // to give feedback
    msg = document.getElementById('msg');
    ////email = document.getElementById('email');
    subject = document.getElementById('subject');

    formData = new FormData(form);



    xhr.open("POST", "../backend/contact-form.php");


    xhr.onload = function(){
        if(xhr.status === 200){
            msg.innerHTML = xhr.responseText;
            //msg.innerHTML = "Good work !11";
            //console.log(xhr.responseText);
            //email.value = "";
            subject.value = "";
        }
        else {
            msg.innerHTML = "Error : request failed with status ::"+ xhr.status;

        }
    }


    xhr.send(formData);

    return false;


}



	



