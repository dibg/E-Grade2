function submitForm(username, password){
    document.getElementById('username').value = username;
    document.getElementById('password').value = password;
    document.forms[0].submit();
}
function loginAs(username) {
    submitForm(username, username);
}