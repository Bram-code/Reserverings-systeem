let drop = document.getElementById('dropdown');
drop.addEventListener('click', myFunction)

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

window.onscroll = function() {Function()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function Function() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

setInterval(function(){
    window.location.reload(1);
}, 30000);


    let knop = document.getElementsByTagName('p')
    let plek = document.getElementsByClassName('soort')

    for (let i = 0; i < knop.length; i++) {

        let test = knop.item(i);
        let test2 = plek.item(i);

        test.addEventListener("click", function () {
            test2.scrollIntoView({block: 'center', behavior: "smooth"})
        })

    }
