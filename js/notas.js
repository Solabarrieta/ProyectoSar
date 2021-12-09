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
                <input type= "text" placeholder="Titulo" class="input-titulo"> 
                <div class="div__buttons">

                    <input type="text" placeholder="Categoria" class="categoria" value="${
                      categoria ? categoria : ""
                    }">
                    <p class = "categoria>
                    <div class="buttons">
                        <button class="edit"><i class="fas fa-edit"></i></button>
                        <button class="delete"><i class="fas fa-trash-alt"></i></button>

                        
                    </div>
                </div>

                <div class='preview'>
                <input class="imagen" id="file" type="file">
                <img src="" id="img" width="100" height="100">
                <input type="button" value="Guardar" id="btn_guardar">
              </div>
            </div>
            <div class="main ${
              text ? "" : "hidden"
            }"><h1>fjdskljfasdlk</h1></div>

            <textarea class="${text ? "hidden" : ""}">

            </textarea>
        </div>
    `;
  const main = note.querySelector(".main");
  const textArea = note.querySelector("textarea");

  const editBtn = note.querySelector(".edit");
  const deleteBtn = note.querySelector(".delete");
  // const imagenBtn = note.querySelector(".imagen");

  textArea.value = text;
  main.innerHTML = text;

  editBtn.addEventListener("click", () => {
    console.log("ha pulsado el botón de editar");
    main.classList.toggle("hidden");
    textArea.classList.toggle("hidden");
    $.ajax({
      type: "POST",
      url: "../php/AddXMLNote.php",
      data: { title: title, categoria: categoria, text: text, id: id },
      success: (data) => {
        console.log(data);
        //window.location.replace('../php/AddXMLNote.php');
      },
    });
  });

  $("#btn_guardar").click(function () {
    let imagen = document.createElement("img");

    let fd = new FormData();
    let files = $("#file")[0].files;

    // Check file selected or not
    if (files.length > 0) {
      fd.append("file", files[0]);

      $.ajax({
        url: "../php/SubirFoto.php",
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response != 0) {
            $("#img").attr("src", response);
            $(".preview img").show(); // Display image element
          } else {
            alert("file not uploaded");
          }
        },
      });
    } else {
      alert("Please select a file.");
    }
  });

  deleteBtn.addEventListener("click", () => {
    console.log("ha pulsado el botón de borrar");
    note.remove();
    //updateLS();
  });

  textArea.value = text;
  main.innerHTML = text;
  notas.appendChild(note);
}

function filtrarNotas() {
  const busqueda = document.getElementById("busqueda").value;
  const div = document.getElementById("notas");

  div.innerHTML = " ";

  $.get("../xml/Notes.xml", (xml) => {
    $(xml)
      .find("NoteUser")
      .each(function viewdata() {
        const text = $(this).find("Text").text();
        const titulo = $(this).find("Text").attr("title");
        let categoria = $(this).find("Text").attr("categoria");
        if (busqueda == categoria) {
          addNote(text, titulo, categoria);
        }
      });
  });
}
