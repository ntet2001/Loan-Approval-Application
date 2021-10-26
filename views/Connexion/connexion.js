//je recupere mon password et la div de verification
let password= document.getElementById('password');
let verificationmdp=document.getElementById('verificationmdp');

password.addEventListener('input',function (e) {
    if (e.target.value.length==8) {
        verificationmdp.className='alert alert-success';
        verificationmdp.textContent='Password is OK';
    }else{
        verificationmdp.className='alert alert-warning';
        verificationmdp.textContent='08 characters are Required';
    }
},false);