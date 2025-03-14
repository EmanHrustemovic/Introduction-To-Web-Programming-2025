function setReminder() {
  const timeInput = document.getElementById('time').value;
  
  if (!timeInput) {
    document.getElementById('message').textContent = "Molimo unesite vrijeme za terapiju!";
    return;
  }

  const timeParts = timeInput.split(':');
  const reminderTime = new Date();
  reminderTime.setHours(timeParts[0], timeParts[1], 0);

  const currentTime = new Date();
  
  if (reminderTime < currentTime) {
    reminderTime.setDate(reminderTime.getDate() + 1);
  }

  const timeDifference = reminderTime - currentTime;

  setTimeout(() => {
    notifyUser();
    playSound();
    document.getElementById('message').textContent = `Podsjetnik postavljen za: ${reminderTime.toLocaleTimeString()}`;
  }, timeDifference);
  
  document.getElementById('message').textContent = `Podsjetnik postavljen za: ${reminderTime.toLocaleTimeString()}`;
}

function notifyUser() {
  if (Notification.permission === "granted") {
    new Notification("Vrijeme za terapiju!", {
      body: "Podsjetnik: Popij terapiju sada!",
    });
  } else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(permission => {
      if (permission === "granted") {
        new Notification("Vrijeme za terapiju!", {
          body: "Podsjetnik: Popij terapiju sada!",
        });
      }
    });
  }
}

function playSound() {
  const audio = new Audio('alarm.mp3');
  audio.play();
}