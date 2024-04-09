document.getElementById("evaluationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche la soumission standard du formulaire

    let score = 0;
    const totalQuestions = correctAnswers.length; // Utilisez la longueur du tableau des bonnes réponses pour déterminer le nombre total de questions

    for (let i = 1; i <= totalQuestions; i++) {
        const userAnswer = document.querySelector(`input[name="q${i}"]:checked`);
        if (userAnswer && userAnswer.value === String(correctAnswers[i - 1])) { // Convertissez explicitement en chaîne pour la comparaison
            score += 1;
        }
    }



    document.getElementById("scoreText").innerText = `Votre score est de ${score} sur ${totalQuestions}.`;
    document.getElementById("scorePopup").style.display = "flex";

    document.getElementById("closePopup").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        window.location.href = "../html/eleves.php";
    };

    document.querySelector(".close-button").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        window.location.href = "../html/eleves.php";
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
            window.location.href = "../html/eleves.php"; // Redirection
        }
    }, 1000); // Mise à jour chaque seconde
});
