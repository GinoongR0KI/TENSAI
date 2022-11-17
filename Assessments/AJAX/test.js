function something() {
    // var test = document.querySelector(document.querySelector(".slideBtn").getAttribute("data-bs-target")).childNodes[2].childNodes[0].firstChild.childNodes[0].childNodes[1].value;
    // var test = document.querySelector(document.querySelectorAll(".slideBtn")[0].getAttribute("data-bs-target")).childNodes[0].firstChild.childNodes[1].value;
    // var test = document.querySelector(document.querySelectorAll(".slideBtn")[0].getAttribute("data-bs-target")).childNodes[2].firstChild.firstChild.childNodes;
    // for (i = 0; i < test.length; i++) {
    //     console.log(test[i].childNodes[0].checked);
    //     if (test[i].childNodes[0].checked) {console.log(test[i].childNodes[1].value)}
    // }
    var test = document.querySelector(document.querySelectorAll(".slideBtn")[0].getAttribute("data-bs-target")).childNodes[1].firstChild.innerHTML;
    console.log(test);
}