/**
 * @param {String} oeuvre 
 * @param {String} description
 */
export const addComment = (oeuvre,description,login) => {
    console.log(oeuvre+description+login)

    let headers = {
        //'Content-Type': 'application/json'
    }

    const options = {
        method: "GET",
        headers: headers,
    }

    const url = `js/ajax/ajax_addComment.php?oeuvre=${oeuvre}&description=${description}&login=${login}`

    return fetch(url, options).then((response) => {
        if(response.ok) {
            return response.json().then(function(json) {
                // traitement du JSON
                
                console.log("test: "+json);
                
                if(json){
                    let newDiv = document.createElement("div")
                    let span = document.createElement("span")
                    let listeCom = document.querySelector("div#listeCommentaires")

                    let strg = document.createElement("strong")
                    strg.innerHTML = login+" :"
                    newDiv.append(strg)
                    newDiv.append(document.createElement("br"))
                    //span.id = 'SpanAddedCom'
                    span.innerText=description
                    span.style="padding:0 0 0 20px"
                    newDiv.append(span)
                    listeCom.insertBefore(document.createElement("br"), listeCom.childNodes[0]);
                    listeCom.insertBefore(newDiv, listeCom.childNodes[0]);
                }
                else{
                    window.alert("Erreur Impossible d'inserer les commentaires")
                }
            }); 
        } else {
            console.log("[readFileOnServer] Erreur HTTP")
            return null
        }
    }).catch((reason) => {
        console.log("[readFileOnServer] Erreur Fetch:", reason)
    })

}
