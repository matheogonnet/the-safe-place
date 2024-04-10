
//fonction pour afficher les quizz
function showQuiz(quizNumber) {
    // Masquer tous les quizz
    document.querySelectorAll('.quiz-content').forEach(function(quiz) {
        quiz.style.display = 'none';
    });

    // Afficher le quizz sélectionné
    document.getElementById('quiz' + quizNumber).style.display = 'block';
}

// Fonction pour vérifier les réponses du quiz
function checkQuiz(quizNumber) {
    let score = 0;
    // Sélectionner toutes les questions du quiz actuel
    const quizForm = document.querySelector(`#quiz${quizNumber}-form`);
    const questions = quizForm.querySelectorAll('.quiz-question');

    questions.forEach((question, index) => {
        // L'identifiant de la question est extrait depuis le nom des inputs radio
        const questionId = question.querySelector('input[type="radio"]').name;
        const selectedOption = question.querySelector('input[type="radio"]:checked');

        if (selectedOption && selectedOption.value === String(correctOptions[questionId])) {
            score += 1;
        }
    });

    const totalQuestions = questions.length;
    const results = document.getElementById(`quiz${quizNumber}-results`);
    results.textContent = `Vous avez ${score} sur ${totalQuestions} bonnes réponses.`;
    results.style.display = 'block'; // Afficher les résultats

    // Ajouter la logique de coloration des résultats
    if (score < 3) {
        // Si le score est inférieur à 3, mettre le texte en rouge
        results.style.color = 'red';
    } else if (score === 4) {
        // Si le score est de 4/4, mettre le texte en vert
        results.style.color = 'lightgreen';
    } else {
        // Pour les autres scores (3 sur 4 par exemple), tu peux choisir une couleur neutre ou laisser la couleur par défaut
        results.style.color = 'orange';
    }
}



// Listenner pour le bouton le defilement des vidéos
document.addEventListener('keydown', function(e) {
    const videos = document.querySelectorAll('.video-container');
    if (e.key === " " || e.key === "ArrowDown") {
        e.preventDefault();
        // Trouver la prochaine vidéo vers le bas
        for (let i = 0; i < videos.length; i++) {
            const video = videos[i];
            if (video.getBoundingClientRect().top > 50) { // Un peu plus de marge pour garantir la sélection
                video.scrollIntoView({ behavior: 'smooth', block: 'center' });
                break;
            }
        }
    } else if (e.key === "ArrowUp") {
        e.preventDefault();
        // Trouver la prochaine vidéo vers le haut
        for (let i = videos.length - 1; i >= 0; i--) {
            const video = videos[i];
            if (video.getBoundingClientRect().bottom < 0) { // Utiliser bottom pour vérifier si au-dessus de la vue
                video.scrollIntoView({ behavior: 'smooth', block: 'center' });
                break;
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.currentTime = 0; // Réinitialise la vidéo au début
                entry.target.play();
            } else {
                entry.target.pause();
            }
        });
    }, {
        root: null, // par défaut, le viewport
        rootMargin: '0px',
        threshold: 0.5 // déclenche lorsque 50% de l'élément est visible
    });

    document.querySelectorAll('video').forEach(video => {
        observer.observe(video);
    });
});


document.getElementById("openEvaluationForm").addEventListener("click", function() {
    window.location.href = "../html/evaluation.php"; // Assurez-vous que le chemin est correct
});





