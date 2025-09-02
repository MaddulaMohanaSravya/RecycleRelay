 document.addEventListener("DOMContentLoaded", function () {
    const signInBox = document.querySelector(".auth-box.signin");
    const signUpBox = document.querySelector(".auth-box.signup");
    const signInBtn = document.getElementById("show-signin");
    const signUpBtn = document.getElementById("show-signup");
  
    // Default to Sign In
    showSignIn();
  
    signInBtn.addEventListener("click", showSignIn);
    signUpBtn.addEventListener("click", showSignUp);
  
    function showSignIn() {
      signInBox.style.display = "block";
      signUpBox.style.display = "none";
      signInBtn.classList.add("active");
      signUpBtn.classList.remove("active");
    }
  
    function showSignUp() {
      signInBox.style.display = "none";
      signUpBox.style.display = "block";
      signUpBtn.classList.add("active");
      signInBtn.classList.remove("active");
    }
  });
 