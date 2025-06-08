
document.querySelector('.signup-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  fetch('http://localhost/webProject/backend/rest/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  })
  .then(res => {
    if (!res.ok) return res.json().then(err => { throw new Error(err.error); });
    return res.json();
  })
  .then(data => {
    alert(data.message);
    window.location.href = 'mainPage.html'; 
  })
  .catch(err => {
    document.querySelector('.feedback').textContent = err.message;
  });
});
