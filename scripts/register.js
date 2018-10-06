var validRegister = false;
var timeout;

function register(){
    validRegister = true;
    checkPassword();
    checkUsername();
    checkEmail();

    if(validRegister)
    {
        registerPost();
    }

}

function checkUsername(){

    if($('#username').val().length < 3)
    {
        validRegister = false;
        $('#username').addClass('is-invalid').removeClass('is-valid');
        $('#usernameLabel').removeClass('text-success');
        $('#usernameLabel').addClass('text-danger');
        $('#usernameError').html('Username should have 3 letters or more.').css('opacity', 1);
        return;
    }
    else
    {
        
        $('#username').addClass('is-valid').removeClass('is-invalid');
        $('#usernameLabel').removeClass('text-danger');
        $('#usernameLabel').addClass('text-success');
        $('#usernameError').css('opacity', 0);
    }

    var str = $('#username').val();
    var patt = new RegExp(/[^\w\s]/gi);
    if(patt.test(str)){
        validRegister = false;
        $('#username').addClass('is-invalid').removeClass('is-valid');
        $('#usernameLabel').removeClass('text-success');
        $('#usernameLabel').addClass('text-danger');
        $('#usernameError').html('Special characters are not allowed.').css('opacity', 1);
        return;
    }


}

function checkPassword(){
    
    if($('#password').val().length < 5)
    {
        $('#password').addClass('is-invalid').removeClass('is-valid');
        $('#passwordLabel').removeClass('text-success').addClass('text-danger');
        $('#passwordError').html('Password should have 5 letters or more.').css('opacity', 1);
        validRegister = false;
        return;
    }
    else if($('#password').val()!=$('#repassword').val())
    {
        $('#passwordError').css('opacity', 0);
        $('#password').addClass('is-invalid').removeClass('is-valid');
        $('#repassword').addClass('is-invalid').removeClass('is-valid');
        $('#passwordLabel').removeClass('text-success').addClass('text-danger');
        $('#repasswordLabel').removeClass('text-success').addClass('text-danger');
        $('#repasswordError').html('Retype your password properly.').css('opacity', 1);
        validRegister = false;
        return;
    }
    else
    {
        $('#password').addClass('is-valid').removeClass('is-invalid');
        $('#repassword').addClass('is-valid').removeClass('is-invalid');
        $('#passwordLabel').removeClass('text-danger').addClass('text-success');
        $('#repasswordLabel').removeClass('text-danger').addClass('text-success');
        $('#passwordError').css('opacity', 0);
        $('#repasswordError').css('opacity', 0);

    }

}

function checkEmail(){

    var str = $('#email').val();
    var patt = new RegExp(/^(([^<>!\-()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})|[\w\s])$/);
    if(!patt.test(str)){
        validRegister = false;
        $('#email').addClass('is-invalid').removeClass('is-valid');
        $('#emailLabel').removeClass('text-success').addClass('text-danger');
        $('#emailError').html('Email is not valid.').css('opacity', 1);
        return;
    }
    else{
        $('#email').addClass('is-valid').removeClass('is-invalid');
        $('#emailLabel').removeClass('text-danger').addClass('text-success');
        $('#emailError').css('opacity', 0);
    }
    
}

function registerPost(){

    var registerInfo = {
        
        username: $('#username').val(),
        password: $('#password').val(),
        email: $('#email').val()

    };

    $('.loader').addClass('show');

    timeout = setTimeout(()=>{

        $.post("php/register.php", registerInfo, (res)=>{
            var data = JSON.parse(res);
            $('#result').html(data.message);
            if(data.status=='success'){
                $('#result').addClass('text-success').removeClass('text-danger');
                timeout = setTimeout(()=>{ window.location.href = "index.php" },1000);
            }
            else{
                $('#result').removeClass('text-success').addClass('text-danger');
                $('#username').addClass('is-invalid').removeClass('is-valid');
                $('#usernameLabel').removeClass('text-success').addClass('text-danger');
            }
              
            $('.loader').removeClass('show');
            $('#result').removeClass('hidden');
        });

    },500);
    

}