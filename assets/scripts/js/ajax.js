
 async function getMapping(URL){
     return await fetch(URL);
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