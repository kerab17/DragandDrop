<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <title> API Drag & Drop </title>
  
    </head>


    <body>
        <div class="container">
            <div id="pending-tasks" class="tasks">
                <h2 class="title">Pending Tasks</h2>

                <?php 
                $item = null;
                $valor = null;

                $Users = UsuarioCOntrolador:: ctrMostrarUsuario($item, $valor) ;
                foreach ($Users as $key => $value) {
                echo '<div id="'.$value['AirUserId'].'"  data-AirUserId="'.$value['AirUserId'].'"  class="task" draggable="true">'.$value['AirUserName'].'</div>';

                }



                 ?>
                
                
            </div>

            <div id="finished-tasks" class="tasks">
                <h2 class="title">Finished Tasks</h2>
            </div>
        </div>
     




    </body>

<script type="module">

  const pendingTasks = document.getElementById('pending-tasks')
            const finishedTasks = document.getElementById('finished-tasks')

            pendingTasks.addEventListener('dragstart',(e)=>{
                e.dataTransfer.setData('text/plain', e.target.id)
            })
            pendingTasks.addEventListener('drag', (e)=>{
                e.target.classList.add('active')
            })
            pendingTasks.addEventListener('dragend', (e)=>{
                e.target.classList.remove('active')
            })
            pendingTasks.addEventListener('dragover', (e)=>{
                e.preventDefault()
            })
            pendingTasks.addEventListener('drop', (e)=>{
                e.preventDefault()
                const elementReceived = document.getElementById(e.dataTransfer.getData('text'))

                const elementReceivedd = document.getElementById('task')

                //var idUser= 
                //console.log('iduser',idUser)
//var idUser=elementReceivedd.getAttribute('data-idUser')

           
             console.log('elementReceived',idUser)


















                  
                for (const element of pendingTasks.children) {
                    if( element == elementReceived ){
                        e.target.before(elementReceived)
                       // console.log('1',e.target.before(elementReceived))
                    }
                }

                for (const element of finishedTasks.children) {
                    if( element == elementReceived ){
                        pendingTasks.appendChild(finishedTasks.removeChild(elementReceived))
                        elementReceived.classList.remove('active')
                        //console.log('2',elementReceived.classList.remove('active'))
                    }
                }

            })


            finishedTasks.addEventListener('dragstart',(e)=>{
                e.dataTransfer.setData('text/plain', e.target.id)
            })
            finishedTasks.addEventListener('drag', (e)=>{
                e.target.classList.add('active')
            })
            finishedTasks.addEventListener('dragend', (e)=>{
                e.target.classList.remove('active')
            })
       
            finishedTasks.addEventListener('dragover', (e)=>{
                e.preventDefault()
            })
            
            finishedTasks.addEventListener('drop', (e)=>{
                e.preventDefault()
                const elementReceived = document.getElementById(e.dataTransfer.getData('text'))
                           
                


                for (const element of finishedTasks.children) {
                    if( element == elementReceived ){
                        e.target.before(elementReceived)
                    }
                }

                for (const iterator of pendingTasks.children) {
                    if( iterator == elementReceived ){
                        finishedTasks.appendChild(pendingTasks.removeChild(elementReceived))
                        elementReceived.classList.remove('active')
                    }
                }

            })




/*

$(".tasks").on("change", "div.task", function(){

                    var idCliente = $(this).attr("idCliente");

                    var datos = new FormData();
                  datos.append("idCliente", idCliente);

                    $.ajax({

                      url:"ajax/clientes.ajax.php",
                      method: "POST",
                      data: datos,
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType:"json",
                      success:function(respuesta){
                      
                         $("#idCliente").val(respuesta["id"]);
                           $("#editarCliente").val(respuesta["nombre"]);
                           $("#editarDocumentoId").val(respuesta["documento"]);
                           $("#editarEmail").val(respuesta["email"]);
                           $("#editarTelefono").val(respuesta["telefono"]);
                           $("#editarDireccion").val(respuesta["direccion"]);
                         $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
                      }

                    })
                    alert('hola')
                    
                })*/

</script>

</html>






<style type="text/css">
    
body{
    margin: 0;
    background-color: #ec407a;
    font-family: sans-serif;
    color: #fff;
    user-select: none;
}

.container{
    margin-top: 1rem;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.title{
    margin: 0 0 1rem;
    padding: 1rem;
    border-bottom: 1px solid #000;
    background-color: #7e57c2;
}


.tasks {
    width: 30%;
    text-align: center;
    background: rgb(48, 166, 221);
    border: 1px solid black;
    min-height: 130px;
}

.tasks:first-child {
    margin-right: 1rem;
}


.task {
    background-color: #7e57c2;
    padding: 1rem;
    border-bottom: 1px solid #000;
    cursor: move;
}


.task:first-child {
    border-top: 1px solid #000;
}

.task:last-child {
    border-bottom: none;
}


.active {
    background-color: #fff;
    color: #000;
}

</style>


