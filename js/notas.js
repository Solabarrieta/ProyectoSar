const addButton = document.getElementById('add');


$(document).ready(() => {
    $.get('../xml/Notes.xml', (xml) => {
        $(xml)
            .find('NoteUser')
            .each(function viewdata() {
                addNote($(this).text(),$(this).find('text').text());
                console.log($(this).find('Text'));
            });
    });

    addButton.addEventListener("click", () => {
        //console.log('pulsado');
        addNote();
    });
}
);

function addNote(text = " ", title = " ") {

    const note = document.createElement("div");
    note.classList.add("note");

    note.innerHTML = `
        <div class="notes">
        <div class="tools">
        <i class = "categoria">categoria<i/>
        <div class="buttons">
        <button class="edit"><i class="fas fa-edit"></i></button>
        <button class="delete"><i class="fas fa-trash-alt"></i></button>
        </div>
                
            </div>
            <div class="main ${text ? "" : "hidden"}"></div>
            <h1 class=" ${text ? "" : "hidden"}">fjdskljfasdlk</h1>
            <input:text></input>
            <textarea class="${text ? "hidden" : ""}">
            </textarea>
        </div>
    `;
    const main = note.querySelector(".main");
    const textArea = note.querySelector("textarea");

    const editBtn = note.querySelector(".edit");
    const deleteBtn = note.querySelector(".delete");

    textArea.value = text;
    main.innerHTML=text;

    editBtn.addEventListener("click", () => {
        console.log("ha pulsado el botón de editar");
        main.classList.toggle("hidden");
        textArea.classList.toggle("hidden");

    });

    deleteBtn.addEventListener("click", () => {
        console.log("ha pulsado el botón de borrar");
        note.remove();

        //updateLS();
    });

    textArea.value = text;
    main.innerHTML = text;
    document.body.appendChild(note);
}