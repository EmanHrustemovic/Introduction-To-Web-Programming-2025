const routes = {
    homePage: "mainPage.html",
    login: "login.html",
    registration: "registration.html",
    password: "password.html",
    healthCard: "healthCard.html",
    laboratory: "laboratory.html",
    medicalCheck: "medicalCheck.html",
    profil: "userProfile.html",
    theraphy: "theraphy.html"
  };
  
  function loadPage(page) {
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
                window.history.pushState({ page }, "", `#${page}`);
  
                document.title = document.querySelector("#app h1")?.textContent || "Moje Zdravlje";
            })
            .catch(error => {
                appDiv.innerHTML = `<p>${error.message}</p>`;
            });
    } else {
        appDiv.innerHTML = "<h1>Stranica nije pronađena!</h1>";
    }
  }
  
  window.addEventListener("hashchange", () => {
    const page = window.location.hash.substring(1);
    loadPage(page);
  });
  
  window.addEventListener("popstate", (event) => {
    const page = event.state ? event.state.page : defaultPage;
    loadPage(page);
  });
  
  const defaultPage = "homePage";
  window.addEventListener("load", () => {
    const page = window.location.hash.substring(1) || defaultPage;
  
    if (!window.location.hash) {
        window.location.hash = `#${defaultPage}`;
    }
    loadPage(page);
  });