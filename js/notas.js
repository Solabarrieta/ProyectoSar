const addButton = document.getElementById('add');


$(document).ready(() => {
    $.get('../xml/Notes.xml', (xml) => {
        $(xml)
            .find('NoteUser')
            .each(function viewdata() {
                addNote($(this).text());
                console.log($(this));
            });
    });

    addButton.addEventListener("click", () => {
        //console.log('pulsado');
        addNote();
    });
}
);

function addNote(text= " ") {
    const note = document.createElement("div");
    note.classList.add("note");

    note.innerHTML = `
        <div class="notes">
            <div class="tools">
                <button class="edit"><i class="fas fa-edit"></i></button>
                <button class="delete"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="main ${text ? "" : "hidden"}"></div>
            <textarea class="${text ? "hidden" : ""}"></textarea>
        </div>
    `;
    const main = note.querySelector(".main");
    const textArea = note.querySelector("textarea");

    textArea.value = text;
    main.innerHTML = text;
    document.body.appendChild(note);
}