function ValidarLogIn(form)
{
 

  var email = form.email.value;
  var password = form.password.value;


  if(password=="" || email==""){
    swal("Atención!","Tienes que rellenar todos los campos", "error");
    return false;
  }
  

  else if(email != "" && !VerificarCorreo(email)){
    swal("Atención!","El formato de la dirección de correo no es correcto", "error");
    return false;
  }
  

  else if(password.length>8){
    swal("Atención!","La contraseña solo puede tener 8 caracteres como máximo", "error");
    return false;
  }

  else
    return true;




}



function VerificarCorreo(correo)
{
  if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(correo))
    return true;
  return false;
  
}




