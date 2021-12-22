const addButton = document.getElementById("add");
let session;
function getId(insession) {
  session = insession;
  console.log(session);
}
$(document).ready(() => {
  $.get(`../xml//Notes.xml?id=${Math.random()}`, (xml) => {
    $(xml)
      .find("NoteUser")
      .each(function viewdata() {
        if ($(this).attr("correo") == session) {
          addNote(
            $(this).find("Text").text(),
            $(this).find("Text").attr("title"),
            $(this).find("Text").attr("categoria"),
            $(this).attr("id")
          );
        }
      });
  });

  addButton.addEventListener("click", () => {
    id = ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, (c) =>
      (
        c ^
        (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
      ).toString(16)
    );
    addNote(" ", " ", " ", id);
  });
});

function addNote(text = " ", title = " ", categoria = "", id) {
  const notas = document.getElementById("notas");
  const note = document.createElement("div");
  note.classList.add("note");

  note.innerHTML = `
        <div class="notes">
            <div class="tools">
                <input type= "text" placeholder="Titulo" value="${
                  title ? title : "Titulo"
                }" class="input-titulo"> 
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
                <form method="POST">
                  <div class='preview'>
                  <input class="imagen" id="file" type="file">
                  <img src="" id="img" width="100" height="100">
                  <input type="button" value="Guardar" id="btn_guardar">
                </form>
              </div>
            </div>
            <div class="main ${text ? "" : "hidden"}"></div>
            
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
  const updateBtn = note.querySelector(".update");

  textArea.value = text;
  main.innerHTML = text;

  editBtn.addEventListener("click", () => {
    main.classList.toggle("hidden");
    textArea.classList.toggle("hidden");
  });

  $("#btn_guardar").click(function () {
    var fd = new FormData();
    var files = $("#file")[0].files;

    // Check file selected or not
    if (files.length > 0) {
      fd.append("file", files[0]);

      $.ajax({
        url: "SubirFoto.php",
        type: "POST",
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
          alert(response);
          if (response != 0) {
            $("#img").attr("src", response);
            $(".preview img").show();
          } else {
            alert("No se ha podido subir el archivo!");
          }
        },
      });
    } else {
      alert("Por favor, selecciona una imagen");
    }
  });

  deleteBtn.addEventListener("click", () => {
    note.remove();
    console.log(id);
    deleteNote(id);
    updateLS();
    //updateLS();
  });
  textArea.addEventListener("input", (e) => {
    const { value } = e.target;
    main.innerHTML = value;
    updateLS();
  });

  updateBtn.addEventListener("click", () => {
    updateXML(textArea.value, htmltitle.value, htmlcategoria.value, id);
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
  categoria = categoria.trimStart();
  categoria = categoria.trimEnd();
  title = title.trimStart();
  title = title.trimEnd();
  text = text.trimStart();
  text = text.trimEnd();
  $.ajax({
    type: "POST",
    url: "../php/AddXMLNote.php",
    data: { title: title, categoria: categoria, text: text, id: id },
    success: (data) => {
      console.log(data);
      //window.location.replace('../php/AddXMLNote.php');
    },
  });
}
function deleteNote(id) {
  $.ajax({
    type: "POST",
    url: "../php/DeleteXMLNote.php",
    data: { id: id },
    success: (data) => {
      console.log(data);
    },
  });
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

const logoutButton = document.getElementById("logoutbtn");

logoutButton.addEventListener("click", () => {
  $.ajax({
    type: "GET",
    url: "../php/Logout.php",
    success: () => {
      alert("Se ha cerrado sesión correctamente, hasta otra !");
      window.location.href = "index.php";
    },
  });
});
