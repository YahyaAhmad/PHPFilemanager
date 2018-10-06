var timeOut;

function login() {

    if($('#username').val ==''|| $('#password').val()==''){
        $('#result').html('Please enter your username or password');
        return;
    }
    var loginInfo = {

        username: $('#username').val(),
        password: $('#password').val()

    };

    $.post('php/login.php', loginInfo, (res) => {

        $('.loader').addClass('show');

        setTimeout(() => {
            $('.loader').removeClass('show');
            if (res.status == "success"){
                $('#result').removeClass('text-danger').addClass('text-success').html('Logged in succesfully.');
                timeOut = setTimeout(()=>{ window.location.href = "user"; },1000);
            }
            else if (res.status == "failed")
                $('#result').html('Username of password is incorrect.');
                

        }, 500);



    });

}