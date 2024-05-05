const mdp1 = document.querySelector('.mdp1');
const mdp2 = document.querySelector('.mdp2');

mdp2.onkeyup = () => {
    message_error = document.querySelector('.message_error');

    if(mdp1.value != mdp2.value) {
        message_error.innerText = "Le mot de passe est incorrect"
    } else {
        message_error.innerText = ""
    }
}

