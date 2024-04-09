document.getElementById("evaluationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche la soumission standard du formulaire

    let score = 0;
    const totalQuestions = correctAnswers.length;

    for (let i = 1; i <= totalQuestions; i++) {
        const userAnswer = document.querySelector(`input[name="q${i}"]:checked`);
        if (userAnswer && userAnswer.value === String(correctAnswers[i - 1])) {
            score += 1;
        }
    }

    document.getElementById("scoreText").innerText = `Votre score est de ${score} sur ${totalQuestions}.`;
    document.getElementById("scorePopup").style.display = "flex";

    function sendScoreToServer(score) {
        fetch('../html/sauvegarder_score.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({score: score}), // On envoie juste le score, l'ID de l'élève est géré côté serveur via la session
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Vous pourriez vouloir rediriger l'utilisateur ou afficher un message de succès ici
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    document.getElementById("closePopup").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        sendScoreToServer(score);
        window.location.href = "../html/eleves.php";
    };

    document.querySelector(".close-button").onclick = function() {
        document.getElementById("scorePopup").style.display = "none";
        sendScoreToServer(score); // Si vous voulez également envoyer le score en fermant avec la croix
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
