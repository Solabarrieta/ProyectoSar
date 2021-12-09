function ValidarSignUp(form)
{
 
  var userName = form.userName.value;
  var email = form.email.value;
  var password = form.password.value;
  var password2 = form.password2.value;


  

  if(userName=="" ||password=="" || password2==""||email==""){
    swal("Atención!","Tienes que rellenar todos los campos", "error");
    return false;
  }
    
  

  else if(email != "" && !VerificarCorreo(email)){
    swal("Atención!","El formato de la dirección de correo no es correcto", "error");
    return false;
  }
    


  
  else if(userName.length>5){
    swal("Atención!","El nombre de usuario solo puede tener 5 carácteres como máximo", "error");
    return false;
  }
  	
 

  else if(password.length>8){
    swal("Atención!","La contraseña solo puede tener 8 caracteres como máximo", "error");
    return false;
  }
  	
  	

  else if(password != "" && password2!="" && !VerificarPassword()){
    swal("Atención!","Las contraseñas no coinciden", "error");
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

function VerificarPassword(){
	var pass1= $('#password').val();
	var pass2= $('#password2').val();

	if(pass1!=pass2)
		return false;
	return true;


}




