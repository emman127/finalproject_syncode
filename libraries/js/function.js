const register_user = async data => {
    const response = await $.post(state.app + state.helper + 'UserHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        alert('User Insert!');
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/dashboard.php', 1000);
    }
    else if(resDestroy.status === 201) {
        alert('User Insert!');
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/', 1000);
    }
    else if(resDestroy.status === 403){
        alert('User already exists!');
    }
}

const registerValidation = data => {
    if(!data.firstname || !data.lastname || !data.username || !data.password || !cpass.value) {
        alert('Fields are required!');
    }
    else {
        if(data.password !== cpass.value) alert('Password mismatch!');
        else register_user(data);
    }
}

$('#btnSubmit').on('click', () => {
    const data = {
        firstname: firstname.value,
        lastname: lastname.value,
        username: username.value,
        password: password.value,
        register_method: true
    }

    registerValidation(data);
});

const login_user = async data => {
    const response = await $.post(state.app + state.helper + 'UserHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        alert('Login Success!');
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/dashboard.php', 1000);
    }
    else if(resDestroy.status === 'user') {
        alert('Login Success!');
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/normalusercontent/user_dashboard.php', 1000);
    }
    else if(resDestroy.status === 404){
        alert('Invalid username and password!');
    }
    else if(resDestroy.status === 201) {
        alert('Disabled account!');
    }
}

const loginValidataion = data => {
    !data.username || !data.password ? alert('Fields are required!') : login_user(data);
}

$('#btnLogin').on('click', () => {
    const data = {
        username: username_login.value,
        password: password_login.value,
        login_method: true
    }

    loginValidataion(data);
});