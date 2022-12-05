// Init
const font = document.querySelector("#ctrlFnt");
// const plus = document.querySelector("#ctrlFntPlus");
// const minus = document.querySelector("#ctrlFntMinus");

const bold = document.querySelector("#ctrlBold");
const italic = document.querySelector("#ctrlItalic");
const underline = document.querySelector("#ctrlUnderline");
const strike = document.querySelector("#ctrlStrikethrough");

const left = document.querySelector("#ctrlLeft");
const center = document.querySelector("#ctrlCenter");
const right = document.querySelector("#ctrlRight");
const just = document.querySelector("#ctrlJustify");

const ol = document.querySelector("#ctrlOrderList");
const ul = document.querySelector("#ctrlUnorderList");

const indLeft = document.querySelector("#ctrlIndent");
const indRight = document.querySelector("#ctrlOutdent");

const img = document.querySelector("#ctrlImg");
const vid = document.querySelector("#ctrlVid");

const undo = document.querySelector("#ctrlUndo");
const redo = document.querySelector("#ctrlRedo");
const delPage = document.querySelector("#ctrlDelPage");
//

// Listeners
    // Fonts
font.addEventListener('change', ()=>{
    var fnt = font.value;
    console.log(fnt);
    document.execCommand("fontName", false, fnt);
});
    //

    // Formatting
bold.addEventListener('click', ()=>{
    document.execCommand("bold");
});

italic.addEventListener('click', ()=>{
    document.execCommand("italic");
});

underline.addEventListener('click', ()=>{
    document.execCommand("underline");
});

strike.addEventListener('click', ()=>{
    document.execCommand("strikeThrough");
});
    //

    // Alignment
left.addEventListener('click', ()=>{
    document.execCommand("justifyLeft");
});

center.addEventListener('click', ()=>{
    document.execCommand("justifyCenter");
});

right.addEventListener('click', ()=>{
    document.execCommand("justifyRight");
});

just.addEventListener('click', ()=>{
    document.execCommand("justifyFull");
});
    //

    // Lists
ol.addEventListener('click', ()=>{
    document.execCommand("insertOrderedList");
});

ul.addEventListener('click', ()=>{
    document.execCommand("insertUnorderedList");
});
    //

    // Indentation
indLeft.addEventListener('click', ()=>{
    document.execCommand("indent");
});

indRight.addEventListener('click', ()=>{
    document.execCommand("outdent");
});
    //

    // Media
        // Image
img.addEventListener('click', async ()=>{
    imgFile = document.querySelector("#imgFile");

    let formData = new FormData();

    formData.append("file", imgFile.files[0]);
    var response = await fetch('AJAX/Admin/sendImage.php', {method: "POST", body: formData});
    var dest = await response.text();
    if (dest != "false") {
        console.log(dest);
        // document.execCommand("insertImage", false, dest);
        // var imgWidth = 
        document.execCommand("insertHTML", false, '<img src="'+dest+'" style="width:50vh">');
    }
});
        //

        // Video
vid.addEventListener('click', ()=>{
    // document.execCommand("insertHTML", false, document.querySelector("#ctrlInVid").value);
    var link = "https://www.youtube.com/watch?v=WgTms03-syU";
    link = link.split("watch?v=");
    document.execCommand("insertHTML", false, '<iframe width="560" height="315" src="https://www.youtube.com/embed/'+link[1]+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
});
        //
    //

    // Extra
undo.addEventListener('click', ()=>{
    document.execCommand("undo");
});

redo.addEventListener('click', ()=>{
    document.execCommand("redo");
});

delPage.addEventListener('click', ()=>{
    console.log("Delete");
    // Containers
    var cont_draggables = document.querySelector(".cont_draggables");
    var cont_pages = document.querySelector("#cont_pageContents");
    //

    var targetSlide = document.querySelector(".nav-link.slideBtn.active");
    console.log(targetSlide);
    var targetPage = document.querySelector(targetSlide.getAttribute("data-bs-target"));
    console.log(targetPage);

    // Remove Targets
    cont_draggables.removeChild(targetSlide.parentElement);
    cont_pages.removeChild(targetPage);
    //

    // Assign new active
    if (cont_draggables.firstChild != undefined) {
        var newSlideActive = cont_draggables.firstChild;
        console.log(newSlideActive.firstChild);
        newSlideActive.firstChild.classList.add("active");

        var newPageActive = newSlideActive.firstChild.getAttribute("data-bs-target");
        newPageActive = document.querySelector(newPageActive);
        newPageActive.classList.add("show");
        newPageActive.classList.add("active");
    } else {
        var uniqueID = Date.now();

        var slide = createNewSlide();
        var slideBtn = createSlideButton("page-"+uniqueID, uniqueID);

        var page = createNewPage(uniqueID);

        // Append
        slide.appendChild(slideBtn);

        cont_draggables.appendChild(slide);
        cont_pages.appendChild(page);

        //

        // Set Attributes
        slideBtn.classList.add("active");
        page.classList.add("show");
        page.classList.add("active");
        //
    }

    //

});
    
    //

//

