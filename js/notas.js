const addButton = document.getElementById("add");

$(document).ready(() => {
    $.get('../xml/Notes.xml', (xml) => {
        $(xml)
            .find('NoteUser')
            .each(function viewdata() {
                addNote($(this).find('Text').text(),$(this).find('Text').attr("title"),$(this).find('Text').attr('categoria'),$(this).attr('id'));
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
                <input type= "text" placeholder="Titulo" value="${title ? "" : title}" class="input-titulo"> 
                <div class="div__buttons">
                    <input type="text" placeholder="Categoria" class="categoria" value>
                    <div class="buttons">
                        <button class="edit"><i class="fas fa-edit"></i></button>
                        <button class="delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="main ${
              text ? "" : "hidden"
            }"><h1>fjdskljfasdlk</h1></div>
            
            <input:text></input>
            <textarea class="${text ? "hidden" : ""}">

            </textarea>
        </div>
    `;
  const main = note.querySelector(".main");
  const textArea = note.querySelector("textarea");

  const editBtn = note.querySelector(".edit");
  const deleteBtn = note.querySelector(".delete");

    editBtn.addEventListener("click", () => {
        //console.log("ha pulsado el botón de editar");
        main.classList.toggle("hidden");
        textArea.classList.toggle("hidden");
        main.innerHTML=textArea.value;
        updateNotes();
        $.ajax({
            type: "POST",
            url: '../php/AddXMLNote.php',
            data: {title: title, categoria: categoria, text: text, id: id },
            success: (data)=>{
                console.log(data);
                //window.location.replace('../php/AddXMLNote.php');
            }
    });

    deleteBtn.addEventListener("click", () => {
        console.log("ha pulsado el botón de borrar");
        note.remove();
        
        });
        //updateLS();
    });

    textArea.value = text;
    main.innerHTML = text;
    document.body.appendChild(note);
}
function updateNotes() {
    const notesText = document.querySelectorAll("textarea");

    const notes = [];

    notesText.forEach((note) => {
        notes.push(note.value);
        console.log(note.value);
    });

  textArea.value = text;
  main.innerHTML = text;
  notas.appendChild(note);
}
