// Initialisation de la reconnaissance vocale en fonction du navigateur
// Pour l'instant, seul Google Chrome le supporte
var SpeechRecognition = SpeechRecognition ||
                          webkitSpeechRecognition ||
                          mozSpeechRecognition ||
                          msSpeechRecognition ||
                          oSpeechRecognition;
                           
var recognition;
var lastStartedAt;
var reco = true;
                           
if (!SpeechRecognition) 
{
    console.log('Pas de reconnaissance vocale disponible');
    alert('Pas de reconnaissance vocale disponible');
} 
else 
{
     
    // Arrêt de l'ensemble des instances déjà démarrées
        if (recognition && recognition.abort) 
        {
            recognition.abort();
        }
     
    // Initialisation de la reconnaissance vocale
    recognition = new SpeechRecognition();
    // Reconnaissance en continue
    recognition.continuous = true;
    // Langue française
    recognition.lang = 'fr-FR';
     
    // Evènement de début de la reconnaissance vocale
    recognition.onstart = function() 
    {
        console.log('Démarrage de la reconnaissance');
    };
     
    // Evènement de fin de la reconnaissance vocale
    // A la fin de la reconnaissance (timeout), il est nécessaire de la redémarrer pour avoir une reconnaissance en continu
    // Ce code a été repris de annyang
    recognition.onend = function() 
    {
        console.log('Fin de la reconnaissance');
        var timeSinceLastStart = new Date().getTime()-lastStartedAt;
        if(reco)
        {
            if (timeSinceLastStart < 1000) 
            {
                setTimeout(startRecognition, 1000-timeSinceLastStart);
            } 
            else 
            {
                // Démarrage de la reconnaissance vocale
                startRecognition();
            }
        }
        
    };
 
    // Evènement de résultat de la reconnaissance vocale
    recognition.onresult = function (event) {
        for (var i = event.resultIndex; i < event.results.length; ++i) 
        {
            var texteReconnu = event.results[i][0].transcript;
            console.log('Résultat = ' + texteReconnu);
            sendText("../chatBot.php", texteReconnu);
            // Synthèse vocale de ce qui a été reconnu
            var u = new SpeechSynthesisUtterance();
            u.text = texteReconnu;
            u.lang = 'fr-FR';
            u.rate = 1.2;
            speechSynthesis.speak(u);
        }
    };
     
    // Démarrage de la reconnaissance vocale
    document.querySelector("button").addEventListener("click", function() 
    {
        if(!reco)
        {
            recognition.start();
            reco = true;
        }
        else
        {
            recognition.stop();
            reco = false;
        }
    })
}
 
function startRecognition() {
    // Démarrage de la reconnaissance vocale
    lastStartedAt = new Date().getTime();
        recognition.start();
}

function sendText(url, text)
{
    // Envoi du texte reconnu au bot
    axios.post(url, text)
    .then(function (response) 
    {
        console.log(response);
    })
    .catch(function (error) 
    {
        console.log(error);
    });
}

function stopRecognition()
{

}