function togglePassword(inputId) {
    var passwordInput = document.getElementById(inputId);
    var passwordIcon = document.getElementById(inputId + "-icon");
  
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordIcon.classList.remove("fa-eye-slash");
      passwordIcon.classList.add("fa-eye");
    } else {
      passwordInput.type = "password";
      passwordIcon.classList.remove("fa-eye");
      passwordIcon.classList.add("fa-eye-slash");
    }
  }
  document.querySelector("form").addEventListener("submit", function (event) {
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");
    var emailFeedback = emailInput.nextElementSibling;
    var passwordFeedback = passwordInput.nextElementSibling;
  
    if (!emailInput.value) {
      emailInput.classList.add("invalid-border");
      emailFeedback.classList.remove("d-none");
      event.preventDefault();
    } else {
      emailInput.classList.remove("invalid-border");
      emailFeedback.classList.add("d-none");
    }
  
    if (!passwordInput.value) {
      passwordInput.classList.add("invalid-border");
      passwordFeedback.classList.remove("d-none");
      event.preventDefault();
    } else {
      passwordInput.classList.remove("invalid-border");
      passwordFeedback.classList.add("d-none");
    }
  });
  