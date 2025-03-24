let progress = 0;
const progressBar = document.querySelector('.progress-bar');
const heartFace = document.querySelector('.face');
const heartSound = document.getElementById('heartbeat-sound');
const fallingText = document.getElementById('falling-text');
const text = "Moje Zdravlje".split("");

fallingText.innerHTML = text.map(letter => `<span class="falling-letter">${letter}</span>`).join("");
const letters = document.querySelectorAll('.falling-letter');

function playSound() {
    heartSound.play().catch(error => console.log("Auto-play blocked, user interaction needed."));
}

function updateProgress() {
    if (progress === 0) { 
        playSound();
    }

    if (progress <= 100) {
        progressBar.style.width = progress + '%';
        progressBar.textContent = progress + '%';
        
        if (progress < 30) {
            heartFace.textContent = "😟";
        } else if (progress < 60) {
            heartFace.textContent = "🙂";
        } else {
            heartFace.textContent = "😃";
        }

        let index = Math.floor((progress / 100) * text.length);
        if (index < text.length) {
            letters[index].style.opacity = "1";
            letters[index].style.transform = "translateY(0)";
        }

        if (progress < 50) {
            fallingText.style.color = "red"; 
        } else {
            fallingText.style.color = "green";
        }

        progress += 2;
        setTimeout(updateProgress, 200);
    } else {
        window.location.href = "registrate.html";
    }
}

updateProgress();