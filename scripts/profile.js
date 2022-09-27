let params = new URLSearchParams(window.location.search)

let userid = params.get("id")

function profileLoad(){

    if(userid == null){
        document.getElementById("profileName").innerHTML = "Account Unavailable"
        return
    }

    $.ajax({
        url: "/api/userDetails",
        data:{'id':userid},
        dataType: "json",
        async: false,
        type: "GET",
        complete: res => {
            let data = res.responseJSON;
            
            if(data == undefined || 'error' in data || data.length == 0){
                document.getElementById("profileName").innerHTML = "Account Unavailable"
                return
            }

            document.getElementById("profileName").innerHTML = data.displayname
            document.getElementById("profileCreated").innerHTML = (new Date(data.created * 1000)).toLocaleString()
        }
    });
}

profileLoad()