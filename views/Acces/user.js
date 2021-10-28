/**
 * ici je recuperer les champs password et confirm password
 */
let password=document.getElementById('password');
let confirmation=document.getElementById('confirmPassword');
let verification=document.getElementById('verification');

/**
 * function qui permet de faire la verification de mes champs
 */
function verificationmdp() {
    if(password.value==confirmation.value){
        verification.style.color='green';
        verification.textContent='password is Confirmed';
    }else{
        verification.style.color='red';
        verification.textContent='Enter the same Password';
    }
}
confirmation.addEventListener('input',verificationmdp,false);