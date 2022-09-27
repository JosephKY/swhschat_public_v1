

async function headerButton(content, func, icon = undefined, id = undefined) {
    let header = document.getElementById("header")
    if (header == undefined) return

    let button = document.createElement("button")
    let buttonContent = document.createElement("span")
    buttonContent.innerHTML = content
    buttonContent.classList.add("headerButtonContent")
    button.onclick = func
    button.append(buttonContent)
    button.classList.add("headerButton")

    if (icon != undefined) {
        let iconE = document.createElement("img")
        iconE.src = icon
        iconE.classList.add("headerButtonIcon")
        button.prepend(iconE)
    }

    header.append(button)
    return button
}

let me;

$.ajax({
    url: "/api/me",
    dataType: "json",
    async: false,
    type: "GET",
    complete: res => {
        me = res.responseJSON;
        console.log(me)
    }
});

const header = document.getElementById("header")

if (header) {
    headerButton("Home", () => { window.location.href = "/" }, "/assets/icons/house.png")
}

if (!me.login) {
    headerButton("Log In", () => { window.location.href = "/login" }, "/assets/icons/user.png")
    headerButton("Sign Up", () => { window.location.href = "/signup" }, "assets/icons/vcard_add.png")
} else {
    headerButton("Profile", () => { window.location.href = "/profile?id=" + me.id }, "/assets/icons/user_green.png")
    //headerButton("Settings", () => { window.location.href = "/settings" }, "/assets/icons/cog.png")
    headerButton("Sign Out", () => { window.location.href = "/api/signout" }, "/assets/icons/door_out.png")
    welcomeName = me.displayname
}




