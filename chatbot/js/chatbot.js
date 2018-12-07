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
            axios({
                method: 'get',
                url: './chatbot.php?usr_message='+text.value,
                data: {}
              }).then(function(response){
                  response.data.forEach(function(element){   
                    setTimeout(function(){
                        let p_bot_message = document.createElement("p");
                        let div_bot_message = document.createElement("div");
                        div_bot_message.id = "bite";
                        div_bot_message.classList.add("BotMessage");
                        p_bot_message.appendChild(document.createTextNode("..."));
                        div_bot_message.appendChild(p_bot_message);
                        chatHistory.appendChild(div_bot_message);
                    }, 500);
                    setTimeout(function(){
                        //chatHistory.removeChild(div_bot_message);
                        document.getElementById("bite").parentElement.removeChild(document.getElementById("bite"));
                        console.log("ZIZI");
                    }, 2000);
                    setTimeout(function(){
                        let p_bot_message = document.createElement("p");
                        let div_bot_message = document.createElement("div");
                        div_bot_message.classList.add("BotMessage");
                        p_bot_message.appendChild(document.createTextNode(element));
                        div_bot_message.appendChild(p_bot_message);
                        chatHistory.appendChild(div_bot_message);
                        responsiveVoice.speak(element, "French Male");
                        console.log(element);
                    }, 2800);
                });
            });
            text.value = "";
        }
    });

});
