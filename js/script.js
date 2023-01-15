const pass = document.querySelector('#password');
const confPass = document.querySelector("#confPass");
const showPass = (element) => {
  if (element.type === 'password') {
    element.type = 'text'
  } else {
    element.type = 'password'
  }
}