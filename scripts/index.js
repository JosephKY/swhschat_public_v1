let welcomeName = "<a href='/signup'>create an account</a>"
if(me.login){
    welcomeName = me.displayname
}
document.getElementById("homeWelcome").innerHTML = "Hello, " + welcomeName

$.ajax({
    url: "/api/recentSignups",
    data:{amount:10},
    dataType: "json",
    async: false,
    type: "GET",
    complete: res => {
        let usrs = res.responseJSON;
        let container = document.getElementById("recentSignupsUsers")
        
        usrs.forEach(usr => {
            let usrElement = document.createElement("div")
            usrElement.classList.add("recentUserContainer")

            let usrElementPicture = document.createElement("img")
            usrElementPicture.src = "/assets/usrgen/pfpplaceholder.png"
            usrElementPicture.classList.add("recentUserPicture")
            usrElement.appendChild(usrElementPicture)

            let usrElementDetails = document.createElement("div")
            usrElementDetails.classList.add("recentUserDetails")
            usrElement.appendChild(usrElementDetails)

            let usrElementName = document.createElement("a")
            usrElementName.href = "/profile?id=" + usr.id
            usrElementName.classList.add("recentUserName")
            usrElementName.innerHTML = usr.displayname 
            usrElementDetails.appendChild(usrElementName)

            let usrElementTime = document.createElement("p")
            usrElementTime.classList.add("recentUserTime")
            usrElementTime.innerHTML = (new Date(usr.created * 1000)).toLocaleString()
            usrElementDetails.appendChild(usrElementTime)
            
            container.appendChild(usrElement)
        });
    }
});