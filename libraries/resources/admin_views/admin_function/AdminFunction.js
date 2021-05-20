const create_user = async data => {
    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let resData = JSON.parse(response);
    if(resData.status === 200) {
        return alert('Insert Success!'), 
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/create_user.php', 1000);
    }
    else if(resData.status === 201) {
        return alert('Username is already exists!');
    }
    else {
        alert('SERVER ERROR!');
    }
}

const validateInsert = data => {
    if(!data.firstname || !data.lastname || !data.username || !data.password || !cpass.value) {
        alert('Fields are required!');
    }
    else {
        if(data.password !== cpass.value) {
            password.style.borderColor = 'red';
            cpass.style.borderColor = 'red';
            alert('Password mismatch');
        }
        else {
            create_user(data);
        }
    }
}

$('#btnSubmit').on('click', () => {
    const data = {
        firstname: firstname.value,
        lastname: lastname.value,
        username: username.value,
        password: password.value,
        insert_method: true
    }

    // console.log('dads');
    validateInsert(data);
});

const modify = async id => {
    const data = {
        id,
        getId_method: true
    }

    const response = await $.get(state.app + state.helper + 'AdminHelper.php', data);
    let user = JSON.parse(response);

    state.id = user.id;

    document.getElementById('firstname_update').value = user.firstname;
    document.getElementById('lastname_update').value = user.lastname;
    document.getElementById('username_update').value = user.username;
}

const update_user = async data => {
    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        return alert('User Updated!'),
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/data_table.php', 1000);
    }
}

const validateUpdate = data => {
    if(!data.firstname || !data.lastname || !data.username) {
        alert('Fields are required!');
    }
    else {
        if(data.password !== cpass_update.value) {
            alert('Password mismatch!');
            password.style.borderColor = 'red';
            cpass.style.borderColor = 'red';
        }
        else {
            update_user(data);
        }
    }
}

$('#btnUpdate').on('click', () => {
    const data = {
        id: state.id,
        firstname: firstname_update.value,
        lastname: lastname_update.value,
        username: username_update.value,
        password: password_update.value,
        update_method: true
    }

    validateUpdate(data);
});

const askDelete = id => {
    let ask = confirm('Are you sure you want to delete this account ?');
    if(ask === true) {
        delete_user(id);
    }
    else {
        alert('No Action');
    }
}

const delete_user = async id => {
    const data = {
        id, 
        deleteId_method: true
    }

    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        alert("User's Deleted!");
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/data_table.php', 1000);
    }
}

const toActivate = async id => {
    const data = {
        id,
        activate_method: true
    }

    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        alert("User's Activated!");
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/data_table.php', 1000);
    }
}

const toDeactivate = async id => {
    const data = {
        id,
        deactivate_method: true
    }

    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let resDestroy = JSON.parse(response);
    if(resDestroy.status === 200) {
        alert("User's Deactivated!");
        setTimeout(() => window.location.href = 'http://localhost/usermanagement_final_req/admincontent/data_table.php', 1000);
    }
}