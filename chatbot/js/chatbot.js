document.addEventListener("DOMContentLoaded", function(){
    //responsiveVoice.speak("JE SUIS YANIS", "French Male");
    let button = document.getElementById("button-send");
    button.addEventListener("click", function(){
        let text = document.getElementById("message-to-bot");
        if(text.value != ""){
            let chatHistory = document.getElementById("chat-history");
            let p_message = document.createElement("p");
            let div_message = document.createElement("div");
            div_message.classList.add("SendMessage");
            p_message.appendChild(document.createTextNode(text.value));
            div_message.appendChild(p_message);
            chatHistory.appendChild(div_message);
            //chatHistory.appendChild(document.createElement("br"));
            if(text.value == "Salut !"){
                let p_bot_message = document.createElement("p");
                p_bot_message.appendChild(document.createTextNode("Bonjour humain !"));
                let div_bot_message = document.createElement("div");
                div_bot_message.classList.add("BotMessage");
                div_bot_message.appendChild(p_bot_message);
                chatHistory.appendChild(div_bot_message);
            }
            text.value = "";
        }
    });

    axios({
        method: 'get',
        url: './data.php',
        data: {}
      }).then(function(response){
          response.data.forEach(function(element){   

        });
    });

});