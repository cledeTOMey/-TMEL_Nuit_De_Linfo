document.addEventListener("DOMContentLoaded", function(){
    //responsiveVoice.speak("JE SUIS YANIS", "French Male");
    let button = document.getElementById("button-send");
    button.addEventListener("click", function(){
        let text = document.getElementById("message-to-bot");
        if(text.value != null){
            let chatHistory = document.getElementById("chat-history");
            let p_message = document.createElement("p");
            p_message.appendChild(document.createTextNode(text.value));
            chatHistory.appendChild(p_message);
            text.value = "";
        }
    });
});