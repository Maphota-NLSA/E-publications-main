const form = document.getElementById('form')
const full_name_input = document.getElementById('full-name-input')
const email_input = document.getElementById('input-email')
const password_input = document.getElementById('password-input')
const contact_input = document.getElementById('input-contact')
const confirm_password_input = document.getElementById('confirm-password-input')
const error_message = document.getElementById('error-text')

form.addEventListener('submit', (e) => {
    let errors = []
    
    if(full_name_input){
        errors = getSignUpFormErrors(full_name_input.value, email_input.value, contact_input.value, password_input.value, confirm_password_input.value)
    }
    else{
        ///This is where the login validations would be
    }
    if (errors.length > 0) {
        e.preventDefault()   
        error_message.innerText = errors.join(". ")
    }
})

function getSignUpFormErrors(fullname, email_address, contact, password, confirm_password){
    let errors = []

    if (fullname === '' || fullname == null) {
        errors.push('Full name is required')
        full_name_input.parentElement.classList.add('incorrect')
    }
    if (email_address === '' || email_address == null) {
        errors.push('Email is required')
        email_input.parentElement.classList.add('incorrect')
    }
    if (contact === '' || contact == null) {
        errors.push('Contact number is required')
        contact_input.parentElement.classList.add('incorrect')
    }
    if (password === '' || password == null) {
        errors.push('Password is required')
        password_input.parentElement.classList.add('incorrect')
    }
    if (confirm_password === '' || confirm_password == null) {
        errors.push('Confirm password field is required')
        confirm_password_input.parentElement.classList.add('incorrect')
    }
    if (password.length < 8) {
        errors.push('Password must have at least 8 characters')
        password_input.parentElement.classList.add('incorrect')    
    }
    if (password !== confirm_password) {
        errors.push('Passwords does not match')
        password_input.parentElement.classList.add('incorrect')
        confirm_password_input.parentElement.classList.add('incorrect')
    }

return errors;
}
const allInputs = [full_name_input, email_input, contact_input, password_input, confirm_password_input]
allInputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.parentElement.classList.contains('incorrect')) {
            input.parentElement.classList.remove('incorrect')            
            error_message.innerText = ''
        }
    })
})

