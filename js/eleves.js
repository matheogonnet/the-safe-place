
// Fonction pour vérifier les réponses du quiz
function checkQuiz() {
    const answers = { q1: '1', q2: '1', q3: '1', q4: '1', q5: '1' }; // Les bonnes réponses sont marquées par '1'
    let score = 0;
    const totalQuestions = Object.keys(answers).length;

    Object.keys(answers).forEach(question => {
        const selectedOption = document.querySelector(`input[name="${question}"]:checked`);
        if (selectedOption && selectedOption.value === answers[question]) {
            score += 1;
        }
    });

    const results = document.getElementById('quiz-results');
    results.textContent = `Vous avez ${score} sur ${totalQuestions} bonnes réponses.`;
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



