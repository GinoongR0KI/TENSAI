// Card Group
function createCardGroup() {
    var div = document.createElement("div");

    // Attributes
    div.setAttribute("class", "card-group");
    
    // Return
    return div;
}

// Cards
function createCard(cardID, imgSrc, title, desc, url, btnText, openNew) {
    var card = assemCard(cardID);
    var thumb = assemCardThumbnail(imgSrc);
    var body = assemCardBody();

    var elTitle = assemCardTitle(title);
    var elDesc = assemCardDescription(desc);
    var elBtn = assemCardButton(url, btnText, openNew);

    // Appending
    body.appendChild(elTitle);
    body.appendChild(elDesc);
    body.appendChild(elBtn);

    card.appendChild(thumb);
    card.appendChild(body);

    // Return
    return card;
}

function assemCard(cardID) {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class", "card border-palette3 bg-transparent");
    div.setAttribute("id", cardID);
    div.setAttribute("style", "width:15rem;");
    //

    return div;
}

function assemCardThumbnail(imgSrc) {
    var img = document.createElement("img");

    // Attribute
    img.setAttribute("src",imgSrc);
    img.setAttribute("alt","Card Thumbnail");
    img.setAttribute("class","card-img-top");
    //

    return img;
}

function assemCardBody() {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class","card-body");
    //

    return div;
}

function assemCardTitle(title) {
    var el = document.createElement("h5");

    // Attribute
    el.setAttribute("class", "card-title");
    el.innerText = title;
    //

    return el;

}

function assemCardDescription(text) {
    var el = document.createElement("p");

    // Attribute
    el.setAttribute("class", "card-text");
    el.innerText = text;
    //

    return el;
}

function assemCardButton(url, text, openNew) {
    var btn = document.createElement("a");

    // Attribute
    btn.setAttribute("href",url);
    btn.setAttribute("class","btn btn-palette3");
    if (openNew) {
        btn.setAttribute("target", "_blank");
    }
    btn.innerText = text;
    //

    return btn;
}

// GETTERS
function getCardElements(cardID) {
    var card = document.querySelector(cardID);
    console.log(card);

    var elements = new Array();

    var thumbnail = card.firstChild;
    var body = card.childNodes[1];
    var title = body.firstChild;
    var desc = body.childNodes[1];
    var btn = body.childNodes[2];

    // Push
    elements.push(card);
    elements.push(thumbnail);
    elements.push(body);
    elements.push(title);
    elements.push(desc);
    elements.push(btn);


    return elements;
}