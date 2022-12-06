function getDraggables() {
    const draggables = document.querySelectorAll(".draggable");

    const containers = document.querySelectorAll(".cont_draggables");

    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', ()=>{
            draggable.classList.add("dragging");
        });

        draggable.addEventListener('dragend', ()=>{
            draggable.classList.remove("dragging");
            displayArrange();
        });
    });

    containers.forEach(container => {
        container.addEventListener('dragover', e=>{
            e.preventDefault();
            const afterElement = getDragAfterElement(container, e.clientY);

            const draggable = document.querySelector('.dragging');

            if (afterElement == null) {
                container.appendChild(draggable);
            } else {
                container.insertBefore(draggable, afterElement);
            }

        });
    });

    displayArrange();
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;

        if (offset < 0 && offset > closest.offset) {
            return {offset: offset, element: child};
        } else {
            return closest;
        }

    }, {offset: Number.NEGATIVE_INFINITY}).element;
}

function displayArrange() {
    const draggables = document.querySelectorAll(".draggable");
    
    for (i = 0; i < draggables.length; i ++) {
        draggables[i].firstChild.firstChild.innerText = " Page No. " + (i + 1);
    }
}