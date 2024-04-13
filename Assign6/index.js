const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// Website code

function validateregForm() {
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email1').value;
    const address = document.querySelector('#address').value;
    const contact = document.querySelector('#contact').value;
    const password = document.querySelector('#pass1').value;
    const confirm = document.querySelector('#confpass').value;

    const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if(!name || !email || !address || !contact || !password || !confirm) {
        alert('All fields are required.');
        return false;
    }
    if(contact.length !== 10) {
        alert('Contact number must be 10 digits.');
        return false;
    }
    if(!regexPassword.test(password)) {
        alert('Password must have at least one uppercase character, one lowercase character, one number, and one special character.');
        return false;
    }
    if(password !== confirm) {
        alert('Password and Confirm Password do not match.');
        return false;
    }

    return true;
}

function validatelogForm() {
    const email = document.querySelector('#email2').value;
    const password = document.querySelector('#pass2').value;

    const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if(!email || !password) {
        alert('All fields are required.');
        return false;
    }

    return true;
}

function Register() {
    if (validateregForm()) {
		console.log("Register");
        document.querySelector('.form1').submit();
    }
}

function Login() {
    if (validatelogForm()) {
		console.log("Login");
        document.querySelector('.form2').submit();
    }
}


window.onload = function() {
  const urlParams = new URLSearchParams(window.location.search);
  const section = urlParams.get('section');
  const error = urlParams.get('error');

  if (section === 'login') {
      showDownside();
      if (error) {
          alert('Error: Incorrect Email or Password');
      }
  } else if (section === 'signup') {
      showUpside();
  }
}
