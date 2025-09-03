function clearCookiesAndStorage() {
  // Borrar cookies
  document.cookie.split(";").forEach(function(c) { 
    document.cookie = c
      .replace(/^ +/, "")
      .replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); 
  });

  // Borrar localStorage y sessionStorage
  localStorage.clear();
  sessionStorage.clear();

  console.log("Cookies y almacenamiento local eliminados");
}

// Ejecutar al entrar a la página
window.onload = function() {
  clearCookiesAndStorage();
};

// También podrías hacerlo cuando presionas el botón de Google:
document.addEventListener("DOMContentLoaded", () => {
  const googleBtn = document.querySelector(".g_id_signin");
  if (googleBtn) {
    googleBtn.addEventListener("click", () => {
      clearCookiesAndStorage();
    });
  }
});