var transparentBlack = "rgba(0,0,0,0.5)";

const canvas = new fabric.Canvas("cont_canvas", {
    width: window.innerWidth,
    height: 500,
    backgroundColor: fabric.Color.fromRgba(transparentBlack)
});

canvas.renderAll();

var savedJSON;

var undo = document.querySelector("#ctrlUndo");
var redo = document.querySelector("#ctrlRedo");
var imgBtn = document.querySelector("#ctrlUpload");
var delBtn = document.querySelector("#ctrlDel");
var saveBtn = document.querySelector("#ctrlSave");
var loadBtn = document.querySelector("#ctrlLoad");

undo.addEventListener("click", function() {
    console.log("Undo");
    canvas.undo();
});

redo.addEventListener("click", function () {
    console.log("Redo");
    canvas.redo();
});

imgBtn.addEventListener("click", function() {
    console.log("upload");
    fabric.Image.fromURL("images/test.jpeg", function (img) {
        img.set({left:0, top:0});
        canvas.add(img);
    });
});

delBtn.addEventListener("click", function() {
    console.log("delete");
    canvas.remove(canvas.getActiveObject());
});

saveBtn.addEventListener("click", function(){
    console.log("save");
    savedJSON = canvas.toJSON();
    alert(JSON.stringify(savedJSON));
});

loadBtn.addEventListener("click", function() {
    console.log("load");
    try {
        canvas.loadFromJSON(savedJSON, function() {
            canvas.renderAll();
        });
    } catch (e) {
        alert("Invalid JSON file");
    }
});

// canvas.toDataURL('image/png'); // This line is supposed to save the canvas as an image. This image needs to be uploaded to the server in a specific filename and
// overwrites the file whenever there are changes. filename should be "lessonName+pageNumber"