const addButton = document.getElementById("add");

$(document).ready(() => {
    $.get("../xml/Notes.xml", (xml) => {
        $(xml)
            .find("NoteUser")
            .each(function viewdata() {
                addNote(
                    $(this).find("Text").text(),
                    $(this).find("Text").attr("title"),
                    $(this).find("Text").attr("categoria"),
                    $(this).attr("id")
                );
            });
    });

    addButton.addEventListener("click", () => {
        //console.log('pulsado');
        addNote();
    });
});

function addNote(text = " ", title = " ", categoria = "", id) {
    const notas = document.getElementById("notas");
    const note = document.createElement("div");
    note.classList.add("note");

    note.innerHTML = `
        <div class="notes">
            <div class="tools">
                <input type= "text" placeholder="Titulo" value="${title ? title : "Titulo"}" class="input-titulo"> 
                <div class="div__buttons">

                    <input type="text" placeholder="Categoria" value="${categoria ? categoria : "categoria"}"class="categoria">
                    <p class = "categoria>
                    <div class="buttons">
                        <button class="edit"><i class="fas fa-edit"></i></button>
                        <button class="delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="main ${text ? "" : "hidden"
        }"><h1>fjdskljfasdlk</h1></div>
            
            <input:text></input>
            <textarea class="${text ? "hidden" : ""}">

            </textarea>
            <div class= "confirm__button">
            <button class="update"><i class="fas fa-pen-alt"></i></button>
            </div>
        </div>
    `;
    const main = note.querySelector(".main");
    const textArea = note.querySelector("textarea");
    const htmltitle = note.querySelector(".input-titulo");
    const htmlcategoria = note.querySelector(".categoria");

    const editBtn = note.querySelector(".edit");
    const deleteBtn = note.querySelector(".delete");
    const updateBtn= note.querySelector(".update");

    textArea.value = text;
    main.innerHTML = text;

    editBtn.addEventListener("click", () => {
        main.classList.toggle("hidden");
        textArea.classList.toggle("hidden");
    });

    deleteBtn.addEventListener("click", () => {
        console.log("ha pulsado el botón de borrar");
        note.remove();
        updateLS();
        //updateLS();
    });
    textArea.addEventListener("input", (e) => {
        const { value  } = e.target;
        main.innerHTML=value;
        updateLS();
    });


    updateBtn.addEventListener("click",()=>{
        updateXML(textArea.value,htmltitle.value,htmlcategoria.value,id);
    });



    textArea.value = text;
    main.innerHTML = text;
    notas.appendChild(note);
    
}
function updateLS() {
    const notesText = document.querySelectorAll("textarea");
    
    const notes = [];

    notesText.forEach((note) => {
        notes.push(note.value);
    });
    
}
function updateXML(text, title, categoria, id) {
    $.ajax({
        type: "POST",
        url: '../php/AddXMLNote.php',
        data: { title: title, categoria: categoria, text: text, id: id },
        success: (data) => {
            console.log(data);
            //window.location.replace('../php/AddXMLNote.php');
        }
    });
    
}
