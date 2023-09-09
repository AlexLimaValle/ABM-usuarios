const table = document.querySelector(".tabla");

table.addEventListener("click",(e)=>{
    const {target} = e;
    if(target.classList.contains("boton")){
        const id = target.getAttribute("id");
        swal({
            title: "Seguro que quiere borrar?",
            text: "Una vez borrado no se recuperara",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Se borro correctamente", {
                icon: "success",
              });
              window.location.assign(`http://localhost/proyectos/app/secciones/empleados/index.php?empleID=${id}`);
            } else {
              swal("Se cancelo el borrado");
            }
          });
          

    }
})



