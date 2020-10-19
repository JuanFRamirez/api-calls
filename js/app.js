const url='http://localhost/project/rest_api_php/v1/task.php';
const container = document.querySelector('.container');
const submit = document.querySelector('.submit-button');



function getUser(){
    axios({
        method:'GET',
        url:url,
        responseType:'json'
    }).then(res=>{
        let result = res.data;
        container.innerHTML='';
        result.map(task=>{
            let div = document.createElement('div');
            let divBotones = document.createElement('div');

            divBotones.innerHTML='<button class="eliminar" onclick="eliminar('+task.id+')">Eliminar</button><button class="editar" data-id="'+task.id+'" data-name="'+task.name+'" data-desc="'+task.description+'">Editar</button>';
            console.log(task.id);
            let header = document.createElement('h4');
            header.textContent = task.name;

            let paragraph = document.createElement('p');
            paragraph.innerText = task.description;
            div.classList.add('holder');

            div.appendChild(header);
            div.appendChild(paragraph);
            div.appendChild(divBotones);

            container.appendChild(div);

            //editar
            
                
        })
    }).catch(err=>{console.log(err)})

}

getUser();
setTimeout(()=>{
    const editarButton = document.querySelectorAll('.editar');
    editarButton.forEach(function(editReady){
         

           editReady.addEventListener('click',function(e){
            let dataId = e.target.dataset.id;
            let dataName = e.target.dataset.name;
            let dataDesc = e.target.dataset.desc;

            let name = document.querySelector('input[name="name"]');
            let description = document.querySelector('input[name="desc"]');
            let submit = document.querySelector('.submit-button');
            let editAndSubmit = document.querySelector('.edit-button');
            name.value = dataName;
            description.value = dataDesc;
            submit.classList.add('hidden');

            editAndSubmit.addEventListener('click',e=>{
                e.preventDefault();
                let data={
                    id:dataId,
                    name:name.value,
                    description:description.value
                }
               editAxios(data);
            })
        });
    });
},1000)


function eliminar(index){
    axios({
        method:'DELETE',
        url:url + `?id=${index}`,
        responseType:'json'
    }).then(res=>{
        console.log(res);
        getUser();
    }).catch(err=>console.log(err));

}

submit.addEventListener('click',e=>{
    e.preventDefault();
    let name = document.querySelector('input[name="name"]').value;
    let description = document.querySelector('input[name="desc"]').value;
    if(name !=='' && description !==''){
        let id = container.childElementCount;

        let userTask = {
            id:id,
            name:name,
            description:description
        }
        axios({
            method:'POST',
            url:url,
            responseType:'json',
            data:userTask
        }).then(res=>{
            console.log(res);
            getUser();
            document.querySelector('input[name="name"]').value='';
            document.querySelector('input[name="desc"]').value='';
        }).catch(err=>{
            console.log(err);
        })


    }else{
        alert('debe llenar los campos');
    }
})

function editAxios(data){
    console.log(data);
    axios({
        method:'PUT',
        url:url + `?id=${data.id}`,
        responseType:'json',
        data:data
    }).then((res)=>{
        console.log(res);
        location.reload();
    })
    .catch(err=>console.log(err));
}

