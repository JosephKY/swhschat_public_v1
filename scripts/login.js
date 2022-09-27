let gResponseKey;

async function signup(name, email, passwd) {
    document.getElementById("signupSubmit").disabled = true;
    document.getElementById("signupSubmit").innerHTML = "Loading..."
    document.getElementById("signupError").innerHTML = ""
    await $.ajax({
        url: "/api/createAccount",
        //dataType:"json",
        type: "POST",
        data: { name: name, email: email, passwd: passwd, 'g-recaptcha-response':gResponseKey  },
        complete: xhr => {
            console.log(xhr)
            const res = xhr.responseJSON
            console.log(res)

            document.getElementById("signupSubmit").disabled = false;
            document.getElementById("signupSubmit").innerHTML = "Submit"

            if ("error" in res) {
                grecaptcha.reset();
                let err = res['error']
                document.getElementById("signupError").innerHTML = err
                document.getElementById("signupError").style.opacity = 1
                return
            }
            if ("success" in res) {
                let success = res['success']
                document.getElementById("signupError").innerHTML = success
                document.getElementById("signupError").style.opacity = 1
                document.getElementById("signupError").style.color = "#00CC00"
                return
            }

        }
    });
}

async function login(email, passwd) {
    document.getElementById("loginSubmit").disabled = true;
    document.getElementById("loginSubmit").innerHTML = "Loading..."
    document.getElementById("loginError").innerHTML = ""
    email = document.getElementById("loginEmail").value;
    passwd = document.getElementById("loginPassword").value;
    console.log(email, passwd)
    await $.ajax({
        url: "/api/login",
        //dataType:"json",
        type: "POST",
        data: { 'email': email, 'passwd': passwd, 'g-recaptcha-response':gResponseKey },
        complete: xhr => {
            console.log(xhr)
            const res = xhr.responseJSON
            console.log(res)

            document.getElementById("loginSubmit").disabled = false;
            document.getElementById("loginSubmit").innerHTML = "Submit"

            if ("error" in res) {
                grecaptcha.reset();
                let err = res['error']
                document.getElementById("loginError").innerHTML = err
                document.getElementById("loginError").style.opacity = 1
                return
            }
            if ("success" in res) {
                let success = res['success']
                document.getElementById("loginError").innerHTML = success
                document.getElementById("loginError").style.opacity = 1
                document.getElementById("loginError").style.color = "#00CC00"
                setTimeout(() => { window.location.href = "/" }, 2500)
                return
            }

        }
    });
}

if (me['login'] == true) {
    window.location.href = "/"
}

function onSubmit(key){
    gResponseKey = key
}
