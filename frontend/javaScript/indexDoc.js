const routes = {
    homePage: "mainForDoc.html",
    login: "doctorLogin.html",
    password: "password.html",
    healthCard: "cardForDoc.html",
    laboratory: "resultsForDoc.html",
    medicalCheck: "Check-UpsAtTheDoc.html",
    theraphy: "theraphyForDoc.html"
  };
  
  function loadPage(page, pushToHistory = true) {
    const appDiv = document.getElementById("app");
    const url = routes[page];
  
    if (url) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Greška prilikom učitavanja stranice!");
                }
                return response.text();
            })
            .then(html => {
                appDiv.innerHTML = html;
                if (pushToHistory) {
                    history.pushState({ page: page }, "", `#${page}`);
                }
            })
            .catch(error => {
                appDiv.innerHTML = `<p>${error.message}</p>`;
            });
    } else {
        appDiv.innerHTML = "<h1>Stranica nije pronađena!</h1>";
    }
  }
  
  window.addEventListener("popstate", (event) => {
    if (event.state && event.state.page) {
        loadPage(event.state.page, false);
    }
  });
  
  window.addEventListener("load", () => {
    const page = window.location.hash.substring(1) || "homePage";
    loadPage(page);
  });
  
  document.querySelectorAll("nav a").forEach(link => {
    link.addEventListener("click", (event) => {
        event.preventDefault();
        const page = event.target.getAttribute("href").substring(1);
        loadPage(page);
    });
  });
  