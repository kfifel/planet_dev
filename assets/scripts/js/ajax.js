
 async function getMapping(URL){
     let ajax = new XMLHttpRequest();
     ajax.open('GET', URL, true);
     ajax.onreadystatechange = ()=>{
         if(ajax.status === 200 && ajax.readyState === 4 ) {
            return ajax.response;
         }
     }
     ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //format submitting form
     ajax.send();

 }

 async function postMapping(URL, data) {
     return await fetch(URL, {
         method: 'POST',
         headers: {
             'Content-Type': 'application/json' // body has a json format
         },
         body: JSON.stringify(data)
     });
 }