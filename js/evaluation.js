document.getElementById("evaluationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche la soumission standard du formulaire

    const correctAnswers = {
        q1: '1',
        q2: '1',
        q3: '1',
        q4: '1',
        q5: '1',
        q6: '1',
        q7: '1',
        q8: '1',
        q9: '1',
        q10: '1'
    };

    let score = 0;
    const totalQuestions = 10; // Assurez-vous que cela correspond au nombre réel de questions

    // Calculez le score ici
    for (let i = 1; i <= totalQuestions; i++) {
        const userAnswer = document.querySelector(`input[name="q${i}"]:checked`);
        if(userAnswer && userAnswer.value === correctAnswers[`q${i}`]) {
            score += 1;
        }
    }

    // Mise à jour et affichage de la popup au lieu de l'alert
    document.getElementById("scoreText").innerText = `Votre score est de ${score} sur ${totalQuestions}.`;
    document.getElementById("scorePopup").style.display = "flex";

    // Optionnellement, cachez la popup et redirigez après un clic sur OK
    document.getElementById("closePopup").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        window.location.href = "../html/eleves.html";
    };

    // Fermer la popup avec le bouton de fermeture
    document.querySelector(".close-button").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        window.location.href = "../html/eleves.html";
    };
});

document.addEventListener("DOMContentLoaded", function() {
    let time = 10 * 60; // 20 minutes converties en secondes
    const timerDisplay = document.getElementById("timerDisplay");

    const intervalId = setInterval(function() {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        // Assurez-vous que les secondes sont affichées avec deux chiffres
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Mettez à jour le texte du minuteur
        timerDisplay.textContent = `${minutes}:${seconds}`;

        // Décompte
        time--;

        // Si le minuteur atteint 0, arrêtez le minuteur et redirigez
        if (time < 0) {
            clearInterval(intervalId);
            window.location.href = "../html/eleves.html"; // Redirection
        }
    }, 1000); // Mise à jour chaque seconde
});
